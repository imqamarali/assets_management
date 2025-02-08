				<?php
				$conn = Yii::$app->getDb();
				$sqlimg = "SELECT * FROM config";
				$resultimg = $conn->createCommand($sqlimg)->queryOne();


				$sqlimg1 = "SELECT * FROM navbarlogo";
				$resultimg1 = $conn->createCommand($sqlimg1)->queryOne();

				$sqla = "SELECT COUNT(*) FROM memberplot
                where  memberplot.status='Sales'";
				$resulta = $conn->createCommand($sqla)->queryOne();

				$sqlat = "SELECT COUNT(*) FROM transferplot";
				$resultat = $conn->createCommand($sqlat)->queryOne();

				$sqlat1 = "SELECT COUNT(*) FROM possession where status=0";
				$resultat1 = $conn->createCommand($sqlat1)->queryOne();
				?>

				<div id="navbar" class="navbar navbar-default ace-save-state">
					<div class="navbar-container ace-save-state" id="navbar-container">


						<div class="navbar-header pull-left"> <a href="index.php?r=" class="navbar-brand"> <small>
									<?php echo $resultimg['companyname']; ?></small> </a> </div>

						<?php if (isset($_SESSION['user_array'])) { ?>
							<div class="navbar-buttons navbar-header pull-right" role="navigation">
								<ul class="nav ace-nav pull-right">

									<li class="green dropdown-modal">
										<a class="dropdown-toggle" href="?r=memberplot/index2" aria-expanded="false"
											title="Allotment Requests">
											<i class="ace-icon fa fa-bell"></i>
											<span class="badge badge-important"><?php echo $resulta['COUNT(*)']; ?></span>
										</a>
									</li>
									<li class="red dropdown-modal">
										<a class="dropdown-toggle" href="?r=memberplot/aprovalr" aria-expanded="false"
											title="Trasfer Requests">
											<i class="ace-icon fa fa-bell"></i>
											<span class="badge badge-important"><?php echo $resultat['COUNT(*)']; ?></span>
										</a>
									</li>

									<li class="grey dropdown-modal">
										<a class="dropdown-toggle" href="?r=memberplot/indexp" aria-expanded="false"
											title="Possession Requests">
											<i class="ace-icon fa fa-bell"></i>
											<span class="badge badge-important"><?php echo $resultat1['COUNT(*)']; ?></span>
										</a>
									</li>

									<li class="light-blue user-profile">
										<a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">
											<?php if (file_exists("img/employee/" . $_SESSION['user_array']['pic'])) { ?>
												<img src="img/employee/<?php echo $_SESSION['user_array']['pic']; ?>" class="nav-user-photo"
													alt="N/A" />
											<?php } else { ?>
												<img src="img/dummy.png" class="nav-user-photo" />
											<?php } ?>
											<span id="user_info">
												<b>Welcome,</b> <?php echo $_SESSION['user_array']['name']; ?>
											</span>
											<i class="icon-caret-down"></i>
										</a>
										<ul id="user_menu"
											class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
											<li><a
													href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/setting&id=<?php echo $_SESSION['user_array']['id']; ?>"><i
														class="icon-cog"></i> Settings</a></li>
											<li><a
													href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/profile&id=<?php echo $_SESSION['user_array']['id']; ?>"><i
														class="icon-user"></i> Profile</a></li>
											<li><a
													href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=cdashboard/&uid=<?php echo $_SESSION['user_array']['id']; ?>"><i
														class="icon-user"></i>Customize Your Dashboard</a></li>
											<li class="divider"></li>
											<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=/site/logout"><i
														class="icon-off"></i> Logout</a></li>
										</ul>
									</li>
								</ul>
							</div>
						<?php } ?>
						<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<li> <a href="index.php?r=dashboard"> eSystem
										&nbsp; </a> </li>
							</ul>
						</nav>
					</div>
				</div>





				<div class="main-container ace-save-state" id="main-container">
					<script type="text/javascript">
						try {
							ace.settings.loadState('main-container')
						} catch (e) {}
					</script>

					<div id="sidebar" class="sidebar ace-save-state h-sidebar navbar-collapse collapse">
						<script type="text/javascript">
							try {
								ace.settings.loadState('sidebar')
							} catch (e) {}
						</script>

						<div class="sidebar-shortcuts" style=" width:100px;padding:5px !important;" id="sidebar-shortcuts">
							<img src="img/logo/logo.jpeg" alt="<?php echo $resultimg['companyname']; ?>" style="max-width: 60px;">
						</div><!-- /.sidebar-shortcuts -->

						<ul class="nav nav-list" id="n">

							<li class="open hover">
								<a href="index.php">
									<i class="menu-icon fa fa-tachometer"></i>
									<span class=""> Dashboard </span>
								</a>

								<b class="arrow"></b>

							</li>
							<li class="open hover">
								<a href="index.php?r=projects">
									<i class="fa fa-graduation-cap menu-icon"></i>
									<span class="">
										Projects
									</span>


								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=projects">
											<i class="menu-icon fa fa-caret-right"></i>
											List
										</a>

										<b class="arrow"></b>
									</li>
								</ul>

							</li>
							<li class="open hover">
								<a href="#">
									<i class="fa fa-graduation-cap menu-icon"></i>
									<span class="">
										Memberships
									</span>


								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=memberplot">
											<i class="menu-icon fa fa-caret-right"></i>
											Plot/File
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=memberplot/index1">
											<i class="menu-icon fa fa-caret-right"></i>
											Property
										</a>

										<b class="arrow"></b>
									</li>
								</ul>

							</li>
							<li class="open hover">
								<a href="#">
									<i class="fa fa-graduation-cap menu-icon"></i>
									<span class="">
										Allotment
									</span>


								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=memberplot/memberplot">
											<i class="menu-icon fa fa-caret-right"></i>
											Plot/File
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=memberplot/memberp">
											<i class="menu-icon fa fa-caret-right"></i>
											Property
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="open hover">
								<a href="index.php?r=promote">
									<i class="fa fa-trophy menu-icon"></i>
									<span class="">
										Housing(Plot)
									</span>


								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=sectors">
											<i class="menu-icon fa fa-caret-right"></i>
											Sectors
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=streets">
											<i class="menu-icon fa fa-caret-right"></i>
											Streets
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=plots">
											<i class="menu-icon fa fa-caret-right"></i>
											Plot/Files
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=size">
											<i class="menu-icon fa fa-caret-right"></i>
											Plot Size
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=category/category_list">
											<i class="menu-icon fa fa-caret-right"></i>
											Plot Categories
										</a>

										<b class="arrow"></b>
									</li>


								</ul>
							</li>

							<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-users"></i>
									<span class="">Property</span>

									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=sectors/block">
											<i class="menu-icon fa fa-caret-right"></i>
											Block/Tower
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=streets/floor">
											<i class="menu-icon fa fa-caret-right"></i>
											Floor
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=plots/unit">
											<i class="menu-icon fa fa-caret-right"></i>
											Unit
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=category/category_list1">
											<i class="menu-icon fa fa-caret-right"></i>
											Property Type
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="index.php?r=size/index1">
											<i class="menu-icon fa fa-caret-right"></i>
											Property Size
										</a>

										<b class="arrow"></b>
									</li>


								</ul>
							</li>
							<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-users"></i>
									<span class="">Customer Management</span>

									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=members/consumer">
											<i class="menu-icon fa fa-caret-right"></i>
											Consumer
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=servicescharges">
											<i class="menu-icon fa fa-caret-right"></i>
											Services/Charges
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=extraservices">
											<i class="menu-icon fa fa-caret-right"></i>
											Extra Services/Charges
										</a>

										<b class="arrow"></b>
									</li>

								</ul>
							</li>
							<!--
					<li class="open hover">
						<a href="index.php?r=memberplot/transferreq">
							<i class="fa fa-graduation-cap menu-icon" ></i>
							<span class="">
								Transfer
							</span>

							
						</a>

						<b class="arrow"></b>
											<ul class="submenu">
							<li class="hover">
								<a href="index.php?r=memberplot/transferreq">
									<i class="menu-icon fa fa-caret-right"></i>
									Request
								</a>

								<b class="arrow"></b>
							</li>
							<li class="hover">
								<a href="index.php?r=memberplot/approvalr">
									<i class="menu-icon fa fa-caret-right"></i>
									Approval
								</a>

								<b class="arrow"></b>
							</li>
							</ul>
						
					</li>
					-->
							<li class="open hover">
								<a href="index.php?r=memberplot/reserveplot">
									<i class="fa fa-graduation-cap menu-icon"></i>
									<span class="">
										Reservation
									</span>


								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=memberplot/reserved">
											<i class="menu-icon fa fa-caret-right"></i>
											List
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=rcategory">
											<i class="menu-icon fa fa-caret-right"></i>
											Reservation Categories
										</a>

										<b class="arrow"></b>
									</li>
								</ul>

							</li>
							<li class="open hover">
								<a href="index.php?r=plots/allplot">
									<i class="fa fa-graduation-cap menu-icon"></i>
									<span class="">
										Plot Development Status
									</span>


								</a>

							</li>
							<li class="hover">
								<a href="index.php?r=config/msg" class="dropdown-toggle">
									<i class="menu-icon fa fa-users"></i>
									<span class="">Broadcasting</span>
									<b class="arrow fa fa-angle-down"></b>

								</a>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=config/msg">
											<i class="menu-icon fa fa-caret-right"></i>
											Send Message
										</a>

										<b class="arrow"></b>
									</li>
								</ul>



							</li>

							<li class="hover">
								<a href="index.php?r=recovery/dashboard">
									<i class="menu-icon fa fa-users"></i>
									<span class="">Recovery</span>
									<b class="arrow fa fa-angle-down"></b>

								</a>
								<ul class="submenu">
									<li class="hover">
										<a href="index.php?r=recovery">
											<i class="menu-icon fa fa-caret-right"></i>
											Due Instalment List
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=recovery/watchlist">
											<i class="menu-icon fa fa-caret-right"></i>
											Watch List
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=recovery/followup">
											<i class="menu-icon fa fa-caret-right"></i>
											Follow Up List
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="index.php?r=recovery/defaulter1">
											<i class="menu-icon fa fa-caret-right"></i>
											Defaulter List
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>





						</ul><!-- /.nav-list -->
					</div>