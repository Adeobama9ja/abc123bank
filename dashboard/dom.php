<?php
session_start();
include_once ('../include/session.php');
require_once '../include/class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}

$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stat = $row['status'];
if($stat == 'DORMANT/INACTIVE'){
	header('Location: summary.php?dormant');
	exit();
}$stat = $row['status'];
if($stat == 'ON HOLD'){
	header('Location: summary.php?hold');
	exit();
}
if(isset($_POST['transfer'])){
	$email = $row['email'];
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$acc_no = trim($_POST['acc_no']);
	$acc_no = strip_tags($acc_no);
	$acc_no = htmlspecialchars($acc_no);
	
	$acc_name = trim($_POST['acc_name']);
	$acc_name = strip_tags($acc_name);
	$acc_name = htmlspecialchars($acc_name);
	
	$bank_name = trim($_POST['bank_name']);
	$bank_name = strip_tags($bank_name);
	$bank_name = htmlspecialchars($bank_name);
	
	$swift = trim($_POST['swift']);
	$swift = strip_tags($swift);
	$swift = htmlspecialchars($swift);
	
	$routing = trim($_POST['routing']);
	$routing = strip_tags($routing);
	$routing = htmlspecialchars($routing);
		
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
		$cout = trim($_POST['cout']);
	$cout = strip_tags($cout);
	$cout = htmlspecialchars($cout);
	
		$transtype = trim($_POST['transtype']);
	$transtype = strip_tags($transtype);
	$transtype = htmlspecialchars($transtype);
	
	
	
	if($reg_user->temp($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks,$cout,$transtype)){
if (isset($_SESSION['acc_no']))
	     $codeq = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 $sql = "UPDATE account SET tmp_otp = '$codeq' WHERE acc_no ='$acc_no'";
 if(mysqli_query($link, $sql))
 $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $sender = "DEMOBANK"; /* sender id */
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
                                                  <h1 style='font-size:20px;font-weight:normal;color:blue;line-height:19px;'>Hello</h1>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='18'></td></tr>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <p style='font-size:13px;color:blue;line-height:19px;'>Please enter OTP to complete your Transfer Process <br> <h4>$codeq</h4></p>
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
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>L'Orent Western Online</p>
                                    </div>
    <br>                           <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='#F00; font-size:13px;line-height: 15px;'>This message is sent to this email to $fname <br /> <br /> <center><b>How do I know this is not a fake email?</b></center> <br />

An email really coming from us will address you by your registered first and last name or your business name. It will not ask you for sensitive information like your password, bank account or credit card details.<br /><br />
                                      </p>
                                      <p style='#F00; font-size:13px;line-height: 15px;'>Remember not to click any links in suspicious looking emails. </p>
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

    $queri = " UPDATE account SET tmp_otp = '$codeq' WHERE acc_no ='$acc_no'";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));


$subject = "Confirm Transfer OTP";
  $reg_user->send_mail($row['email'], $message, $subject);
      $acc_no = $_SESSION['acc_no'];
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

	     $reg_user->send_mail($row['email'], $message, $subject);
        $phone = preg_replace('/[^0-9]/', '', $row['phone']);
        $mobile_msg = "Dear " . $row['fname'] . ", Please use the One Time Passcode (OTP): " . $codeq . " to complete your Transfer process";
        //$reg_user->otp($phone,$mobile_msg);
       
	header("Location: pin.php");
	}
	
}
	

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Domestic Bank Transfer</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="css/main.css?version=4.4.0" rel="stylesheet">
	
	
	<link rel="stylesheet" type="text/css" href="clock_style.css">
	<style>.alert-success {
    color: #090909;
    background-color: #e2e9e1;
    border-color: #36b927;
}
}

