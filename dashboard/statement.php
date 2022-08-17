<?php
session_start();
include_once ('../include/session.php');
require_once '../include/class.user.php';
if (!isset($_SESSION['acc_no'])) {
    header("Location: login.php");
    exit();
}


$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no" => $_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);



$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ");
$temp->execute(array(":acc_no" => $_SESSION['acc_no']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Account Statement</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
  
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> 
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="css/main.css?version=4.4.0" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <style>.alert-success {
    color: #090909;
    background-color: #e2e9e1;
    border-color: #36b927;
}
}
.img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.table-responsive {
    display: block;
    width: 95%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: initial;
    font-weight: 500;
    line-height: 1.2;
    color: #0a0a0b;
}

.btn-success {

    color: 

#fff;

background-color:
#00afe9;

border-color:

    #00afe9;

}

</style>	
	
	
	<link rel="stylesheet" type="text/css" href="clock_style.css">
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
	
	
  </head>
  
  <body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
		
      <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
          
		  
	<script type="text/javascript">
        function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#customers')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
        }
    </script>	  
		  
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-box"></div>
              </div>
              <div class="ssg-name">
               
              </div>
              <div class="ssg-info">
               
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-boxed">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company6.png)"></div>
                  <div class="item-name">
                    
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company7.png)"></div>
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
                   <span></span>s
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
                    <span></span>
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-image"></i>
                  </div>
                  <div class="item-name">
                    <span></span>
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
                <i class="os-icon os-icon-mail-14"></i>
                
                
                  <!-- <ul> -->
                    <!-- <li> -->
                      <!-- <a href="#"> -->
                        <!-- <div class="user-avatar-w"> -->
                          <!-- <img alt="" src="admin/pic/<?php echo $row['acc_no']; ?>.jpg"> -->
                        <!-- </div> -->
                        <!-- <div class="message-content"> -->
                          <!-- <h6 class="message-from"> -->
                            <!-- John Mayers -->
                          <!-- </h6> -->
                          <!-- <h6 class="message-title"> -->
                            <!-- Account Update -->
                          <!-- </h6> -->
                        <!-- </div> -->
                      <!-- </a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="#"> -->
                        <!-- <div class="user-avatar-w"> -->
                          <!-- <img alt="" src="img/avatar2.jpg"> -->
                        <!-- </div> -->
                        <!-- <div class="message-content"> -->
                          <!-- <h6 class="message-from"> -->
                            <!-- Phil Jones -->
                          <!-- </h6> -->
                          <!-- <h6 class="message-title"> -->
                            <!-- Secutiry Updates -->
                          <!-- </h6> -->
                        <!-- </div> -->
                      <!-- </a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="#"> -->
                        <!-- <div class="user-avatar-w"> -->
                          <!-- <img alt="" src="img/avatar3.jpg"> -->
                        <!-- </div> -->
                        <!-- <div class="message-content"> -->
                          <!-- <h6 class="message-from"> -->
                            <!-- Bekky Simpson -->
                          <!-- </h6> -->
                          <!-- <h6 class="message-title"> -->
                            <!-- Vacation Rentals -->
                          <!-- </h6> -->
                        <!-- </div> -->
                      <!-- </a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="#"> -->
                        <!-- <div class="user-avatar-w"> -->
                          <!-- <img alt="" src="img/avatar4.jpg"> -->
                        <!-- </div> -->
                        <!-- <div class="message-content"> -->
                          <!-- <h6 class="message-from"> -->
                            <!-- Alice Priskon -->
                          <!-- </h6> -->
                          <!-- <h6 class="message-title"> -->
                            <!-- Payment Confirmation -->
                          <!-- </h6> -->
                        <!-- </div> -->
                      <!-- </a> -->
                    <!-- </li> -->
                  <!-- </ul> -->
                
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
                      
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                    <!-- <ul> -->
                      <!-- <li> -->
                        <!-- <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a> -->
                      <!-- </li> -->
                      <!-- <li> -->
                        <!-- <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a> -->
                      <!-- </li> -->
                      <!-- <li> -->
                        <!-- <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a> -->
                      <!-- </li> -->
                      <!-- <li> -->
                        <!-- <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a> -->
                      <!-- </li> -->
                      <!-- <li> -->
                        <!-- <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a> -->
                      <!-- </li> -->
                    <!-- </ul> -->
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
                      YOUR ONLINE BANKING STATEMENT!
                    </h6>
                   
                  </div>
                </div>
              </div>
			  
            
                  <!-- <!--END - Top Selling Chart--> 
               
			  
			  
              <div class="row">
                 
          
                <div class="col-12 mg-t-20">
                     
                     
                  <div class="element-wrapper">
                    <h6 class="element-header">
                      RECENT TRANSFER STATEMENT <input type='button' id='btn' class="btn btn-success btn-sm" value='Print Statement' onclick='printtag("DivIdToPrint");' >
                      <br><br>
                   <div id='DivIdToPrint'> 
                    <div id="dvContainer"><br>
                    <img src="paris.png" alt="eh" style="width:30%;" style="img">
                 <h6 class="element-header">
                      </br>TRANSFER HISTORY
                    </h6>
                      <div class="table-responsive">
                       <script>$(document).ready( function () {
    $('#table').DataTable();
} );</script>   
                        
                        <!-- BEGIN table -->
			<table id="table" class="display table table-striped table-condensed table-bordered bg-white" data-show-header="true" data-pagination="true"
           data-id-field="name"
           data-page-list="[5, 10, 25, 50, 100, ALL]"
           data-page-size="5">
				<thead>
					<tr>
						<th style="white-space: nowrap">AMOUNT</th>
						<th style="white-space: nowrap">RECIEVING ACCOUNT AND NAME</th>
						<th style="white-space: nowrap">TYPE</th>
						<th style="white-space: nowrap">BANK</th>
						<th style="white-space: nowrap">COUNTRY</th>
						<th style="white-space: nowrap">DESCRIPTION</th>
						<th style="white-space: nowrap">DATE/TIME</th>
						<th style="white-space: nowrap">STATUS</th>
						
					</tr>
				</thead>
				<tbody>
				<?php 
				$acc_no = $_SESSION['acc_no'];
				$email = $row['email'];
				$his = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email'");
				$his->execute(array(":acc_no"=>$_SESSION['acc_no']));
				while($rows = $his->fetch(PDO::FETCH_ASSOC)){?>
					<tr>
						<td><?php echo $row['currency']; ?> <?php echo $rows['amount']; ?></td>
						<td><?php echo $rows['acc_no']; ?> - <?php echo $rows['acc_name']; ?></td>
						<td><?php echo $rows['transtype']; ?></td>
						<td><?php echo $rows['bank_name']; ?></td>
						<td><?php echo $rows['cout']; ?></td>
						<td><?php echo $rows['remarks']; ?></td>
						<td><?php echo $rows['date']; ?></td>
						<td><?php echo $rows['status']; ?></td>
						
					</tr>
				<?php } ?>
				</tbody>
			</table>
                        
                        
                              
                      
                      <!--------------------
                      END - Table with actions
                      ------------------            -->
					  <!--------------------
					  
                      ------------------  -->
					  </br>
					  <div id="content" class="content">
		
					   <h6 class="element-header">
                      TRANSACTION STATEMENT
                    </h6>
                    <P>Here is your Credit and Debit Transaction Statement</P>
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					  <!-- BEGIN table -->
					   <div class="table-responsive">
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">Ref No.</th>
						
						<th style="white-space: nowrap">TYPE</th>
						<th style="white-space: nowrap">AMOUNT <b>(<?php echo $row['currency']; ?>)</b></th>
						<th style="white-space: nowrap">TO/FROM</th>
						<th style="white-space: nowrap">DESCRIPTION</th>
						<th style="white-space: nowrap">DATE/TIME</th>
						
						
					</tr>
				</thead>
				<tbody>
				<?php 
				$uname = $_SESSION['acc_no'];
				$debcre = $reg_user->runQuery("SELECT * FROM alerts WHERE uname = '$uname'");
				$debcre->execute();
				while($rows = $debcre->fetch(PDO::FETCH_ASSOC)){?>
					<tr>
						<td><?php echo $rows['id']; ?>
                              </td>
						<td><?php include('ss.php');  ?></td>
						<td><?php echo $rows['amount']; ?></td>
						<td><?php echo $rows['sender_name']; ?></td>
						<td><?php echo $rows['remarks']; ?></td>
						<td><?php echo $rows['date']; ?> &nbsp;<?php echo $rows['time']; ?></td>
						
						
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<!-- END table -->
			
		</div>
		
          </div>   </div> 
          <br>
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
                              Account Logged in from:
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
      <div class="display-type"></div>
    </div>
    
	<!-- Footer -->
<footer class="page-footer font-small blue">
<br>
<br>
<br>
<br><br><br><br><br>
  <!-- Copyright -->
  <?php include 'footercopyright.php';
?>
  <!-- Copyright -->

</footer>

<!-- Footer -->
<script>var data = [
    {
        name: "bootstrap-table",
        stargazers_count: "526",
        forks_count: "122",
        description: "An extended Bootstrap table with radio, checkbox, sort, pagination, and other added features. (supports twitter bootstrap v2 and v3) "
    },
    {
        name: "multiple-select",
        stargazers_count: "288",
        forks_count: "150",
        description: "A jQuery plugin to select multiple elements with checkboxes :)"
    },
    {
        name: "bootstrap-show-password",
        stargazers_count: "32",
        forks_count: "11",
        description: "Show/hide password plugin for twitter bootstrap."
    },
    {
        name: "blog",
        stargazers_count: "13",
        forks_count: "4",
        description: "my blog"
    },
    {
        name: "scutech-redmine",
        stargazers_count: "6",
        forks_count: "3",
        description: "Redmine notification tools for chrome extension."
    },
    {
        name: "scutech-redmine1",
        stargazers_count: "6",
        forks_count: "3",
        description: "Redmine notification tools for chrome extension."
    }
];

function nameFormatter(value) {
    return '<a href="statement.php/' + value + '">' + value + '</a>';
}

function starsFormatter(value) {
    return '<i class="glyphicon glyphicon-star"></i> ' + value;
}

function forksFormatter(value) {
    return '<i class="glyphicon glyphicon-cutlery"></i> ' + value;
}

$(function () {
    $('#table').bootstrapTable({
        data: data
    });
});</script>
<script>function printtag(tagid) {
            var hashid = "#"+ tagid;
            var tagname =  $(hashid).prop("tagName").toLowerCase() ;
            var attributes = ""; 
            var attrs = document.getElementById(tagid).attributes;
              $.each(attrs,function(i,elem){
                attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
              })
            var divToPrint= $(hashid).html() ;
            var head = "<html><head>"+ $("head").html() + "</head>" ;
            var allcontent = head + "<body  onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</body></html>"  ;
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write(allcontent);
            newWin.document.close();
           // setTimeout(function(){newWin.close();},10);
        }</script>
<script src="assets/plugins/table/DataTables/JSZip-3.1.3/jszip.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/pdfmake.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/vfs_fonts.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/dataTables.autoFill.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/autoFill.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.print.min.js"></script>
	<script src="assets/plugins/table/DataTables/ColReorder-1.3.3/js/dataTables.colReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
	<script src="assets/plugins/table/DataTables/KeyTable-2.2.1/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowGroup-1.0.0/js/dataTables.rowGroup.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowReorder-1.2.0/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
	<script src="assets/plugins/table/DataTables/Select-1.2.2/js/dataTables.select.min.js"></script>
	<script src="assets/js/page/table-data.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
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
    <script>
		$(document).ready(function() {
			App.init();
			TableData.init();
		});
	</script>
<script src="//code.tidio.co/sulacvnq9bpifkbkortjpvcuacuoup7r.js" async></script>

  </body>
</html>
