<?php
	$message = $_POST["message"];
	$id = $_POST["id"];

	// message = 수정할 데이터, id = 접근용 데이터
	// id에서 Googleid와 Sid로 검색한다.
	//Tagid
	$query = "UPDATE sjoinlist SET ". $message;
	$query = $query . " where " . $id;

	$enc = mb_detect_encoding ($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>