.btn-primary, .all-wrapper .fc-button.fc-state-active {
    color: #fff;
    background-color: #f1612d;
    border-color: #f1612d;
}</style>	
  <script type="text/javascript">
    window.onload = setInterval(clock,1000);

    function clock()
    {
	  var d = new Date();
	  
	  var date = d.getDate();
	  
	  var month = d.getMonth();
	  var montharr =["Jan","Feb","Mar","April","May","June","July","Aug","Sep","Oct","Nov","Dec"];
	  month=montharr[month];
	  
	  var year = d.getFullYear();
	  
	  var day = d.getDay();
	  var dayarr =["Sun","Mon","Tues","Wed","Thurs","Fri","Sat"];
	  day=dayarr[day];
	  
	  var hour =d.getHours();
      var min = d.getMinutes();
	  var sec = d.getSeconds();
	
	  document.getElementById("date").innerHTML=day+" "+date+" "+month+" "+year;
	  document.getElementById("time").innerHTML=hour+":"+min+":"+sec;
    }
	
	
	
	 var result;
    
    function showPosition(){
        // Store the element where the page displays the result
        result = document.getElementById("result");
        
        // If geolocation is available, try to get the visitor's position
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            result.innerHTML = "Getting the position information...";
        } else{
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }
    };
    
    // Define callback function for successful attempt
    function successCallback(position){
        result.innerHTML = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
    }
    
    // Define callback function for failed attempt
    function errorCallback(error){
        if(error.code == 1){
            result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
        } else if(error.code == 2){
            result.innerHTML = "The network is down or the positioning service can't be reached.";
        } else if(error.code == 3){
            result.innerHTML = "The attempt timed out before it could get the location data.";
        } else{
            result.innerHTML = "Geolocation failed due to unknown error.";
        }
    }
  </script>
	
	
  </head>
  <body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
		
      <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
          <div class="">
			
              <div class="close-search-suggestions">
                <i class="os-icon os-icon-x"></i>
              </div>
            </input>
          </div>
		  
		  
		  
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-box"></div>
              </div>
              <div class="ssg-name">
                Projects
              </div>
              <div class="ssg-info">
                24 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-boxed">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company6.png)"></div>
                  <div class="item-name">
                    Integ<span>ration</span> with API
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company7.png)"></div>
                  <div class="item-name">
                    Deve<span>lopm</span>ent Project
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-users"></div>
              </div>
              <div class="ssg-name">
                Customers
              </div>
              <div class="ssg-info">
                12 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-list">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(admin/pic/<?php echo $row['uname']; ?>.jpg)"></div>
                  <div class="item-name">
                    John Ma<span>yer</span>s
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar2.jpg)"></div>
                  <div class="item-name">
                    Th<span>omas</span> Mullier
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar3.jpg)"></div>
                  <div class="item-name">
                    Kim C<span>olli</span>ns
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-folder"></div>
              </div>
              <div class="ssg-name">
                Files
              </div>
              <div class="ssg-info">
                17 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-blocks">
                <a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-file-text"></i>
                  </div>
                  <div class="item-name">
                    Work<span>Not</span>e.txt
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-film"></i>
                  </div>
                  <div class="item-name">
                    V<span>ideo</span>.avi
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-database"></i>
                  </div>
                  <div class="item-name">
                    User<span>Tabl</span>e.sql
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-image"></i>
                  </div>
                  <div class="item-name">
                    wed<span>din</span>g.jpg
                  </div>
                </a>
              </div>
              <div class="ssg-nothing-found">
                <div class="icon-w">
                  <i class="os-icon os-icon-eye-off"></i>
                </div>
                <span>No files were found. Try changing your query...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <?php include 'mobmenu.php';
?>
        <!--------------------
        END - Mobile Menu
        <!--------------------
        <?php include 'mainmenu.php';
