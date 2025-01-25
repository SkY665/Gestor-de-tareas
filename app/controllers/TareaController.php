<?php
class TareaController {
    private $tareaModel;

    public function __construct() {
        $database = new Database();
        $this->tareaModel = new Tarea($database->getConnection());
    }

    public function listar() {
        $tareas = $this->tareaModel->listar();
        include '../app/views/tareas/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $this->tareaModel->crear($nombre, $descripcion);
            header("Location: index.php?action=listar");
        }
        include '../app/views/tareas/crear.php';
    }

    public function editar($id) {
//
        $tarea = $this->tareaModel->obtenerPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];

            $this->tareaModel->actualizar($id, $nombre, $descripcion, $estado);
            header("Location: index.php?action=listar");
        }            // Incluye la vista para editar el producto
            include '../app/views/tareas/editar.php';
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->tareaModel->eliminar($id);
        header("Location: index.php?action=listar");
    }

    public function generarPDF() {
        require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 19);
        $pdf->Cell(180, 10, 'Lista de Tareas', 0, 1, 'C', 0);
        $pdf->Ln();
        $tareas = $this->tareaModel->listar();

        $pdf->Cell(50, 12, "Nombre", 1, 0, 'C',0);
        $pdf->Cell(80, 12, "Descripcion", 1, 0, 'C',0);
        $pdf->Cell(60, 12, "Estado", 1, 0, 'C',0);

        while ($tarea = $tareas->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Ln();           
            $pdf->Cell(50, 12, "{$tarea['nombre']}", 1, 0, 'C', 0);
            $pdf->Cell(80, 12, "{$tarea['descripcion']}", 1, 0, 'C', 0);
            $pdf->Cell(60, 12, "{$tarea['estado']}", 1, 0, 'C', 0);
        }
        $pdf->Output('D', 'reporte_tareas.pdf');
    }
}
?>