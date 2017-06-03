<?php
	$message = $_POST["message"];

	//Sid = ~~~ 하나의 스케줄 해제	Googleid = ~~ 탈퇴시 모든 스케줄 해제
	$query = "Delete From sjoinlist "; 
	$query = $query . "Where " . $message;

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>