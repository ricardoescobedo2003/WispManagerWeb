<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Verificar si el usuario ya existe
$sql_check_user = "SELECT * FROM usuarios WHERE username = '$username'";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows > 0) {
    // El usuario ya existe, realizar actualización
    $sql_update_user = "UPDATE usuarios SET password = '$password' WHERE username = '$username'";
    if ($conn->query($sql_update_user) === TRUE) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }
} else {
    // El usuario no existe, realizar inserción
    $sql_insert_user = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql_insert_user) === TRUE) {
        echo "Usuario creado correctamente.";
    } else {
        echo "Error al crear el usuario: " . $conn->error;
    }
}

$conn->close();
?>
