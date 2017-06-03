<?php
	$message = $_POST["message"];

	//Tagid = ~~ 하나만 지우기	Googleid = ~~~ 회원탈퇴시 모두 지우기
	$query = "Delete From staglist "; 
	$query = $query . "Where " . $message;

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>