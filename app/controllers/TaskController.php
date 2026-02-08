<?php
    require_once __DIR__ . '/../models/task.php';

    class TaskController{
        private Task $taskModel;

        public function __construct(PDO $pdo)
        {
            $this->taskModel = new Task($pdo);
        }

        public function index(): array{
            return $this->taskModel->getAll();
        }

        public function store(array $data): ?array{
            if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
                die("CSRF token mismatch");

            $error = [];
            
            $title = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $is_done = isset($data['is_done']) ? 1 : 0;

            if($title === ''){
                $error[] = "Название обязательно";
            }
            if($description === ''){
                $error[] = "Описание обязательно";
            }
            if(!empty($error)){
                return $error;
            }

            $this->taskModel->create($title, $description, $is_done);
            
            header('Location: ?page=tasks');
            exit;
        }

        public function edit(int $id): ?array{
            return $this->taskModel->find($id);
        }

        public function update(int $id, array $data): ?array{
            if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
                die("CSRF token mismatch");
            $error = [];
            
            $title = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $is_done = trim($data['is_done'] ?? '0');

            if($title === ''){
                $error[] = "Название обязательно";
            }
            if($description === ''){
                $error[] = "Описание обязательно";
            }
            if(!empty($error)){
                return $error;
            }

            $this->taskModel->update($id, $title, $description, $is_done);

            header("Location: ../public/index.php?page=tasks");
            exit;
        }

        public function destroy(int $id): void{
            $this->taskModel->delete($id);

            header("Location: ../public/index.php?page=tasks");
            exit;
        }
    }