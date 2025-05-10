<?php
// Conexión a la base de datos
$host = 'localhost';
$nombreBD = 'hotel_contacto';
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8", $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM mensajes ORDER BY fecha DESC");
    $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mensajes Recibidos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f4f4f4;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #008080;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .container {
      max-width: 1000px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Mensajes Recibidos</h1>

    <?php if (count($mensajes) > 0): ?>
    <table>
      <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Mensaje</th>
        <th>Fecha</th>
      </tr>
      <?php foreach ($mensajes as $msg): ?>
      <tr>
        <td><?= htmlspecialchars($msg['nombre']) ?></td>
        <td><?= htmlspecialchars($msg['email']) ?></td>
        <td><?= htmlspecialchars($msg['telefono']) ?></td>
        <td><?= nl2br(htmlspecialchars($msg['mensaje'])) ?></td>
        <td><?= $msg['fecha'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
      <p style="text-align: center;">No hay mensajes registrados.</p>
    <?php endif; ?>
  </div>
</body>
</html>
