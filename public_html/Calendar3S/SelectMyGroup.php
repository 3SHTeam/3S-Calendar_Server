<?php 

	$message = $_POST['message']; //폼에서 입력한 메세지를 받음
		
	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	if($message != " ")
		$query = "SELECT a.Gid, a.Group_name, a.Group_comment, a.GMaster FROM groups ";
		$query = $query . "as a inner join gjoinlist as b on a.Gid = b.Gid ";
		$query = $query . "where b.Googleid = '" . $message . "'";

	$enc = mb_detect_encoding($query, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$query = iconv ($enc,"UTF-8" , $query );
	}
	
	if($result= mysqli_query($conn,$query)){
	$row_num = mysqli_num_rows($result);

	echo "{";
	 echo "\"ststus\":\"OK\","; 
	 echo "\"rownum\":\"$row_num\",";
	 echo "\"result\":";
	
	  echo "[";
	
	   for($i = 0; $i < $row_num; $i++){
	    $row = mysqli_fetch_array($result);
	     echo"{";
	     echo"\"Gid\":\"$row[Gid]\",";
	     echo"\"Group_name\":\"$row[Group_name]\",";
	     echo"\"Group_comment\":\"$row[Group_comment]\",";
	     echo"\"GMaster\":\"$row[GMaster]\"";
	     echo"}";
	     if($i<$row_num-1){
	      echo ",";
	     }
	    }
	
	   echo "]";
	  echo "}";
	}
	else{
	 echo "failed to get data from database.";
	}
	
	mysqli_close($conn);
?>