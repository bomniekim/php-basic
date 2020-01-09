<?php

    $id=$_POST['id'];
    $pass=$_POST['pass'];

    // id와 pw 입력여부 확인
    if(!$id){
        //경고창을 띄우고 이전 페이저로 이동 (JS의 history객체 이동)
        echo "
            <script>
                alert('id를 입력하세요');
                history.go(-1);
            </script>
        ";
        exit;
    }

    if(!$pass){
        //경고창을 띄우고 이전 페이저로 이동 (JS의 history객체 이동)
        //history.go();가 더 유용
        echo "
            <script>
                alert('비밀번호를 입력하세요');
                history.back;
            </script>
        ";
        exit;
    }

    //exit가 안되었다면 id와 pw가 전달된 것이므로 DB에서 해당 id와 비밀번호 체크
    
    // DB접속 공통모듈 사용
    include "../lib/dbconn.php";

    // 쿼리문
    $sql="SELECT * FROM member Where id='$id' and pass='$pass'";
    $result= mysqli_query($conn, $sql);

    // 결과 테이블로부터 레코드 수를 얻어오기
    $row_num= mysqli_num_rows($result);

    //$row_num이 0이면 id와 pw가 맞지 않는 것
    if(!$row_num){
        echo "
            <script>
                alert('id와 비밀번호가 일치하지 않습니다. 다시 확인해주세요');
                history.go(-1);
            </script>
        ";
        exit;
    }

    // exit이 안되었다면 로그인이 된 상태
    // 다른 페이지에서 로그인이 되었다고 인지하기 위해 회원정보를 세션에 저장
    // 해당하는 id의 회원정보 얻어오기
    $row =mysqli_fetch_array($result, MYSQLI_ASSOC);

    // 세션에 저장
    session_start();
    $_SESSION['userid']= $row['id'];
    $_SESSION['username']= $row['name'];
    $_SESSION['userlevel']= $row['level'];
    $_SESSION['userpoint']= $row['point'];

    //세션저장이 되었으니 index.php로 이동
    echo "
        <script>
            location.href='../index.php';
        </script>
    ";


?>