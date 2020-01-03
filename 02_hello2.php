<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h2>오직 HTML만 있는 PHP파일입니다.</h2>

    <?php

    echo "Hello World";
    
    ?>
    <hr>
    
    <!-- php는 대/소문자 구분이 없음 -->
    <?php

    Echo "Hello World";
    eCho "Hello World";
   
    IF(5>3) ECHO "Zenx";

    // 심지어 함수명까지도
    function fun(){
        echo "Hoxy?";
    }

    fun();
    FUn(); // echo 됨

    //오히려 대/소문자를 구분하면 error
    // function Fun(){
    //     echo "nice";
    // }

    // 단, 변수명은 대/소문자 구별함
    $a=10;
    echo $a; // 10
    echo $A; // Notice: Undefined variable: A
    echo "zzz";

    // JS처럼 ; 생략 안됨
    // php영역의 마지막 명령은 생략 가능
    echo "kkk"
    // echo "aa"

    ?>

    <hr>

    <?php
        echo "aa";
        print "bb";
        prinT "cc";

        //d
        #한줄짜리 주석 표시로 '#'사용 가능

    ?>
    
</body>
</html>