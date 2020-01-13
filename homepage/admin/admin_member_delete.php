<?php

    $num=$_GET['num'];

    include "../lib/dbconn.php";

    // 회원을 삭제하면 작성했던 쪽지와 게시글도 모두 삭제해야 함
    // 그걸 안하면 문제가 생김, 아니면 그 글의 작성자를 변경하든가

    $sql= "DELETE FROM member where num=$num";
    mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo"
        <script>
            location.href='./admin.php';
        </script>
    ";

?>