# Тестовое задание 


## Installation

Запуск

```bash
  docker-compose up -d
```
Перейти на localhost


## Задание 1

Перейти по ссылке на начальной странице.

После перехода откроется шаблон `millennium/src/public/user.html` и будет автоматически отправлен GET запрос на получения списка заказов `api/user/1`.

Этот запрос обрабатывается контроллером `millennium/src/controllers/UserController.php` в методе `getUserOrders()`.
Запрос на получение данных лежит в `millennium/src/models/UserModel.php`.


## Задание 2

По желанию дополнить данные на форме, на начальной странице. 

При нажатии на "отправить", отправляется POST запрос на `api/products`.

Этот запрос обрабатывается контроллером `millennium/src/controllers/ProductController.php` в методе `addProducts()`.
Запрос на сохранение данных лежит в `millennium/src/models/ProductModel.php`.

## Задание 3
Самое первое, что бросилось в глаза, отсутствие внешних ключей в `user_order`

Далее можно добавить индексы, для ускорения поиска (предполагается большой размер).

Если уж добавили метку времени для `users`, добавим везеде время добавления и обновления. И обязательно проставить значения по умолчанию.

Страдает целостность данных, уберем все null.

Итог


```MySql
CREATE TABLE user
(
    id          int auto_increment primary key,
    first_name  varchar(100) charset utf8mb4 not null,
    second_name varchar(100) charset utf8mb4 not null,
    birthday    date                         not null,
    created_at  datetime default CURRENT_TIMESTAMP not null,
    updated_at  datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
);

CREATE TABLE products
(
    id    int auto_increment primary key,
    title varchar(200) charset utf8mb4 not null,
    price decimal(10, 2)               not null,
    created_at datetime default CURRENT_TIMESTAMP not null,
    updated_at datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
);

CREATE TABLE user_order
(
    id         int auto_increment primary key,
    user_id    int                                 not null,
    product_id int                                 not null,
    quantity   int       default 1                 not null,
    created_at datetime  default CURRENT_TIMESTAMP not null,
    updated_at datetime  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    constraint fk_user_order_user foreign key (user_id) references user (id) on delete cascade,
    constraint fk_user_order_product foreign key (product_id) references products (id) on delete cascade,
);

CREATE INDEX idx_user_name ON user (first_name, second_name);
CREATE INDEX idx_product_title ON products (title);
CREATE INDEX idx_user_order_user ON user_order (user_id);
CREATE INDEX idx_user_order_product ON user_order (product_id);
```

## Задание 4

Чистой воды полиморфизм. Объекты `RaceCar` и `Track` хоть и используют один и тот же интерфейс, но реализуют его по разному.

## Задание 5

SQL - язык запросов, используется в различных СУБД.
MySql - вот как раз одна их таких СУБД.

## Задание 6

Реализация signelton: `millennium/src/databases/MySql.php`

```PHP
class MySql
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new MySql();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
```

Теперь мы можем везде использовать один и тот же инстанс подключения к бд