?>
      
        <div class="content-w">
         
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              <div class="">
               
              </div>
              <!--------------------
              START - Messages Link in secondary top menu
              -------------------->
              <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-mail-14"></i>
                
                
                 
                
              </div>
              <!--------------------
              END - Messages Link in secondary top menu
              --------------------><!--------------------
              START - Settings Link in secondary top menu
              -------------------->
              <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-ui-46"></i>
                <div class="os-dropdown">
                  <div class="icon-w">
                    <i class="os-icon os-icon-ui-46"></i>
                  </div>
                  <ul>
                    <li>
                      <a href="profile.php"><i class="os-icon os-icon-ui-49"></i><span>My Profile</span></a>
                    </li>
					<li>
                      <a href="logout.php"><i class="os-icon os-icon-lock"></i><span>Logout</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
              <!--------------------
              END - Settings Link in secondary top menu
              --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="">
                  <div class="avatar-w">
                    <img alt="" src="admin/pic/<?php echo $row['uname']; ?>.jpg">
                  </div>
                  <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                      <div class="avatar-w">
                        <img alt="" src="admin/pic/<?php echo $row['uname']; ?>.jpg">
                      </div>
                      <div class="logged-user-info-w">
                        <div class="logged-user-name">
                        Logout
                        </div>
                        
                      </div>
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                   
                  </div>
                </div>
              </div>
              <!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>
          <!--------------------
          END - Top Bar
          --------------------><!--------------------
          START - Breadcrumbs
          -------------------->
         <?php include 'bread.php';
