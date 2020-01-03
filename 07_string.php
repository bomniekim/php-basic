<?php

// 스트링에 관련된 함수들 (메소드가 아님)
// 글자 수 알아내기

$str="Hello world!";
echo strlen("Hello world!");
echo "<br>";

// 단어 수 알아내기
echo str_word_count("Hello world!");
echo "<br>";

// 자바의 indexof
echo strpos("Hello world!", "world"); // 6
echo "<br>";

// replace
echo str_replace("world", "android", $str);

// split
$phone= "010-2421-5734";
$hps= explode("-", $phone);

echo $hps."<br>"; // Array: notice
echo $hps[0]."<br>"; 
echo $hps[1]."<br>"; 
echo $hps[2]."<br>";

// split의 반대: 배열요소를 붙여서 문자열 하나로 출력
$arr= array("Sonny","boy","7");
$str= implode("/",$arr);
echo "$str <br>";

// 줄바꿈문자(\n)을 <br>태그로 변경
$cont= "Hello.\nNice to meet you.\n";

$cont=nl2br($cont);
echo $cont;

// <br>을 \n으로 변경하는 함수는 없음
// 하고 싶다면 replace
$cont=str_replace("<br />", "\n",$cont);
echo $cont;













?>