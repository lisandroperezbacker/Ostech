$(document).ready(function () {
    $('#formRegister').on('submit', function (e) {
        e.preventDefault(); // Previene el envío tradicional

        $.ajax({
            url: 'register_usuario.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'login.html'; // Redirección
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo completar el registro.'
                });
            }
        });
    });
});
