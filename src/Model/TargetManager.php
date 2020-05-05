<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class TargetManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'target';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    public function getWeapon($id)
    {
        $statement = $this->pdo->prepare("SELECT weapon_name FROM weapon WHERE id=:weapon_id");
        $statement->bindValue('weapon_id', $id, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetchAll();
        }
    }

    public function getStatus($id)
    {
        $statement = $this->pdo->prepare("SELECT status_name FROM status WHERE id=:status_id");
        $statement->bindValue('status_id', $id, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetchAll();
        }
    }

    public function getImg($id)
    {
        $statement = $this->pdo->prepare("SELECT img FROM target WHERE id=:img;");
        $statement->bindValue('img', $id, \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $statement->fetchAll();
        }
    }

    public function getDead()
    {
        $statement = $this->pdo->query('SELECT name FROM target WHERE status_id = 1');

        return $statement->fetchAll();
    }

    public function getAlive()
    {
        $statement = $this->pdo->query('SELECT name FROM target WHERE status_id=2');

        return $statement->fetchAll();
    }
}
