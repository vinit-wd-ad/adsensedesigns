<?php

class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    // store Table name
    public $table;

    public function __construct($table_name = null)
    {
        $this->table = $table_name; 
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;

            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }
    }

    // Base query function (for Internal using)
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function fetchAll($columns = "*", $where = "", $params = [])
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if (!empty($where)) {
            $sql .= " WHERE $where";
        }

        return $this->query($sql, $params)->fetchAll();
    }

    public function fetchOne($where, $params = [], $columns = "*")
    {
        $sql = "SELECT $columns FROM {$this->table} WHERE $where LIMIT 1";
        return $this->query($sql, $params)->fetch();
    }

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        $this->query($sql, $data);
        return $this->conn->lastInsertId();
    }

    public function update($data, $where, $whereParams = [])
    {
        $updateFields = '';
        foreach ($data as $key => $value) {
            $updateFields .= "$key = :$key, ";
        }
        $updateFields = rtrim($updateFields, ', ');

        $sql = "UPDATE {$this->table} SET $updateFields WHERE $where";

        $params = array_merge($data, $whereParams);
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function delete($where, $params = [])
    {
        $sql = "DELETE FROM {$this->table} WHERE $where";
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}
?>