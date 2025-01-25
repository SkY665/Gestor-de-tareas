<?php
// Cambiar la ruta de inclusión de la librería FPDF
require_once 'C:/xampp/htdocs/gestor_tareas/vendor/fpdf/fpdf.php';  // Ruta completa
require_once 'C:/xampp/htdocs/gestor_tareas/config/Database.php';  // Ruta completa
require_once 'C:/xampp/htdocs/gestor_tareas/app/models/Tarea.php';  // Ruta completa
require_once __DIR__ . '/../../../config/autoload.php';  // Ruta correcta desde generar_pdf.php


// Crear la conexión a la base de datos
$database = new Database();
$tareaModel = new Tarea($database->getConnection());

// Crear el objeto PDF
$pdf = new FPDF(); // Crear objeto FPDF
$pdf->AddPage(); // Agregar una página
$pdf->SetFont('Arial', 'B', 16); // Establecer la fuente
$pdf->Cell(40, 10, 'Lista de Tareas');

// Obtener las tareas
$tareas = $tareaModel->listar();  // Método listar() debe devolver un PDOStatement con las tareas
while ($tarea = $tareas->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Ln();
    // Añadir información de la tarea al PDF
    $pdf->Cell(0, 10, "Tarea: {$tarea['nombre']} - Estado: {$tarea['estado']}", 0, 1);
}

// Salida del PDF
$pdf->Output('D', 'reporte_tareas.pdf');
?>

