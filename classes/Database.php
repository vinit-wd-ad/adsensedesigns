<?php

class Database
{

    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $table = '';
    private $conn = null;

    public function __construct($table)
    {
        $this->table = $table;
        $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        $smtp = $this->conn->prepare($sql);
        $smtp->execute($params);
        return $smtp;
    }

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $this->query($sql, $data);
        return $this->conn->lastInsertId();
    }

    public function update($data, $where)
    {
        if (empty($where)) {
            throw new Exception("WHERE condition required to prevent accidental mass update.");
        }

        $set = [];
        $whereClause = [];

        foreach ($data as $key => $value) {
            $set[] = "$key = :set_$key";
        }

        foreach ($where as $key => $value) {
            $whereClause[] = "$key = :where_$key";
        }

        $sql = "UPDATE $this->table SET " . implode(", ", $set) . " WHERE " . implode(" AND ", $whereClause);

        $params = [];

        foreach ($data as $key => $value) {
            $params["set_$key"] = $value;
        }

        foreach ($where as $key => $value) {
            $params["where_$key"] = $value;
        }

        return $this->query($sql, $params)->rowCount();
    }

    public function delete($where)
    {
        if (empty($where)) {
            throw new Exception("WHERE condition required to prevent accidental data loss.");
        }

        $sql = "DELETE FROM $this->table WHERE " . $this->whereClause($where);

        return $this->query($sql, $where)->rowCount();
    }

    public function fetchAll($columns = "*")
    {
        $sql = "SELECT $columns FROM $this->table";
        $res = $this->query($sql);
        return $res->fetchAll();
    }

    public function first()
    {
        $sql = "SELECT * FROM $this->table LIMIT 1";
        $res = $this->query($sql);
        return $res->fetch();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $res = $this->query($sql, ['id' => $id]);
        return $res->fetch();
    }

    public function where($where)
    {
        if (empty($where)) {
            throw new Exception("WHERE condition required");
        }

        $sql = "SELECT * FROM $this->table WHERE " . $this->whereClause($where);

        $res = $this->query($sql, $where);
        return $res->fetchAll();
    }

    private function whereClause($where)
    {
        $whereClause = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "$key = :$key";
        }

        return implode(" AND ", $whereClause);
    }

    public function whereCustom($where, $param)
    {
        if (empty($where)) {
            throw new Exception("WHERE condition required");
        }

        $sql = "SELECT * FROM $this->table WHERE " . $param;

        $res = $this->query($sql, $where);
        return $res->fetchAll();
    }
}
