<?php

class ProductModel extends BaseModel
{
    public function addProduct(array $product): void
    {
        $query = 'INSERT INTO products (title, price) VALUES (:title, :price)';
        $stms = $this->pdo->prepare($query);
        $stms->execute(['title' => $product['title'], 'price' => $product['price']]);     
    }
}