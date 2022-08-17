<?php
session_start();
require_once ('class.admin.php');
include_once ('session.php');

$reg_user = new USER();

if (!isset($_SESSION['email'])) {

    header("Location: login.php");

    exit();
}

$stmt = $reg_user->runQuery("SELECT * FROM account");
$stmt->execute();

$credit = $reg_user->runQuery("SELECT * FROM account");
$credit->execute();

$debit = $reg_user->runQuery("SELECT * FROM account");
$debit->execute();

$mail = $_SESSION['email'];

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = '$mail'");
$ad->execute();
$rom = $ad->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['edit'])) {
    $pass = $_POST['upass1'];
    $cpass = $_POST['upass'];
    $email = $_POST['email'];

    if ($cpass !== $pass) {
        $msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Passwords Doesn't match. 
						</div>";
    } else {
        $password = md5($cpass);
        $ed = $reg_user->runQuery("UPDATE admin SET email = '$email', upass = :upass WHERE email=:email");
        $ed->execute(array(":upass" => $password, ":email" => $_SESSION['email']));

        $msg = "<div class='alert alert-info'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Login Details Was Successfully Changed!</strong>
						</div>";
    }
}

if (isset($_POST['his'])) {
    $uname = trim($_POST['uname']);
    $uname = strip_tags($uname);
    $uname = htmlspecialchars($uname);

    $amount = trim($_POST['amount']);
    $amount = strip_tags($amount);
    $amount = htmlspecialchars($amount);

    $sender_name = trim($_POST['sender_name']);
    $sender_name = strip_tags($sender_name);
    $sender_name = htmlspecialchars($sender_name);

    $type = trim($_POST['type']);
    $type = strip_tags($type);
    $type = htmlspecialchars($type);

    $remarks = trim($_POST['remarks']);
    $remarks = strip_tags($remarks);
    $remarks = htmlspecialchars($remarks);

    $date = trim($_POST['date']);
    $date = strip_tags($date);
    $date = htmlspecialchars($date);

    $time = trim($_POST['time']);
    $time = strip_tags($time);
    $time = htmlspecialchars($time);

    $alerts = $reg_user->runQuery("SELECT * FROM alerts");
    $alerts->execute();

    if ($reg_user->his($uname, $amount, $sender_name, $type, $remarks, $date, $time)) {
        $id = $reg_user->lasdID();


        $msg = "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>History Successfully Added!</strong> 
			  </div>";
    } else {
        $msg = "Error!";
    }
}

