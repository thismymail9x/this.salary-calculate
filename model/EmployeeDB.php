<?php


class EmployeeDB
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($employee)
    {
        $sql = "INSERT INTO employees(name, gender, dateOfBirth, address, phone, email, positionId, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?);
                INSERT INTO users(username, password, employeeNumber) VALUES (?, LAST_INSERT_ID(), LAST_INSERT_ID())";
        $statement = $this->conn->prepare($sql);
        $name = $employee->getName();
        $email = $employee->getEmail();
        $dateOfBirth = $employee->getDateOfBirth();
        $phone = $employee->getPhone();
        $address = $employee->getAddress();
        $gender = $employee->getGender();
        $position = $employee->getPosition();
        $avatar = $employee->getAvatar();
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $gender);
        $statement->bindParam(3, $dateOfBirth);
        $statement->bindParam(4, $address);
        $statement->bindParam(5, $phone);
        $statement->bindParam(6, $email);
        $statement->bindParam(7, $position);
        $statement->bindParam(8, $avatar);
        $statement->bindParam(9, $email);
        $statement->execute();
    }

    public function getByID($id)
    {
        $sql = "SELECT * FROM employees WHERE employeeNumber = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();
        $row = $statement->fetch();
        $employee = new Employee ($row['name'], $row['gender'], $row['dateOfBirth'], $row['email'], $row['phone'],
            $row['address'], $row['positionId']);
        $employee->setEmployeeNumber($row['employeeNumber']);
        $employee->setAvatar($row['avatar']);
        return $employee;
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM users WHERE employeeNumber = ?;
                DELETE FROM payroll WHERE employeeNumber = ?;
                DELETE FROM employee_timesheet WHERE employeeNumber = ?;
                DELETE FROM employees WHERE employeeNumber = ?;";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->bindParam(2, $id);
        $statement->bindParam(3, $id);
        $statement->bindParam(4, $id);
        return $statement->execute();
    }

    public function updateById($id, $employee)
    {
        $sql = "UPDATE employees SET name = ?, email = ?, phone = ? ,address= ?, gender = ?, positionId = ?, dateOfBirth = ?, avatar = ? WHERE employeeNumber = ?";
        $statement = $this->conn->prepare($sql);
        $name = $employee->getName();
        $dateOfBirth = $employee->getDateOfBirth();
        $email = $employee->getEmail();
        $phone = $employee->getPhone();
        $address = $employee->getAddress();
        $gender = $employee->getGender();
        $position = $employee->getPosition();
        $avatar = $employee->getAvatar();
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $phone);
        $statement->bindParam(4, $address);
        $statement->bindParam(5, $gender);
        $statement->bindParam(6, $position);
        $statement->bindParam(7, $dateOfBirth);
        $statement->bindParam(8, $avatar);
        $statement->bindParam(9, $id);
        $statement->execute();
    }

    public function getAll()
    {
        $sql = "SELECT employeeNumber, employees.name, gender, dateOfBirth, email, phone, address, position.name AS position , avatar FROM employees JOIN position ON employees.positionId = position.positionId ORDER BY employeeNumber";
        $statement = $this->conn->query($sql);
        $row = $statement->fetchAll();
        $employees = [];
        foreach ($row as $item) {
            $employee = new Employee($item['name'], $item['gender'], $item['dateOfBirth'], $item['email'], $item['phone'],
                $item['address'], $item['position']);
            $employee->setEmployeeNumber($item['employeeNumber']);
            $employee->setAvatar($item['avatar']);
            $employees[] = $employee;
        }
        return $employees;
    }

    public function getPositionList()
    {
        $sql = "SELECT * FROM position";
        $statement = $this->conn->query($sql);
        return $statement->fetchAll();
    }

    public function search($keyword)
    {
        $sql = "SELECT employeeNumber, employees.name, gender, dateOfBirth, email, phone, address, position.name AS position , avatar FROM employees JOIN position ON employees.positionId = position.positionId WHERE employees.name LIKE '%$keyword%' OR employeeNumber = '$keyword'";
        $statement = $this->conn->query($sql);
        $result = $statement->fetchAll();
        $employees = [];
        foreach ($result as $item) {
            $employee = new Employee($item['name'], $item['gender'], $item['dateOfBirth'], $item['email'], $item['phone'],
                $item['address'], $item['position']);
            $employee->setEmployeeNumber($item['employeeNumber']);
            $employee->setAvatar($item['avatar']);
            $employees[] = $employee;
        }
        return $employees;
    }

    public function addToTimesheet($offHours, $overtimeHours, $employeeNumber, $day)
    {
        $sql = "INSERT INTO timesheets (offHours, overtimeHours) VALUES (?, ?);
                INSERT INTO employee_timesheet (employeeNumber, timesheetId, day) VALUES (?, LAST_INSERT_ID(), ?)";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $offHours);
        $statement->bindParam(2, $overtimeHours);
        $statement->bindParam(3, $employeeNumber);
        $statement->bindParam(4, $day);
        $statement->execute();
    }

    public function getIdAndDayFromEmployeeTimesheet($id, $day)
    {
        $sql = "SELECT timesheetId FROM employee_timesheet WHERE employeeNumber = ? AND day = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->bindParam(2, $day);
        $statement->execute();
        return $statement->fetch();
    }

    public function getEmployeeNumberAndDay($employeeNumber, $day)
    {
        $sql = "SELECT id FROM payroll WHERE employeeNumber = ? AND day = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $employeeNumber);
        $statement->bindParam(2, $day);
        $statement->execute();
        return $statement->fetch();
    }

    public function getIdToday($day)
    {
        $sql = 'SELECT employeeNumber FROM employee_timesheet WHERE day = ?';
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $day);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getEmployeeNumberFromPayroll($day)
    {
        $sql = "SELECT employeeNumber FROM payroll WHERE day = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $day);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSumWorkingDays($from, $to)
    {
        $sql = "select employees.employeeNumber, name, SUM(working) AS workingDays, SUM(offHours) AS offHours, SUM(overtimeHours) AS overtimeHours FROM employees
                JOIN employee_timesheet ON employees.employeeNumber = employee_timesheet.employeeNumber
                JOIN timesheets ON employee_timesheet.timesheetId = timesheets.id WHERE day >= ? AND DAY <= ? GROUP BY employees.employeeNumber";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $from);
        $statement->bindParam(2, $to);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getTimesheetIdByDay($employeeNumber, $day)
    {
        $sql = "SELECT timesheets.id, working, offHours, overtimeHours FROM employees
                JOIN employee_timesheet ON employees.employeeNumber = employee_timesheet.employeeNumber
                JOIN timesheets ON timesheets.id = employee_timesheet.timesheetId WHERE day = ? AND employees.employeeNumber = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $day);
        $statement->bindParam(2, $employeeNumber);
        $statement->execute();
        return $statement->fetch();
    }

    public function updateTimesheet($working, $offHours, $overtimeHours, $id)
    {
        $sql = "UPDATE timesheets SET working = ?, offHours = ?, overtimeHours = ? WHERE id = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $working);
        $statement->bindParam(2, $offHours);
        $statement->bindParam(3, $overtimeHours);
        $statement->bindParam(4, $id);
        $statement->execute();
    }

    public function getBasicSalary($employeeNumber)
    {
        $sql = "SELECT employeeNumber, employees.name, salary FROM employees JOIN position ON employees.positionId = position.positionId WHERE employeeNumber = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $employeeNumber);
        $statement->execute();
        return $statement->fetch();
    }

    public function countSalary($payroll)
    {
        $sql = "INSERT INTO payroll(basicSalary, insurance, overtimeMoney, fine, totalSalary, employeeNumber, day) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);
        $basicSalary = $payroll->getBasicSalary();
        $insurance = $payroll->getInsurance();
        $overtimeMoney = $payroll->getOvertimeMoney();
        $fine = $payroll->getFine();
        $totalSalary = $payroll->getTotalSalary();
        $employeeNumber = $payroll->getEmployeeNumber();
        $day = $payroll->getDay();
        $statement->bindParam(1, $basicSalary);
        $statement->bindParam(2, $insurance);
        $statement->bindParam(3, $overtimeMoney);
        $statement->bindParam(4, $fine);
        $statement->bindParam(5, $totalSalary);
        $statement->bindParam(6, $employeeNumber);
        $statement->bindParam(7, $day);
        $statement->execute();
    }

    public function getPayrollByEmployeeNumber($employeeNumber, $day)
    {
        $sql = "SELECT * FROM payroll WHERE employeeNumber = ? AND day = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $employeeNumber);
        $statement->bindParam(2, $day);
        $statement->execute();
        return $statement->fetch();
    }
}






