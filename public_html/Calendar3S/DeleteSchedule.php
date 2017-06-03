<?php
	$message = $_POST["message"];

	//Sid = ~~~ 스케줄 하나 지우기	SMaster = ~~~ 내가 만든것 모두 지우기
	$query = "delete from schedules "; 
	$query = $query . "where " . $message;

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>