<?php
session_start();
include_once ('../include/session.php');
require_once '../include/class.user.php';

if (!isset($_SESSION['acc_no'])) {
	
header("Location: login.php");
exit(); 
}
;

if ($_SERVER['HTTP_REFERER'] == $url) {
  header('Location: logout.php'); //redirect to some other page
  exit();
}
$reg_user = new USER();
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['code'])){
	$pin_auth = $row['pin_auth'];
	$sub = $_POST['pin_auth'];
	if($sub !== $pin_auth){
		header("Location: pin_auth.php?errorpin");
	}
	else {
		header("Location: summary.php");
	$sql = " UPDATE account SET pin_verify = '1' WHERE acc_no ='$acc_no'";
	}
}
	
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="http://speedhubexpress.com/wp-content/uploads/2021/06/favicon.png">
    <title>Enter Login Pin To Continue</title>
    
    <!-- page css -->
    <link href="../dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>input.MyButton {
    width: 75px;
    padding: 11px;
    cursor: pointer;
    font-weight: normal;
    font-size: 80%;
    background: #03a9f3;
    color: #fff;
    border: 1px solid #3366cc;
    border-radius: px;
    -moz-box-shadow: : 6px 6px 5px #999;
    -webkit-box-shadow: : 6px 6px 5px #999;
    box-shadow: : 6px 6px 5px #999;
}
input.MyButton:hover {
color: #fff;
background: #1176a3;
border: 1px solid #fff;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: 
#fff;
background-clip: border-box;
border: 0 solid
    transparent;
    border-radius: 25px;
}
.login-box {
    width: 350px;
    margin: 0 auto;
        margin-bottom: 0px;
}

body {
    line-height: 1.5;
}
dl, h1, h2, h3, h4, h5, h6, ol, p, pre, ul {
    color: 
    black;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .5rem;
    font-weight: 300;
    line-height: 1.2;
    color: 
    #0076b6;
}
.img-circle {
    border-radius: 9%;
}

.small, small {
    font-size: 80%;
    font-weight: 400;
    color: 
    black;
}


</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Authenticating</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(../banner.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form>
<input class="MyButton" type="button" value="Logout" onclick="window.location.href='logout.php'" />
</form>
                    <?php 
							if(isset($_GET['errorpin']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid PIN Code! Unable to Proceed.</strong> 
									</div>
									<?php
								}
						?>
							<?php if(isset($errorpin)){ echo $errorpin;}?>
                    <form class="form-horizontal form-material" id="loginform" method="POST">
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <div class="user-thumb text-center"> <img alt="thumbnail" class="img-circle" width="100" src="admin/pic/<?php echo $row['uname']; ?>.jpg">
                                    </br><p>Welcome Back </p><h4> <?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <center><p>Enter PIN to Proceed</p></center>
                                <input class="form-control" type="password" name="pin_auth" required="" placeholder="Enter PIN here">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="code" type="submit">Confirm Login</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../dist/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../dist/assets/node_modules/popper/popper.min.js"></script>
    <script src="../dist/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        
    </script>

</body>

</html>