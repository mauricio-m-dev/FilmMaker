<?php

namespace Controller;

use Model\User;
use Exception;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function createUser($user_fullname, $email, $password)
    {
        if (empty($user_fullname) or empty($email) or empty($password)) {
            return false;
        }

        return $this->userModel->registerUser($user_fullname, $email, $password);

    }

    public function checkUserByEmail($email)
    {
        return $this->userModel->getUserByEmail($email);
    }

    public function login($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);
        // var_dump($user);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION['user_fullname'] = $user['user_fullname'];
            $_SESSION['email'] = $user['email'];
            // var_dump($_SESSION);
            return true;
        }
        return false;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION["id"]);
    }

    public function getUserData($id, $user_fullname, $email)
    {
        return $this->userModel->getUserInfo($id, $user_fullname, $email);
    }
}
?>