<?php
namespace Model;
   
use Model\Connection;

use PDO;
use PDOException;
use Expection;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function registerUser($user_fullname, $email, $password)
    {
        try {
            $sql = 'INSERT INTO user (user_fullname, email, password) VALUES (:user_fullname, :email, :password)';

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $connection = $this->db->prepare($sql);

            $connection->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
            $connection->bindParam(':email', $email, PDO::PARAM_STR);
            $connection->bindParam(':password', $hashPassword, PDO::PARAM_STR);

            return $connection->execute();
        } catch (PDOException $error) {
            die("Erro ao registrar usuário: " . $error->getMessage());
            return false;
        } 
    }   

    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";

            $connection = $this->db->prepare($sql);

            $connection->bindParam(':email', $email, PDO::PARAM_STR);

            $connection->execute();

            return $connection->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
        }
    }

    public function getUserInfo($id, $user_fullname, $email)
    {
        try {
            $sql = "SELECT user_fullname FROM user WHERE id = :id AND user_fullname = :user_fullname AND email = :email = :email";

            $connection = $this->db->prepare($sql);

            $connection->bindParam(':id', $id, PDO::PARAM_INT);
            $connection->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
            $connection->bindParam(':email', $email, PDO::PARAM_STR);

            $connection->execute();

            return $connection->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Erro ao obter informações do usuário: " . $error->getMessage());
            return false;
        }
    }
}
?>