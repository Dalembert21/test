<?php
include_once "conexion.php";

class ModeloAdministrador {
    public static function registroEmpleado() {
        try {
            if (!isset($_POST['cedula_Empleado']) || !isset($_POST['nombre_Empleado'])) {
                echo json_encode(['mensaje' => 'Faltan datos']);
                return;
            }

            $cedulaEmpleado = $_POST['cedula_Empleado'];
            $nombreEmpleado = $_POST['nombre_Empleado'];
            $apellidoEmpleado = $_POST['apellido_Empleado'];
            $correoEmpleado = $_POST['correo_Empleado'];
            $claveEmpleado = $_POST['clave_Empleado'];
            
            $rol = 'Empleado';  
            $objetoConexion = new Conexion();
            $con = $objetoConexion->conectar();
        
            $sql = "INSERT INTO empleados (cedula_Empleado, nombre_Empleado, apellido_Empleado, correo_Empleado, clave_Empleado, rol) VALUES (?, ?, ?, ?, ?, ?)";
            $datos = $con->prepare($sql);

            if ($datos->execute([$cedulaEmpleado, $nombreEmpleado, $apellidoEmpleado, $correoEmpleado, $claveEmpleado, $rol])) {
                echo json_encode(['mensaje' => 'Empleado creado correctamente']);
            } else {
                echo json_encode(['mensaje' => 'Empleado no creado: error al ejecutar la consulta']);
            }

        } catch (PDOException $e) {
            echo json_encode(['mensaje' => 'Error: ' . $e->getMessage()]);
        }
    }
}


?>

