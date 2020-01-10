<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>쪽지 내용보기</title>

        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" href="../css/message_view.css">
    </head>
    <body>
        <header>
            <?php include "../lib/header2.php"; ?>
        </header>
        <section>
            <div id="main_content">
                <div id="message_box">
                    <!-- 제목 -->
                    <h3>
                        <?php 
                                $mode= $_GET['mode']; ?> <!-- 모드 값 가져오기 -->
                                <?=($mode=="send")?"보낸 쪽지함 > 내용보기":"수신 쪽지함 > 내용보기"?>
                    </h3>

                    <?php 
                        // 내용을 표시할 num 쪽지 번호의 내용 읽어오기
                        $num=$_GET['num'];

                        include "../lib/dbconn.php";

                        // 해당 번호의 쪽지 레코드 읽어오기
                        $sql= "SELECT * FROM message where num='$num'";
                        $result= mysqli_query($conn, $sql);

                        //쿼리 결과에서 데이터 한 줄 연관배열로 읽어오기
                        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $send_id=$row['send_id'];
                        $recv_id=$row['recv_id'];
                        $regist_date=$row['regist_date'];
                        $subject=$row['subject'];
                        $content=$row['content'];

                        // $contnet는 줄바꿈 \n이 있을 수 있으므로
                        $content= str_replace("\n","<br>", $content);
                        $content= str_replace(" ","&nbsp;", $content); 

                        $msg_id= ($mode=='send')?$recv_id:$send_id;


                    ?>
                    <!-- 쪽지내용 -->
                    <ul id="view_content">
                        <!-- 쪽지 제목/상대방 id/등록일 -->
                        <li>
                            <span class='col1'><strong>제목 : </strong><?=$subject?></span>
                            <span class='col2'><?=$msg_id?> | <?=$regist_date?></span>
                        </li>
                        <!-- 쪽지 내용 표시 -->
                        <li><?=$content?></li>
                    </ul>

                    <!-- 하단 버튼 -->
                    <ul class="buttons">
                        <li><button onclick="location.href='./message_box.php?mode=recv'">받은 쪽지함</button></li>
                        <li><button onclick="location.href='./message_box.php?mode=send'">보낸 쪽지함</button></li>
                        <!-- 쪽지 답장 페이지로 이동 (답변할 쪽지번호 같이 전달) -->
                        <li><button onclick="location.href='./message_response_form.php?num=<?=$num?>'">쪽지 답장하기</button></li>

                        <!-- 삭제할 쪽지번호 전달 & 삭제 후 쪽지함으로 돌아올 때 send/recv 모드를 결정하기 위해 $mode도 전달 -->
                        <li><button onclick="location.href='./message_delete.php?num=<?$num=?>&mode=<?=$mode?>'">삭제하기</button></li>
                    </ul>
                </div>
            </div>
        </section>
        <footer>
            <?php include "../lib/footer.php"; ?>
        </footer>
    
    </body>
</html>