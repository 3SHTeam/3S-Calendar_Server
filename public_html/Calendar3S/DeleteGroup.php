<?php
	$message = $_POST["message"];

	//�� php�� �ϱ� ���� �����ٰ� ������ ���ο��� �� �׷�� ���õ� ������
	//�����ؾ� �Ѵ�. 



	//�׷� �������� ��� ����
	$query = "Delete From sjoinlist "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	mysqli_query($conn, $query);

	
	//�׷� �޼����� ��� ����
	$query = "Delete From invitemessages "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);
	

	//�׷� �±׸� ��� ����
	$query = "Delete From staglist "; 
	$query = $query . "Where Gid='" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);


	//�׷쿡�� ��� Ż��
	$query = "Delete From gjoinlist "; 
	$query = $query . "Where Gid = '" . $message."'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);



	//�׷��� ����
	$query = "Delete From groups "; 
	$query = $query . "Where Gid ='" . $message."'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}

	mysqli_query($conn, $query);


	mysqli_close($conn);	
?>