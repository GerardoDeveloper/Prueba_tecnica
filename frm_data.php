<?php
require 'connection/connection.php';

$connection = new ConnectionDataBase;

$name = $_POST['name'];
$cell = $_POST['cell'];
$email = $_POST['email'];
$reply = $_POST['reply'];
$file = $_FILES['file'];

$destination_directory = "";

if (isset($_POST['enviar'])) {
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_temp_name = $_FILES['file']['tmp_name'];
    $file_error = $_FILES['file']['error'];

    $file_extension = explode('.', $file_name);
    $file_actual_extension = strtolower(end($file_extension));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'rar', 'zip');

    if (in_array($file_actual_extension, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 10000000) {
                if (file_exists($file_name)) {
                    echo "El archivo ya se encuentra almacenado en la carpeta";
                } else {
                    $file_name_new = uniqid('', true).".".$file_actual_extension;
                    $destination_directory = 'uploads/' . $file_name_new;
                    move_uploaded_file($file_temp_name, $destination_directory);
                }
            } else {
                echo "El archivo es demaciado grande. Debe ser menor a 10MB";
            }
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "No se puede subir un archivo de ese tipo. Debe ser de tipo: " . implode(", ", $allowed);
    }
} else {
    echo "Error";
}


$sql = "INSERT into proveedor (name, cell, email, reply, url_file)
            values ('$name','$cell','$email','$reply', '$destination_directory')";
$reply_query = mysqli_query($connection->connection_mysql(), $sql);

if ($reply_query == 1) {
    echo "Archivo almacenado.<br/>";

    echo "<a href='index.html' class='button_volver'>VOLVER</a>";
}