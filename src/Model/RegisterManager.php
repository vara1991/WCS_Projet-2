<?php

namespace App\Model;

class RegisterManager extends AbstractManager
{
    const TABLE = 'user';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function add($register)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (username,email,password,role_id) 
        VALUES (:username,:email,:password,:role)");

        $statement->bindValue('username', $register['pseudo']);
        $statement->bindValue('email', $register['email']);
        $statement->bindValue('password', $register['password']);
        $statement->bindValue('role', $register['role']);

        $statement->execute();
    }

    public function user($speudo)
    {
        $statement = $this->pdo->prepare("SELECT username FROM user WHERE username=:username");
        $statement->bindValue('username', $speudo);
        $statement->execute();
        return $statement->fetch();
    }
}
