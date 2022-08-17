<?php
session_start();
include_once ('../include/session.php');
require_once '../include/class.user.php';
if (!isset($_SESSION['acc_no'])) {
    header("Location: ../login.php");
    exit();
}


$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no" => $_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);



$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 3");
$temp->execute(array(":acc_no" => $_SESSION['acc_no']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
  <head>
    <title>Account Summary | L'Orent Western</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
      <!-- azia CSS -->
       <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
	   <link href='https://fonts.googleapis.com/css?family=Asap:400&subset=latin' rel='stylesheet' type='text/css'>
    <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="css/main.css?version=4.4.0" rel="stylesheet">

    <link rel="stylesheet" href="lib/azia.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
   	  
    <link href="lib/jqvmap/jqvmap.min.css" rel="stylesheet">

	<!-- vendor css -->
  
  
	
	<style>
	.menu-w.color-style-bright {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#111111), to(#111111));
    background-image: linear-gradient(to bottom, 
#1d8fc4 0%,
    #1d8fc4 100%);
    background-repeat: repeat-x;
}
.menu-w.color-scheme-dark.color-style-bright ul.main-menu .icon-w {
    color: white;
}
body.full-screen .menu-w, body.full-screen .top-bar {
    border-radius: 0px !important;
}
.menu-w ul.main-menu > li.sub-header {
    text-transform: uppercase;
    color: #d8d6d6;
    font-size: 0.72rem;
    letter-spacing: 1px;
    padding-top: 20px;
    padding-bottom: 0px;
    border-bottom: none;
}
	</style>
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
  </script>
<style>.alert-success {
    color: #090909;
    background-color: #e2e9e1;
    border-color: #36b927;
}


.MyButton {
    padding: 5px;
    font-weight: normal;
    font-size: 90%;
    background: 
#1d8fc4;
color:
#fff;
border: 1px solid
    #1d8fc4;
    border-radius: px;
    -moz-box-shadow: : 6px 6px 5px #999;
    -webkit-box-shadow: : 6px 6px 5px #999;
    box-shadow: : 6px 6px 5px #999;
}
.MyButton:hover {
color: #fff;
background: #1d8fc4;
border: 1px solid #1d8fc4;
}

.menu-w .logo-w .logo-label, .top-bar .logo-w .logo-label {
    display: inline-block;
    vertical-align: middle;
    color: 
    #fff;
    letter-spacing: 0px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 0.78rem;
    position: relative;
    margin-left: 10px;
}

</style>	
	
  </head>
  <body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
		
      <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
          
		  
		  
		  
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
                    Integ<span></span> 
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
                  <div class="item-media" style="background-image: url(admin/pic/<?php echo $row['acc_no']; ?>.jpg)"></div>
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
        
        <!--------------------
        <!--------------------
        START - Mobile Menu
        -------------------->
      <?php include 'mobmenu.php';
?>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        
        //START - Main Menu
       <?php include 'mainmenu.php';
?>
       
        
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              
              <!--------------------
              START - Messages Link in secondary top menu
              -------------------->
              <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
               <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                
                
                
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
                    
                  </ul>
                </div>
              </div>
              <!--------------------
              END - Settings Link in secondary top menu
              --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="logged-user-i">
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
                        <a href="logout.php">Secure Signout</a>
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
          --------------------><?php
                                if (isset($_GET['dormant'])) {
                                    ?>
                                    <div class='alert alert-warning'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Sorry, your account is DORMANT/INACTIVE, please contact customer care </a></strong> 
                                    </div>
                                    <?php
                                }
                                ?>
                                
                                <?php
                                if (isset($_GET['hold'])) {
                                    ?>
                                    <div class='alert alert-warning'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Sorry, your account Status is ON HOLD Please Contact Customer care</a></strong> 
                                    </div>
                                    <?php
                                }
                                ?>
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">
            <div class="content-box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="element-wrapper">
     
      <div class="az-content-body az-content-body-dashboard-six">
        <h2 class="az-content-title tx-24 mg-b-5">Welcome Back  <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></h2>
        <p class="mg-b-20">Banking With Utmost Comfort!</p>

        <div class="row row-sm">

          <div class="col-lg-6 mg-t-20 mg-lg-t-0">
            <div class="card card-dashboard-balance">
              <div class="card-body">
                  <p style="font-size:16px color: red"><strong>SAFETY TIPS</strong><p style="font-size:16px" style="color: red">Change Your Online Banking Password  <br>Frequently to Keep Your Account Safe</p>
                <i class="fab fa-cc-money"></i>
                <p style="font-size:16px"><strong>AVAILABLE BALANCE</strong></p>
                 <img alt="" src="balance.png" align="center" height="27" width="70">
                <h1 class="balance-amount"><span><?php echo $row['currency']; ?></span><?php echo $english_format_number = number_format( $row['a_bal'] , 2, '.', ','); ?></h1>

                <p style="font-size:16px"><strong>YOUR ACCOUNT NUMBER</strong></p>
                
                <div class="account-number">
                  
                  <span><?php echo $row['acc_no']; ?></span>
                </div><!-- account-number -->

                <div class="d-sm-flex">
                  <div>
                <p style="font-size:14px"><strong>ACCOUNT HOLDER</strong></p>
                    <h6 class="account-name" style="color: purple"> <?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></h6>
                  </div>
                  <div class="mg-t-20 mg-sm-t-0 mg-sm-l-50">
                <p style="font-size:14px"><strong>ACCOUNT TYPE</strong></p>
                    <h6 class="account-name" style="color: blue"><?php echo $row['type']; ?></h6>
                  </div>
				  <div class="mg-t-20 mg-sm-t-0 mg-sm-l-50">
                <p style="font-size:14px"><strong>ACCOUNT STATUS</strong></p>
                    <h6 class="account-name" style="color: green"><?php echo $row['status']; ?></h6>
                  </div>
                </div>
              </div><!-- card-body -->
              <div class="chart-wrapper">
                <div id="flotChart2" class="flot-chart"></div>
              </div><!-- chart-wrapper -->
            </div><!-- card -->
          </div>

          <div class="col-lg-6 mg-t-20">
            <div class="row row-sm">
              <div class="col-sm-6">
                <div class="card card-dashboard-finance">
                  <h6 class="card-title">Total Book Balance</h6>
                 <img alt="" src="balance.png" align="center" height="27" width="70">
                  <h3><span><?php echo $row['currency']; ?></span><?php echo  $english_format_number = number_format( $row['t_bal'] , 2, '.', ','); ?></h3>
                  <span class="tx-12"><span>as at</span> <span class="tx-success tx-bold"> <?php echo " " .$today = date("F j, Y"); ; ?></span>
                </div>
              </div><!-- col -->
              <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                <div class="card card-dashboard-finance">
                    
                  <h6 class="card-title">Account Logged From:</h6>
                   <img alt="" src="ipaddress.png" align="center" height="35" width="30">Your Device IP Address</span>
                 
                  <h4 style="color: red"><span></span><?PHP

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


?>    </h4>
                  <span class="tx-12"><span class="tx-danger tx-bold"></span> </span>
                </div>
              </div><!-- col -->
              <div class="col-12  mg-t-20 ">
                <div class="card card-dashboard-finance">
                  <form>
<h5 class="card-title">LAST TRANSFER MADE</h5> <input class="MyButton" type="button" value="View More" onclick="window.location.href='statement.php'" />
<div class="table-responsive">
                <table class="table table-striped">
                 <div class="table-responsive">
                        <table class="table table table-striped table-condensed table-bordered bg-white">
                          <thead>
                            <tr>
                              
                              <th>
                                Beneficiary Bank & Account
                              </th>
                              
                              <th>
                                Amount
                              </th>
                              <th>
                               Status
                              </th>
                            
                              <th>
                                Date/Time
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              
                              <td>
                                <?php echo $rows['bank_name']; ?><br> <?php echo $rows['acc_no']; ?>
                              </td>
                             
                              <td >
                              <?php echo $row['currency']; ?> <?php echo $rows['amount']; ?>
                              </td>
                              <td>
                                <?php echo $rows['status']; ?>
                              </td>
                              
                              <td >
                               <?php echo $rows['date']; ?>
                              </td>
                            </tr>
                            <tr>
                             
                              </td>
                              
                            </tr>
                          </tbody>
                        </table>
                      </div>
                       <form>
</form></div>
              </div><!-- col -->
              
              </div><!-- col -->
            </div><!-- row -->
          </div>
          <div class="col-12 mg-t-20">
            <div class="card card-dashboard-table-six">
              <h6 class="card-title">Your Financial Statement</h6>
</form> 
					   <div class="table-responsive">
                        <table class="table table table-striped table-condensed table-bordered bg-white">
                          <thead>
                            <tr>
                              
                             <th class="text-center">
                             
                                Type 
                              </th>
                              <th>
                               Amount
                              </th>
                              <th>
                                To/From 
                              </th>
                              <th>
                               Description
                              </th>
                              <th>
                                Date/Time 
                              </th>
                              <th>
                                Status
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                              <?php 
				$acc_no = $_SESSION['acc_no'];
				$debcre = $reg_user->runQuery("SELECT * FROM alerts WHERE uname = '$acc_no' ORDER BY id DESC LIMIT 3 ");
				$debcre->execute();
				while($rows = $debcre->fetch(PDO::FETCH_ASSOC)){?>
				
			 
                            <tr>
                              <td class="text-center">
                               
                                <b><?php echo $rows['type']; ?></b>
                              </td>
                              <td>
                              <?php echo $row['currency']; ?> <?php echo $rows['amount']; ?>
                              </td>
                              <td class="text-right">
                               <?php echo $rows['sender_name']; ?>
                              </td>
                              <td>
                               <?php echo $rows['remarks']; ?>
                              </td>
                              <td class="text-center">
							  <?php echo $rows['date']; ?> &nbsp;<?php echo $rows['time']; ?>
                               
                              </td>
                              <td class="row-actions">
                               <?php echo $rows['statz']; ?>
                              </td>
                            </tr>
                            <tr>
                             
                              </td>
                              
                            </tr>
                          </tbody>
                            <tr>
                             
                              
                             
							
                               
                              	<?php } ?>
                            </tr>
                            <tr>
                             
                              </td>
                              
                            </tr>
                          </tbody>
                        </table>
                        <form>
<input class="MyButton" type="button" value="View More" onclick="window.location.href='statement.php'" />
</form>
                      <!--------------------
                      END - Table with actions
                      ------------------            -->
					  <!--------------------
					  
                      ------------------  -->
              </div><!-- table-responsive -->
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- az-content-body -->
  </div><!-- row -->
      </div><br><br><br><br><br><br><br><br><br>
    <div class="az-footer">
       
        <center>     <?php include 'footercopyright.php';
?></center>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->
    
<!-- Footer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/peity/3.3.0/jquery.peity.min.js"></script>

    <script src="js/azia.js"></script>
    <script src="js/chart.flot.sampledata.js"></script>
    
  <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/ionicons/ionicons.js"></script>
    <script src="lib/jquery.flot/jquery.flot.js"></script>
    <script src="lib/jquery.flot/jquery.flot.resize.js"></script>
    
    <script>
      $(function(){
        'use strict'

        if($('.az-iconbar .nav-link.active').length) {
          var targ = $('.az-iconbar .nav-link.active').attr('href');
          $(targ).addClass('show');

          if(window.matchMedia('(min-width: 1200px)').matches) {
            $('.az-iconbar-aside').addClass('show');
          }

          if(window.matchMedia('(min-width: 992px)').matches &&
            window.matchMedia('(max-width: 1199px)').matches) {
              $('.az-iconbar .nav-link.active').removeClass('active');
          }
        }

        $('.az-iconbar .nav-link').on('click', function(e){
          e.preventDefault();

          $(this).addClass('active');
          $(this).siblings().removeClass('active');

          $('.az-iconbar-aside').addClass('show');

          var targ = $(this).attr('href');
          $(targ).addClass('show');
          $(targ).siblings().removeClass('show');
        });

        $('.az-iconbar-toggle-menu').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('.az-iconbar .nav-link.active').removeClass('active');
            $('.az-iconbar-aside').removeClass('show');
          } else {
            $('body').removeClass('az-iconbar-show');
          }
        })

        $('#azIconbarShow').on('click', function(e){
          e.preventDefault();
          $('body').toggleClass('az-iconbar-show');
        });


        $.plot('#flotChart2', [{
            data: flotSampleData1,
            color: '#969dab'
          }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 0.2 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: { show: false },
    			xaxis: { show: false }
    		});


        // Mini Bar charts
        $('.peity-bar').peity('bar');
      });
    </script>
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
    <script src="//code.tidio.co/sulacvnq9bpifkbkortjpvcuacuoup7r.js" async></script>
  </body>
</html>
