<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'soporte_servitec';
$username = 'root';
$password = '1234';
$port = '3307';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: No se pudo conectar a la base de datos " . $e->getMessage());
}

// Procesar los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $proyecto = $_POST['proyecto'];
    $mensaje = $_POST['mensaje'];
    $tipo_moneda = $_POST['tipo_moneda'];

    // Preparar la consulta SQL para insertar los datos
    $stmt = $pdo->prepare("INSERT INTO cotizaciones (nombre, apellidos, email, telefono, proyecto, mensaje, tipo_moneda) 
                           VALUES (:nombre, :apellidos, :email, :telefono, :proyecto, :mensaje, :tipo_moneda)");

    // Bind de parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':proyecto', $proyecto);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->bindParam(':tipo_moneda', $tipo_moneda);

    // Ejecutar la consulta
    try {
        $stmt->execute();
        echo "Cotización guardada exitosamente.";
    } catch (PDOException $e) {
        echo "Error al guardar la cotización: " . $e->getMessage();
    }
}
?>
