<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la URL de la API del formulario
$url = $_POST['apiUrl'];

// Eliminar la parte de la URL después de "text="
$textIndex = strpos($url, "text=");
if ($textIndex !== false) {
    $url = substr($url, 0, $textIndex + 5);
}

// Preparar la consulta SQL para insertar la URL en la tabla apiKey
$sql = "INSERT INTO apiKey (url) VALUES ('$url')";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo "URL de la API guardada correctamente.";
} else {
    echo "Error al guardar la URL de la API: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
