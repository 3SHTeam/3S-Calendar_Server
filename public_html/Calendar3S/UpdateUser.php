<?php
	$message = $_POST["message"];
	$id = $_POST["id"];

	//id에서 Googleid와 Googlepw로 검색한다.
	//(Googlepw, name, gender, nickname, birth, phone, comment, FBuId)
	// Sname = 'name',  ....
	$query = "UPDATE users set ". $message;
	$query = $query . " where '" . $id;

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>