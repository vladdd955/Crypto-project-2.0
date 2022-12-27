create table users
(
    id       int auto_increment
        primary key,
    name     varchar(255) not null,
    email    varchar(255) not null,
    password varchar(255) not null
);

create table cryptoWallet
(
    id          int auto_increment,
    user_id     int           not null,
    price       int           null,
    trade_date  varchar(255)  null,
    coin_symbol varchar(255)  null,
    coin_amount varchar(255)  null,
    money       float(255, 0) null,
    total_money int default 0 null,
    constraint `key`
        unique (id),
    constraint cryptoWallet_users_null_fk
        foreign key (user_id) references users (id)
);

create table short
(
    id            int auto_increment,
    short_user_id int default 0 not null,
    buy_sell      varchar(255)  not null,
    short_price   float(255, 0) not null,
    short_symbol  varchar(255)  not null,
    short_amount  int           not null,
    short_time    varchar(255)  not null,
    constraint short_key
        unique (id),
    constraint short_users_id_fk
        foreign key (short_user_id) references users (id)
);


