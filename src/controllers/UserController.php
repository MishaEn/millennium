<?php

class UserController extends BaseController
{
    public function getUserOrders(): array
    {
        $orders = $this->model->getOrders($this->params['id']);

        return [
            'orders' => $orders,
        ];
    }
}