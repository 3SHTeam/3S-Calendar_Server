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


	// (자신의 토큰, 메세지)

	$SendMessage = $_POST['message']; //폼에서 입력한 메세지를 받음
	if ($SendMessage == ""){
		$SendMessage = "메세지 전송 오류!.";
	}
	$enc = mb_detect_encoding($SendMessage, array("UTF-8","EUC-KR","SJIS"));
	if($SendMessage != "UTF-8"){
		$SendMessage = iconv ($enc,"UTF-8" , $SendMessage);
	}
	$message = array("message" => $SendMessage);


	$Token = $_POST['Token']; //폼에서 입력한 메세지를 받음

	$enc = mb_detect_encoding($Token, array("UTF-8","EUC-KR","SJIS"));
	if($Token != "UTF-8"){
		$Token = iconv ($enc,"UTF-8" , $Token );
	}
	$tokens = array();
	//$tokens[]= "c0NOXp_J_RE:APA91bF-AHbTXGyusrunJL5W9m-ZMSlbynErJlxDa56xJ9U8wRLfi2PGlo6C2Y_f4uCP9DN6mM5o__IX6n_5uhagdtscLr32mFqOXgw2Yf2iugAlzfn9GLBC9uN9Cl8-oL1MEeRnS5RQ"; // 태블릿
	$tokens[] = $Token;
	
	$message_status = send_notification($tokens, $message);
	//echo $message_status;


	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "John Doe\n";
	fwrite($myfile, $txt);
	fwrite($myfile, $message_status);
	fclose($myfile);

 ?>