<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'Exception.php';
	require 'PHPMailer.php';
	require 'SMTP.php';

	if(empty($_POST["name"]) or empty($_POST["email"]) or empty($_POST["message"]) or !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			echo "<script>alert('Error, probá otra vez!');window.location.replace('https://www.diestrocorp.com.ar/portfolio-matias-perez-dev/index.html');</script>";
			die();
	}

	$name = $_POST["name"];
	$email = $_POST["email"];
	$message = $_POST["message"];

	$emailBody = "Nombre: ".$name." | E-mail: ".$email." | Mensaje: ".$message;

	//----------------------------Empieza PHPMailer----------------------------------------------------
	$mail = new PHPMailer(true);
	try{
		$mail->setFrom($email, $name.' | Contacto Portfolio Matías Pérez');
		$mail->addAddress('matias.perez.mcd@gmail.com', 'Matías Pérez Portfolio');
		$mail->Subject = "Contacto Portfolio Matías Pérez";
		$mail->Body = $emailBody;		
   		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
   		$mail->Host = //Here goes the server address (example 'smtp.gmail.com').
   		$mail->SMTPAuth = TRUE;
  		$mail->SMTPSecure = 'tls';
   		$mail->Username = //Here goes the email adress.
   		$mail->Password = //Here goes the password.
   		$mail->Port = 587;if($mail->send()){
			echo "<script>alert('Mensaje enviado!');window.location.replace('https://www.diestrocorp.com.ar/portfolio-matias-perez-dev/gracias.html');</script>";
			die();
		}else{
			echo "<script>alert('Error, probá otra vez!');window.location.replace('https://www.diestrocorp.com.ar/portfolio-matias-perez-dev/index.html');</script>";
			//print_r(error_get_last());
			die();
		}
	}catch (Exception $e){
		echo $e->errorMessage();
	}catch (\Exception $e){
		echo $e->getMessage();
	}
	//----------------------------Termina PHPMailer----------------------------------------------------
?>
