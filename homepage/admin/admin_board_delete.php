<?php

    // 체크박스를 체크하지 않았을 수도 있으므로
    if ( !isset($_POST['items']) ){
        echo "
            <script>
                alert('삭제할 게시글을 선택하세요');
                history.back();
            </script>
        ";
        exit;
    }
    
    include "../lib/dbconn.php";

    // 전달받은 체크박스의 값들을 배열로 받기
    $items= $_POST['items'];

    // $items는 체크된 항목들의 게시글 num를 가진 배열변수
    // 전달된 게시글 num의 개수 알아내기 [배열의 길이 : count() ]
    $item_num= count($items);

    for($i=0; $i<$item_num; $i++){
        $num= $items[$i];

        // 업로드된 파일도 삭제하고 싶다면
        $sql= "SELECT * FROM board where num=$num";
        $result= mysqli_query($conn, $sql);
        $row= mysqli_fetch_array($result);

        $copied_name=$row['file_copied'];
        if($copied_name){
            $file_path= "../board/uploads/".$copied_name;
            unlink($file_path);
        }


        // board 테이블에서 해당하는 게시글 삭제 쿼리문
        $sql= "DELETE FROM board where num=$num";
        mysqli_query($conn, $sql);
    }

    mysqli_close($conn);

    echo "
        <script>
            location.href='./admin.php';
        </script>
    ";


?>