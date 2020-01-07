<?php
    header('Content-Type:text/html; charset=utf-8');

    // 데이터베이스에 저장할 데이터 (GET, POST를 이용)
    $name= 'Son';
    $msg= 'Come On Your Spurs';

    // time-zone 설정을 하지 않으면 시간이 다르게 나올 수 있음(default:로마시간)
    // 닷홈같은 호스팅 업체는 이미 설정이 되어 있어서 실무에서는 별로 사용할 일이 없음
    // php.ini 파일 안에서 time-zone을 직접 설정할 수 있음
    // 코드로 처리할 수도 있음
    date_default_timezone_set('Asia/Seoul');
    $now= date('Y-m-d H:i:s');


    // 데이터베이스에 저장
    // php와 DBMS를 연결하기
    $conn =mysqli_connect('localhost', 'bomnie', '1234', 'mrhi_db') or die('DB 접속 실패'); // 다잉메세지 작성 시 다음 줄을 실행시키지 않음
    // if($conn) die('연결실패');

    // 한글깨짐 방지
    mysqli_query($conn, "set names utf-8");

    // 원하는 쿼리문(Structured Query Language:SQL) 작성
    // 1) table 생성

    $sql="CREATE TABLE IF NOT EXISTS board(no integer not null primary key auto_increment, name varchar(20) not null, msg text, date datetime);";
    // 쿼리문 실행
    mysqli_query($conn, $sql) or die('테이블 생성 실패');
    
    // 2) 데이터 삽입
    $sql="insert into board(name, msg, date) values('$name','$msg','$now')";
    $result= mysqli_query($conn, $sql); // 리턴값 true or false
    if($result) echo "insert 성공";
    else echo "insert 실패";

    // 3) 데이터 읽어오기
    $sql= "select * from board";
    $result= mysqli_query($conn, $sql); // 리턴값: 찾아온 결과 테이블(result set) or false

    // 결과로 나온 $result(결과 테이블)에서 총 레코드(record:행) 수 얻어오기
    $row_num=mysqli_num_rows($result);

    // php에서는 결과 테이블에서 한 줄씩만 데이터를 읽어올 수 있기 때문에
    // 행의 수(record의 수)만큼 반복해서 읽어와야 함
    for($i=0; $i<$row_num; $i++){
        // 현재 커서 위치에서 한 줄을 배열로 읽어드리기
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC); // 리턴값: 1차원 배열


        // 화면에 읽어온 row의 필드 값들 출력
        ?>

        <!-- html 영역 -->
        <h2><?php echo $row['name']?></h2>
        <p><?=$row['msg']?></p>
        <p><?=$row['date']?></p>
        <hr>
    
    <?php
    }

    // 데이터베이스 연결 닫기
    mysqli_close($conn);
    ?>