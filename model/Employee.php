<?php


class Employee
{
    private $employeeNumber;
    private $name;
    private $gender;
    private $email;
    private $phone;
    private $address;
    private $position;
    private $avatar;
    private $dateOfBirth;

    public function __construct($name, $gender, $dateOfBirth, $email, $phone, $address, $position)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->position = $position;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setEmployeeNumber($employeeId)
    {
        $this->employeeNumber = $employeeId;
    }

    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPosition()
    {
        return $this->position;
    }


}

