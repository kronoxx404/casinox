<?php
/**
 * DbAdapter - Allows existing mysqli code to talk to PostgreSQL via PDO.
 * Handles: prepare, query, bind_param, execute, get_result, fetch_assoc, etc.
 */

class DbAdapter
{
    private $pdo;
    public $connect_error = null;
    public $error = null;
    public $insert_id = 0;

    public function __construct($host, $user, $pass, $db)
    {
        $this->connect($host, $user, $pass, $db);
    }

    public function connect($host, $user, $pass, $db)
    {
        // Check for Render.com environment variable for database URL
        $dbUrl = getenv('DATABASE_URL'); // e.g. postgres://user:pass@host:port/dbname

        try {
            if ($dbUrl) {
                // Parse standard Postgres URL
                $opts = parse_url($dbUrl);
                $dsn = "pgsql:host=" . $opts['host'] . ";port=" . ($opts['port'] ?? 5432) . ";dbname=" . ltrim($opts['path'], '/');
                $user = $opts['user'];
                $pass = $opts['pass'];
            } else {
                // Fallback to manual credentials (or local if configured that way)
                // Note: If running locally with MySQL credentials passed in, this might fail if we don't have a local Postgres.
                // Assuming we are moving to Postgres, we use the passed args but with pgsql driver.
                $dsn = "pgsql:host=$host;dbname=$db";
            }

            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect_error = null;
        } catch (PDOException $e) {
            $this->connect_error = $e->getMessage();
            // In mysqli, connection failure doesn't always throw, but sets connect_error.
            // We'll mimic that.
        }
    }

    public function prepare($sql)
    {
        try {
            // Postgres uses $1, $2 instead of ?
            // We need to replace ? with $1, $2, etc. ONLY if it's not inside quotes.
            // A simple regex replacement for ? -> $n

            // Simple replacement loop for now.
            $paramCount = 0;
            $sql = preg_replace_callback('/\?/', function ($matches) use (&$paramCount) {
                $paramCount++;
                // return '$' . $paramCount; 
                return '?'; // Actually, PDO supports '?' for positional placeholders natively even in PgSQL driver usually?
                // Let's stick to '?' first. PDO pgsql driver supports it.
            }, $sql);

            $stmt = $this->pdo->prepare($sql);
            return new DbStmtAdapter($stmt, $this); // Pass $this to set error/insert_id
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function query($sql)
    {
        try {
            $stmt = $this->pdo->query($sql);
            return new DbResultAdapter($stmt);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function close()
    {
        $this->pdo = null;
    }

    // Helper to escape strings if absolutely needed (try to use prepared statements!)
    public function real_escape_string($string)
    {
        if (!$this->pdo)
            return $string;
        // PDO doesn't have a direct equivalent that returns a string without quotes easily, 
        // strictly speaking `quote` returns it quoted.
        // For compatibility, we trim the quotes. 
        $quoted = $this->pdo->quote($string);
        // Remove first and last char (quotes)
        return substr($quoted, 1, -1);
    }
}

class DbStmtAdapter
{
    private $pdoStmt;
    private $dbAdapter;
    private $boundParams = [];
    public $insert_id = 0; // Simulate mysqli_stmt::$insert_id

    public function __construct($pdoStmt, $dbAdapter)
    {
        $this->pdoStmt = $pdoStmt;
        $this->dbAdapter = $dbAdapter;
    }

    public function bind_param($types, ...$vars)
    {
        // mysqli uses types string ("ssi"), PDO just needs values.
        // We store them to bind/execute later.
        $this->boundParams = $vars;
        // Handle case where vars might need to be references if we were strictly following mysqli, 
        // but for now capturing values is safest for simple migration.
        return true;
    }

    private $boundResults = [];

    public function bind_result(&...$vars)
    {
        $this->boundResults = $vars;
        return true;
    }

    public function fetch()
    {
        if (!$this->pdoStmt)
            return false;

        $row = $this->pdoStmt->fetch(PDO::FETCH_NUM);

        if ($row) {
            foreach ($this->boundResults as $key => &$val) {
                $val = $row[$key] ?? null;
            }
            return true;
        }
        return false;
    }

    public function execute()
    {
        try {
            /* 
               PDO execute() can take an array of values for positional parameters (?).
               The boundParams from bind_param should match the '?' order.
            */
            $params = $this->boundParams;

            if ($this->pdoStmt->execute($params)) {
                // Update insert_id
                // Note: PostgreSQL requires sequence name sometimes if not standard 'id', 
                // but usually lastInsertId() works for SERIAL if called without args on recent drivers/versions or with default.
                try {
                    $id = $this->dbAdapter->getPdo()->lastInsertId();
                    $this->insert_id = $id;
                    $this->dbAdapter->insert_id = $id;
                } catch (Exception $e) {
                    // Ignore if no insert id available
                }
                return true;
            }
            return false;
        } catch (PDOException $e) {
            $this->dbAdapter->error = $e->getMessage();
            return false;
        }
    }

    public function get_result()
    {
        return new DbResultAdapter($this->pdoStmt);
    }

    public function close()
    {
        $this->pdoStmt = null;
    }
}

class DbResultAdapter
{
    private $pdoStmt;

    public function __construct($pdoStmt)
    {
        $this->pdoStmt = $pdoStmt;
    }

    public $num_rows; // Need to populate this? 
    // PDO rowCount() is reliable for DELETE/UPDATE, but not always SELECT in all databases.
    // Postgres PDO usually supports rowCount for Selects.

    public function fetch_assoc()
    {
        return $this->pdoStmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetch_array($mode = PDO::FETCH_BOTH)
    {
        // mysqli default is FETCH_BOTH
        return $this->pdoStmt->fetch($mode);
    }

    // Add properties dynamically if needed
    public function __get($name)
    {
        if ($name === 'num_rows') {
            return $this->pdoStmt->rowCount();
        }
        return null;
    }
}
?>