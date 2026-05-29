<?php

class Installer
{
    public static function initSetup()
    {
        $host     = DB_HOST;
        $dbName   = DB_NAME;
        $username = DB_USER;
        $password = DB_PASS;

        try {

            // Database Connection
            $dsn = "mysql:host=" . $host;

            $pdo = new PDO($dsn, $username, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Create Database
            $pdo->exec("
                CREATE DATABASE IF NOT EXISTS `$dbName`
                CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci;
            ");

            // Select Database
            $pdo->exec("USE `$dbName`;");

            // Create Admins Table
            $tableQuery = "
                CREATE TABLE IF NOT EXISTS `admins` (

                    `id` INT AUTO_INCREMENT PRIMARY KEY,

                    `name` VARCHAR(100) NOT NULL,

                    `username` VARCHAR(50) NOT NULL UNIQUE,

                    `email` VARCHAR(100) NOT NULL UNIQUE,

                    `role` ENUM('Super Admin','Admin','Moderator')
                    DEFAULT 'Admin',

                    `status` ENUM('Active','Pending','Blocked')
                    DEFAULT 'Active',

                    `password` VARCHAR(255) NOT NULL,

                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                ) ENGINE=InnoDB;
            ";

            $pdo->exec($tableQuery);

            // Check Default Admin Exists
            $stmt = $pdo->query("SELECT COUNT(*) AS total FROM `admins`");

            $result = $stmt->fetch();

            // Insert Default Admin
            if ($result['total'] == 0) {

                $defaultName     = 'Admin';
                $defaultUser     = 'admin';
                $defaultEmail    = 'admin@example.com';
                $defaultRole     = 'Super Admin';
                $defaultStatus   = 'Active';
                $defaultPassword = password_hash('admin123', PASSWORD_BCRYPT);

                $insertQuery = "
                    INSERT INTO `admins`
                    (
                        `name`,
                        `username`,
                        `email`,
                        `role`,
                        `status`,
                        `password`
                    )

                    VALUES
                    (
                        :name,
                        :username,
                        :email,
                        :role,
                        :status,
                        :password
                    )
                ";

                $insertStmt = $pdo->prepare($insertQuery);

                $insertStmt->execute([
                    'name'     => $defaultName,
                    'username' => $defaultUser,
                    'email'    => $defaultEmail,
                    'role'     => $defaultRole,
                    'status'   => $defaultStatus,
                    'password' => $defaultPassword
                ]);
            }
        } catch (PDOException $e) {

            die("Setup Initialization Failed: " . $e->getMessage());
        }
    }
}
