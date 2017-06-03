<?php
	$message = $_POST["message"];
	$id = $_POST["id"];

	//(Group_name, Group_comment, GMaster)
	// Group_name = 'name', Group_comment = 'comment' ....
	$query = "UPDATE groups set ". $message;
	$query = $query . " where Gid = '" . $id . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	mysqli_close($conn);

?>