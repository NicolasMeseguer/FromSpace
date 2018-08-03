<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'constantes.php';

if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message']) ) {
	$email = $_POST['email'];
	$user = $_POST['name'];
	$message = $_POST['message'];

	$mail = new PHPMailer();

	/*Configuracion PHPMailer*/
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = EMAIL;
	$mail->Password = PX_555923_XD;

	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->setFrom('youremail', 'Portfolio Contact');
	$mail->addAddress('email to someone', 'Portfolio Contact');
	$mail->Subject  = 'Message from www.nicolasmeseguer.com';
	$mail->Body     = "Sender's name: '".$user."' | Sender's mail: '".$email."' | Message attached: '".$message."'";
	$mail->send();

	echo("Message sent. I am personally redirecting you to the website.<br> Thanks, Nicolas Meseguer.");
	header( "refresh:3;url=../" );
}
else {
	echo("Hmm... are you lost ? Let me take you to the index");
	header( "refresh:3;url=../" );
}
?>