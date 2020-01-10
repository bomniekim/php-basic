<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>게시판</title>

        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" href="../css/board.css">
    </head>
    <body>
        <header>
            <?php include "../lib/header2.php"; ?>
        </header>
        <section>
            <div id="main_content">
                <!-- message_box.php와 비슷하게 제작: 크게 4개의 영역 -->
                <div id="board_box">
                    <!-- 제목 영역 -->
                    <h3>게시판 > 목록보기</h3>

                    <!-- 리스트 영역 -->
                    <ul id="board_list">
                        <!-- 제목 영역: .col을 이용해서 구분 -->
                        <li>
                            <span class="col1">num</span>
                            <span class="col2">제목</span>
                            <span class="col3">글쓴이</span>
                            <span class="col4">첨부</span>
                            <span class="col5">등록일</span>
                            <span class="col6">조회수</span>
                        </li>

                        <!-- 게시글 영역 : DB에서 읽어와서 표시 -->
                        <?php
                            include '../lib/dbconn.php';

                            // 최신글 순 (num 내림차순)으로 보여주도록 쿼리문 작성
                            $sql= "SELECT * FROM board order by num desc";
                            $result= mysqli_query($conn, $sql);

                            // 전체 게시글 수
                            $row_num=mysqli_num_rows($result);

                            // 한 페이지에 게시글 10개씩 보여줄 것임
                            // 현재 보여줄 페이지 번호
                            if (isset($_GET['page'])) $page= $_GET['page'];
                            else $page=1;

                            // 전체 페이지 수 계산
                            if($row_num % 10==0) $total_page=floor($row_num/10);
                            else $total_page=floor($row_num/10)+1;

                            if($total_page==0) $total_page=1;

                            // 현재 페이지의 시작 레코드 row 번호(num 값이 아님)- 0부터 시작
                            $start= ($page-1) * 10;

                            for($i=$start; $i<$start+10 && $i<$row_num; $i++){
                                // 해당하는 row 위치로 커서 이동
                                mysqli_data_seek($result, $i);

                                // 이동한 위치의 레코드를 연관배열로 읽어오기
                                $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

                                // 읽어온 하나의 레코드 필드값들 가져오기
                                $num= $row['num'];
                                $id= $row['id'];
                                $name= $row['name'];
                                $subject= $row['subject'];
                                $regist_date= $row['regist_date'];
                                $hit= $row['hit'];
                                
                                if($row['file_name']) $file_image="<img src='../img/file.gif>'";
                                else $file_image="";
                                
                        ?>
                            <!-- html 문법으로 화면에 필드값들 출력 -->
                            <li>
                                <span class="col1"><?=$num?></span>
                                <span class="col2"><a href="./board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                                <!-- 게시글의 제목을 누르면 상세보기(board_view) 페이지로 이동-->
                                <!-- 상세보기를 위해 게시글번호(num)전달 및 상세보기 종료 후 돌아올 page번호를 알기 위해 $page전달 -->
                                <span class="col3"><?=$name?></span>
                                <span class="col4"><?=$file_image?></span> <!-- 첨부파일이 있다면 디스켓모양 보임 -->
                                <span class="col5"><?=$regist_date?></span>
                                <span class="col6"><?=$hit?></span>
                            </li>
                        <?php     
                            }

                            mysqli_close($conn);

                        ?>

                    </ul>
                    <!-- pagination -->
                    <ul id="page_num">
                        <?php
                        if(!$page=1){
                            $newPage= $page-1;
                            echo"<li><a href='./board_list.php?page=$newPage'>◀이전 </a> </li>";
                        }else{
                            echo"<li>◀이전 </li>";
                        }

                        // 페이지 수만큼 페이지 번호 출력
                        for($i=1; $i<=$total_page; $i++){
                            if($i==$page) echo "<li><strong>$i</strong><li>"; // 현재페이지인 경우 클릭X
                            else echo "<li><a href='./board_list.php?page=$i'> $i </a></li>";

                        }

                        if($page != $total_page){
                            $newPage= $page+1;
                            echo"<li><a href='./board_list.php?page=$newPage'> 다음▶</a> </li>";
                        }else{
                            echo"<li> 다음▶</li>";
                        }
                        ?>

                    </ul>

                    <!-- 하단 버튼들 -->
                    <ul class="buttons">
                        <li><button onclick="location.href='./board_list.php'">첫페이지로</button></li>
                        <li>
                        <?php if($userid){ ?>
                            <button onclick="location.href='./board_write_form.php'">글쓰기</button>                    
                        <?php }else{ ?>
                            <button onclick="alert('로그인 후 이용해주세요!')">글쓰기</button>                     
                        <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <footer>
            <?php include "../lib/footer.php"; ?>
        </footer>    
    </body>
</html>