?>
          <!--------------------
          END - Breadcrumbs
          -------------------->
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">
            <div class="content-box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="element-wrapper">
                    <div class="element-actions">
                      <!-- <form class="form-inline justify-content-sm-end"> -->
                        <!-- <select class="form-control form-control-sm rounded"> -->
                          <!-- <option value="Pending"> -->
                            <!-- Today -->
                          <!-- </option> -->
                          <!-- <option value="Active"> -->
                            <!-- Last Week  -->
                          <!-- </option> -->
                          <!-- <option value="Cancelled"> -->
                            <!-- Last 30 Days -->
                          <!-- </option> -->
                        <!-- </select> -->
                      <!-- </form> -->
                    </div>
					
				
					 <h6 class="element-header">
                      Transfer Form to other Domestic Banks
                    </h6>
                    <div class="element-content">
					
					
					 <div class="row">
                <div class="col-sm-12">
                  <div class="element-wrapper">
                    <h6 class="element-header">
                    <p>Your IP:<b> <?php echo $_SERVER['REMOTE_ADDR']; ?> </b>has been logged on our server <br />at <?php echo date("h:i A d M Y"); ?> to monitor and Secure your Transaction.</p>
                       <p>Ensure you fill the forms Carefully and correctly</p>
                    </h6>
					
                    <div class="element-box-tp">
                      <!--------------------
                      START - Controls Above Table
                      -------------------->
                      <div class="controls-above-table">
                        <div class="row">
                          <div class="col-sm-6">
                            <!-- <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="#">Archive</a><a class="btn btn-sm btn-danger" href="#">Delete</a> -->
                          </div>
                          <div class="col-sm-6">
                            <?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorcot']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid COT Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortax']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Tax Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorotp']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid TRANSFER OTP Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['insufficient']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your balance is insufficient to make the transfer, please transfer a lower amount.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['amounterror']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
									</div>
									<?php
								}
						?> 
                          </div>
                        </div>
                      </div>
                      <!--------------------
                      END - Controls Above Table
                      ------------------          --><!--------------------
                      START - Table with actions
                      ------------------  -->
                      <div class="table-responsive">
                        <div class="col-lg-12">
                            
    <div class="element-wrapper">
      
      <div class="element-box">
        <form autocomplete="off" method="post" >
          
          <?php if(isset($error)){ echo $error;}?>
			    				<?php if(isset($errorcot)){ echo $errorcot;}?>
								<?php if(isset($errortax)){ echo $errortax;}?>
								<?php if(isset($errorpin)){ echo $errorpin;}?>
								<?php if(isset($insufficient)){ echo $insufficient;}?>
								<?php if(isset($amounterror)){ echo $amounterror;}?>
									<?php if(isset($errorotp)){ echo $errorotp;}?>
								
          <div class="form-group row">
            <label class="col-form-label col-sm-4" for="">Amount (<?php echo $row['currency']; ?>)</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Eg 23678" name="amount" type="number" required>
            </div>
          </div>
		  <div class="form-group row">
            <label class="col-form-label col-sm-4" for="">Beneficiary Account Name</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Beneficiary Name" name="acc_name" type="text" required>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-form-label col-sm-4" for="">Beneficiary Account Number</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Beneficiary Account Number" name="acc_no" type="number" required>
            </div>
          </div>
		 
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Bank Name</label>
              <div class="col-sm-8">
                <input class="form-control" placeholder="Bank Name" name="bank_name" type="text" required>
             <input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?> "/>
			</div>
            </div>
			
			<div class="form-group row">
              
              <div class="col-sm-8">
                <input class="form-control" placeholder="Bank Address" name="swift" type="hidden" value="DOMESTIC" required>
              </div>
            </div>
			
			<div class="form-group row">
              
              <div class="col-sm-8">
                <input class="form-control" placeholder="Swiftcode" name="routing" type="hidden" value="DOMESTIC" required>
                
                
               <input class="form-control" placeholder="Swiftcode" name="cout" type="hidden" value="Domestic-Transfer" required>
               
               <input class="form-control" placeholder="Swiftcode" name="transtype" type="hidden" value="DOMESTIC" required>
              </div>
            </div>
            
            
			
			 <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Desc.</label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Funds Description" name="remarks" type="text" required></textarea>
              </div>
            </div>
			
			<div class="form-group">
										<label class="control-label">Account Type <span class="text-danger">*</span></label>
										<div class="radio">
											<div class="radio-inline">
												<input type="radio" name="inline_radio" id="inline_radio_1" value="Savings" checked required>
												
												<label for="inline_radio_1">
													PERSONAL (Savings)
												</label><input type="hidden" name="type" value="Savings">
											</div>
											<div class="radio-inline">
												<input type="radio" id="inline_radio_2" name="inline_radio" value="Current" required>
												<label for="inline_radio_2">
													CURRENT
												</label>
											</div>
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="Checking" required>
												<label for="inline_radio_3">
													CHECKING
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="Fix Deposit" required>
												<label for="inline_radio_3">
													FIX DEPOSIT
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="NON RESIDENT" required>
												<label for="inline_radio_3">
													NON RESIDENT
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="ONLINE BANKING" required>
												<label for="inline_radio_3">
													ONLINE BANKING
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="DOMICILIARY ACCOUNT" required>
												<label for="inline_radio_3">
												DOMICILIARY ACCOUNT
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="JOINT ACCOUNT" required>
												<label for="inline_radio_3">
												JOINT ACCOUNT
												</label>
											</div>
										</div>
										
										
									</div> 
          <div class="form-buttons-w">
            <button class="btn btn-primary" type="submit" name="transfer"> Transfer</button>
          </div>
        </form>
      </div>
                      <div class="row">
                        <div class="col-sm-4 col-xxxl-3">
                          <a class="element-box el-tablo" href="#">
                            <div class="label">
                              Book Balance
                            </div>
                            <div class="value"><span style="color:orange;font-size:20px;">
                             <p><?php echo $row['currency']; ?><?php echo  $english_format_number = number_format( $row['t_bal'] , 2, '.', ','); ?></p>
                            </span></div>
                            
                          </a>
                        </div>
						
                        <div class="col-sm-4 col-xxxl-3">
                          <a class="element-box el-tablo" href="#">
                            <div class="label">
                              Available Balance
                            </div>
                            <div class="value"><span style="color:green;font-size:20px;">
                              <?php echo $row['currency']; ?><?php echo number_format( $row['a_bal'] , 2, '.', ','); ?>
                            </span></div>
                            
                          </a>
                        </div>
                        <div class="col-sm-4 col-xxxl-3">
                          <a class="element-box el-tablo" href="#">
                           <div class="label">
                              Account IP:
                            </div>
                            <div class="value"><span style="color:green;font-size:15px;">
                              <?PHP

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

echo $user_ip; // Output IP address [Ex: 177.87.193.134]


