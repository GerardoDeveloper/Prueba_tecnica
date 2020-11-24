<?php
require_once 'config/connection.php';

$connection = new ConnectionDataBase;

$destination_directory = "";
$file_name = $_FILES['file']['name'];

$name = $_POST['name'];
$cell = $_POST['cell'];
$email = $_POST['email'];
$reply = $_POST['reply'];
$file = $_FILES['file']['name'];

$post = (isset($name) && !empty($name)) && (isset($cell) && !empty($cell)) &&
    (isset($email) && !empty($email)) && (isset($reply) && !empty($reply)) &&
    (isset($file) && !empty($file));

if ($post) {
    upload_file();
    if ($destination_directory != null && $destination_directory != "") {
        $destination_directory = upload_file();
    }

    $sql = "INSERT into proveedor (name, cell, email, reply, url_file)
            values ('$name','$cell','$email','$reply', '$destination_directory')";
    $reply_query = mysqli_query($connection->connection_mysql(), $sql);

    if ($reply_query == 1) {
        echo "<script>alert('Nombre: $name\\nNº Celular: $cell\\nEmail: $email\\nRespuesta: $reply\\nArchivo: $$file_name')</script>";

        echo "<a href='index.html'>VOLVER</a>";
    }
} else {
    echo "<script>alert('Faltan datos de llenar')</script>";
    echo "<a href='index.html'>VOLVER</a>";
}

function upload_file()
{
    if (isset($_POST['enviar'])) {
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_temp_name = $_FILES['file']['tmp_name'];
        $file_error = $_FILES['file']['error'];

        $file_extension = explode('.', $file_name);
        $file_actual_extension = strtolower(end($file_extension));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'rar', 'zip', 'txt');

        if ($file_name != null) {
            if (in_array($file_actual_extension, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size <= 10000000) {
                        if (file_exists($file_name)) {
                            echo "El archivo ya se encuentra almacenado en la carpeta";
                        } else {
                            $file_name_new = uniqid('', true) . "." . $file_actual_extension;
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
                echo "No se puede subir un archivo con este tipo de extención. Debe ser: " . implode(", ", $allowed);
            }
        }

    } else {
        echo "Error";
    }
    return $destination_directory;
}
