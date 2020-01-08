<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 프로그래밍 입문</title>

    <!-- 공통 스타일시트 연결 -->
    <link rel="stylesheet" href="./css/common.css">
    <!-- main.php만의 스타일시트 연결 -->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <!-- 공통사용 외부 php문서 추가 :공통으로 사용하는 php는 lib폴더 작성해 공통모듈을 만들어 적용-->
        <?php include "./lib/header.php"?> <!-- include: 다른 폴더의 문서가 복사되어 안으로 들어오는 개념 -->
    
    </header>
    <section>
        <!-- Main Content 문서를 별도로 제작: 추후의 유지/보수시의 편의성을 위해 -->
        <?php include "./main.php" ?>
    
    </section>
    <footer>
        <!-- 공통모듈 추가 -->
        <?php include "./lib/footer.php" ?>
    
    </footer>
    
</body>
</html>