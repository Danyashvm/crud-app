<?php
require_once __DIR__ . '/../models/user.php';

class AuthController{
    private User $userModel;

    public function __construct(PDO $pdo){
        $this->userModel = new User($pdo);
    }

    public function login(array $data): ?string {
        if(!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']){
            return "Ошибка безопасности (CSRF)";
        }

        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if($email === '' || $password === ''){
            return 'Введите email и пароль';
        }

        $user = $this->userModel->findByEmail($email);

        if(!$user || password_verify($password, $user[$password])){
            return 'Неверный email или пароль';
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: ?page=tasks");
        exit;
    }

    public function logout(): void{
        session_destroy();
        header("Location: ?page=login");
        exit;
    }
}

?>