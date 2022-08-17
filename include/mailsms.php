 <?php 
 function send_mail($email, $messag, $subject) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "";
        $mail->Host = "one.log-hosts.xyz";
        $mail->Port = 587;
        $mail->AddAddress($email);
        $mail->Username = "support@one.log-hosts.xyz";
        $mail->Password = "1lorentBank!";
        $mail->SetFrom('support@one.log-hosts.xyz', 'LOrent Western');
        $mail->AddReplyTo("support@one.log-hosts.xyz", "L'Orent Western");
        $mail->Subject = $subject;
        $mail->MsgHTML($messag);
        $mail->Send();
    }

    function otp($to, $msg) {
        //twillio
        $sid = "AC99a2326a0790b30a46f2109c01f9b39e"; // Your Account SID from www.twilio.com/console
        $token = "3430c6b577d3ddf268d2600098d96560"; // Your Auth Token from www.twilio.com/console
        $client = new Twilio\Rest\Client($sid, $token);
         try { $message = $client->messages->create(
                '+' . $to, array(
            'from' => 'LOrent Western', // From a valid Twilio number
            'body' => $msg
                )
        );
  // Display a confirmation message on the screen
        echo "Sent message to $name";

   //sent successfully
    echo "sent to $to successfully<br>";
  }catch(Exception $e){
    echo $e->getCode() . ' : ' . $e->getMessage()."<br>";
  }

}

    ?>