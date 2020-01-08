<meta charset="utf-8">

<?php

    $id= $_GET['id'];

    // 값을 전달하지 않을 수도 있으니
    if(!$id){
        echo "아이디를 입력하세요";
        exit;
    }

    // 데이터베이스에 접속하는 공통모듈 사용
    include "../lib/dbconn.php";

    // 전달받은 id가 member table에 있는지 검사
    $sql= "SELECT * FROM member WHERE id='$id'";
    $result= mysqli_query($conn, $sql);
    $row_num= mysqli_num_rows($result);

    //$row_num이 0이 아니면 id 중복
    if( $row_num){
        echo "아이디가 중복됩니다.<br>";
        echo "다른 아이디를 사용해주세요.<br>";
    }else{
        echo "사용가능한 아이디입니다.";
    }

    mysqli_close($conn);
?>