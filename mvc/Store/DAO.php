<?php

require_once ('DB/DB.php');

class DAO {

    private $connection;

    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    
    public function query($sql)
    {        
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function selectById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(1, $id);
        $stm->execute();
        $res = $stm->fetch();
        if ($res == false) {
            return null;
        }
        return $res;
    }

    
    public function store($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stm = $this->connection->prepare($sql);

        $index = 1;
        foreach ($data as $value) {
            $stm->bindValue($index++, $value);
        }

        $stm->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(1, $id);
        $stm->execute();
    }

    public function update($id, $data)
    {
        $setStatements = [];
        foreach ($data as $column => $value) {
            $setStatements[] = "{$column} = ?";
        }

        $setClause = implode(', ', $setStatements);
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stm = $this->connection->prepare($sql);

        $index = 1;
        foreach ($data as $value) {
            $stm->bindValue($index++, $value);
        }
        $stm->bindValue($index, $id);

        $stm->execute();
    }
        
}
