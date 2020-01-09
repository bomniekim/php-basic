<?php

    // 로그아웃은 세션만 지우면 됨
    session_start();

    // $_SESSION['userid']="";

    // unset: 변수 자체를 지움
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['userlevel']);
    unset($_SESSION['userpoint']);

    // index 페이지로 돌아가기
    echo "
    <script>
        location.href='../index.php';
    </script>
    ";


?>