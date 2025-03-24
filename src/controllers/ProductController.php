<?php

class ProductController extends BaseController
{
    public function addProducts(): void
    {
        $products = $this->params;

        foreach ($products as $product) {
            // Убрать в валидатор
            if (!isset($product['title']) || !isset($product['price'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Где данные, Лебовски?']);
            }
        
            $this->model->addProduct($product);
        }
    }
}