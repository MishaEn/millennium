<?php

class BaseController
{
    protected $params = [];
    protected BaseModel $model;

    public function __construct(array $params, BaseModel $model)
    {
        $this->params = $params;
        $this->model = $model;
    }
}