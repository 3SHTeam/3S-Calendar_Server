<?php 
	//FCM 보내기
	function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);

		$headers = array(
			'Authorization:key = AAAAQgmd8Uk:APA91bH7jrmQpgP3XC9KJD7Xz7kNQITZO1nSX1XjgJpRUFfJ2UDMAgDOZuAI17hjRDojijZ8Kb_U0srucQ6fkhiaeYSeh8wyukTqDplNlMDjtXJxhZYtHi1M96uhfvsA2kJz6oYkfQNZ',
			'Content-Type: application/json'
			);


	   	$ch = curl_init();
      		curl_setopt($ch, CURLOPT_URL, $url);
       		curl_setopt($ch, CURLOPT_POST, true);
       		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
       		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

       		$result = curl_exec($ch);           
       		if ($result === FALSE) {
           		die('Curl failed: ' . curl_error($ch));
       		}
       		curl_close($ch);
       		return $result;
	}


	// 원하는 기기의 토큰값을 찾아온다. (그룹아이디, 메세지)

	$SendMessage = $_POST['message']; //폼에서 입력한 메세지를 받음
	if ($SendMessage == ""){
		$SendMessage = "메세지 전송 오류!.";
	}
	$enc = mb_detect_encoding($SendMessage, array("UTF-8","EUC-KR","SJIS"));
	if($SendMessage != "UTF-8"){
		$SendMessage = iconv ($enc,"UTF-8" , $SendMessage);
	}
	//메세지를 동적배열로 만들어줌
	$message = array("message" => $SendMessage);


	$Gid = $_POST['Gid']; //폼에서 입력한 메세지를 받음
	$conn = mysqli_connect("localhost","root","autoset","3s_calendar_db");
	$sql = "Select a.FBToken From users as a inner join gjoinlist as b ";
	$sql = $sql . "on a.Googleid = b.Googleid where b.Gid = '".$Gid ."'";
	
	$enc = mb_detect_encoding($sql, array("UTF-8","EUC-KR","SJIS"));
	if($query != "UTF-8"){
		$sql = iconv ($enc,"UTF-8" , $sql );
	}

	$result = mysqli_query($conn,$sql);


	$tokens = array();
	//그룹의 토큰값들을 tokens로 묶는다.
	if(mysqli_num_rows($result) > 0 ){
		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["FBToken"];	
		}
	}
	mysqli_close($conn);

	$message_status = send_notification($tokens, $message);
	//echo $message_status;


	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "John Doe\n";
	fwrite($myfile, $txt);
	fwrite($myfile, $message_status);
	fclose($myfile);

 ?>