<?php

	$message = $_POST["message"];

	$query = "INSERT INTO invitemessages(sender, receiver, type, message, Gid, Gname) ";
	$query = $query."Values (".$message.")";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>