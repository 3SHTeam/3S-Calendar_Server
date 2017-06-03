<?php 

	$message = $_POST['message']; //폼에서 입력한 메세지를 받음
	

	// sender가 자신이거나 receiver가 자신일경우 가져옴	
	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	if($message != " ")
		$query = "SELECT Mid, sender, receiver, type, message, Gid, Gname FROM invitemessages "; 
		$query = $query ."where ". $message;


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
	     echo"\"Mid\":\"$row[Mid]\",";
	     echo"\"sender\":\"$row[sender]\",";
	     echo"\"receiver\":\"$row[receiver]\",";
	     echo"\"type\":\"$row[type]\",";
	     echo"\"message\":\"$row[message]\",";
	     echo"\"Gid\":\"$row[Gid]\",";
	     echo"\"Gname\":\"$row[Gname]\"";
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