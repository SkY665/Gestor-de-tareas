<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea</title>
    <style>
        /* Cambio de fondo a un tono suave y moderno */
        body {
            font-family: Arial, sans-serif; /* Tipografía más moderna */
            background-color: #f4f6f9; /* Fondo suave para la página */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #2c3e50; /* Color más oscuro para los encabezados */
            text-align: center;
        }

        form {
            background-color: white; /* Fondo blanco para el formulario */
            padding: 20px;
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave para el formulario */
            width: 100%;
            max-width: 500px; /* Ancho máximo para el formulario */
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #34495e; /* Color más suave para las etiquetas */
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #3498db; /* Color azul para los botones */
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9; /* Color al pasar el mouse sobre el botón */
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
    <h1>Crear Tarea</h1>
    <form action="index.php?action=crear" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>
        <button type="submit">Crear Tarea</button>
    </form>
    <a href="index.php?action=listar">Volver a la lista</a>
</body>
</html>
