<?php

namespace App\Model;


class LogManager extends AbstractManager
{
    const TABLE = 'user';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function login()
    {

        $statement = $this->pdo->prepare("SELECT username,password FROM user WHERE username=:username AND password=:password");
        $statement->bindValue('username', $_POST['pseudo']);
        $statement->bindValue('password', $_POST['password']);
        $statement->execute();

        return $statement->fetch();
    }

}
