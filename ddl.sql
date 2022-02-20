create table sessions
(
    id         varchar(255)                          not null
        primary key,
    payload    text null,
    created_at timestamp default current_timestamp() not null,
    updated_at timestamp default current_timestamp() not null on update current_timestamp ()
);

create table users
(
    id       int auto_increment
        primary key,
    email    varchar(100) not null,
    password varchar(255) not null,
    username varchar(30)  not null
);

create table posts
(
    id         int auto_increment
        primary key,
    user_id    int null,
    title      varchar(100) not null,
    content    text null,
    created_at datetime     not null
);