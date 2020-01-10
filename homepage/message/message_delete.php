<?php

    $num= $_GET['num'];
    $mode= $_GET['mode'];

    include "../lib/dbconn.php";

    //해당 번호 쪽지 삭제
    $sql= "DELETE FROM message WHERE num=$num";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // 삭제 후 돌아갈 쪽지함의 모드를 지정
    if($mode=="send") $url= "./message_box.php?mode=send";
    else $url= "./message_box.php?mode=recv";

    echo "
        <script>
            location.href='$url';
        </script>
    ";

?>