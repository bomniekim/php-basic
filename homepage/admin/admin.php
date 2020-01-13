<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>관리자모드</title>

        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <header>
            <?php include "../lib/header2.php"; ?>
        </header>
        <section>
            <div id="main_content">
                <div id="admin_box">
                    <!-- 회원정보 관리 -->
                    <h3>관리자 모드 > 회원관리</h3>
                    <!-- 회원명단 관리 테이블 -->
                    <ul id="member_list">
                        <!-- 테이블 제목 라인-->
                        <li>
                            <span class="col1">num</span>
                            <span class="col2">id</span>
                            <span class="col3">이름</span>
                            <span class="col4">레벨</span>
                            <span class="col5">포인트</span>
                            <span class="col6">가입일</span>
                            <span class="col7">수정</span>
                            <span class="col8">삭제</span>
                        </li>

                        <!-- 제목 라인 밑으로 회원정보 한 줄씩 출력 -->
                        <!-- 회원정보 읽어오는 코딩 -->
                        <?php
                            include "../lib/dbconn.php";

                            //최신명단순으로 
                            $sql="SELECT * FROM member order by num desc";
                            $result= mysqli_query($conn, $sql);
                            
                            // for문 대신에 while문으로 레코드 읽어와보기
                            while( $row= mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                                $num=$row['num'];
                                $id=$row['id'];
                                $name=$row['name'];
                                $level=$row['level'];
                                $point=$row['point'];
                                $regist_date=$row['regist_date'];

                                // 필드값 출력을 위해 php 구문 분리
                        ?>
                            <!-- html 문법으로 값 출력 가능 -->
                            <li>
                                <!-- 수정하는 작업을 form의 submit을 통해서 하고, delete는 버튼으로 처리 -->
                                <form action="./admin_member_update.php?num=<?=$num?>" method="post">
                                    <span class="col1"><?=$num?></span>
                                    <span class="col2"><?=$id?></span>
                                    <span class="col3"><?=$name?></span>
                                    <!-- level과 point는 변경이 가능하도록 input요소로 -->
                                    <span class="col4"><input type="text" value="<?=$level?>"></span>
                                    <span class="col5"><input type="text" value="<?=$point?>"></span>
                                    <span class="col6"><?=$regist_date?></span>
                                    <!-- button의 type으로 submit 가능 -->
                                    <span class="col7"><button type="submit">수정</button></span>
                                    <span class="col8"><button type="button" onclick="location.href='./admin_member_delete.php?num=<?$num?>'">삭제</button></span>
                                
                                </form>
                            </li>
                        <?php } ?>
                    </ul>

                    <!-- 게시판 관리 -->
                    <h3>관리자 모드 > 게시판 관리</h3>
                    <ul id="board_list">
                        <!-- 테이블의 제목 라인 -->
                        <li class="title">
                            <span class="col1">선택</span>
                            <span class="col2">번호</span>
                            <span class="col3">이름</span>
                            <span class="col4">제목</span>
                            <span class="col5">첨부파일명</span>
                            <span class="col6">작성일</span>
                        </li>
                        <!-- 테이블의 내용 레코드 출력 -->
                        <form action="./admin_board_delete.php" method="post">
                            <!-- 보여줄 레코드값들 읽어오기 -->
                            <?php
                                $sql= "SELECT * FROM board order by num desc";
                                $result= mysqli_query($conn, $sql);

                                while( $row= mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                                    $num=$row['num'];
                                    $name=$row['name'];
                                    $subject=$row['subject'];
                                    $file_name=$row['file_name'];
                                    $regist_date=$row['regist_date'];
                                    // 게시글 등록일자만 (시간은 제거)
                                    $regist_date=substr($regist_date, 0, 10); // 0번 인덱스부터 ~10번 인덱스 전까지 문자열 잘라내기


                                    // 출력을 위해 php 분리
                                
                            ?>
                                <!-- html로 필드값 출력 -->
                                <li>
                                    <!-- 삭제를 한 번에 제어하기 위해 체크박스 이용 -->
                                    <span class="col1"><input type="checkbox" name="items[]" value="<?=$num?>"></span>
                                    <span class="col2"><?=$num?></span>
                                    <span class="col3"><?=$name?></span>
                                    <span class="col4"><?=$subject?></span>
                                    <span class="col5"><?=$file_name?></span>
                                    <span class="col6"><?=$regist_date?></span>
                                </li>

                            <?php
                                }
                                mysqli_close($conn); ?>

                            <!-- 선택된 글 삭제 버튼-->
                            <button type="submit">선택된 글 삭제</button>
                        
                        </form>
                    
                    </ul>

                </div>
            </div>
        </section>
        <footer>
            <?php include "../lib/footer.php"; ?>
        </footer>
    </body>
</html>