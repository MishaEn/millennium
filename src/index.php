<?php

spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/databases/',
    ];

    $class = str_replace('\\', '/', $class);

    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$requestUri = $_SERVER['REQUEST_URI'];

// TODO: Сделать нормальный роутинг

if (strpos($requestUri, '/api/user/') === 0) {
    $parts = explode('/', $requestUri);
    $id = $parts[3];

    $model = new UserModel();
    $user = new UserController(['id' => $id], $model);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($user->getUserOrders());
}

if (strpos($requestUri, '/api/products') === 0) {
    $input = file_get_contents('php://input');
    $products = json_decode($input, true);

    $model = new ProductModel();
    $product = new ProductController($products, $model);
    
    $product->addProducts();
}