if (isset($_POST['credit'])) {
    $uname = trim($_POST['uname']);
    $uname = strip_tags($uname);
    $uname = htmlspecialchars($uname);

    $amount = trim($_POST['amount']);
    $amount = strip_tags($amount);
    $amount = htmlspecialchars($amount);

    $sender_name = trim($_POST['sender_name']);
    $sender_name = strip_tags($sender_name);
    $sender_name = htmlspecialchars($sender_name);

    $type = trim($_POST['type']);
    $type = strip_tags($type);
    $type = htmlspecialchars($type);

    $remarks = trim($_POST['remarks']);
    $remarks = strip_tags($remarks);
    $remarks = htmlspecialchars($remarks);
    
     $statz = trim($_POST['statz']);
    $statz = strip_tags($statz);
    $statz = htmlspecialchars($statz);

    $date = trim($_POST['date']);
    $date = strip_tags($date);
    $date = htmlspecialchars($date);

    $time = trim($_POST['time']);
    $time = strip_tags($time);
    $time = htmlspecialchars($time);



    if ($reg_user->his($uname, $amount, $sender_name, $type, $remarks, $date, $time, $statz)) {
        $read = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
        $read->execute();
        $show = $read->fetch(PDO::FETCH_ASSOC);

        $currency = $show['currency'];
        $acc = $show['acc_no'];
        $fname = $show['fname'];
        $mname = $show['mname'];
        $lname = $show['lname'];
        $email = $show['email'];
        $phone = $show['phone'];
        $tbal = $show['t_bal'];
        $abal = $show['a_bal'];
        $diff = $amount + $tbal;
        $dif = $amount + $abal;

        $credited = $reg_user->runQuery("UPDATE account SET t_bal = '$diff', a_bal = '$dif' WHERE acc_no = '$uname'");
        $credited->execute();

        $id = $reg_user->lasdID();




        $messag = "
			
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1{
  color:#382F2E;
  margin:0;
}

div,p,ul,h1{
  margin:0;
}
p{
font-size:13px;
color:#99A1A6;
line-height:19px;
}
h2,h1{
color:#444444;
font-weight:normal;
font-size: 22px;
margin:0;
}
a.link2{
padding:15px;
font-size:13px;
text-decoration:none;
background:#2D94DF;
color:#ffffff;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}
.bgBody{
background: #f6f6f6;
}
.bgItem{
background: #2C94E0;
}

@media only screen and (max-width:480px)
		
{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}	
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}		
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
	.font{
		font-size:15px !important;
		line-height:19px !important;
		
		}
}

</style>

<script type='colorScheme' class='swatch active'>
  {
    'name':'Default',
    'bgBody':'f6f6f6',
    'link':'ffffff',
    'color':'99A1A6',
    'bgItem':'2C94E0',
    'title':'444444'
  }
</script>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style=' margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
  
    <!-- =============================== Header ====================================== -->

  <tr>
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>

                    <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='transparent' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='200'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  <center><img src='https://secure.theubaonline.com/home/images/EHBankbank-logo-white.png' alt='' data-default='placeholder' data-max-width='100' width='150' height='80' ></center>
								  <b style='font-size:1.5em; color:#fff;'></b>
                                </div>
                              </div>
                            </td>

                            
                          </tr>
                        </table>
                      </td>
                    </tr>
          </table>
      </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'> </div>
        
        
        
      <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
       <br >                             <h1 style='font-size:20px;font-weight:normal;color:#0076b6;line-height:19px;'>Dear $fname $lname,</h1> <br >
 <p style='font-size:15px;color:#0076b6;line-height:19px;'>This is a summary of a transaction that has occurred on your account below</p>									<h3>Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>$type</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date $time</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>$remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>

										<tr style='background-color:#0076b6;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $diff</td>
										</tr>
                                     </table>
                                    </div>
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>L'Orent Western Online.</p>
                                    </div>
    <br>                           <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                     </div>
                                  </div>                               </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>&nbsp;</p>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
        </div>
    </td>
  </tr>
</table>


  </body>
  </html>


";


        $subject = '[Credit Alert] - LOrent Western Online';

        $reg_user->send_mail($email, $messag, $subject);
        $phone_sms = preg_replace('/[^0-9]/', '', $phone);
       $last_digit = substr($acc, -4);
        $amountt = $currency ."".$amount;
        $avl_bal = $currency ."".$diff;
        $rem = $remarks;
       
        $message_sms =" 
        Your Acct $last_digit Has Been Credited with $amountt.00 On $date $time By $rem .Available Bal:$avl_bal";
        $reg_user->otp($phone_sms, $message_sms);


        $msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$uname Successfully Credited the Sum of $amount!</strong> 
			  </div>";
    } else {
        $msg = "Error!";
    }
}

