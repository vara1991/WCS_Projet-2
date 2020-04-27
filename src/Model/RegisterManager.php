<?php

namespace App\Model;

class RegisterManager extends AbstractManager
{
    const TABLE_R = 'role';
    const TABLE_U = 'user';

    public function __construct()
    {
        parent::__construct(self::TABLE_R);
    }

    public function add()
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE_U . " (username,email,password,role_id) 
        VALUES (:username,:email,:password,:role_id)");

        $statement->bindValue('username', $_POST['pseudo']);
        $statement->bindValue('email', $_POST['email']);
        $statement->bindValue('password', $_POST['password']);
        $statement->bindValue('role_id', $_POST['role_id']);

        $statement->execute();
    }
}
