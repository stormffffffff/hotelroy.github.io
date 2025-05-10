<?php
// =============================
// Conexión a la base de datos
// =============================

$host = 'localhost';
$nombreBD = 'hotel_contacto';
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8", $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// =============================
// Procesamiento del formulario
// =============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✅ CAMBIADOS a los mismos nombres del formulario HTML
    $nombre  = trim($_POST['nombre']);
    $email   = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $mensaje = trim($_POST['mensaje']);
    
    if (empty($nombre) || empty($email) || empty($telefono) || empty($mensaje)) {
        die("Error: Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: El formato del correo electrónico no es válido.");
    }

    $sql = "INSERT INTO mensajes (nombre, email, telefono, mensaje, fecha) 
            VALUES (:nombre, :email, :telefono, :mensaje, :fecha_envio)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $fecha_envio = date('Y-m-d H:i:s');
        $stmt->bindParam(':fecha_envio', $fecha_envio, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: contacto.html?enviado=1");
        exit();
    } catch (PDOException $e) {
        echo "Error al guardar el mensaje: " . $e->getMessage();
    }
} else {
    echo "Acceso inválido.";
}
