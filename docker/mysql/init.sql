create table user
(
    id          int auto_increment
        primary key,
    first_name  varchar(255) charset utf8mb4 null,
    second_name varchar(255) charset utf8mb4 null,
    birthday    date                         null,
    created_at  datetime                     null
);

INSERT INTO user (id, first_name, second_name, birthday, created_at) VALUES (1, 'Петр', 'Петров', '2000-04-14', '2024-02-01 18:17:16');
INSERT INTO user (id, first_name, second_name, birthday, created_at) VALUES (2, 'Иван', 'Иванов', '1997-06-17', '2024-02-02 18:17:43');

create table products
(
    id    int auto_increment
        primary key,
    title varchar(255) charset utf8mb4 null,
    price decimal(10, 2)               null
);

INSERT INTO products (id, title, price) VALUES (1, 'Три товарища', 49.80);
INSERT INTO products (id, title, price) VALUES (2, 'Триумфальная арка', 349.00);
INSERT INTO products (id, title, price) VALUES (3, 'Один год жизни', 149.00);
INSERT INTO products (id, title, price) VALUES (4, 'Северный дракон', 249.00);


create table user_order
(
    user_id    int                                 not null,
    product_id int                                 not null,
    created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP
);

INSERT INTO user_order (user_id, product_id, created_at) VALUES (1, 4, '2024-02-14 18:41:25');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 1, '2024-02-14 18:40:52');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 2, '2024-02-14 18:40:51');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 3, '2024-02-02 18:40:45');
