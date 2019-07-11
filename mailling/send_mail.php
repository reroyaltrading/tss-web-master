<?php

//print_r($_POST);

$Nome		=  'Marco'; //$_POST["first_name"];	// Pega o valor do campo Nome
$Fone		=  '13997574127'; //isset($_POST["phone"]) ? $_POST["phone"] : "";	// Pega o valor do campo Telefone
$Email		= 'marckdx@outlook.com';//$_POST["email"];	// Pega o valor do campo Email
$Mensagem	=  'Olá';//isset($_POST["message"]) ? $_POST["message"] : "";
$hash	=  '123456'; //isset($_POST["hash"]) ? $_POST["hash"] : "";	// Pega os valores do campo Mensagem

// Variável que junta os valores acima e monta o corpo do email

$Body 		= "Hey $Nome,\nYour purchase order was received, you can access using this <a href='https://project99.globalapps.ca/view_order.php?hash=$hash'>link</a>";

require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'no-reply@blascke.com');	// <-- Insira aqui o seu GMail
define('GPWD', '*hAP2>4W');		// <-- Insira aqui a senha do seu GMail

$message_sent = false;

function smtpmailer($para, $de, $de_nome, $assunto, $corpo, $copy) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.googlemail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
    $mail->MsgHTML($corpo);
    $mail->AddAddress($para);
    $mail->AddAddress($copy);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return array('error' => $error, 'sent' => false);
	} else {
		$error = 'Mensagem enviada!';
		return array('error' => $error, 'sent' => true);
	}
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

$message_sent = smtpmailer($Email, 'no-reply@blascke.com', 'Blascke', 'Purchase order received', $Body, "brasil@blascke.com");

print(json_encode(array('sent' => $message_sent, 'email' => $Email)));
//if (!empty($error)) echo $error;
?>