<?php
$mailto = $_POST['mail_to'];
$mailSub = $_POST['mail_sub'];
$mailMsg = $_POST['mail_msg'];

require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail -> IsSmtp();
$mail -> SMTPDebug = 0;
$mail -> SMTPAuth = true;
$mail -> SMTPSecure = 'ssl';
$mail -> Host = "smtp.gmail.com";
$mail -> Port = 567;
$mail -> IsHTML(true);
$mail -> Username = "hayleyfyp@gmail.com";
$mail -> Password = "xxbutterfly10";
$mail -> SetFrom("hayleyfyp@gmail.com");
$mail -> Subject = $mailSub;
$mail -> Body = $mailMsg;
$mail -> AddAddress($mailto);

if(!$mail -> Send())
{
    echo "Mail not sent";
}
else {
    echo "Mail sent";
};

//$message = "The mail message was sent from the following mail";
//$headers = "From: hayleyfyp@gmail.com";
//
//mail("hayleyfyp@gmail.com", "Testing", $message, $headers);
//
//echo "Test message is sent to hayleyfyp@gmail.com  <br>";

?>
