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
class AdminManager extends AbstractManager
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


    /**
     * @param array $item
     * @return int
     */
    public function insert(array $item): int
    {
        // prepared request

        if ($_POST['status_id'] == 2) {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(`name`, `bio`, `status_id`, `bounty`, `img`) VALUES (:name, :bio, :status_id, :bounty, :img)");
            $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
            $statement->bindValue('status_id', $item['status_id'], \PDO::PARAM_INT);
            $statement->bindValue('bounty', $item['bounty'], \PDO::PARAM_STR);
            $statement->bindValue('bio', $item['bio'], \PDO::PARAM_STR);
            $statement->bindValue('img', $item['img'], \PDO::PARAM_STR);

            if ($statement->execute()) {
                return (int)$this->pdo->lastInsertId();
            }
        } else {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(`name`, `bio`, `status_id`, `bounty`, `date_kill`, `weapon_id`, `img`) VALUES (:name, :bio, :status_id, :bounty, :date_kill, :weapon_id, :img)");
            $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
            $statement->bindValue('status_id', $item['status_id'], \PDO::PARAM_INT);
            $statement->bindValue('bounty', $item['bounty'], \PDO::PARAM_STR);
            $statement->bindValue('date_kill', $item['date_kill'], \PDO::PARAM_STR);
            $statement->bindValue('weapon_id', $item['weapon_id'], \PDO::PARAM_INT);
            $statement->bindValue('bio', $item['bio'], \PDO::PARAM_STR);
            $statement->bindValue('img', $item['img'], \PDO::PARAM_STR);

            if ($statement->execute()) {
                return (int)$this->pdo->lastInsertId();
            }
        }
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $item
     * @return bool
     */
    public function update(array $item): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE  " . self::TABLE . " SET `name` = :name, `bio` = :bio, `status_id` = :status_id, `bounty` = :bounty, `date_kill` = :date_kill, `weapon_id` = :weapon_id, `img` = :img WHERE id= :id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('status_id', $item['status_id'], \PDO::PARAM_INT);
        $statement->bindValue('bounty', $item['bounty'], \PDO::PARAM_STR);
        $statement->bindValue('date_kill', $item['date_kill'], \PDO::PARAM_STR);
        $statement->bindValue('weapon_id', $item['weapon_id'], \PDO::PARAM_INT);
        $statement->bindValue('bio', $item['bio'], \PDO::PARAM_STR);
        $statement->bindValue('img', $item['img'], \PDO::PARAM_STR);


        return $statement->execute();
    }
}
