<?php

namespace App\Models;

use PDO;

class Database
{
    /**
     * @var PDO $pdo
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE contact_id = $id");

        $success = $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return ($success) ? $row : [];
    }

    public function fetchAll($table)
    {
        $sql = "SELECT * FROM $table";

        $statement = $this->pdo->prepare($sql);

        $success = $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return ($success) ? $rows : [];
    }

    public function create($table, $data)
    {
        $columns = array_keys($data);

        $columnSql = implode(',', $columns);

        $bindingSql = ':' . implode(',:', $columns);

        $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";

        $statement = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $status = $statement->execute();
        
        // return ($status) ? $this->pdo->lastInsertId() : false;
        return [
            'id' => $this->pdo->lastInsertId(),
        ];
    }

    public function update($table, $id, $data)
    {
        if (isset($data['contact_id']))
            unset($data['contact_id']);
        $columns = array_keys($data);
        $columns = array_map(function($item){
            return $item.'=:'.$item;
        }, $columns);
        $bindingSql = implode(',', $columns);
        $sql = "UPDATE $table SET $bindingSql WHERE contact_id = :contact_id";
        $stm = $this->pdo->prepare($sql);
        $data['contact_id'] = $id;
        foreach ($data as $key => $value){
            $stm->bindValue(':'. $key, $value);
        }
        $status = $stm->execute();
        return $status;
    }

    public function delete($table, $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
    }

    public function save($table, $data)
    {
        if (isset($data['contact_id'])) {
            $this->update($table, $data['contact_id'], $data);
        } else {
            return $this->create($table, $data);
        }
    }
}