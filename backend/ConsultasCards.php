<?php
include_once "conexion.php";

header('Content-Type: application/json'); 

class ModeloVehiculos {

    public static function obtenerVehiculos() {
        try {
            $objetoConexion = new Conexion();
            $con = $objetoConexion->conectar();
    
            $sql = "SELECT 
                v.matricula_vehiculo,
                v.titulo_vehiculo,
                v.imagen_vehiculo,
                v.año_vehiculo,
                v.color_vehiculo,
                v.combustible_vehiculo,
                v.pasajeros_vehiculo,
                v.transmision_vehiculo,
                v.precio_vehiculo,
                t.tipo_vehiculo,
                d.estado_disponibilidad,
                det.marca_vehiculo,
                det.modelo_vehiculo,
                det.caracteristicas
            FROM 
                vehiculos v
            JOIN 
                tipo_vehiculos t ON v.id_tipo_vehiculo = t.id_tipo_vehiculo
            JOIN 
                disponibilidad_vehiculo d ON v.id_disponibilidad_pertenece = d.id_disponibilidad_vehiculo
            JOIN 
                detalle_vehiculo det ON v.matricula_vehiculo = det.matricula_vehiculo";
    
            $stmt = $con->prepare($sql);
            $stmt->execute();
    
            $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($vehiculos);
        } catch (PDOException $e) {
            echo json_encode(['mensaje' => 'Error al obtener vehículos: ' . $e->getMessage()]);
        }
    }

    public static function obtenerTiposVehiculos() {
        $objetoConexion = new Conexion();
        $con = $objetoConexion->conectar();
        $sql = "SELECT DISTINCT tipo_vehiculo FROM tipo_vehiculos";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Similar para obtener los años de vehículos
    public static function obtenerAniosVehiculos() {
        $objetoConexion = new Conexion();
        $con = $objetoConexion->conectar();
        $sql = "SELECT DISTINCT año_vehiculo FROM vehiculos ORDER BY año_vehiculo DESC";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Similar para obtener transmisiones
    public static function obtenerTransmisiones() {
        $objetoConexion = new Conexion();
        $con = $objetoConexion->conectar();
        $sql = "SELECT DISTINCT transmision_vehiculo FROM vehiculos";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Similar para obtener combustibles
    public static function obtenerCombustibles() {
        $objetoConexion = new Conexion();
        $con = $objetoConexion->conectar();
        $sql = "SELECT DISTINCT combustible_vehiculo FROM vehiculos";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>