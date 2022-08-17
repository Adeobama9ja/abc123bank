<?php session_start();
include_once ('../include/session.php');
require_once ('../include/class.user.php');
if(!isset($_SESSION['acc_no'])){
header("Location: login.php");
exit();
}
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include_once ('counter.php');?>


<!DOCTYPE html>
<html>
  <head>
    <title>My Profile</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
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
          <div class="element-search">
		
              <div class="close-search-suggestions">
               
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
        --------------------><!--------------------
        
       <?php include 'mainmenu.php';
?>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              <div class="element-search autosuggest-search-activator">
               
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
                      CUSTOMER PROFILE
                    </h6>
                    
                  </div>
                </div>
              </div>
			  
            
                  <!-- <!--END - Top Selling Chart--> 
               
			  
			  
              <div class="row">
                <div class="col-sm-12">
                  <div class="element-wrapper">
                    
                    <div class="element-box-tp">
                      <!--------------------
                      START - Controls Above Table
                      -------------------->
                      
                      <!--------------------
                      END - Controls Above Table
                      ------------------          --><!--------------------
                      START - Table with actions
                      ------------------  -->
					  
					  
					  
                      <div class="table-responsive">
					  
					  
					  <div class="content-box"><div class="row">
			
  <div class="col-sm-5">
    <div class="user-profile compact">
      <div class="up-head-w" style="background-image:url(admin/pic/<?php echo $row['uname']; ?>.jpg)">
        <div class="up-social">
        </div>
        <div class="up-main-info">
          <h2 class="up-header">
             <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
          </h2>
          <h6 class="up-sub-header">
           <?php echo $row['acc_no']; ?>
          </h6>
        </div>
        <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
      </div>
      
      <div class="up-contents">
        <div class="m-b">
          <div class="row m-b">
            
            
          </div>
          <div class="padded">
            <div class="os-progress-bar primary">
              <div class="bar-labels">
               
				 <li>
                                    <div class="field"><strong>Email:</strong></div>
                                    <div class="value">
                                       
                                    </div>
                                </li>
                <div class="bar-label-left">
                 <?php echo $row['email']; ?> 
                </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 100%">
                  <div class="bar-level-3" style="width: 100%"></div>
                </div>
              </div>
            </div>
			
            <div class="os-progress-bar primary">
              <div class="bar-labels">
			   <li>
                                    <div class="field"><b>Account Type:</b></div>
                                    <div class="value">
                                       </div>
                                </li>
                <div class="bar-label-left">
                  <?php echo $row['type']; ?> 
                                            (<?php echo $row['currency']; ?>)
                </div>
                <div class="bar-label-right">
                  </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 100%">
                  <div class="bar-level-3" style="width: 100%"></div>
                </div>
              </div>
            </div>
			
			<div class="os-progress-bar primary">
              <div class="bar-labels">
			   <li>
                                    <div class="field"><b>Available Balance:</b></div>
                                    <div class="value">
                                         
                                           </div>
                                </li>
                <div class="bar-label-left">
                 <?php echo $row['currency']; ?><?php echo number_format( $row['a_bal'] , 2, '.', ','); ?>
                           
                </div>
                <div class="bar-label-right">
                 
                </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 100%">
                  <div class="bar-level-3" style="width: 100%"></div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  <div class="col-sm-7">
    <div class="element-wrapper">
      <div class="element-box">
        <form id="formValidate">
          <div class="element-info">
            <div class="element-info-with-icon">
              <div class="element-info-icon">
                <div class="os-icon os-icon-user"></div>
              </div>
              <div class="element-info-text">
                <h5 class="element-inner-header">
                  Profile Overview
                </h5>
                <div class="element-inner-desc">
                  Below is your Online Banking profile details
                </div>
              </div>
            </div>
          </div>
		   <!-- BEGIN profile-header -->
                <div class="profile-header">
                    <!-- BEGIN profile-header-cover -->
                    <!-- END profile-header-cover -->
                    <!-- BEGIN profile-header-content -->
                    <div class="profile-header-content">
                        <!-- BEGIN profile-header-img -->
                        <!-- END profile-header-img -->
                        <!-- BEGIN profile-header-info -->
                        <div class="profile-header-info">
                            <!-- END profile-header-info -->
                    </div>
                    <!-- END profile-header-content -->
                    <!-- BEGIN profile-header-tab -->
                    
                    <!-- END profile-header-tab -->
                </div>
                <!-- END profile-header -->
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN row -->
                    <div class="row row-space-20">
                        <!-- BEGIN col-8 -->
                        <!-- BEGIN col-4 -->
                        <!-- BEGIN profile-info-list -->
                        <ul class="profile-info-list">
                            
                               
                            <div class="col-md-4 col-xs-6 col-ms-6">
                               
                                <br>
                                <li>
                                    <div class="field"><b>Phone</b></div>
                                    <div class="value">
                                        <?php echo $row['phone']; ?>
                                    </div>
                                </li>
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Sex</b></div>
                                    <div class="value">
                                        <?php echo $row['sex']; ?>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="field"><b>Marital Status</b></div>
                                    <div class="value">
                                        <?php echo $row['marry']; ?>
                                    </div>
                                </li>
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Date of Birth</b></div>
                                    <div class="value">
                                        <?php echo $row['dob']; ?>
                                    </div>
                                </li>
                                <br>
                                 <li>
                                    <div class="field"><b>Address</b></div>
                                    <div class="value"> <address class="m-b-0">										<?php echo $row['addr']; ?>									</address> </div>
                                </li>
                                <br>
                               <li>
                                    <div class="field"><b>Active Since</b></div>
                                    <div class="value">
                                        
                                            (<?php echo $row['reg_date']; ?>)</div>
                                </li>
                                <br>
							</div>
                           
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                               
                                <br> 
							</div>
							<div class="col-md-4 col-xs-6 col-ms-6">
                                
                                <br> 
							</div>
							
							</ul>
							
                        <!-- END profile-info-list -->
                        </div>
                        <!-- END col-4 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END profile-container -->
            </div>
            <!-- END #content -->
            <!-- BEGIN btn-scroll-top --><a href="index.php#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
            <!-- END btn-scroll-top -->
        </div>
        <!-- END #page-container -->
          
      </div>
    </div>
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
					  
					  
					   <!--START - MESSAGE ALERT-->
                      <div class="alert alert-warning borderless">
                        <h5 class="alert-heading">
                          </h5>
                        <p>
						</p>
                        <div class="alert-btn">
                        </div>
                      </div>
                      <!--END - MESSAGE ALERT-->
					  
					  
                      
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
           	<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
   <?php include 'footercopyright.php';
?>
  <!-- Copyright -->

</footer>
          </div>
        </div>
      </div>
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
    <script src="//code.tidio.co/sulacvnq9bpifkbkortjpvcuacuoup7r.js" async></script>
  </body>
</html>
