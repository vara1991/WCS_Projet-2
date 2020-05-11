<?php

namespace App\Model;

/**
 *
 */
class HomeManager extends AbstractManager
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

    public function kill()
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT COUNT(*) AS dead_status FROM target WHERE status_id = 1");
        $statement->execute();
        return $statement->fetch();
    }

    public function bounty()
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT SUM(bounty) AS total_prime FROM target WHERE status_id = 1");
        $statement->execute();
        return $statement->fetch();
    }

    public function killByDate()
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT COUNT(date_kill) AS same_date, date_kill FROM target GROUP BY date_kill HAVING COUNT(date_kill)>1");
        $statement->execute();
        return $statement->fetch();
    }

    public function favWeapon()
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT MAX(weapon_name) AS favorite_weapon FROM weapon JOIN target ON weapon.id = target.weapon_id");
        $statement->execute();
        return $statement->fetch();
    }
}
