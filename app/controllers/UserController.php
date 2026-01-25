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

        public function store(array $data): void
        {
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');

            if($name == "" || $email == "")
                return;
            
            $this->userModel->create($name, $email);

            header('Location: /../crud-app/public/index.php');
            exit;
        }

        public function edit(int $id) : ?array
        {
            return $this->userModel->find($id);
        }
        public function update(int $id, array $data): void
        {
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');
            if($name == "" || $email == "")
                return;

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