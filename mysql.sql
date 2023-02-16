-- Active: 1676095685779@@127.0.0.1@3306@a_tyreport
show databases;

create database a_tyreport
    character set utf8mb4
    collate utf8mb4_unicode_ci;

use a_tyreport;

drop table users_rn;

create table users_rn (
    id int primary key auto_increment,
    firstname varchar(100) not null,
    lastname varchar(100) not null,
    username varchar(100) not null,
    password varchar(20) not null,
    status tinyint default 1,
    level tinyint default 1,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

insert into users_rn (firstname, lastname, username, password) values ('Ron', 'Armengol', 'ron1', 12345);
insert into users_rn (firstname, lastname, username, password) values ('Gee', 'Armengol', 'gee1', 12345);
insert into users_rn (firstname, lastname, username, password, level) values ('big', 'boss', 'boss1', 12345, 10);



create table contact_msg (
    id int primary key auto_increment,
    name varchar(100),
    company varchar(100),
    mobile varchar(100),
    email varchar(100),
    message text,
    is_read TINYINT default 0,
    created_at TIMESTAMP DEFAULT NOW()
);


SELECT table_schema AS "Database", SUM(data_length + index_length) / 1024 / 1024 AS "Size (MB)" FROM information_schema.TABLES GROUP BY table_schema;


select * from users_rn;


select * FROM contact_msg;

select IF(LENGTH(message) > 10, CONCAT(SUBSTRING(message, 1, 10), '...'), message) as message from contact_msg order by created_at desc;



select * from contact_msg;
