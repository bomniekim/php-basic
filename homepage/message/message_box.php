<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>쪽지함</title>

    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/message_box.css"> 
</head>

<body>
    <header>
        <?php include "../lib/header2.php";?>
    </header>
    <section>
        <div id="main_content">
            <div id="message_box">
                <h3>
                    <?php
                        $mode=$_GET['mode'];
                        if($mode=="send") echo "보낸 쪽지함 > 목록보기";
                        else echo "받은 쪽지함 > 목록보기";
                    ?>
                </h3>

                <!-- 쪽지 목록이 보여지는 영역 (게시판 모양) -->
                <div>
                    <ul id="message">
                        <!-- 목록의 제목 -->
                        <li>
                            <span class="col1">num</span>
                            <span class="col2">제목</span>
                            <span class="col3"><?= ($mode=="send")?"받은이":"보낸이"?></span>
                            <span class="col4">등록일</span>
                        </li>

                        <!-- DB에 저장된 데이터들 읽어와서 보여주기 -->
                        <?php
                            include "../lib/dbconn.php";

                            // 받은 쪽지함이면 userid가 send_id로 저장되어 있는 목록만 가져오기
                            if($mode=="send"){
                                $sql= "SELECT * FROM message where send_id='$userid' order by num desc";
                                // 로그인되어 있는 사용자 아이디와 같은 경우 최신순으로 
                                
                            }else{ //받은 쪽지함이면 userid가 recv_id로 저장되어 있는 목록만
                                $sql= "SELECT * FROM message where recv_id='$userid' order by num desc";

                            }

                            $result=mysqli_query($conn, $sql);

                            // 전체 쪽지 수
                            $row_num=mysqli_num_rows($result);

                            // 한 페이지 안에 모든 쪽지를 목록으로 보여주면 너무 많아서
                            // 최대 한 페이지에 10개까지만 보여지게 하고
                            // 목록의 하단에 pagination을 표시하여 선택할 수 있도록 
                            if( isset($_GET['page']) ) $page= $_GET['page'];
                            else $page=1;
                            
                            // 쪽지의 수에 따른 전체 페이지 수 계산
                            if( $row_num % 10 == 0) $total_page= floor($row_num/10);
                            else $total_page= floor($row_num/10)+ 1;

                            if($total_page==0) $total_page=1;

                            // 현재 페이지에서 시작할 쪽지글의 row번호 (num값이 아님)
                            $start= ($page -1)*10;



                            for($i=$start; $i<$start+10 && $i<$row_num; $i++){

                                // 가져올 레코드의 위치(row 위치)로 이동
                                mysqli_data_seek($result, $i);


                                $row= mysqli_fetch_array($result, MYSQLI_ASSOC); 
                                $num= $row['num'];
                                $subject= $row['subject'];
                                $msg_id=($mode=="send")?$row['recv_id']:$row['send_id'];
                                $regist_date=$row['regist_date'];

                                // 화면에 보여주는 작업은 쉽게 html로
                        ?>
                                <!-- 이 영역은 html -->
                                <li>
                                    <span class="col1"><?=$num?></span>
                                    <span class="col2"><a href="./message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
                                    <span class="col3"><?=$msg_id?></span>
                                    <span class="col4"><?=$regist_date?></span>
                                </li>
                            <?php
                            }

                            mysqli_close($conn);
                            ?>
                    </ul>
                    <!-- 쪽지 출력 END -->

                    <!-- pagination -->
                    <ul id="page_num">
                        <?php
                            if(!$page=1){
                                $newPage= $page-1;
                                echo"<li><a href='./message_box.php?mode=$mode&page=$newPage'>◀이전 </a> </li>";
                            }else{
                                echo"<li>◀이전 </li>";
                            }

                            // 페이지 수만큼 페이지 번호 출력
                            for($i=1; $i<=$total_page; $i++){
                                if($i==$page) echo "<li><strong>$i</strong><li>"; // 현재페이지인 경우 클릭X
                                else echo "<li><a href='./message_box.php?mode=$mode&page=$i'> $i </a></li>";

                            }

                            if($page != $total_page){
                                $newPage= $page+1;
                                echo"<li><a href='./message_box.php?mode=$mode&page=$newPage'> 다음▶</a> </li>";
                            }else{
                                echo"<li> 다음▶</li>";
                            }
                        ?>
                    </ul>

                    <!-- 쪽지함 이동 버튼 -->
                    <ul class="bottom_buttons">
                        <li><button onclick="location.href='./message_box.php?mode=recv'">받은 쪽지함</button></li>
                        <li><button onclick="location.href='./message_box.php?mode=send'">보낸 쪽지함</button></li>
                        <li><button onclick="location.href='./message_form.php'">쪽지 보내기</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer>
       <?= include "../lib/footer.php";?> 
    </footer>
    
</body>
</html>