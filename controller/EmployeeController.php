<?php


class EmployeeController
{
    public $employeeDB;

    public function __construct()
    {
        $conn = new DBConnection("mysql:host=localhost;dbname=case_study_2", "root", "Khongba0.");
        $this->employeeDB = new EmployeeDB($conn->connect());
    }

    public function index()
    {
        $employees = $this->employeeDB->getAll();
        $checkedEmployees = $this->employeeDB->getIdToday(date('yy-m-d'));
        include "view/employee-list.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $positionList = $this->employeeDB->getPositionList();
            include "view/add-employee.php";
        } else {
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $dateOfBirth = $_POST['date-of-birth'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $position = $_POST['position'];
            if ($_FILES['avatar']['name'] == "") {
                $avatarName = 'default.png';
            } else {
                $avatarName = time() . '-' . $_FILES['avatar']['name'];
            }
            $destination = "img/" . $avatarName;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
            $employee = new Employee($name, $gender, $dateOfBirth, $email, $phone, $address, $position);
            $employee->setAvatar($avatarName);
            $this->employeeDB->create($employee);
            header("Location: ./");
        }
    }

    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = $_GET['id'];
            $employee = $this->employeeDB->getByID($id);
            $positionList = $this->employeeDB->getPositionList();
            include 'view/edit-employee.php';
        } else {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $dateOfBirth = $_POST['date-of-birth'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $position = $_POST['position'];
            if ($_FILES['avatar'][$name] == "") {
                $avatarName = $_POST['old-avatar'];
            } else {
                $avatarName = time() . '-' . $_FILES['avatar']['name'];
                unlink('img/' . $_POST['old-avatar']);
            }
            $destination = "img/" . $avatarName;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
            $employee = new Employee($name, $gender, $dateOfBirth, $email, $phone, $address, $position);
            $employee->setAvatar($avatarName);
            $this->employeeDB->updateById($id, $employee);
            header('location:index.php');
        }
    }


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $employee = $this->employeeDB->getByID($id);
            $avatarName = $employee->getAvatar();
            if ($avatarName != 'default.png') {
                unlink('img/' . $avatarName);
            }
            $this->employeeDB->deleteById($id);
            header('Location: index.php');
        }
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $keyword = $_GET['keyword'];
            $employees = $this->employeeDB->search($keyword);
            $checkedEmployees = $this->employeeDB->getIdToday(date('yy-m-d'));
            include 'view/employee-list.php';
        }
    }
    public function addTimesheet()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = $_GET['id'];
            include "view/timekeeping.php";
        } else {
            $day = $_POST['day'];
            $offHours = $_POST['off-hours'];
            $overtimeHours = $_POST['overtime-hours'];
            $employeeNumber = $_POST['id'];
            if (!$this->employeeDB->getIdAndDayFromEmployeeTimesheet($employeeNumber, $day)) {
                $this->employeeDB->addToTimesheet($offHours, $overtimeHours, $employeeNumber, $day);
                header("Location: ./");
            } else {
                $_SESSION['message'] = 'This employee was checked today';
                header('Location: ./');
            }
        }
    }

    public function getSumWorkingToday()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $from = date('yy-m-d');
            $to = date('yy-m-d');
            $timesheets = $this->employeeDB->getSumWorkingDays($from, $to);
            include "view/timesheets.php";
        }
    }

    public function getSumWorkingSelectedDay()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $from = $_GET['from'];
            $to = $_GET['to'];
            $timesheets = $this->employeeDB->getSumWorkingDays($from, $to);
            include "view/timesheets.php";
        }
    }

    public function getSumWorkingDayBySelectedMonth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $month = $_GET['month'];
            $from = $month . '-01';
            $to = $month . '-31';
            $timesheets = $this->employeeDB->getSumWorkingDays($from, $to);
            $salaryCountedEmployees = $this->employeeDB->getEmployeeNumberFromPayroll($month);
            include "view/monthly-timesheets.php";
        }
    }

    public function getSumWorkingDayThisMonth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $from = date('yy-m') . '-01';
            $to = date('yy-m-d');
            $timesheets = $this->employeeDB->getSumWorkingDays($from, $to);
            $salaryCountedEmployees = $this->employeeDB->getEmployeeNumberFromPayroll(date('yy-m'));
            include "view/monthly-timesheets.php";
        }
    }

    public function editTimesheet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $day = $_GET['day'];
            $employeeNumber = $_GET['employeeNumber'];
            $timesheet = $this->employeeDB->getTimesheetIdByDay($employeeNumber, $day);
            include "view/edit-timesheet.php";
        } else {
            $working = $_POST['working'];
            $offHours = $_POST['off-hours'];
            $overtimrHours = $_POST['overtime-hours'];
            $id = $_POST['id'];
            $this->employeeDB->updateTimesheet($working, $offHours, $overtimrHours, $id);
            header("Location: ./index.php?page=timesheets");
        }
    }

    public function countSalary()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $workingDays = $_GET['workingDays'];
            $offHours = $_GET['offHours'];
            $overtimeHours = $_GET['overtimeHours'];
            $employeeNumber = $_GET['employeeNumber'];
            $employee = $this->employeeDB->getBasicSalary($employeeNumber);
            include "view/count-salary.php";
        } else {
            $basicSalary = $_POST['basic-salary'];
            $insurance = $_POST['insurance'];
            $overtimeMoney = $_POST['overtime-money'];
            $fine = $_POST['fine'];
            $totalSalary = $_POST['total-salary'];
            $employeeNumber = $_POST['employee-number'];
            $day = $_POST['day'];
            $payroll = new Payroll($basicSalary, $insurance, $overtimeMoney, $fine, $totalSalary, $employeeNumber, $day);
            if (!$this->employeeDB->getEmployeeNumberAndDay($employeeNumber, $day)) {
                $this->employeeDB->countSalary($payroll);
                header('Location: ./index.php?page=monthly-timesheets');
            } else {
                $_SESSION['message'] = 'This employee was counted this month';
                header('Location: ./index.php?page=monthly-timesheets');
            }
        }
    }

    public function getUserPayroll()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $day = date('yy-m');
            $employeeNumber = $_SESSION['user']['employeeNumber'];
            $payroll = $this->employeeDB->getPayrollByEmployeeNumber($employeeNumber, $day);
            include "user-payroll.php";
        }
    }

    public function searchPayroll()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $day = $_GET['day'];

        }
    }
}