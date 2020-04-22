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
        $statement = $this->pdo->prepare("SELECT username,password,role_id FROM user 
        WHERE username=:username");
        $statement->bindValue('username', $_POST['pseudo']);
        $statement->execute();
        return $statement->fetch();
    }
}
