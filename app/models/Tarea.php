<?php
class Tarea {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM tareas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear($nombre, $descripcion) {
        $query = "INSERT INTO tareas (nombre, descripcion, estado) VALUES (:nombre, :descripcion, 'pendiente')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $descripcion, $estado) {
        $query = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM tareas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM tareas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}
?>