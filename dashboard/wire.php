<?php
session_start();
include_once ('session.php');
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
	
	header("Location: cot.php");
	}
	
}
	
include_once ('counter.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Wire Transfer</title>
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
.btn-primary, .all-wrapper .fc-button.fc-state-active {
    color: #fff;
    background-color: #f1612d;
    border-color: #f1612d;
}
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
               
              </div>
              <div class="ssg-info">
              
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-list">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(admin/pic/<?php echo $row['acc_no']; ?>.jpg)"></div>
                  <div class="item-name">
                   <span></span>
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar2.jpg)"></div>
                  <div class="item-name">
                   <span></span> 
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar3.jpg)"></div>
                  <div class="item-name">
                  <span></span>
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
              
              </div>
              <div class="ssg-info">
               
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-blocks">
                <a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-file-text"></i>
                  </div>
                  <div class="item-name">
                   <span></span>
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
                <span></span>
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
                      DOMESTIC/INTERNATIONAL TRANSFER
                    </h6>
                    <div class="element-content">
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
                              Protect your account details
                            </div>
                            <div class="value"><span style="color:green;font-size:15px;">
                              <p>Do not reveal your account login and transaction details to anyone.</p>
                            </span></div>
                           
                          </a>
                        </div>
                        <div class="d-none d-xxxl-block col-xxxl-3">
                          <a class="element-box el-tablo" href="#">
                            <div class="label">
                              Refunds Processed
                            </div>
                            <div class="value">
                              $294
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
               
			  
			  
              <div class="row">
                <div class="col-sm-12">
                  <div class="element-wrapper">
                    <h6 class="element-header">
                      TRANSFER FORM
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
                              
                              <p>Fill in the form below with correct details.</p>
                       
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
							if(isset($_GET['errorimf']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid IMF Code! Transfer Failed.</strong> 
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
										<strong>Invalid OTP Code! Transfer Failed.</strong> 
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
			    				<?php if(isset($errorotp)){ echo $errorotp;}?>
								<?php if(isset($errortax)){ echo $errortax;}?>
								<?php if(isset($errorimf)){ echo $errorimf;}?>
								<?php if(isset($insufficient)){ echo $insufficient;}?>
								<?php if(isset($amounterror)){ echo $amounterror;}?>
		
		<div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Transfer Type</label>
			  <select name="cout" class="form-control">
                                   <option value="Domestic">Domestic</option>
   <option value="Inter-Bank">Inter-Bank</option>
   <option value="Wire">Wire Transfer</option>
                            </select>
			 
                           
            </div>
			</div>
								
          <div class="form-group row">
              <input class="form-control" placeholder="Routing Num." name="transtype" type="text" value="Wire Transfer" hidden>
            <label class="col-form-label col-sm-4" for="">Amount (<?php echo $row['currency']; ?>)</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Eg 35678" name="amount" type="number" required>
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
			  <select name="cout" class="form-control" required>
   <option value="" disabled selected>Select Country</option>
   <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
                            </select>
			 
                           
            </div>
			</div>
			<div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> SWIFT code</label> 
              <div class="col-sm-8">
                <input class="form-control" placeholder="Enter Swift code" name="swift" type="text" value="" >
              </div>
            </div>
			
			<div class="form-group row">
                
              <div class="col-sm-8">
                <input class="form-control" placeholder="Routing Num." name="routing" type="number" value="none" hidden >
              
              </div>
            </div>
            
            
			
			 <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Description</label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Description" name="remarks" type="text" required></textarea>
              </div>
            </div>
			
			<div class="form-group">
										<label class="control-label">Account Type <span class="text-danger">*</span></label>
										<div class="radio">
											<div class="radio-inline">
												<input type="radio" name="inline_radio" id="inline_radio_1" value="Savings" checked required>
												
												<label for="inline_radio_1">
													Savings
												</label><input type="hidden" name="type" value="Savings">
											</div>
											<div class="radio-inline">
												<input type="radio" id="inline_radio_2" name="inline_radio" value="Current" required>
												<label for="inline_radio_2">
													Current
												</label>
											</div>
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="Checking" required>
												<label for="inline_radio_3">
													Checking
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="Fix Deposit" required>
												<label for="inline_radio_3">
													Fixed Deposit
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="NON RESIDENT" required>
												<label for="inline_radio_3">
													Non-Resident
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="ONLINE BANKING" required>
												<label for="inline_radio_3">
													Online Banking
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="DOMICILIARY ACCOUNT" required>
												<label for="inline_radio_3">
												Domiciliary Account
												</label>
											</div>
											
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="JOINT ACCOUNT" required>
												<label for="inline_radio_3">
												Joint Account
												</label>
											</div>
										</div>
										
										
									</div> 
          <div class="form-buttons-w">
            <button class="btn btn-primary" type="submit" name="transfer"> Transfer</button>
          </div>
        </form>
      </div>
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
                  TODAY'S DATE 
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
                  NEED HELP?
                </h6>
                <div class="element-box-tp">
                  <div class="profile-tile">
                    <a class="profile-tile-box" href=mailto:support@one.lorentwestern.com>
                      <div class="pt-avatar-w">
                        <img alt="" src="chat.png">
                      </div>
                      <div class="pt-user-name">
                        online
                      </div>
                    </a>
                    <div class="profile-tile-meta">
                      <ul>
                        
                         <li>
                          Do you have issues regarding Online Banking? Feel free to contact Customer care
                        </li>
                      </ul>
                      <div class="pt-btn">
                        <a class="btn btn-success btn-sm" href=mailto:support@one.lorentwestern.com>Contact Customer Care</a>
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
