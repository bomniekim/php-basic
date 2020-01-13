<?php

    $src_name=$_GET['src_name'];   // 원본파일명
    $file_path=$_GET['file_path']; // 저장된 파일경로 및 파일명
    $file_size=$_GET['file_size']; // 파일사이즈
    
    // 저장된 파일을 사용자에게 byte단위로 echo --> 다운로드 동작

    // 1. 저장된 파일을 읽어오기
    if ( file_exists($file_path) ){

        // 파일을 Byte단위로 읽기 위한 파일포인터 얻어오기
        $fp= fopen($file_path, "rb"); // binary(2진수)모드로 읽기

        // 다운로드 받을 사용자에게 파일에 대한 meta데이터를 
        // header에 추가해서 보내줘야만 다운로드가 가능
        Header("Content-Type: text/html:application/x-msdownload");
        Header("Content-Length: ".$file_size);
        Header("Content-Disposition: attachment; filename=".$src_name); // 파일첨부; 파일명은 사용자의 브라우저에 보여지는 파일명
        Header("Content-Transfer-Encoding: binary");
        Header("Content-Description: File Transfer"); // 콘텐츠의 세부행동이 파일전송이라는 의미
        Header("Expire : 0"); // 만료기한 없음
        

    }

    // fpassthru(); 사용자에게 파일의 내용를 뿌려주는 함수 (파일 포인터의 끝까지 모든 데이터를 출력해주는 함수)
    // 즉, 파일의 데이터들을 byte단위로 echo해줌 
    // 파일 끝에 도달하면 false가 return (파일데이터 출력(다운로드)이 종료되었다는 것)
    if( fpassthru($fp) ) fclose($fp);


?>