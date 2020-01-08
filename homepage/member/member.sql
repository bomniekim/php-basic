CREATE TABLE member(
    num INT NOT NULL AUTO_INCREMENT,
    id VARCHAR(15) NOT NULL,
    pass VARCHAR(15) NOT NULL,
    name VARCHAR(20) NOT NULL,
    email VARCHAR(50),
    regist_date VARCHAR(20), -- 날짜를 문자열로 처리
    level INT,
    point INT,
    PRIMARY KEY(num),
    UNIQUE(id) -- unique를 쓰면 중복이 안된다는 의미(여러개를 지정해도 ok)
);