if (isset($_POST['debit'])) {
    $uname = trim($_POST['uname']);
    $uname = strip_tags($uname);
    $uname = htmlspecialchars($uname);

    $amount = trim($_POST['amount']);
    $amount = strip_tags($amount);
    $amount = htmlspecialchars($amount);

    $sender_name = trim($_POST['sender_name']);
    $sender_name = strip_tags($sender_name);
    $sender_name = htmlspecialchars($sender_name);

    $type = trim($_POST['type']);
    $type = strip_tags($type);
    $type = htmlspecialchars($type);

    $remarks = trim($_POST['remarks']);
    $remarks = strip_tags($remarks);
    $remarks = htmlspecialchars($remarks);

    $date = trim($_POST['date']);
    $date = strip_tags($date);
    $date = htmlspecialchars($date);
    
    $statz = trim($_POST['statz']);
    $statz = strip_tags($statz);
    $statz = htmlspecialchars($statz);

    $time = trim($_POST['time']);
    $time = strip_tags($time);
    $time = htmlspecialchars($time);

    $readd = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
    $readd->execute();
    $shows = $readd->fetch(PDO::FETCH_ASSOC);

    $email = $shows['email'];

    $name = $shows['fname'];
    $tbal = $shows['t_bal'];
    $abal = $shows['a_bal'];

    if ($tbal < $amount && $abal < $amount) {
        $msg = "<div class='alert alert-warning'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>The Amount ($amount) to be Debited is Higher Than $name's Account Balance ($tbal)</strong> 
			  </div>";
    } elseif ($reg_user->his($uname, $amount, $sender_name, $type, $remarks, $date, $time, $statz)) {
        $readd = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
        $readd->execute();
        $shows = $readd->fetch(PDO::FETCH_ASSOC);

        $currency = $shows['currency'];
        $acc = $shows['acc_no'];
        $fname = $shows['fname'];
        $mname = $shows['mname'];
        $lname = $shows['lname'];
        $email = $shows['email'];
        $phone = $shows['phone'];
        $tbal = $shows['t_bal'];
        $abal = $shows['a_bal'];
        $diffi = $tbal - $amount;
        $difi = $abal - $amount;

        $debited = $reg_user->runQuery("UPDATE account SET t_bal = '$diffi', a_bal = '$difi' WHERE acc_no = '$uname'");
        $debited->execute();

        $id = $reg_user->lasdID();




        $msg = "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$uname Successfully Debited the Sum of $amount!</strong> 
			  </div>";



        $messag = "
			
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1{
  color:#382F2E;
  margin:0;
}

div,p,ul,h1{
  margin:0;
}
p{
font-size:13px;
color:#99A1A6;
line-height:19px;
}
h2,h1{
color:#444444;
font-weight:normal;
font-size: 22px;
margin:0;
}
a.link2{
padding:15px;
font-size:13px;
text-decoration:none;
background:#2D94DF;
color:#ffffff;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}
.bgBody{
background: #f6f6f6;
}
.bgItem{
background: #2C94E0;
}

@media only screen and (max-width:480px)
		
{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}	
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}		
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
	.font{
		font-size:15px !important;
		line-height:19px !important;
		
		}
}

</style>

<script type='colorScheme' class='swatch active'>
  {
    'name':'Default',
    'bgBody':'f6f6f6',
    'link':'ffffff',
    'color':'99A1A6',
    'bgItem':'2C94E0',
    'title':'444444'
  }
</script>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style=' margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
  
    <!-- =============================== Header ====================================== -->

  <tr>
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>

                    <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='transparent' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='200'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  <center><img src='https://secure.theubaonline.com/home/images/EHBankbank-logo-white.png' alt='' data-default='placeholder' data-max-width='100' width='150' height='80' ></center>
								  <b style='font-size:1.5em; color:#fff;'></b>
                                </div>
                              </div>
                            </td>

                            
                          </tr>
                        </table>
                      </td>
                    </tr>
          </table>
      </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'> </div>
        
        
        
      <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
       <br >                             <h1 style='font-size:20px;font-weight:normal;color:#0076b6;line-height:19px;'>Dear $fname $lname,</h1> <br >
 <p style='font-size:15px;color:#0076b6;line-height:19px;'>This is a summary of a transaction that has occurred on your account below</p>									<h3>Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>$type</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date $time</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>$remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>

										<tr style='background-color:#0076b6;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $diffi</td>
										</tr>
                                     </table>
                                    </div>
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>L'Orent Western Online.</p>
                                    </div>
    <br>                           <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      
                                    </div>
                                  </div>                               </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>&nbsp;</p>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
        </div>
    </td>
  </tr>
</table>


  </body>
  </html>


";



        $subject = "[Debit Alert] - L'Orent Western Online";

        $reg_user->send_mail($email, $messag, $subject);
        $phone_sms = preg_replace('/[^0-9]/', '', $phone);
        $last_digit = substr($acc, -4);
        $amountt = $currency ."".$amount;
       $avl_bal = $currency ."".$diffi;
        $rem = $remarks;
       
        $message_sms =
        "
        Your Acct $last_digit 
        Has Been Debited with $amountt.00 On $date $time By $rem .Available Bal:$avl_bal
      ";
          $reg_user->otp($phone_sms, $message_sms);
          
      $msg1 = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$uname Successfully Debited the Sum of $amount!</strong> 
			  </div>";     
    } else {
        $msg = "Error!";
    }
}

