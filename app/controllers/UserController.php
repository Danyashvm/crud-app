<?php
    require_once __DIR__ . "/../models/user.php";

    class UserController
    {
        private User $userModel;
        
        public function __construct(PDO $pdo)
        {
            $this->userModel = new User($pdo);
        }

        public function index(): array
        {
            return $this->userModel->getAll();
        }   

        public function store(array $data): ?array
        {
            if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
                die("CSRF token mismatch");

            $error = [];
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');

            if($name === "")
                $error[] = "Имя обязательно";
            if($email === '')
                $error[] = "Email обязателен";
            if(!empty($error))
                return $error;
            
            $this->userModel->create($name, $email);

            header('Location: /../crud-app/public/index.php');
            exit;
        }

        public function edit(int $id) : ?array
        {
            return $this->userModel->find($id);
        }
        public function update(int $id, array $data): ?array
        {
            if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
                die("CSRF token mismatch");

            $error = [];

            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');

            if($name === "")
                $error[] = "Имя обязательно";
            if($email === '')
                $error[] = "Email обязателен";
            if(!empty($error))
                return $error;

            $this->userModel->update($id,$name,$email);

            header('Location: /../crud-app/public/index.php');
            exit;
        }

        public function destroy(int $id): void
        {
            $this->userModel->delete($id);
            
            header('Location: /../crud-app/public/index.php');
            exit;
        }
    }
?>