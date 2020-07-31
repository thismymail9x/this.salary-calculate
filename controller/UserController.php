<?php


class UserController
{
    public $userDB;

    public function __construct()
    {
        $conn = new DBConnection("mysql:host=localhost;dbname=case_study_2", "root", "123465");
        $this->userDB = new UserDB($conn->connect());
    }

    public function login()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $result = $this->userDB->get($username, $password);
        if ($result) {
            $_SESSION['user'] = $result;
            header('Location: ../');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include "view/change-password.php";
        } else {
            $error = 0;
            if (empty($_REQUEST["current-password"])) {
                $_SESSION['current-password-err'] = "*Current password is required";
                $error++;
            } else {
                $currentPassword = $_REQUEST["current-password"];
                if ($currentPassword != $_SESSION['user']['password']) {
                    $_SESSION['current-password-err'] = "*Current password is incorrect";
                    $error++;
                }
            }

            if (empty($_REQUEST["new-password"])) {
                $_SESSION['new-password-err'] = "*New password is required";
                $error++;
            } else {
                $newPassword = $_REQUEST["new-password"];
            }

            if (empty($_REQUEST["confirm-password"])) {
                $_SESSION['confirm-password-error'] = "*Confirm password is required";
                $error++;
            } elseif ($_REQUEST["confirm-password"] != $_REQUEST["new-password"]) {
                $_SESSION['confirm-password-error'] = "*Confirm your password";
                $error++;
            }

            if ($error == 0) {
                $this->userDB->update($newPassword, $_SESSION['user']['id']);
                $_SESSION['user']['password'] = $newPassword;
                $_SESSION['change-password-success'] = true;
                header("Location: ./");
            } else {
                include "view/change-password.php";
            }
        }
    }
}