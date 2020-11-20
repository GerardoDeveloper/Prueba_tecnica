<?php
class ConnectionDataBase
{

  function connection_mysql(){
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $data_base = "prueba_formulario";

    $connection = mysqli_connect($server_name, $user_name, $password, $data_base);

    if (!$connection) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $connection;
  }
}

