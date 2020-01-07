<?php

    echo "<meta charset='utf-8'>";

    // &&, || --> and, or 키워드 추가
    $age= 25;
    if( $age>20 and $age<30) echo "20대<br>";
    if( $age<20 or $age<30) echo "20대<br>";

    // 조건문 중 else if문
    $score= 85;
    if( $score>=90) echo "A입니다.<br>";
    elseif( $score>=80) echo "B입니다.<br>";
    elseif( $score>=70) echo "C입니다.<br>";
    else if( $score>=60) echo "D입니다.<br>";
    else echo "F<br>";

    // 문자열 비교: ==
    $name= "hong";
    if( $name=="hong") echo "same<br>";
    else if( $name="kim") echo "different<br>";

    //switch문도 가능함
    switch($name){
        case "kim":
            echo "different<br>";
            break;
        case 'hong':
            EcHo "same<br>";
            break;
    }

    // foreach문 
    // foreach .. as(~로써) 
    $arr= array(10, 20, 30);
    foreach( $arr as $e ){
        echo "$e <br>";
    }

    //함수는 JS와 같음
    function show(){
        echo "show <br>";
    }
    show();
    //호출순서 상관없음
    kkk();

    function add($x, $y){
        echo $x+$y ."<br>";
    }
    add(10, 5);

    function sss($x){
        if($x<10) return null;

        if($x<20) return "sss";

        return 100;
    }

    echo sss(5)."<br>";
    echo sss(15)."<br>";
    echo sss(25)."<br>";

    
?>

<?php

    function kkk(){
        echo "kkk <br>";
    }

?>

<?php $gg=10; ?>
<?php echo $gg; ?>

<?php 
    for($i=0; $i<10; $i++){        
?>
        <h2><?= $i?></h2>
<?php
    }?>