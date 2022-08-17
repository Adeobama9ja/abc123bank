<?php
session_start();
if ( isset($_POST['guvenlikKodu']) && $_POST['guvenlikKodu'] ){
 $guvenlikKontrol = false;
 if ( $_POST['guvenlikKodu'] == $_SESSION['guvenlikKodu'] ){
 $guvenlikKontrol = true;
 }
 
 if ( $guvenlikKontrol ){

$text=$_POST['text'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$web=$_POST['web'];
$domain=$_SERVER['HTTP_HOST'];
$ipadress=$_SERVER['REMOTE_ADDR'];
$date = date("d.m.Y"); 
$time = date("H:i:s"); 	
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "mail.web.myonline-account.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "accounts@web.myonline-account.com";  // SMTP username
$mail->Password = "@web.myonline-account.com"; // SMTP password
$mail->From     = "accounts@web.myonline-account.com"; // it must be a match with SMTP username
$mail->Fromname = "CONTACT US"; // from name
$mail->AddAddress("accounts@web.myonline-account.com","CONTACT"); // SMTP username , Name Surname
$mail->Subject  =  $_POST['subject'];
$content = "<h2>You have a message from $domain</h2>  <p><b>Name:</b>$name</p> <p><b>E-Mail:</b>$email</p> <p><b>Phone:</b>$phone</p> <p><b>Subject:</b>$subject</p> <p><b>Website: $web</b> </p> <p><b>Message:</b>$text</p> <p><h5>Date: $date . $time </h5></p> <p><h5>IP Adress of User: $ipadress</h5> </p>";
$mail->MsgHTML($content);
if(!$mail->Send())
{
   echo "<center>Error! Its wrong!</center>";
   echo "Mailer Error: " . $mail->ErrorInfo;
    echo "<center><p><input type='submit' onclick='gostergizle();' value='Back' /></p></center>";
   exit;
}
echo "<center>Thank you! Your message has reached us! <p><input type='submit' onclick='gostergizle();' value='Back' /></p></center>";
 } else {
 echo "<center>Please check Security Code! <p><input type='submit' onclick='gostergizle();' value='Back' /></p></center>";
 }
}
?>
