<?php
//Start the Session
header("X-Robots-Tag: noindex, nofollow", true);
session_start();

// require('include/dbconfig.php');
// require_once 'include/class.user.php';

$reg_user = new USER();




//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['acc_no']) and isset($_POST['upass'])) {
//3.1.1 Assigning posted values to variables.

    $acc_no = $_POST['acc_no'];
    $upass = $_POST['upass'];
    $upass = ($upass);

//3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM account WHERE acc_no='$acc_no' and upass='$upass'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);


    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $log = $reg_user->runQuery("UPDATE account SET logins = logins + 1 WHERE '$acc_no'");
   


    $status = $row['status'];
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 0) {
        $msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  Invalid Account No or Password!
                   
			  </div>";
    } elseif ($status == 'DISABLED') {
        $msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! Your Account Has Been Disabled For Violation of Our Terms!</strong>
                   
			  </div>";
    } 
    
    elseif ($status == 'CLOSED') {
        $msg = "<div class='alert alert-inverse'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! That Account No Longer Exist!</strong>
                   
			  </div>";
			  
    } 
    
    elseif ($status == 'SUSPEND') {
        $msg = "<div class='alert alert-inverse'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! This Account is Suspended Contact Customercare!</strong>
                   
			  </div>";
    } else {
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        $_SESSION['acc_no'] = $acc_no;
         $_SESSION['acc_no'] = $acc_no;
        // Redirect user to dashboard/summary.php
        // header("Location: dashboard/summary.php");
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['acc_no'])) {
    $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $sender = "Welcome"; /* sender id */
    $message = "Please enter this code to continue proceed
				$code";


    $message = "
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
                     
                    </tr>
                </table>
        </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                        <tr><td height='2'  ></td></tr>

                        <tr>
                          <td height='200'  bgcolor='#fdfefe'>
                            <table align='center' border='0' cellspacing='0' cellpadding='0' class='MainContainer'>
  <tr>
    <td></td>
  </tr>
  

                                    <tr>
                                      <td></td>
                                      <td valign='top'>
                                        <table width='300' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <h1 style='font-size:20px;font-weight:normal;color:blue;line-height:19px;'>Dear $fname, </h1>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='18'></td></tr>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <p style='font-size:13px;color:blue;line-height:19px;'>Please use the One Time Password OTP $code to complete your Login Process <br> 
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          
                                          <tr><td height='1'></td></tr>
                                        </table>
                                      </td>
                                      <td></td>
                                    </tr>
                                  </table>
                                </td>
  </tr>
</table>
</td>
  </tr>

</table>

                          </td>
                        </tr>

                        <tr><td height='0' ></td></tr>
                </table>
       
        
        
        
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td>
                                  
                                </td>
                              </tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>L'Orent Western</p>
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



    $acc_no = $_SESSION['acc_no'];

    $queri = " UPDATE account SET tmp_otp = '$code' WHERE acc_no ='$acc_no'";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));

    $subject = "Login Verification";
    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION['acc_no']) && $row['phone_verify'] == 1) {
        header('Location: dashboard/pin_auth.php');
        exit();
    } else {
        $reg_user->send_mail($row['email'], $message, $subject);
        $phone = preg_replace('/[^0-9]/', '', $row['phone']);
        $mobile_msg = "Dear " . $row['fname'] . ", Please use the One Time Passcode (OTP): " . $code . " to complete your login process";
        $reg_user->otp($phone,$mobile_msg);
        header('Location: dashboard/otp.php');
    }
} else {
    
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
<!doctype html>
<html class="no-js" lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <title>Account Login |</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <link rel="icon" href="dashboard/favicon.png" sizes="32x32" />
<link rel="icon" href="dashboard/favicon.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="" />
<meta name="msapplication-TileImage" content="" />
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
<!------ Include the above in your HEAD tag ---------->
</head>
<style>
  body {
    font-family: 'Nunito', sans-serif;
    font-size: 14px;
    line-height: 1.28571429;
    color: 
    #000;
}  
   body { 
  background: url(register.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.panel-default {
    opacity: 0.9;
    margin-top: 70px;
}

.btn-sm, .btn-xs {
    padding: 5px 40%;
    font-size: 15px;
    line-height: 1.5;
    border-radius: 3px;
}

.form-group.last { margin-bottom:0px; } 
    
.btn-success {
    color: 
#fff;
background-color:
#187718;
border-color:
    #187718;
}
 .alert-danger {

    color: #fff;
    background-color: #e30909;
    border-color: #eed3d7;

}
</style>



<div class="container">
    <div class="row">
        
        <div class="col-md-4 col-md-offset-7">
            <div class="panel panel-default">
               <center><img src='favicon.png' alt='logo' data-default='placeholder' data-max-width='100' width='20%' ></center>
                <div class="panel-heading">
                    	</div><br><center><div id="google_translate_element"></div></center>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<br><strong><center>Welcome! Login into your Account.</center></strong>
                <div class="panel-body">
                     <?php
if (isset($_GET['inactive'])) {
    ?>
                        <div class='alert alert-info col-4'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong> This Account is not Activated Contact Customer Care Activate it. 
                        </div>
    <?php
}
?>
                    <?php if (isset($msg)) echo $msg; ?>

                    <form autocomplete="off" method="POST">
            <div class="form-inputs p-b">
              <p><strong>LOGIN ID</strong></p>
              <input type="text" name="acc_no" class="form-control" placeholder="Enter Your Login ID." autofocus />
                            <input type="hidden" name="code" value="<?php echo $code; ?>"
              <br>
              <label class="text-uppercase">PASSWORD</label>
               <input type="password" name="upass" class="form-control" placeholder="Enter Password" value="" />
              <blockquote>
                 <p>Don't have an Account?<a href="dashboard/applicationform.php"> Sign Up</a></p>
              </blockquote>
            </div>
            <button name="login" class="btn btn-success btn-sm" type="submit">
            <div align="center">Login</div>
            </button>
            <div class="divider">
              
            </div>
         
          </form>
                </div>
                <div class="panel-footer">
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="//code.tidio.co/sulacvnq9bpifkbkortjpvcuacuoup7r.js" async></script>
