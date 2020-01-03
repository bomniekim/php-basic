<?php

    $dan= 2;
    for($i=1; $i<10; $i++){
        echo "$dan * $i = " .$dan*$i;
        echo "<br>";

    }
?>

<hr>
<!-- 표로 보여주기 -->
<?php

    $dan=2;
    echo "<table border='1'>";

    for($i=1; $i<10; $i++){
        echo ("<tr>
                <td>$dan</td>
                <td>$i</td>
                <td>". $dan*$i ."</td>
            </tr>");
            // 줄바꿈을 하기 위해서 원래는 ()를 사용했어야 했지만 버전업 후엔 취사선택 가능
    }
    echo "</table>";


?>

<!-- echo로 html을 작성하는 것은 번거로움 -->
<!-- 그래서 html과 php를 혼용해서 사용 -->
<hr>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

    <table border="2" style="text-align: center;">

        <?php
            $dan=5;

            for($i=1; $i<10; $i++){

        ?>

            <!-- 이 영역은 html -->
            <tr>
                <td><?php echo $dan;?></td>
                <td><?= $i?></td>
                <td width="50"><?= $dan*$i ?></td>
            </tr>
        <?php
            }
        ?>

    </table>

</body>
</html>