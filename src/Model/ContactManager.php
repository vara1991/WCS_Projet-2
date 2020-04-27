<?php

namespace App\Model;

/**
 *
 */
class ContactManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'message';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
