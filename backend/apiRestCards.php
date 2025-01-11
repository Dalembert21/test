<?php
include_once "ConsultasCards.php";
header('Content-Type: application/json'); 

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'obtenerVehiculos':
        ModeloVehiculos::obtenerVehiculos();
        break;
    case 'obtenerTiposVehiculos':
        ModeloVehiculos::obtenerTiposVehiculos();
        break;
    case 'obtenerAniosVehiculos':
        ModeloVehiculos::obtenerAniosVehiculos();
        break;
    case 'obtenerTransmisiones':
        ModeloVehiculos::obtenerTransmisiones();
        break;
    case 'obtenerCombustibles':
        ModeloVehiculos::obtenerCombustibles();
        break;
    default:
        echo json_encode(['mensaje' => 'Acción no válida']);
}
?>