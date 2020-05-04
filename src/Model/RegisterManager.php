<?php

namespace App\Model;

class RegisterManager extends AbstractManager
{
    const TABLE = 'user';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function add()
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (username,email,password,role_id) 
        VALUES (:username,:email,:password,:role)");

        $statement->bindValue('username', $_POST['pseudo']);
        $statement->bindValue('email', $_POST['email']);
        $statement->bindValue('password', $_POST['password']);
        $statement->bindValue('role', $_POST['role']);

        $statement->execute();
    }

    public function user()
    {
        $statement = $this->pdo->prepare("SELECT username FROM user WHERE username=:username");
        $statement->bindValue('username', $_POST['pseudo']);
        $statement->execute();
        return $statement->fetch();
    }
}
