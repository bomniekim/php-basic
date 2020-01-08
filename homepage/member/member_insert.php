<?php
    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $email1=$_POST['email1'];
    $email2=$_POST['email2'];

    $email= $email1."@".$email2;

    // 등록일
    $regist_date = date("Y-m-d (H:i)");

    // 레벨은 신규회원은 9, 포인트는 0점으로 기본설정

    
    // 데이터베이스 접속도 공통모듈에 작성해서 사용
    include "../lib/dbconn.php";

    // 중복된 아이디 여부를 확인해서 사용자에게 안내
    $sql= "SELECT * FROM member WHERE id='$id'";
    $result= mysqli_query($conn, $sql);
    $row_num= mysqli_num_rows($result); // 결과 테이블로부터 레코드 수 얻어오기

    // $row_num이 0이 아니라는 것은 id가 있다는 것--> 중복
    if($row_num){
        // 경고창을 보여주면서 이전 회원가입 페이지로 다시 이동
        // window.history.back(): 이전 페이지로 이동
        echo ("
            <script>
                alert('해당 아이디가 이미 존재합니다.');
                history.back(); 
            </script>
        ");

        // 중복이 되었으니 다음 작업들을 못하도록 php 종료
        exit;
    }

    // $row_num이 0이라면 신규 id라는 것임
    // 회원정보 insert

    // insert 쿼리문
    $sql= "INSERT INTO member(id, pass, name, email, regist_date, level, point) VALUES ('$id','$pass','$name','$email','$regist_date','9','0')";

    // 쿼리문 실행
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // 데이터 저장이 완료된 후 index.php로 페이지 이동
    echo "
        <script>
            alert('축하합니다! 회원가입이 완료되었습니다.');
            window.location.href='../index.php';
        </script>
    ";






    

?>