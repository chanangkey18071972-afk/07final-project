create database alv_racing;
use alv_racing;

create table users(
id int auto_increment primary key,
username varchar(50) not null unique, //不能空着，不能重复一样的名字
password varchar(255) not null,// 不能空着
email varchar(100) not null unique,//不能空着，不能重复一样的名字
role enum('admin', 'staff', 'customer') default 'customer',//如果没有选身份就默认customer
created_at timestamp default current_timestamp,//
);

create table products(
id int auto_increment primary key,
name varchar(100) not null, // 作品一定要有名字
description text, // 可以写介绍作品的东西 长文
price decimal(10,2) not null, // 
stock int null default 0, // 物品必须是整数不能半个
category varchar(50),
image_url varchar(255),
created_at timestamp default current_timestamp //点上架会自己auto更新上架时间
);

create table orders (
   id int auto_increment primary key, //自动出订单号
   user_id int not null, //可以顺着找谁下单id user
   total_price decimal(10,2) not null, //总金额 二 多少sen rm250 sen50
   status enum('pending', 'shipped', 'completed', 'cancelled') default 'pending', // 订单状态
   created_at timestamp default, current_timestamp, //自动记录下单时间
   foreign key (user_id) references user(id) on delete cascade, //注销账号全部数据没有 user_id是真真有的
);

create table order_items (
    id int auto_increment primary key,
    order_id int not null,
    product_id int null,
    quantity int not null,
    price decimal (10,2) not null,
    foreign key (order_id) references order(id) on delete cascade,
    foreign key (product_id) references product(id) on delete cascade,
);

create table cart (
    id int auto_increment primary key,
    user_id int not null, //
    product_id int not null,
    quantity int not null default 1,
    foreign key (user_id) references user(id) on delete cascade,
    foreign key (product_id) references product(id) on delete cascade,
);