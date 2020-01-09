<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>회원정보 수정</title>

    <!-- 공통 스타일시트 연결 -->
    <link rel="stylesheet" href="../css/common.css">
    <!-- member_form.php전용 스타일시트 -->
    <link rel="stylesheet" href="../css/member.css">

    <!-- 자바스크립트 작성 -->
    <script>
        // submit 이미지버튼 클릭 시
        function submitForm(){

            // 입력값 중 비어있으면 안되는 것들이 있음

            // 비밀번호 칸이 비어 있는가?
            if( !document.member_form.pass.value ){
                alert('비밀번호를 입력하세요');
                document.member_form.pass.focus();
                return;
            }

            // 비밀번호 확인 칸이 비어 있는가?
            if( !document.member_form.pass_confirm.value ){
                alert('비밀번호를 다시 확인해주세요');
                document.member_form.pass_confirm.focus();
                return;
            }

            // 이름 칸이 비어 있는가?
            if( !document.member_form.name.value ){
                alert('이름을 입력하세요');
                document.member_form.name.focus();
                return;
            }

            // 비밀번호와 비밀번호 확인 칸의 입력값이 같은지 비교
            if(document.member_form.pass.value !=
                document.member_form.pass_confirm.value){
                    alert('비밀번호가 일치하지 않습니다.\n비밀번호를 다시 입력해주세요');
                    document.member_form.pass.focus();
                    // 커서가 이동하고 그 칸이 선택되어 있도록
                    document.member_form.pass.select();
                    return;
                }

            // 요소를 찾을 때 getElementByXXX()를 사용하지 않고 document객체의 form과 input요소의 연관배열을 곧바로 이용
            // form 요소와 input요소는 name속성으로 지정한 값이 document의 멤버변수로 지정됨
            
            // form요소를 직접 submit하는 메소드
            document.member_form.submit();
        }
        // 초기화 이미지버튼 클릭 시 
        function resetForm(){
            document.member_form.id.value="";
            document.member_form.pass.value="";
            document.member_form.pass_confirm.value="";
            document.member_form.name.value="";
            document.member_form.email1.value="";
            document.member_form.email2.value="";

            // 첫번째 input요소로 포커스 이동
            document.member_form.id.focus();

        }

        // id는 변경할 수 없도록 설정

        // // 아이디 중복 확인 버튼 클릭시 메소드
        // function checkId(){
        //     // 사용자가 입력한 id값 얻어오기
        //     var userid= document.member_form.id.value;

        //     // DB에서 같은 아이디가 있는지 확인하고 결과를 보여주는 새로운 윈도우 띄우기
        //     open("./check_id.php?id="+userid, "아이디체크", " width=300, height=100, left=800, top=100");
        // }
    </script>
</head>

<body>
    <header>
        <!-- 공통모듈 사용 -->
        <?php include "../lib/header2.php"?>
    </header>

    <!-- 로그인된 회원의 정보를 읽어오는 php 작성 -->
    <?php
        include "../lib/dbconn.php";

        // 로그인된 회원의 정보를 읽어오는 쿼리문
        $sql= "SELECT * FROM member WHERE id='$userid'";
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);

        $pass= $row['pass'];
        $email= $row['email'];
        $email= explode("@", $email); // email은 이제 배열
        $email1= $email[0];
        $email2= $email[1];

    ?>
    <section>
        <div id="main_content">
            <div id="join_box">
                <!-- DB의 member 테이블 정보를 수정하는 member_modify.php에 입력값들을 전달하도록 -->
                <form action="./member_modify.php?id=<?=$userid?>" method="post" name="member_form">
                    <h2>정보 수정</h2>

                    <!-- 각 줄마다 라벨, input영역으로 나누어지므로 col1, col2 클래스 지정해 스타일을 통일적용 -->
                    <div class="form id"> <!--id칸만 중복확인이 있어서 id칸 전용 스타일을 위해 id클래스 추가: 클래스를 2개 지정-->
                        <div class="col1">아이디</div>
                        <div class="col2"> <?=$userid ?></div>
                    </div>
                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2"><input type="password" name="pass" value="<?=$pass?>"></div>
                    </div>
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2"><input type="password" name="pass_confirm" value="<?=$pass?>"></div>
                    </div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2"><input type="text" name="name" value="<?=$username?>"></div>
                    </div>
                    <div class="form email"> <!-- 클래스를 2개 지정-->
                        <div class="col1">이메일</div>
                        <div class="col2">
                            <input type="text" name="email1" value="<?=$email1?>">@<input type="text" name="email2" value="<?=$email2?>">
                        </div>
                    </div>

                    <!-- input요소의 submit, reset으로 만들면 이미지 사용 불가 -->
                    <!-- input요소의 타입 중 image 타입으로 하면 이미지버튼 + submit 기능 가능 -->
                    <!-- 값을 전송할 때 값이 비어있는 지 검증하는 작업도 추가: JavaScript를 이용해서 submit()처리-->
                    <div class="bottom_line"></div>
                    <div class="buttons">
                        <img src="../img/button_save.gif" style="cursor:pointer" onclick="submitForm()">&nbsp;
                        <img src="../img/button_reset.gif" style="cursor:pointer" onclick="resetForm()">
                    </div>
                </form>

            </div> <!-- join_box -->
        </div> <!-- main_content -->          
        
    </section>
    <footer>
        <!-- 공통사용 footer.php 추가 -->
        <?php include "../lib/footer.php"?>
    </footer>
    
</body>
</html>