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


    public function target()
    {
            // a réparer 
            //$statement = $this->pdo->query("SELECT weapon_name FROM weapon JOIN target ON target.weapon_id = weapon.id");
            //return $statement->fetchAll();
    }
}
