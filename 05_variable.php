<?php


    // 자료형: Data Type
    /*
        String
        Integer
        Float
        Boolean
        Array
        NULL
        Object 
    */

    // String
    $x= "Hello World";
    echo $x;
    echo "<br>";
    
    $y='Nice to meet you'; // '도 문자열
    echo $y;
    echo "<br>";

    // "와 '의 차이
    echo "$x <br> $y <br>";
    echo '$x <br> $y <br>';

    // "안에 $를 사용하면 변수명으로 인식
    // '안에 $를 사용하면 문자 $ 자체로 인식

    //문자열 결합
    echo "Son"."Heungmin";

    //Integer
    $x= 7; // 같은 변수에 다른 자료형 대입 가능
    echo "$x <br>";

    //변수의 자료형과 값을 출력해주는 내장함수
    var_dump($x);
    
    //Float
    $x= 10.315;
    var_dump($x);

    //Boolean
    $x= true; // c언어를 기본으로 하는 php: 1
    $y= false; // 값이 0이지만 출력이 아예 없음
    echo $x. ",".$y. "<br>"; // 1,

    //Array
    $arr= array("Harry", "Sonny", "Dele");
    var_dump($arr);

    echo $arr[0].",".$arr[1].",".$arr[2];

    //NULL: 값을 아직 대입하고 싶지 않을 때
    $x=null;
    var_dump($x);
    echo $x; // 출력이 없음

    echo "<hr>";


    // 변수 출력 시 주의할 점
    $a=7;
    echo "$a 입니다.<br>"; // 7 입니다.
    // echo "$a입니다.<br>"; // Undefined variable: a입니다
    echo "{$a}입니다.<br>" // 7입니다.



?>