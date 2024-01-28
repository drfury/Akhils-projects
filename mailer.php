
<?php
include('smtp/PHPMailerAutoload.php');

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phonenum'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];

    $subject = 'Contact Form Submission';
    $msg = "Name: $name<br>Email: $email<br>Phone Number: $phonenum";

    $result = smtp_mailer('akheelchitaa@gmail.com', $subject, $msg);
    
    if ($result === 'Sent') {
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email sending failed']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}

function smtp_mailer($to, $subject, $msg) {
    // The rest of your email sending code
    $mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "akheelchitaa@gmail.com";
	$mail->Password = "vpyotmsycpcrfguc";
	$mail->SetFrom("akheelchitaa@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
?>


