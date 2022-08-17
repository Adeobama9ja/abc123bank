 -------------------->
        <div class="menu-w color-scheme-dark color-style-bright menu-position-side menu-side-left menu-layout-full sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
           <center> <img src="log.png" alt="logo" width="170" height="50"></center>
          <div class="logo-w">
            <a class="logo" >
              <div class="logo-element"></div>
              <div class="logo-label">
               MY ONLINE BANKING
              </div>
            </a>
          </div>
          <div class="logged-user-w avatar-inline">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="admin/pic/<?php echo $row['uname']; ?>.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                <b style="font-size:13px"> <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></b> 
                </div>
                <div class="logged-user-role">
                 <b style="color:white;font-size:13px;font-family: inherit;">Account No: <?php echo $row['acc_no']; ?></b>
                </div>
              </div>
              
              
            </div>
          </div>
          <div class="menu-actions">
            <!--------------------
            START - Messages Link in secondary top menu
            -------------------->
            <!-- <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right"> -->
              <!-- <i class="os-icon os-icon-mail-14"></i> -->
              <!-- <div class="new-messages-count"> -->
                <!-- 12 -->
              <!-- </div> -->
              <!-- <div class="os-dropdown light message-list"> -->
                <!-- <ul> -->
                  <!-- <li> -->
                    <!-- <a href="#"> -->
                      <!-- <div class="user-avatar-w"> -->
                        <!-- <img alt="" src="img/avatar1.jpg"> -->
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
              <!-- </div> -->
            <!-- </div> -->
            <!--------------------
            END - Messages Link in secondary top menu
            --------------------><!--------------------
            START - Settings Link in secondary top menu
            -------------------->
            <!-- <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-right"> -->
              <!-- <i class="os-icon os-icon-ui-46"></i> -->
              <!-- <div class="os-dropdown"> -->
                <!-- <div class="icon-w"> -->
                  <!-- <i class="os-icon os-icon-ui-46"></i> -->
                <!-- </div> -->
                <!-- <ul> -->
                  <!-- <li> -->
                    <!-- <a href="profile.php"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a> -->
                  <!-- </li> -->
                  <!-- <li> -->
                    <!-- <a href="profile.php"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a> -->
                  <!-- </li> -->
                  <!-- <li> -->
                    <!-- <a href="profile.php"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a> -->
                  <!-- </li> -->
                  <!-- <li> -->
                    <!-- <a href="profile.php"><i class="os-icon os-icon-ui-15"></i><span>Cancel Account</span></a> -->
                  <!-- </li> -->
                <!-- </ul> -->
              <!-- </div> -->
            <!-- </div> -->
            <!--------------------
            END - Settings Link in secondary top menu
            --------------------><!--------------------
            START - Messages Link in secondary top menu
            -------------------->
            <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right">
              <h5 style="color:white; font-size:14px; padding-top:10px;"> ACC STATUS: <span style="color:white; font-weight:bolder;"><?php echo $row['status']; ?></span></h5>
            </div>
            <!--------------------
            END - Messages Link in secondary top menu
            -------------------->
          </div>
          <!-- <div class="element-search autosuggest-search-activator"> -->
            <!-- <input placeholder="Start typing to search..." type="text"> -->
          <!-- </div> -->
          <h1 class="menu-page-header">
            Page Header
          </h1>
          <ul class="main-menu">
            <li class="sub-header">
              <span>PERSONAL MENU</span>
            </li>
            <li class="selected has-sub-menu">
              <a href="summary.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Account Summary</span></a>
              <div class="sub-menu-w">
                
                <div class="sub-menu-icon">
                  
                </div>
                <div class="sub-menu-i">
                  <!-- <ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="index.html">Dashboard 1</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_crypto.html">Crypto Dashboard <strong class="badge badge-danger">Hot</strong></a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_support_dashboard.html">Dashboard 3</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_projects.html">Dashboard 4</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_bank.html">Dashboard 5</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top_image.html">Dashboard 6</a> -->
                    <!-- </li> -->
                  <!-- </ul> -->
                </div>
              </div>
            </li>
			
            <li class=" has-sub-menu">
              <a href="profile.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-user-male-circle2"></div>
                </div>
                <span>My Profile</span></a>
              <div class="sub-menu-w">
                
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                
              </div>
            </li>
			
			
			 <li class=" has-sub-menu">
              <a href="statement.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-newspaper"></div>
                </div>
                <span>My Statement</span></a>
              <div class="sub-menu-w">
                
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <!-- <div class="sub-menu-i"> -->
                  <!-- <ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_full.html">Side Menu Light</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_full_dark.html">Side Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_transparent.html">Side Menu Transparent <strong class="badge badge-danger">New</strong></a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_pipeline.html">Side &amp; Top Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_projects.html">Side &amp; Top</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_mini.html">Mini Side Menu</a> -->
                    <!-- </li> -->
                    <!-- </ul><ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_mini_dark.html">Mini Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact.html">Compact Side Menu</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact_dark.html">Compact Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_right.html">Right Menu</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top.html">Top Menu Light</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top_dark.html">Top Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- </ul><ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top_image.html">Top Menu Image <strong class="badge badge-danger">New</strong></a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout.html">Sub Menu Flyout</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout_dark.html">Sub Flyout Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout_bright.html">Sub Flyout Bright</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact_click.html">Menu Inside Click</a> -->
                    <!-- </li> -->
                  <!-- </ul> -->
                <!-- </div> -->
              </div>
            </li>
			
			
			
			<li class=" has-sub-menu">
              <a href="editpass.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-newspaper"></div>
                </div>
                <span>Change Password</span></a>
              <div class="sub-menu-w">
                
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <!-- <div class="sub-menu-i"> -->
                  <!-- <ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_full.html">Side Menu Light</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_full_dark.html">Side Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_transparent.html">Side Menu Transparent <strong class="badge badge-danger">New</strong></a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_pipeline.html">Side &amp; Top Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="apps_projects.html">Side &amp; Top</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_mini.html">Mini Side Menu</a> -->
                    <!-- </li> -->
                    <!-- </ul><ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_mini_dark.html">Mini Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact.html">Compact Side Menu</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact_dark.html">Compact Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_right.html">Right Menu</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top.html">Top Menu Light</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top_dark.html">Top Menu Dark</a> -->
                    <!-- </li> -->
                    <!-- </ul><ul class="sub-menu"> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_top_image.html">Top Menu Image <strong class="badge badge-danger">New</strong></a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout.html">Sub Menu Flyout</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout_dark.html">Sub Flyout Dark</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_sub_style_flyout_bright.html">Sub Flyout Bright</a> -->
                    <!-- </li> -->
                    <!-- <li> -->
                      <!-- <a href="layouts_menu_side_compact_click.html">Menu Inside Click</a> -->
                    <!-- </li> -->
                  <!-- </ul> -->
                <!-- </div> -->
              </div>
            </li>
			
            <li class="sub-header">
              <span>Transfers</span>
            </li>
            
			
			<li class=" has-sub-menu">
              <a href="wire.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-mail-19"></div>
                </div>
                <span>Transfer Funds</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-package"></i>
                </div>
                
              </div>
            </li>
			
			
			<li class="sub-header">
              <span>Personal Banking</span>
            </li>
			<li class=" has-sub-menu">
              <a href="ticket.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-wallet-loaded"></div>
                </div>
                <span>Create a Ticket</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-transfer"></i>
                </div>
                
              </div>
            </li>
			<li class=" has-sub-menu">
              <a href="inbox.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-inbox"></div>
                </div>
                <span>Messages</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-money"></i>
                </div>
                
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="http://lorentwestern.com/loanplans.html" target="_blank">
                <div class="icon-w">
                  <div class="os-icon os-icon-wallet-loaded"></div>
                </div>
                <span>Apply For Loan</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-money"></i>
                </div>
                
              </div>
            </li>
			
			
			<li class=" has-sub-menu">
              <a href=mailto:support@one.lorentwestern.com>
                <div class="icon-w">
                  <div class="os-icon os-icon-mail"></div>
                </div>
                <span>Contact Us</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-package"></i>
                </div>
                
              </div>
            </li>
			
			
			<li class=" has-sub-menu">
              <a href="logout.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-lock"></div>
                </div>
                <span>Logout</span></a>
              <div class="sub-menu-w">
                <!-- <div class="sub-menu-header"> -->
                  <!-- Applications -->
                <!-- </div> -->
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-package"></i>
                </div>
                
              </div>
            </li>
			
			
			
			
			
			
            
                
            
            
          
        </div>
       