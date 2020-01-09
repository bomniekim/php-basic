CREATE TABLE message(
    num int auto_increment,
    send_id varchar(15) not null,
    recv_id varchar(15) not null,
    subject varchar(20) not null,
    content text,
    regist_date varchar(20),
    primary key(num),
    -- index(send_id),
    -- index(recv_id),
    foreign key(send_id) references member(id),
    foreign key(recv_id) references member(id)
    -- member 테이블의 id를 참조하여 없는 id가 들어갈 수 없도록(무결성)
);