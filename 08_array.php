<?php

    $arr= [10, 20, 30];
    echo $arr[0].", ".$arr[1].", ".$arr[2]."<br>";

    echo $arr. "<br>"; // Array
    // Notice: Array to string conversion
    // you cannot treat an array like a string

    foreach($arr as $value){
        echo $value, ', ';
    }
    echo '<br>';


    //배열의 개수 함수
    $len= count($arr);
    echo "배열길이 : $len <br>";

    echo $arr[10];
    echo $arr[-5];

    $arr[3]= 40;
    echo $arr[3]."<br>";
    $len= count($arr);
    echo "배열길이 : $len <br>";

    $arr[9]=100;
    echo $arr[9]."<br>";
    $len= count($arr);
    echo "배열길이 : $len <br>";

    $arr[6]= 70;
    $len= count($arr);
    echo "배열길이 : $len <br>";

    for($i=0; $i<$len; $i++){
        echo $arr[$i]."<br>";
    }

    foreach( $arr as $e){
        echo $e."<br>";
    }


    $arr2= []; //0개짜리 배열
    $len= count($arr2);
    echo "배열길이 : $len <br>";

    //동적 타이핑언어여서
    $arr3= [10, "aa", true, 3.14];


    //배열을 만드는 2번째 방법 : array()함수
    $arr= array(10, "aa", 3.14);
    foreach( $arr as $e) echo "$e<br>";

    echo "$arr[0] $arr[1] $arr[2]<br>";

    //연관배열 : index번호 대신에 key 식별자 사용
    $arr2= array("name"=>"sam", "age"=>20, aver=>70.5);
    echo $arr2["name"]."<br>";
    echo $arr2['age']."<br>";
    echo $arr2['aver']."<br>";

    echo $arr2[name]."<br>";
    echo $arr2[age]."<br>";
    echo $arr2[aver]."<br>";

    $str= Hello;
    echo "$str <br>";

    //연관배열 foreach
    foreach( $arr2 as $e ){
        echo $e."<br>";
    }

    //키도 보고 싶다면
    $aaa="";
    foreach( $arr2 as $k=> $v ){
        $aaa .= $arr[$k];
    }

    echo $arr2[1]. "<br>";

    echo $arr2['name'] . $arr2['age']."<br>";

    //배열의 정렬관련 함수들..w3schools 참고
    // sort()
    // rsort()
    // asort()
    // ksort()
    // arsort()
    // krsort()

    // $car= array(
    //     array(10,20,30),
    //     array("aa","bb"),
    //     array(true, false, null)
    // );


?>