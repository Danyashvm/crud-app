<?php
    class User{
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAll(): array{
            $stmt = $this->pdo->query("SELECT * FROM users order by id desc");

            return $stmt->fetchAll();
        }

        public function find(int $id): ?array{
            $stmt = $this->pdo->prepare("select * from users where id = :id");

            $stmt->execute(['id' => $id]);

            $user = $stmt->fetch();

            return $user ?: null;
        }

        public function create(string $name, string $email): bool{
            $stmt = $this->pdo->prepare("insert into users (name, email) values (:name, :email)");

            return $stmt->execute([
                'name' => $name,
                'email' => $email
            ]);
        }

        public function update(int $id, string $name, string $email): bool{
            $stmt = $this->pdo->prepare("update users set name = :name, email = :email where id = :id");

            return $stmt->execute([
                "name" => $name,
                "email" => $email,
                "id" => $id
            ]);
        }

        public function delete(int $id):bool{
            $stmt = $this->pdo->prepare("delete from users where id = :id");

            return $stmt->execute([
                "id" => $id
            ]);
        }
    }
?>