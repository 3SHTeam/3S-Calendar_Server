<?php 

	$message = $_POST['message']; //폼에서 입력한 메세지를 받음
		
	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	if($message != " ")
		$query = "SELECT a.Sid, a.SMaster, a.Sname, a.Place, a.StartTime, ";
		$query = $query . "a.EndTime, b.Tagid, b.GoogleSid, b.Gid FROM schedules ";
		$query = $query . "as a inner join sjoinlist as b on a.Sid = b.Sid where b.Googleid = '" . $message ."'";

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
	     echo"\"Sid\":\"$row[Sid]\",";
	     echo"\"SMaster\":\"$row[SMaster]\",";
	     echo"\"Sname\":\"$row[Sname]\",";
	     echo"\"Place\":\"$row[Place]\",";
	     echo"\"StartTime\":\"$row[StartTime]\",";
	     echo"\"EndTime\":\"$row[EndTime]\",";
	     echo"\"Tagid\":\"$row[Tagid]\",";
	     echo"\"GoogleSid\":\"$row[GoogleSid]\",";
	     echo"\"Gid\":\"$row[Gid]\"";
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