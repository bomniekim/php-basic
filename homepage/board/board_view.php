<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>

    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/board.css">
</head>
<body>
    <header>
        <?php include '../lib/header2.php';?>

    </header>
    <section>
        <div id="main_content">
            <div id="board_box">
                <h3>게시판 > 내용보기</h3>
            <?php
                $num=$_GET['num'];
                // 목록으로 돌아갈 때 필요한 페이지 번호
                $page=$_GET['page'];

                include '../lib/dbconn.php';

                // 해당 num의 게시글 필드값들 읽어오기
                $sql="SELECT * FROM board where num='$num'";
                $result=mysqli_query($conn, $sql);

                $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
                $id= $row['id'];
                $name= $row['name'];
                $subject= $row['subject'];
                $content= $row['content'];
                $regist_date= $row['regist_date'];
                $hit= $row['hit'];
                $src_name= $row['file_name'];    // 원본파일명
                $file_type= $row['file_type'];   // 파일타입
                $copy_name= $row['file_copied']; // 경로를 제외한 저장된 파일명

                $content= nl2br($content);

                // 조회수 증가
                $hit++;
                mysqli_query($conn, "UPDATE board SET hit='$hit' where num=$num");

            ?>

            <!-- 읽어온 값들 화면에 표시 -->
            <ul id="view_content">
                <li>
                    <span class="col1"><strong>제목 : </strong><?=$subject?></span>
                    <span class="col2"><?=$name?> | <?=$regist_date?></span>
                </li>
                <li>
                    <?php 
                        // 첨부파일이 있다면 관련 표시
                        if($src_name){
                            // 파일 사이즈를 계산하는 php 내장함수: filesize()

                            $file_path="./uploads/".$copy_name;
                            $file_size= filesize($file_path);

                            echo "☞ 첨부파일 : $src_name ($file_size Byte)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href='./download.php?num=$num'>[저장]</a>
                            <a href='$file_path' target='_blank'>[미리보기]</a><br><br>";

                           
                        }
                    ?>
                        
                    <p><?=$content?></p>
                </li>
            </ul>

            <ul class="buttons">
                <li><button onclick="location.href='./board_list.php?page=<?=$page?>'">목록</button></li>
                <li><button onclick="location.href='./board_modify_form.php?num=<?=$num?>'">수정</button></li>
                <li><button onclick="location.href='./board_delete.php?num=<?=$num?>'">삭제</button></li>
                <li><button onclick="location.href='./board_write_form.php'">글쓰기</button></li>
            </ul>


            </div>
        </div>
    </section>
    <footer>
        <?php include '../lib/footer.php';?>
    </footer>
    
</body>
</html>