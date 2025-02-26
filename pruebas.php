<?php
// Configuración de conexión a la base de datos
$host = 'localhost';
$dbname = 'mi_base_datos';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Recibir datos de los filtros
$filtroFecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$filtroCodigoPostal = isset($_GET['codigo_postal']) ? $_GET['codigo_postal'] : '';
$filtroEstado = isset($_GET['estado']) ? $_GET['estado'] : '';
$busquedaNombre = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$ordenarAlfa = isset($_GET['ordenar_alfa']) ? $_GET['ordenar_alfa'] : '';
$antesFecha = isset($_GET['antes_fecha']) ? $_GET['antes_fecha'] : '';

// Construir consulta dinámica con filtros
$query = "SELECT * FROM usuarios WHERE 1=1";
$params = [];

// Agregar filtros dinámicos según la solicitud
if ($filtroFecha) {
    $query .= " AND fecha = :fecha";
    $params[':fecha'] = $filtroFecha;
}

if ($filtroCodigoPostal) {
    $query .= " AND codigo_postal = :codigo_postal";
    $params[':codigo_postal'] = $filtroCodigoPostal;
}

if ($filtroEstado) {
    $query .= " AND estado = :estado";
    $params[':estado'] = $filtroEstado;
}

if ($busquedaNombre) {
    $query .= " AND nombre LIKE :busqueda";
    $params[':busqueda'] = "%" . $busquedaNombre . "%";
}

// Agregar el filtro de fecha anterior a '2023-11-23'
if ($antesFecha) {
    $query .= " AND fecha < '2023-11-23'";
}

// Ordenar alfabéticamente
if ($ordenarAlfa) {
    $query .= " ORDER BY nombre ASC";
}

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filtrar Datos</title>
  <style>
    table {
      width: 100%;
      border: 1px solid black;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    button {
      margin: 5px;
    }

    input, select, label {
      margin: 5px;
    }
  </style>
</head>
<body>
  <h1>Filtrar Datos desde SQL con Nuevos Filtros</h1>
  
  <!-- Formulario para filtros -->
  <form method="GET">
    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
      <option value="">-- Seleccionar --</option>
      <option value="activo">Activo</option>
      <option value="inactivo">Inactivo</option>
    </select>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha">

    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" id="codigo_postal">

    <label for="busqueda">Buscar por Nombre:</label>
    <input type="text" name="busqueda" id="busqueda">

    <label for="ordenar_alfa">Ordenar Alfabéticamente:</label>
    <input type="checkbox" name="ordenar_alfa" id="ordenar_alfa">

    <label for="antes_fecha">Mostrar solo fechas anteriores a 2023-11-23:</label>
    <input type="checkbox" name="antes_fecha" id="antes_fecha">

    <button type="submit">Aplicar Filtros</button>
  </form>
  
  <!-- Tabla para mostrar los datos -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Código Postal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datos as $item): ?>
        <tr>
          <td><?php echo htmlspecialchars($item['id']); ?></td>
          <td><?php echo htmlspecialchars($item['nombre']); ?></td>
          <td><?php echo htmlspecialchars($item['estado']); ?></td>
          <td><?php echo htmlspecialchars($item['fecha']); ?></td>
          <td><?php echo htmlspecialchars($item['codigo_postal']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
