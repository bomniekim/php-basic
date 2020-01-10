<?php

    session_start();

    $userid=$_SESSION['userid'];
    $username=$_SESSION['username'];

    // post로 전달된 값들
    $subject=$_POST['subject'];
    $content=$_POST['content'];

    $regist_date= date('Y-m-d (h:i)');

    // 업로드된 파일
    $src_name=$_FILES['attached_file']['name'];
    $tmp_name=$_FILES['attached_file']['tmp_name'];
    $file_type=$_FILES['attached_file']['type'];

    // 업로드된 파일이 있다면
    if( $src_name ){
        // 서버에 영구 저장할 파일명(날짜_원본파일명.확장자)
        $new_file_name= date('YmdHis')."_".$src_name;
        
        // 최종저장될 경로를 포함한 파일위치
        $dst_name="./upload/".$new_file_name;

        // 임시저장소($tmp_name)의 파일을 $dst_name으로 이동
        move_uploaded_file($tmp_name, $dst_name);

    }else{
        $src_name="";   // 원본파일명
        $file_type="";   // 파일타입
        $new_file_name=""; // 경로제외한 목적파일명(날짜가 추가된 파일명)
    }

    // board 테이블에 값들 저장
    include "../lib/dbconn.php";

    $sql ="INSERT INTO board (id, name, subject, content, regist_date, hit, file_name, file_type, file_copied) ";
    $sql .="VALUES('$userid','$username','$subject','$content','$regist_date','0','$src_name','$file_type','$new_file_name')";
    mysqli_query($conn, $sql);

    // 게시글 작성 시 회원포인트 +100

    // member 테이블에서 해당 id의 point 값 얻어오기
    $sql="SELECT point FROM member where id='$userid'";
    $result= mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result);
    
    $new_point= $row['point']+100; // 기존포인트 +100
    
    // 추가된 포인트로 회원정보 수정
    $sql= "UPDATE member SET point='$new_point' where id='$userid'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // 목록 화면으로 이동
    echo "
        <script>
            location.href='./board_list.php';
        </script>
    ";
    


?>