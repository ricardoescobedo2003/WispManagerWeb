<?php

$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$idc = $_POST['idc'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$localidad = $_POST['localidad'];
$fechaInstalacion = $_POST['fechaInstalacion'];
$equipos = $_POST['equipos'];
$mensualidad = $_POST['mensualidad'];
$comentarios = $_POST['comentarios'];
// Insertar datos en la tabla clientes
$sql = "INSERT INTO clientes (no_cliente, nombre, direccion, telefono, fechaInstalacion, equipos, mensualidad, localidad, comentarios) VALUES ('$idc', '$nombre', '$direccion', '$telefono', '$fechaInstalacion', '$equipos', '$mensualidad', '$localidad', '$comentarios')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente guardado correctamente";
} else {
    echo "Error al guardar el cliente: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
