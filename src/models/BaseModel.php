<?php

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = MySql::getInstance()->getConnection();
    }
}