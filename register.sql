create table register (
    title enum('Mr', 'Mrs') not null,
    first_name varchar(255) not null,
    last_name varchar(255) not null,
    email varchar(255) not null unique,
    password varchar(255) not null,
    primary key (email)
);