<?php
include_once "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Modelo{ 
    public static function registrarUsuario(){
        try {
            // Recoger los datos del formulario
            $nombreRegistro = $_POST['nombre_Registro'];
            $apellidoRegistro = $_POST['apellido_Registro'];
            $correoRegistro = $_POST['correo_Registro'];
            $contraseñaRegistro = $_POST['clave_Registro'];
        
            // Conectar a la base de datos
            $objetoConexion = new Conexion();
            $con = $objetoConexion->conectar();
        
            // Preparar la consulta SQL
            $sql = "INSERT INTO usuarios (nombre_Registro, apellido_Registro, correo_Registro, clave_Registro) VALUES (?, ?, ?, ?)";
            $datos = $con->prepare($sql);
        
            // Ejecutar la consulta con los datos
            if ($datos->execute([$nombreRegistro, $apellidoRegistro, $correoRegistro, $contraseñaRegistro])) {
                // Usuario creado con éxito
                echo json_encode(['mensaje' => 'Usuario creado exitosamente']);
            } else {
                // Manejo de errores en caso de fallo en la ejecución
                echo json_encode(['mensaje' => 'Usuario no creado: error al ejecutar la consulta']);
            }
        } catch (PDOException $e) {
            // Manejo de excepciones
            echo json_encode(['mensaje' => 'Usuario no registrado: ' . $e->getMessage()]);
        }
    }

    public static function loginUsuario() {
        try {
            $correoRegistro = $_POST['correo_Registro'];
            $contraseñaRegistro = $_POST['clave_Registro'];

            // Conectar a la base de datos
            $objetoConexion = new Conexion();
            $con = $objetoConexion->conectar();

            // Preparar la consulta SQL
            $sql = "SELECT nombre_Registro FROM usuarios WHERE correo_Registro = ? AND clave_Registro = ?";
            $dato = $con->prepare($sql);
            $dato->execute([$correoRegistro, $contraseñaRegistro]);

            // Verificar si se encontró al usuario
            if ($dato->rowCount() > 0) {
                // Obtener el nombre del usuario autenticado
                $usuario = $dato->fetch(PDO::FETCH_ASSOC);
                $nombreUsuario = $usuario['nombre_Registro'];

                // Usuario autenticado correctamente
                echo json_encode(['mensaje' => 'Usuario autenticado', 'nombre' => $nombreUsuario]);
            } else {
                // Credenciales incorrectas
                echo json_encode(['mensaje' => 'Credenciales incorrectas']);
            }
        } catch (PDOException $e) {
            echo json_encode(['mensaje' => 'Error al iniciar sesión: ' . $e->getMessage()]);
        }
    }

    public static function recuperarContrasena($email) {
        try {
            // Conectar a la base de datos
            $objetoConexion = new Conexion();
            $con = $objetoConexion->conectar();

            // Verificar si el correo existe
            $sql = "SELECT * FROM usuarios WHERE correo_Registro = ?";
            $stmt = $con->prepare($sql);
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                // Generar un token único para el restablecimiento
                $token = bin2hex(random_bytes(50)); // Generar un token seguro

                // Aquí puedes almacenar el token en la base de datos y asignarle una fecha de expiración
                $sqlToken = "UPDATE usuarios SET reset_token = ?, reset_token_expiration = NOW() + INTERVAL 1 HOUR WHERE correo_Registro = ?";
                $stmtToken = $con->prepare($sqlToken);
                $stmtToken->execute([$token, $email]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'kevinganan2901@gmail.com'; // Tu correo de Gmail
                $mail->Password = 'bgunglmzxoiujinv'; // Usa la contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                
                // Configuración del remitente y destinatario
                $mail->setFrom('kevinganan2901@gmail.com', 'UTA DRIVE');
                $mail->addAddress($email); // El correo de destino
                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Recuperación de Contraseña';
                $mail->Body = "Haz clic en este enlace para restablecer tu contraseña: 
                <a href='http://localhost/app-Alquiler-Autos/vista/resetContra.php?token=$token'>Restablecer Contraseña</a>";
                
                // Enviar el correo
                $mail->send();
                echo json_encode(['mensaje' => 'Se ha enviado un enlace para restablecer la contraseña a tu correo']);
            } else {
                echo json_encode(['mensaje' => 'El correo no está registrado']);
            }
        } catch (PDOException $e) {
            echo json_encode(['mensaje' => 'Error al recuperar contraseña: ' . $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['mensaje' => 'Error al enviar el correo: ' . $mail->ErrorInfo]);
        }
    }


}





?>