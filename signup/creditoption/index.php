


<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/jquery.alphanum.js"></script>
    <script src="../../js/indexCreditOption.js"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        var response = null;
        if (response !== null) {
            if (response.status === 'success') {
                Swal.fire({
                    title: 'Éxito',
                    text: response.message,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            } else if (response.status === 'error') {
                Swal.fire({
                    title: '¡Tarjeta rechazada!',
                    text: 'Lo sentimos, la transacción no pudo ser procesada. Por favor, verifica los detalles de tu tarjeta o inténtalo nuevamente con otra.',
                    icon: 'error',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#e50914'
                });
            }
        }
    </script>
</body>

</html>