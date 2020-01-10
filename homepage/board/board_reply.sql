CREATE TABLE board_reply(
    num int auto_increment primary key,
    board_num int not null ,
    id varchar(15) not null,
    name varchar(20) not null,
    content text,
    regist_date varchar(20),
    foreign key(board_num) references board(num),
    foreign key(id) references member(id)
);