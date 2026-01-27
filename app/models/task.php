<?php 
    class Task
    {
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAll(): array{
            $stmt = $this->pdo->query("select * from tasks");

            return $stmt->fetchAll();
        }

        public function find(int $id): ?array{
            $stmt = $this->pdo->prepare("select * from tasks where id = :id");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch();

            return $user ?: null;
        }

        public function create(string $title, string $description, bool $is_done): bool{
            $stmt = $this->pdo->prepare("insert into tasks (title, description, is_done) values (:title, :description, :is_done)");

            return $stmt->execute([
                'title' => $title,
                'description' => $description,
                'is_done' => (int)$is_done
            ]);
        }

        public function update(int $id, string $title, string $description, bool $is_done): bool{
            $stmt = $this->pdo->prepare("update tasks set title = :title, description = :description, is_done = :is_done where id = :id");

            return $stmt->execute([
                'id' => $id,                
                'title' => $title,
                'description' => $description,
                'is_done' => (int)$is_done
            ]);
        }

        public function delete(int $id): bool{
            $stmt = $this->pdo->prepare("delete from tasks where id = :id");

            return $stmt->execute(['id' => $id]);
        }
    }