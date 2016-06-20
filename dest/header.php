             <a href="index2.php?modul=default&aksi=beranda" class="logo bg-header">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
				<class="icon" width="100" height="60"><span class="logo-lg"><?php echo''.$_SESSION['status_login'].''; ?></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top bg-header" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>  <?php echo $_SESSION['user_id'] ;?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
								<li class="user-header bg-header">
									<img src="<?php echo''.$_SESSION['photo'].''; ?>" class="img-circle" alt="User Image" />
                                    <p>
										<?php echo' '.$_SESSION['status_login'].' - '; if ($_SESSION['status_login']=='Administrator') {echo''.$_SESSION['id'].'';}else{echo''.$_SESSION['bagian'].'';}echo'<br>('.$_SESSION['nama'].')' ;?>
                                         <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <!-- Menu Footer-->
								<li class="user-footer  bg-gray">
									<div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>