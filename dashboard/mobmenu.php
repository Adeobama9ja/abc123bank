  <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="summary.php"><span>MY ONLINE BANKING</span></a>
            <div class="mm-buttons">
              <div class="">

              </div>
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img src="admin/pic/<?php echo $row['uname']; ?>.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                 <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
                </div>
                <div class="logged-user-role">
                   Account #: <?php echo $row['acc_no']; ?>
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
			
              <li class="">
                <a href="summary.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Account Summary</span></a>
              </li>
			  
			  <li class="">
                <a href="profile.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-user-male-circle2"></div>
                  </div>
                  <span>My Profile</span></a>
              </li>
			  
			  <li class="">
                <a href="editpass.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-newspaper"></div>
                  </div>
                  <span>Change Password</span></a>
              </li>
			  
			  
			  <li class="">
                <a href="statement.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-newspaper"></div>
                  </div>
                  <span>My Statement</span></a>
              </li>
              
			  <li class="">
                <a href="wire.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-mail-19"></div>
                  </div>
                  <span>Transfer</span></a>
              </li>
			  
			  <li class="">
                <a href="https://lorentwestern.com/loanplans.html" target="_blank">
                  <div class="icon-w">
                    <div class="os-icon os-icon-wallet-loaded"></div>
                  </div>
                  <span>Apply For Loan</span></a>
              </li>
			  
			  <li class="">
                <a href="inbox.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-mail"></div>
                  </div>
                  <span>Messages</span></a>
              </li>
			  
			  <li class="">
                <a href="ticket.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-mail"></div>
                  </div>
                  <span>Tickets</span></a>
              </li>
			  <li class="">
                <a href=mailto:support@one.lorentwestern.com>
                  <div class="icon-w">
                    <div class="os-icon os-icon-mail"></div>
                  </div>
                  <span>Contact Us</span></a>
              </li>
			  
			  <li class="">
                <a href="logout.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-lock"></div>
                  </div>
                  <span>Logout</span></a>
              </li>
			  
              
              
              
             
              
            </ul>
            <!--------------------
            END - Mobile Menu List
            -------------------->
           <div class="mobile-menu-magic">
              <img alt="" src="SEAL.gif">
              <div class="btn-w">
              </div>
            </div>
          </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------