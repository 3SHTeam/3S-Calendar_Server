<?php
	$message = $_POST["message"];

	//이 php를 하기 전에 스케줄과 스케줄 조인에서 이 그룹과 관련된 모든것을
	//삭제해야 한다. 



	//그룹 스케줄을 모두 삭제
	$query = "Delete From sjoinlist "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	
	//그룹 메세지를 모두 삭제
	$query = "Delete From invitemessages "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);
	

	//그룹 태그를 모두 삭제
	$query = "Delete From staglist "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);


	//그룹에서 모두 탈퇴
	$query = "Delete From gjoinlist "; 
	$query = $query . "Where Gid = '" . $message."'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);



	//그룹을 삭제
	$query = "Delete From groups "; 
	$query = $query . "Where Gid ='" . $message."'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);


	mysqli_close($conn);	
?>