include 'dbconnect.php';

$sql = "SELECT * FROM account ORDER BY id";
$sql1 = "SELECT * FROM ticket ";
$sql2 = "SELECT * FROM transfer";
$sql3 = "SELECT * FROM account WHERE verify ='N' ORDER BY id DESC LIMIT 200";


if ($result = mysqli_query($connection, $sql)) {
    // Return the number of rows in result set
    $rowcount = mysqli_num_rows($result);

    // Free result set
    mysqli_free_result($result);

    if ($result1 = mysqli_query($connection, $sql1)) {
        // Return the number of rows in result set
        $rowcount1 = mysqli_num_rows($result1);

        // Free result set
        mysqli_free_result($result1);

        if ($result2 = mysqli_query($connection, $sql2)) {
            // Return the number of rows in result set
            $rowcount2 = mysqli_num_rows($result2);

            // Free result set
            mysqli_free_result($result2);

            if ($result3 = mysqli_query($connection, $sql3)) {
                // Return the number of rows in result set
                $rowcount3 = mysqli_num_rows($result3);

                // Free result set
                mysqli_free_result($result3);
            }
        }
    }
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Super Admin - Mr S Scripts</title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="../../dist/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="./../dist/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="dist/css/pages/dashboard1.css" rel="stylesheet">
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>.alert-info {
    color: #fdfdfe;
    background-color: #212529;
    border-color: #212529;
}
@media (min-width: 992px)
.modal-lg {
    max-width: 500px;
}


.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #c7cccc;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 2.6rem;
    outline: 0;
}

.btn-info {
    color: #fff;
    background-color: #494b4d;
    border-color: #202122;
}</style>
</head>

<body class="horizontal-nav skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i>MENU</a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                       
                    </ul>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
              &nbsp;   &nbsp;  <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                       &nbsp;   <li class="nav-item"> <b>&nbsp;Admin Dashboard</b> </li>
                        
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="icons/admin.png" alt="user" class=""> <span class="hidden-md-down"><?php echo $row['uname']; ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                           
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php 
include 'menu.php';

?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">QUICK LINKS</h4>
                    </div>
                   
                  
                   
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">ADMIN</a></li>
                                
                            </ol>
                            
                            <a href="pendingacc.php"><button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Pending Accounts</button></a>
 
                            <a href="create_account.php"><button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New User Acc.</button></a>

                        </div>
                    </div>
                </div>
                 
                  <!-- Quick Stats -->
                <div class="block-area">
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats">
                                <div id="stats-line-2" class="pull-left"></div>
                                <div class="data">
                                    <h2 data-value="<?php printf("%d\n", $rowcount) ?>">0</h2>
                                    <small>Total Account</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line-3" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n", $rowcount1) ?>">0</h2>
                                    <small>Tickets</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">

                                <div id="stats-line-4" class="pull-left"></div>

                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n", $rowcount2) ?>">0</h2>
                                    <small>Transfers Made</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n", $rowcount3) ?>">0</h2>
                                    <small>Total Pending Accounts</small>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <?php if (isset($msg)) echo $msg; ?>   
                 <?php if (isset($msg1)) echo $msg1; ?>   
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
               <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add User Transaction History</h4>
                                <!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Add Debit/Credit Transaction History</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    
                                                     <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select User</label>
                                        <select name="uname" class="form-control input-sm validate[required]">
