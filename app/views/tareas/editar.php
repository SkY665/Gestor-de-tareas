<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'gestor_tareas';
$username = 'root';
$password = '';


$x = $_GET['id'];

try {
    // Establecer conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener las tareas
    $stmt = $pdo->query("SELECT * FROM tareas where id = '$x'");
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
    <title>Editar Tarea</title>
    <style>
        /* Estilos similares a los de crear.php */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #34495e;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Editar Tarea</h1>
    <?php
            
        foreach ($tareas as $tarea)
        
    ?>
    <form action="index.php?action=editar" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $tarea['nombre'] ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required><?= $tarea['descripcion'] ?></textarea>
        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="pendiente" <?= $tarea['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="completada" <?= $tarea['estado'] == 'completada' ? 'selected' : '' ?>>Completada</option>
        </select>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="index.php?action=listar">Volver a la lista</a>
</body>
</html>
