<?php 
	
	header('Access-Control-Allow-Origin: *');
	
	session_start();
	require 'PHPMailer/PHPMailerAutoload.php';

	if(isset($_SERVER['HTTP_REFERER'])){
		$headerloc = $_SERVER['HTTP_REFERER'];
	}else{
		// header('Location: ../index.php');
		$headerloc = '../index.html';
	}

	$varMain = false;

	$json = array();

	if(isset($_POST['g-recaptcha-response'])){
		$postdata = http_build_query(
			array(
				'secret' 		=> '6LexmfsgAAAAAJvx57ZBWRl_16o8JayTQedBsGd8',
				'response'	=> $_POST['g-recaptcha-response']
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'content' => $postdata
			)
		);
		$context  = stream_context_create($opts);
		$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
		$result = json_decode($result);
		if($result->success){
			$varMain = true;
		}
	}


	if (!empty($_POST) && $varMain){

		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;
		$mail->IsSMTP();
		$mail->Encoding = "base64";
		$mail->SMTPAuth = true;

		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = 'sravahkumar@gmail.com';
		$mail->Password = 'vpwpkncrrhstgjvr';
		$mail->SMTPSecure = 'ssl';		
		$mail->setFrom('sravahkumar@gmail.com', "DR4 Request");
		$mail->addAddress('info@digitalroof.com');

		unset($_POST['submit']);
		$headingSub = $_POST['heading'];
		unset($_POST['heading']);
		unset($_POST['g-recaptcha-response']);

		$msg_html = "<div> <ul>"; 
		foreach ($_POST as $key => $value) {
			// if(gettype($value) == "array"){
			// 	$value = implode(" & ", $value);
			// }

			$msg_html .= "<li><span>".ucfirst(str_replace(['_']," ",$key))." : </span><span> <b>".ucfirst( str_replace("_", " ", $value))." </b></span></li>";
		}

		$msg_html .= "</ul> </div>";

		if(empty($headingSub)){
			$headingSub = "Request Assistance";
		}

		$mail->Subject = $headingSub;
		$mail->isHTML(true);
		$mail->Body = $msg_html;
		$mail->AltBody = 'This is a plain-text message body';

		if (!$mail->send()){
			// $_SESSION['response'] = "error";
			// if(isset($_SERVER['HTTP_REFERER'])){
			// 	header('Location: '.$_SERVER['HTTP_REFERER']);
			// }else{
			// 	header('Location: ../index.php');
			// }

			$json['success'] = false;

		}else{
			// $_SESSION['response'] = "sent";
			// if(isset($_SERVER['HTTP_REFERER'])){
			// 	header('Location: '.$_SERVER['HTTP_REFERER']);
			// }else{
			// 	header('Location: ../index.php');
			// }

			$json['success'] = true;

		}
	}else{
		
		// $_SESSION['response'] = "error";
		// if(isset($_SERVER['HTTP_REFERER'])){
		// 	header('Location: '.$_SERVER['HTTP_REFERER']);
		// }else{
		// 	header('Location: ../index.php');
		// }
		$json['success'] = false;
	}

	header('Content-type: application/json');
	print_r(json_encode($json));
?>
