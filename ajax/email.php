<?php		
	$errors = array();

	if (strlen(trim($_POST['user_name'])) === 0) {
		$errors[] = 'user_name_error';
	} 
	
	if (strlen(trim($_POST['user_email'])) === 0) {
		$errors[] = 'user_email_error';
	} 
	
	if (strlen(trim($_POST['user_message'])) === 0) {
		$errors[] = 'user_message_error';
	}
	
	if (count($errors) > 0) {
		echo json_encode(array('errors' => $errors));
	} else {
		$email = 'andrew@arobertsillustration.com';
		//$email = 'scott.c.taylor@mac.com';
		$subject = "Website Message from " . $_POST['user_name'];
		$message = htmlentities(nl2br($_POST['user_message']), ENT_QUOTES,"UTF-8");

		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; 	
		$headers .= "From: ".$_POST['user_name']." <".$_POST['user_email'].">";

		if (mail($email, html_entity_decode($subject), html_entity_decode($message), $headers)){
		 	echo json_encode(array('errors' => array()));
		} else {
			echo json_encode(array('errors' => array('email_error_message')));
		}			
	}
?>		