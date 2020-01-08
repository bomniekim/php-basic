<?php

    // DB에 접근
    $conn= mysqli_connect('localhost', 'bomnie', '1234', 'homepage_db');
    // 한글깨짐 방지 쿼리 실행
    mysqli_query($conn, "set names utf8");

?>