<?php
spl_autoload_register(function ($class_name) {
    // Convertir el nombre de la clase en una ruta de archivo
    $class_name = str_replace('\\', '/', $class_name);
    
    // Definir las rutas base donde se encuentran las clases
    $paths = [
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/models/',
        __DIR__ . '/', // Ruta para las clases en la carpeta config
    ];

    // Buscar la clase en las rutas base
    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Si no se encuentra la clase, lanzar una excepción
    throw new Exception("No se pudo cargar la clase: $class_name");
});
?>