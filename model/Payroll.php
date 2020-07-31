<?php


class Payroll
{
    private $id;
    private $basicSalary;
    private $insurance;
    private $overtimeMoney;
    private $fine;
    private $totalSalary;
    private $employeeNumber;
    private $day;

    public function __construct($basicSalary, $insurance, $overtimeMoney, $fine, $totalSalary, $employeeNumber, $day)
    {
        $this->basicSalary = $basicSalary;
        $this->insurance = $insurance;
        $this->overtimeMoney = $overtimeMoney;
        $this->fine = $fine;
        $this->totalSalary = $totalSalary;
        $this->employeeNumber = $employeeNumber;
        $this->day = $day;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBasicSalary()
    {
        return $this->basicSalary;
    }

    public function setBasicSalary($basicSalary)
    {
        $this->basicSalary = $basicSalary;
    }

    public function getInsurance()
    {
        return $this->insurance;
    }

    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
    }

    public function getOvertimeMoney()
    {
        return $this->overtimeMoney;
    }

    public function setOvertimeMoney($overtimeMoney)
    {
        $this->overtimeMoney = $overtimeMoney;
    }

    public function getFine()
    {
        return $this->fine;
    }

    public function setFine($fine)
    {
        $this->fine = $fine;
    }

    public function getTotalSalary()
    {
        return $this->totalSalary;
    }

    public function setTotalSalary($totalSalary)
    {
        $this->totalSalary = $totalSalary;
    }

    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    public function setEmployeeNumber($employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day)
    {
        $this->day = $day;
    }
}