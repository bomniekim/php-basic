<?php
    header('Content-Type:text/html; charset=utf-8');

    // 데이터베이스에 저장할 데이터( 원래는 GET, POST, REQUEST를 통해)
    $name= 'Son';
    $msg= 'Come On Your Spurs';

    date_default_timezone_set('Asia/Seoul');
    $now= date('Y-m-d H:i:s');
    
    // php와 DBMS를 연결하여 제어해주는 객체 생성
    // PDO(Php Data Object) 클래스
    // PDO 객체 생성-지원가능한 DBMS: mysql, mssql, oracle, sqlite, sybase 등
    $db=new PDO('mysql:host=localhost;dbname=mrhi_db','bomnie','1234'); // 파라미터 3개

    // $db는 PDO객체를 가리키는 포인터변수(java의 참조변수)
    // $db를 이용해서 원하는 쿼리문 실행(DDL, DML, DCL)
    // 1) create
    $db->exec('CREATE TABLE IF NOT EXISTS notice(no int primary key auto_increment, name varchar(20) not null , msg text, date datetime)');

    // 2) insert
    $db->exec("INSERT INTO notice(name, msg, date) VALUES('$name','$msg','$now')");

    // 3) select: 리턴이 필요한 경우는 exec()가 아닌 query() 사용
    $result=$db->query("SELECT * FROM notice");

    // 결과 테이블 객체의 값을 한 줄씩 읽어들이기
    while( $row=$result->fetch() ){
        //echo "$row['no'] $row['name'] $row['msg']";
        echo $row['no'].", " .$row['name'].", ".$row['msg'].", ".$row['date']."<hr>";
        
    }

    


?>