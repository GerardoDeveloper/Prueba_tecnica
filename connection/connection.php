<?php
class ConnectionDataBase
{

  function connection_mysql(){
    $user_name = "nSU4vkr4le";
    $data_base = "nSU4vkr4le";
    $password = "uroft4fNtO";
    $server_name = "remotemysql.com";
    $port = '3306';

    // $user_name = "root";
    // $data_base = "prueba_formulario";
    // $password = "";
    // $server_name = "localhost";


    $connection = mysqli_connect($server_name, $user_name, $password, $data_base, $port);

    if (!$connection) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $connection;
  }
}