<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['acc_no']; ?>"><?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Transaction Type</label>
                                        <select name="type" class="form-control input-sm validate[required]">
                                            <option value="Credit">Credit</option>
                                            <option value="Debit">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                                    <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 500,000.00" required/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Description</label>
                                        <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>To/From</label>
                                        <input type="text" name="sender_name" class="input-sm form-control [required] mask-money" placeholder="Eg, John Kennedy" required/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Date dd/MM/yyyy</label>
                                        <div class="input-icon ">
                                            <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21/07/2019" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Time hh:mm:ss</label>
                                        <div class="input-icon">
                                            <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                       <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                        <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                        <button type="submit" name="his" class="btn btn-success btn-lg">Add History</button>  </div>
                                                </form>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                 </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form> </div>
                                <!-- /.modal -->
                               <center> <img src="icons/clipboard.png" alt="ADD HISTORY"  width="100" height="100"data-toggle="modal" data-target=".bs-example-modal-lg" class="model_img img-responsive" /></center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Credit User Account </h4>
                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">CREDIT ACCOUNT</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                           
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Account To Credit</label>
                                        <select name="uname" class="form-control input-sm validate[required]">
<?php while ($rows = $credit->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $rows['acc_no']; ?>"><?php echo $rows['fname']; ?> <?php echo $rows['mname']; ?> <?php echo $rows['lname']; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>From</label>
                                        <input type="text" name="sender_name"  class="input-sm form-control " required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 3500" required/>
                                        <input type="hidden" name="type" value="Credit"/>
                                        
                                        <input type="hidden" name="statz" value="Successfull"/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Description</label>
                                        <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Date dd/MM/yyy</label>
                                        <div class="input-icon ">
                                            <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control " placeholder="Eg, 21/12/2019" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Time hh:mm:ss</label>
                                        <div class="input-icon ">
                                            <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:right;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                        <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                        <button type="submit" name="credit" class="btn btn-success btn-lg">Credit Account</button>

                                    </div>
                                </div>
                            </div>
                        </form> </div>
                                            
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                               <center> <img src="icons/credit.png" alt="default" width="100" height="100" data-toggle="modal" data-target="#myModal" class="model_img img-responsive" />
                           </center> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Debit User Balance </h4>
                                <!-- sample modal content -->
                                <div class="modal fade bs-ex" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mySmallModalLabel">Debit User's Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body"><form method="POST">
                           
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Account To Debit</label>
                                        <select name="uname" class="form-control">
<?php while ($rowd = $debit->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $rowd['acc_no']; ?>"><?php echo $rowd['fname']; ?> <?php echo $rowd['mname']; ?> <?php echo $rowd['lname']; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>From</label>
                                        <input type="text" name="sender_name"  class="input-sm form-control " required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 500,000.00" required/>
                                        <input type="hidden" name="type" value="Debit"/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Description</label>
                                        <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Date dd/MM/yyyy</label>
                                        <div class="input-icon ">
                                            <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21/06/2019" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Time hh:mm:ss</label>
                                        <div class="input-icon ">
                                            <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32:13" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:right;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                        <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                        <button type="submit" name="debit" class="btn btn-success btn-lg">Debit Account</button>

                                    </div>
                                </div>
                            </div>
                        </form> </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                               <center> <img src="icons/debit.png" alt="default" width="100" height="100" data-toggle="modal" data-target=".bs-ex" class="model_img img-responsive" />
                           </center> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Admin Detail</h4>
                                <!-- sample modal content -->
                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Admin Detail</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Recipient:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="control-label">Message:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                 <button type="submit" name="edit" class="btn btn-success btn-lg">Change Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                                <center><img src="icons/admin.png" alt="default" data-toggle="modal"  width="100" height="100" data-target="#edit" class="model_img img-responsive" />
                           </center> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">View Tickets</h4>
                                <!-- sample modal content -->
                                <div class="button-box">
                                    <center> <a href="tickets.php"><img src="icons/ticket.png" alt="default" data-toggle="modal"  width="100" height="100" data-target="" class="model_img img-responsive" />
                           </a> </center>
                                    </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Recipient:</label>
                                                        <input type="text" class="form-control" id="recipient-name1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="control-label">Message:</label>
                                                        <textarea class="form-control" id="message-text1"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Messages </h4>
                                
                                 <center> <a href="messages.php"><img src="icons/inbox.png" alt="default" data-toggle="modal"  width="100" height="100" data-target="" class="model_img img-responsive" />
                           </a> </center>
                                <!-- sample modal content -->
                                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mySmallModalLabel">Debit User's Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body"><form method="POST">
                           
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Account To Debit</label>
                                        <select name="uname" class="form-control input-sm validate[required]">
<?php while ($rowd = $debit->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $rowd['acc_no']; ?>"><?php echo $rowd['fname']; ?> <?php echo $rowd['mname']; ?> <?php echo $rowd['lname']; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>From</label>
                                        <input type="text" name="sender_name"  class="input-sm form-control " required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 500,000.00" required/>
                                        <input type="hidden" name="type" value="Debit"/>
                                        <input type="hidden" name="statz" value="Successfull"/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Description</label>
                                        <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Date dd/MM/yyyy</label>
                                        <div class="input-icon ">
                                            <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21/06/2019" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Time hh:mm:ss</label>
                                        <div class="input-icon ">
                                            <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32:13" required />
                                            <span class="add-on">
                                                <i class="sa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:right;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                        <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                        <button type="submit" name="debit" class="btn btn-success btn-lg">Credit Account</button>

                                    </div>
                                </div>
                            </div>
                        </form> </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                    
               
                    
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme working">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
         <!-- footer -->
        <!-- ============================================================== -->
        
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Edit Admin Account</h4>
                        </div>
                        <div class="modal-body">
                            <p>Change Your Login Details</p>
                        </div>
                        <form method="POST">
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Email</label>
                                        <input type="text" name="email"  value="<?php echo $rom['email']; ?>" class="input-sm form-control " required/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>New Password</label>
                                        <input type="password" name="upass1" class="input-sm form-control [required]" required/>

                                    </div>
                                    <div class="col-md-6 form-group" >
                                        <label>Repeat Password</label>
                                        <input type="password" name="upass" class="input-sm form-control [required]" required/>

                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:right;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>

                                        <button type="submit" name="edit" class="btn btn-success btn-lg">Change Details</button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div> <center><div class="container-fluid">
                    <h6>ALL UPLOADED IMAGES </h6>
<?php
$files = glob("pic/*.*");
for ($i = 0; $i < count($files); $i++) {
    $image = $files[$i];
    $supported_file = array(
        'gif',
        'jpg',
        'jpeg',
        'png'
    );
    $base = basename($image);
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (in_array($ext, $supported_file)) {
        // show only image name if you want to show full path then use this code // echo $image."<br />";
        echo '<img src="' . $image . '" title="' . $base . '" height="50px" width="45px"/>' . "&nbsp;";
    } else {
        continue;
    }
}
?> </center> <!-- =================================================
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    </div> 
   <?php

include_once ('foot.php');
?>
    <!-- ============================================================== -->
    <script src="../../dist/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../../dist/assets/node_modules/popper/popper.min.js"></script>
    <script src="../../dist/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
     <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="../../dist/assets/node_modules/raphael/raphael-min.js"></script>
    <script src="../../dist/assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="../../dist/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="../../dist/assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="dist/js/dashboard1.js"></script>
    <script src="../../dist/assets/node_modules/toast-master/js/jquery.toast.js"></script>
    
    <script src="../../dist/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
   
    <!--stickey kit -->
    <script src="../../dist/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../dist/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    
    
 
   <!-- ============================================================== -->
    <script src="../../dist/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../../dist/assets/node_modules/popper/popper.min.js"></script>
    <script src="../../dist/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="../../dist/assets/node_modules/raphael/raphael-min.js"></script>
    <script src="../../dist/assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="../../dist/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="../../dist/assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="dist/js/dashboard1.js"></script>
    <script src="../../dist/assets/node_modules/toast-master/js/jquery.toast.js"></script>
       
     <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        <script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Charts -->


        <script src="js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
        <script src="js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
        <script src="js/charts.js"></script> <!-- All the above chart related functions -->
        <script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->
        <script src="js/input-mask.min.js"></script> <!-- Input Mask -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        <script src="js/autosize.min.js"></script> <!-- Textare autosize -->
        <script src="js/toggler.min.js"></script> <!-- Toggler -->

        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->


        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        <script src="js/markdown.min.js"></script> <!-- Markdown Editor -->   
</body>

</html>