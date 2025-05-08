$('#formLogin').submit(function(e) {
    e.preventDefault();

    var email = $.trim($('#email').val());
    var contraseña = $.trim($('#contraseña').val());

    if(email.length === 0 || contraseña.length === 0){
        Swal.fire({
            icon: 'warning',
            title: 'Debe ingresar un email y/o contraseña'
        });
        return false;
    } else {
        $.ajax({
            url: "login_usuario.php",
            type: "POST",
            dataType: "json",
            data: {
                email: email,
                contraseña: contraseña
            },
            success: function(data){
                if(data == null || data.status === "error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuario y/o contraseña incorrecto',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Conexión exitosa',
                        confirmButtonColor: '#3885d6',
                        confirmButtonText: 'Ingresar'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location.href = data.redirect;
                        }
                    });
                    
                }
            },
            error: function(xhr, status, error){
                console.log("Error en AJAX:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión al servidor'
                });
            }
        });
    }
});
