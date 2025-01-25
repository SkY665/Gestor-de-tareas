<?php
class AuthController {
    private $usuarioModel;

    public function __construct() {
        $database = new Database();
        $this->usuarioModel = new Usuario($database->getConnection());
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->usuarioModel->registrar($nombre, $email, $password)) {
                header("Location: index.php?action=login");
            } else {
                echo "Error en el registro.";
            }
        }
        include '../app/views/auth/registro.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $usuario = $this->usuarioModel->login($email, $password);
            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php?action=listar");
            } else {
                echo "Credenciales incorrectas.";
            }
        }
        include '../app/views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
    }
}
?>