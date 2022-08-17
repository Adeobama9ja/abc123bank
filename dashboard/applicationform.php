<?php
session_start();
require_once 'admin/class.admin.php';
include_once ('admin/session.php');

$reg_user = new USER();

if (isset($_POST['create'])) {


    $fname = trim($_POST['fname']);
    $fname = strip_tags($fname);
    $fname = htmlspecialchars($fname);

    $mname = trim($_POST['mname']);
    $mname = strip_tags($mname);
    $mname = htmlspecialchars($mname);

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $uname = trim($_POST['uname']);
    $uname = strip_tags($uname);
    $uname = htmlspecialchars($uname);

    $upass = $_POST['upass'];

    $phone = trim($_POST['phone']);
    $phone = strip_tags($phone);
    $phone = htmlspecialchars($phone);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $type = trim($_POST['type']);
    $type = strip_tags($type);
    $type = htmlspecialchars($type);

    $reg_date = trim($_POST['reg_date']);

    $work = trim($_POST['work']);
    $work = strip_tags($work);
    $work = htmlspecialchars($work);

    $acc_no = trim($_POST['acc_no']);
    $acc_no = strip_tags($acc_no);
    $acc_no = htmlspecialchars($acc_no);

    $addr = trim($_POST['addr']);
    $addr = strip_tags($addr);
    $addr = htmlspecialchars($addr);

    $sex = trim($_POST['sex']);
    $sex = strip_tags($sex);
    $sex = htmlspecialchars($sex);

    $dob = trim($_POST['dob']);
    $dob = strip_tags($dob);
    $dob = htmlspecialchars($dob);

    $marry = trim($_POST['marry']);
    $marry = strip_tags($marry);
    $marry = htmlspecialchars($marry);

    $t_bal = trim($_POST['t_bal']);
    $t_bal = strip_tags($t_bal);
    $t_bal = htmlspecialchars($t_bal);

    $a_bal = trim($_POST['a_bal']);
    $a_bal = strip_tags($a_bal);
    $a_bal = htmlspecialchars($a_bal);

    $currency = trim($_POST['currency']);
    $currency = strip_tags($currency);
    $currency = htmlspecialchars($currency);

    $cot = trim($_POST['cot']);
    $cot = strip_tags($cot);
    $cot = htmlspecialchars($cot);

    $tax = trim($_POST['tax']);
    $tax = strip_tags($tax);
    $tax = htmlspecialchars($tax);

    $imf = trim($_POST['imf']);
    $imf = strip_tags($imf);
    $imf = htmlspecialchars($imf);
    
    $pin_auth = trim($_POST['pin_auth']);
    $pin_auth = strip_tags($pin_auth);
    $pin_auth = htmlspecialchars($pin_auth);

    $pin = trim($_POST['pin']);
    $pin = strip_tags($pin);
    $pin = htmlspecialchars($pin);
    
    $verify = trim($_POST['verify']);
    $verify = strip_tags($verify);
    $verify = htmlspecialchars($verify);
    
    $verify = trim($_POST['verify']);
    $verify = strip_tags($verify);
    $verify = htmlspecialchars($verify);
    
    $status = trim($_POST['status']);
    $status = strip_tags($status);
    $status = htmlspecialchars($status);



    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE email=:email");
    $stmt1 = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
    $stmt->execute(array(":email" => $email));
    $stmt1->execute(array(":uname" => $uname));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);


    if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0) {
        $msg = "
		      <div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  Email or Username already exists! Please, try another one!
			  </div>
			  ";
    } else {
        if ($reg_user->createsign($fname, $mname, $lname, $uname, $upass, $phone, $email, $type, $reg_date, $work, $acc_no, $addr, $sex, $dob, $marry, $t_bal, $a_bal, $currency, $cot, $tax, $imf, $pin_auth, $pin, $verify, $status)) {
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
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'> </div>
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
                                <td>
                                  <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='MainContainer'>
                                    <tr><td style='border-bottom:1px solid #DDDDDD'></td></tr>
                                  </table>
                                </td>
                              </tr>

                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <h3>Hello $fname</h3><br>
     <P style='font-size:15px;font-weight:normal;color:#0076b6;'>Congratulations,Your Application  have been recieved and<br> is being checked, you will recieve a reply from our Accounts Department shortly </P>
</div>
									 <div class='contentEditable' ><br>
                                      <p style='font-weight:bold;font-size:13px;line-height: 30px; color:#0076b6;'>Please Note that once your Internet Banking is activated and you will need a combination of your account number and password to access your online banking .</p>
                                    </div>
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>L'Orent Western</p>
                                    </div>
                                  </div>
       <br>                           <div class='contentEditableContainer contentTextEditable'>
                                    
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




            $subject = "Hello $fname - Your Application have been recieved!";




            $send_otp_mobile = preg_replace('/[^0-9]/', '', $_POST['phone']);
            $reg_user->send_mail($email, $messag, $subject);
            //$reg_user->otp($send_otp_mobile, $subject);





            $msg1 = "
					<div class='alert alert-info'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong> Account Form </strong>Has Been Successfully Submitted You will recieve a confirmation Email shortly!
                   
			  		</div>
					";
        } else {
            echo "Sorry , Query could no execute...";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Application Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="admin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="admin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin/css/util.css">
	<link rel="stylesheet" type="text/css" href="admin/css/main.css">
<!--===============================================================================================-->
<style>p {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #c40909;
    margin: 0px;
}

body {
    font-family: unset;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #ce0909;
}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(admin/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Application Form
					</span>
				</div>
				</br>
			<center>	<p>Create an account with us to explore the possibilities of a secured online banking.</p></center>
				<form role="form" class="login100-form validate-form" method="POST" enctype="multipart/form-data">
                    <?php if (isset($msg1)) echo $msg1; ?>
                      <?php if (isset($msg)) echo $msg; ?>
                    <div class="row">
                        	<div class="wrap-input100 validate-input m-b-26" data-validate="First name is required">
						 <label>First Name</label>
                            <input type="text" name="fname" class="input100" placeholder="First Name">
                            <span class="focus-input100"></span>
                        </div>
                        
                        <div class="wrap-input100 " data-validate = "required">
                            <label>Middle Name (Optional)</label>
                            <input type="text" name="mname" class="input100" placeholder="Middle Name">
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="input100" placeholder="Last Name">
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Username</label>
                            <input type="text" name="uname" class="input100" placeholder="Username">
                        </div>
                    </div>
                    <div class="row">
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Password</label>
                            <input type="password" name="upass" class="input100" placeholder="Password">
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Occupation</label>
                            <input type="text" name="work" class="input100" placeholder="Occupation">
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Phone</label>
                            <input type="text" name="phone" class="input100" placeholder="Eg +62 123 456 789">
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Email</label>
                            <input type="email" name="email" class="input100" placeholder="Email">
                        </div>

                    </div>
                    <div class="row">
                        
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">

                            <label>Date of Birth</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" name="dob" type="text" placeholder="Date of Birth dd/MM/yyyy" class="form-control input-sm" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                        </div>

                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Marital Status</label>
                            <select name="marry" class="form-control input-sm validate[required]">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Gender</label>
                            <select  name="sex" class="form-control input-sm validate[required]">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Address</label>
                            <textarea name="addr" class="input100" placeholder="House or Office Address"></textarea>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Account Type</label>
                            <select name="type" class="form-control input-sm validate[required]">
                                <option value="Savings">Savings</option>
                                <option value="Current">Current</option>
                                 <option value="Checking">Checking</option>
                                <option value="Fixed Deposit">Fixed Deposit</option>
                                 <option value="NON-Resident">NON-Resident</option>
                                <option value="Online Banking">Online Banking</option>
                                 <option value="Joint Account">Joint Account</option>
                                <option value="DOMICILIARY ACCOUNT">DOMICILIARY ACCOUNT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">

                            
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" name="reg_date" type="text" value="<?php
echo " " . date("d/m/Y") ;
?>" class="form-control input-sm" hidden/>
                                
                                </span>
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                           
                            <input type="number" name="t_bal" class="input100" value="0" hidden>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            
                            <input type="number" name="a_bal" class="input100" value="0" hidden>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            
                            <input type="text" name="acc_no" class="input100" value="0000" hidden>
                        </div>
                        
                    </div>
                     
                   
                       
<div class="wrap-input100 validate-input m-b-18" data-validate = "required">
                            <label>Account Currency</label>
                            <select class="input100" name="currency">
                                 <option value="USD $">Dollar</option>
                                <option value="GBP £">Pound</option>
                                <option value="EUR €">Euro</option>

                            </select>
                       
                        

                       
                         
                            <input type="text" name="cot" class="input100" value="00" hidden>
                       

                        
                            <input type="text" name="tax" class="input100" value="00" hidden>
                      

                        
                            <input type="text" name="imf" class="input100" value="00" hidden>
                      
                        
                      
                            
                            <input type="text" name="pin_auth" class="input100" value="00" hidden>
                       

                        
                        
                         
                    
                   
                            <input type="text" name="pin" class="input100" value="00" hidden>
                       
                        </div>
                        <div class="" data-validate = "required">
                           
                            <input type="text" name="verify" class="input100" value="N" hidden>
                             <input type="text" name="status" class="input100" value="Dormant/Inactive" hidden>
                        </div>
                          <div class="container-login100-form-btn">
            
           
            <input class="login100-form-btn" type="submit" name="create" value="Submit Application">
</div>
            </div>


          
           

			
				

				
					
				</form>
			</div>
		</div>
	</div>
<center> <?php include 'footercopyright.php';
?> 	</center>
<!--===============================================================================================-->
	<script src="admin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="admin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="admin/vendor/bootstrap/js/popper.js"></script>
	<script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="admin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="admin/vendor/daterangepicker/moment.min.js"></script>
	<script src="admin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="admin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="admin/js/main.js"></script>
  <script src="//code.tidio.co/sulacvnq9bpifkbkortjpvcuacuoup7r.js" async></script>
</body>
</html>