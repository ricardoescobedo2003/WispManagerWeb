<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Obtener los datos enviados por el formulario
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se hayan recibido los datos requeridos
if (isset($data['nombre'], $data['no_recibo'])) {
  $nombre = $data['nombre'];
  $no_recibo = $data['no_recibo'];

  // Crear conexión a la base de datos
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Consultar el no_cliente, nombre y mensualidad del cliente
  $sql = "SELECT no_cliente, nombre, mensualidad FROM clientes WHERE nombre = '$nombre'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $no_cliente = $row['no_cliente'];
    $nombre_cliente = $row['nombre'];
    $mensualidad = $row['mensualidad'];

    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d');

    // Insertar datos en la tabla de pagos
    $insert_sql = "INSERT INTO pagos (no_cliente, nombre, fecha, monto, no_recibo) VALUES ($no_cliente, '$nombre_cliente', '$fecha_actual', $mensualidad, '$no_recibo')";

    if ($conn->query($insert_sql) === TRUE) {
      // Envío de mensaje por WhatsApp si el registro es correcto
      $phone = "5214961121843"; // Número de teléfono al que se enviará el mensaje
      $message = urlencode("El cliente: $nombre_cliente realizó su pago con éxito el día $fecha_actual por la cantidad de: $mensualidad con NO Recibo: $no_recibo.");
      $apikey = "4387760"; // Tu API Key de CallMeBot
      $url = "https://api.callmebot.com/whatsapp.php?phone=$phone&text=$message&apikey=$apikey";

      $response = file_get_contents($url);

      if ($response === false) {
          echo json_encode(['message' => 'Pago registrado con éxito, pero error al enviar el mensaje por WhatsApp.']);
      } else {
          echo json_encode(['message' => 'Pago registrado con éxito y mensaje enviado por WhatsApp.']);
      }
    } else {
      echo json_encode(['message' => 'Error al registrar el pago: ' . $conn->error]);
    }
  } else {
    echo json_encode(['message' => 'No se encontró al cliente con ese nombre']);
  }

  // Cerrar conexión
  $conn->close();
} else {
  echo json_encode(['message' => 'Falta información para procesar la solicitud']);
}
?>