?>  
                            </span></div>
                           
                          </a>
                        </div>
                        <div class="d-none d-xxxl-block col-xxxl-3">
                          <a class="element-box el-tablo" href="#">
                            <div class="label">
                             
                            </div>
                            <div class="value">
                           
                            </div>
                            <div class="trending trending-up-basic">
                              <span>12%</span><i class="os-icon os-icon-arrow-up2"></i>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  
            
                  <!-- <!--END - Top Selling Chart--> 
               
			  
			  
             
    </div>
  </div>
                      </div>
                      <!--------------------
                      END - Table with actions
                      ------------------            -->
					  <!--------------------
					  
                      ------------------  -->
					  </br>
					  <hr>
					  
					  
					  
					  
					  
                      
                      <!--------------------
                      END - Controls below table
                      -------------------->
                    </div>
                  </div>
                </div>
              </div><!--------------------
              START - Color Scheme Toggler
              -------------------->
              
              <!--------------------
              END - Color Scheme Toggler
              --------------------><!--------------------
              START - Demo Customizer
              -------------------->
              
              <!--------------------
              END - Demo Customizer
              --------------------><!--------------------
              START - Chat Popup Box
              -------------------->
              
              <!--------------------
              END - Chat Popup Box
              -------------------->
            </div>
            <!--------------------
          START - Sidebar
            -------------------->
            <div class="content-panel">
              <div class="content-panel-close">
                <i class="os-icon os-icon-close"></i>
              </div>
              <div class="element-wrapper">
                <h6 class="element-header">
                  QUICK VIEWS & LINK
                </h6>
                <div class="element-box-tp">
				
				
   
				
				 <!--START - MESSAGE ALERT-->
                      <div class="alert alert-success borderless">
                        
                        
						<div id="date"></div>
						
					                      
                        <div class="alert-btn"></div>
                      </div>
                      <!--END - MESSAGE ALERT-->
					  
					  
					   <!--START - MESSAGE ALERT-->
                      <div class="alert alert-success borderless">
                        
                        <div class="alert-btn">
                        </div>
                      </div>
                      <!--END - MESSAGE ALERT-->
					  
				
                  <!-- <div class="el-buttons-list full-width"> -->
                    <!-- <a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-delivery-box-2"></i><span>Create New Product</span></a><a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-window-content"> -->
					<!-- </i><span>Customer Comments</span></a><a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-wallet-loaded"></i> -->
					<!-- <span>Store Settings</span></a> -->
                  <!-- </div> -->
                </div>
              </div>
              <!--------------------
              START - Support Agents
              -------------------->
              <div class="element-wrapper">
                <h6 class="element-header">
                  TIPS
                </h6>
                <div class="element-box-tp">
                  <div class="profile-tile">
                    <a class="profile-tile-box" href="profile.php">
                      <div class="pt-avatar-w">
                        <img alt="" src="admin/pic/<?php echo $row['uname']; ?>.jpg">
                      </div>
                      <div class="pt-user-name">
                        online
                      </div>
                    </a>
                    <div class="profile-tile-meta">
                      <ul>
                        <li>
                          <strong>Please fill in the Transfer Form Correctly</strong>
                        </li>
                         <li>
                          Do you have issues regarding Transfer? Feel free to contact Customer care
                        </li>
                      </ul>
                      <div class="pt-btn">
                        <a class="btn btn-success btn-sm" href="/contact/index.php">Contact Customer care</a>
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
             
             
            </div>
            <!--------------------
            END - Sidebar
            -------------------->
          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>
	<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <?php include 'footercopyright.php';
?>
  <!-- Copyright -->

</footer>
      <div class="display-type"></div>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bower_components/moment/moment.js"></script>
    <script src="bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="bower_components/ckeditor/ckeditor.js"></script>
    <script src="bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="bower_components/dropzone/dist/dropzone.js"></script>
    <script src="bower_components/editable-table/mindmup-editabletable.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="bower_components/bootstrap/js/dist/util.js"></script>
    <script src="bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="bower_components/bootstrap/js/dist/button.js"></script>
    <script src="bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src="bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="bower_components/bootstrap/js/dist/popover.js"></script>
    <script src="js/demo_customizer.js?version=4.4.0"></script>
    <script src="js/main.js?version=4.4.0"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-XXXXXXX-9', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
</html>
