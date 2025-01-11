<?php
class Conexion{
    public function conectar(){
        define('server', 'localhost');
        define('db', 'uta_drive');
        define('user', 'root');
        define('password', '');
        try {
            $conn = new PDO("mysql:host=" . server . ";dbname=" . db , user , password);
            //echo "Estas conectado";
            return $conn;
        } catch (PDOException $e) {
            echo "No estas conectado" . $e->getMessage();
        }
    }
}

