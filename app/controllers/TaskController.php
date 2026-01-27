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

        public function store(array $data): void{
            $title = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $is_done = isset($data['is_done']) ? 1 : 0;

            if($title == "" || $description == "")
                return;

            $this->taskModel->create($title, $description, $is_done);
            
            header('Location: ../public/index.php?page=tasks');
            exit;
        }

        public function edit(int $id): ?array{
            return $this->taskModel->find($id);
        }

        public function update(int $id, array $data): void{
            $title = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $is_done = trim($data['is_done'] ?? '0');

            if($title == "" || $description == "")
                return;

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