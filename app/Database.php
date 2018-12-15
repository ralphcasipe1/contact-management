<?php

namespace App;
use PDO;

class Database
{
    private $host = 'localhost';
    private $dbName = 'contact_management';
    private $username = 'root';
    private $password = 'supersun';
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $this->connection;
    }

    public function index()
    {
        $this->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'SELECT * FROM contacts ORDER BY contact_id DESC';

        return $this->connect()->query($sql);
    }

    public function store($name, $photo, $company, $phone, $address, $email)
    {
        $this->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO contacts (name, photo, company, phone, address, email) VALUES (?, ?, ?, ?, ?, ?)";

        $query = $this->connect()->prepare($sql);

        return $query->execute(array(
            $name, 
            $photo, 
            $company, 
            $phone, 
            $address, 
            $email
        ));
    }
    
    public function show($id)
    {
        $sql = "SELECT * FROM contacts where contact_id = ?";

        $query = $this->connect()->prepare($sql);

        $query->execute(array($id));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update($id, $name, $photo, $company, $phone, $address, $email)
    {
        $this->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "UPDATE contacts SET name = ?, photo = ?, company = ?, phone = ?, address = ?, email = ? WHERE contact_id = ?";

        $query = $this->connect()->prepare($sql);

        return $query->execute(array($name, $photo, $company, $phone, $address, $email, $id));
    }

    public function delete($id)
    {
        $this->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM contacts WHERE contact_id = ?";

        $query = $this->connect()->prepare($sql);

        return $query->execute(array($id));
    }

    private function disconnect()
    {
        $this->connection = null;
    }
    
    public function __destruct()
    {
        $this->disconnect();
    }
}

$database = new Database();