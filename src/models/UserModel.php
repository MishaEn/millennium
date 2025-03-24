<?php

class UserModel extends BaseModel
{
    public function getOrders(int $id): array
    {
        $query = '
            SELECT
                CONCAT_WS(" ", u.first_name, u.second_name) AS "clientName",
                p.title,
                p.price
            FROM
                user u
                LEFT JOIN user_order uo ON uo.user_id = u.id
                LEFT JOIN products p ON p.id = uo.product_id
            WHERE
                u.id = :id
            ORDER BY
                p.title ASC,
                p.price DESC
        ';

        $stms = $this->pdo->prepare($query);
        $stms->execute(['id' => $id]);
        $orders = $stms->fetchAll(PDO::FETCH_ASSOC);

        return $orders;        
    }
}