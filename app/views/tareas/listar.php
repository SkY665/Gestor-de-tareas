<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'gestor_tareas';
$username = 'root';
$password = '';

try {
    // Establecer conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener las tareas
    $stmt = $pdo->query("SELECT * FROM tareas");
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    $tareas = []; // En caso de error, asigna un array vacío a $tareas
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 30px;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
        }

        a {
            color: #3498db;
            font-size: 18px;
            text-decoration: none;
            margin-bottom: 20px;
            display: block;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilos de la tabla */
        table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 18px;
            color: #34495e;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #ecf0f1;
            border-bottom: 1px solid #ddd;
        }

        td a {
            color: #3498db;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            background-color: #f0f5f8;
        }

        td a:hover {
            background-color: #2980b9;
            color: white;
        }

        /* Estilos de los enlaces de navegación */
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .nav-links a {
            color: #3498db;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            background-color: #ecf0f1;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #2980b9;
            color: white;
        }

        .create-task {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #3498db;
            text-decoration: none;
        }

        .create-task:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Lista de Tareas</h1>
    <a href="index.php?action=crear" class="create-task">Crear Nueva Tarea</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tareas)): ?>
                <?php foreach ($tareas as $tarea): ?>
                <tr>
                    <td><?= htmlspecialchars($tarea['nombre']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td><?= htmlspecialchars($tarea['estado']) ?></td>
                    <td>
                        <!-- Enlace actualizado a editar.php -->
                        <a href="http://localhost/gestor_tareas/app/views/tareas/editar.php?id=<?= $tarea['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminar&id=<?= $tarea['id'] ?>">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center; font-size: 18px;">No hay tareas disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Enlaces de navegación -->
    <div class="nav-links">
    <a href="index.php?action=generarPDF" class="create-task">Generar PDF</a>
        <a href="index.php?action=crear">Crear Nueva Tarea</a>
    </div>
</body>
</html>
