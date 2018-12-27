<?php

namespace App\Models;

class Contact
{
    private $id;
    private $name;
    private $company;
    private $phone;
    private $address;
    private $email;

    public function __construct($data = [])
    {
        if (isset($data['contact_id'])) {
            $this->id = $data['contact_id'];
            $this->name = $data['name'];
            $this->company = $data['company'];
            $this->phone = $data['phone'];
            $this->address = $data['address'];
            $this->email = $data['email'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function toArray()
    {
        return [
            'contact_id' => $this->getId(),
            'name' => $this->getName(),
            'company' => $this->getCompany(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'email' => $this->getEmail(),
        ];
    }
}