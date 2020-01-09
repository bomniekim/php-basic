<?php

    // get방식으로 전달된 send_id 
    $send_id=$_GET['send_id'];

    //post방식으로 전달된 input요소들
    $recv_id=$_POST['recv_id'];
    $subject=$_POST['subject'];
    $content=$_POST['content'];

    // 쪽지 보낸 시간
    $regist_date= date('Y-m-d (H:i)');

    // message 테이블에 DB 저장하기
    include "../lib/dbconn.php";

    // 받는 아이디가 존재하는지
    $sql="SELECT * FROM member where id='$recv_id'";
    $result=mysqli_query($conn, $sql);
    $row_num=mysqli_num_rows($result);

    if($row_num){
        // message 테이블에 저장
        $sql  = "INSERT INTO message(send_id, recv_id, subject, content, regist_date) ";
        $sql .= "VALUES('$send_id','$recv_id','$subject','$content','$regist_date')"; 
        mysqli_query($conn, $sql);

    }else{
        echo "
            <script>
                alert('받는 아이디가 존재하지 않습니다.');
                histroy.back();
            </script>
        ";
        exit;

    };

    mysqli_close($conn);

    // 우선 뒤로 돌아가기 (즉, 메세지 작성 페이지로 이동)
    echo "
        <script>
            history.back();
        </script>
    ";


    // 원래는 보낸 쪽지함 페이지로 이동

?>