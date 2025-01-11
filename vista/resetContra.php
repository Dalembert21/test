<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "Token no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'http://localhost/app-Alquiler-Autos/backend/apiRest.php',
                    method: 'POST',
                    data: {
                        accion: 'resetearContrasena',
                        token: $('input[name="token"]').val(),
                        new_password: $('#new_password').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.mensaje) {
                            $('#message').html(response.mensaje);
                        } else {
                            $('#message').html('Error desconocido.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                        $('#message').html('Error en la solicitud: ' + textStatus);
                    }
                });
            });
        });
    </script>
  <body class="login-body">
    <div class="recover-password-form">
        <h2 class="reset-password-title">Restablecer Contraseña</h2>
        <form id="resetPasswordForm" class="reset-password-form" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" class="reset-password-token">
            
            <label for="new_password" class="reset-password-label">Nueva Contraseña:</label>
            <input type="password" id="new_password" name="new_password" class="reset-password-input" required>
            
            <button type="submit" class="reset-password-button">Restablecer</button>
        </form>
        <div id="message" class="reset-password-message"></div>
    </div>
</body>
</html>
