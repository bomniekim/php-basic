CREATE TABLE board(
    num int auto_increment,
    id varchar(15) not null,
    name varchar(20) not null,
    subject varchar(40) not null,
    content text,
    regist_date varchar(20),
    hit int,
    file_name varchar(30),
    file_type varchar(30),
    file_copied varchar(30),
    primary key(num),
    foreign key(id) references member(id)
);