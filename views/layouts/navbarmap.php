
<?php use yii\bootstrap\Nav;
?>
			<?php
                $total_notifications = 0;
				$conn=Yii::$app->getDb(); 
				$sqlimg= "SELECT * FROM config";
			    $resultimg = $conn->createCommand($sqlimg)->queryOne();
			    
			    
				$sqlimg1= "SELECT * FROM navbarlogo";
			    $resultimg1 = $conn->createCommand($sqlimg1)->queryOne();
			    
			    $sqla= "SELECT COUNT(*) FROM memberplot
                where  memberplot.status='Sales'";
			    $resulta = $conn->createCommand($sqla)->queryOne();
			    
			    $sqlat= "SELECT COUNT(*) FROM transferplot";
			    $resultat = $conn->createCommand($sqlat)->queryOne();
			    
			    $sqlat1= "SELECT COUNT(*) FROM possession where status=0";
			    $resultat1 = $conn->createCommand($sqlat1)->queryOne();
			    
			    $sqlat12= "SELECT COUNT(*) FROM transaction where isApp=0";
			    $resultat12 = $conn->createCommand($sqlat12)->queryOne();
			    
			    $sqlat12fa= "SELECT COUNT(*) FROM form_generate_sub where isApprove=0";
			    $resultat12fa = $conn->createCommand($sqlat12fa)->queryOne();

                 
			    
			    $sqlla= "SELECT COUNT(*) FROM leadactivities where startdate='".date('Y-m-d')."'";
			    $resultla = $conn->createCommand($sqlla)->queryOne();
			    
			    $sqllt= "SELECT COUNT(*) FROM leadtask where startdate='".date('Y-m-d')."'";
			    $resultlt = $conn->createCommand($sqllt)->queryOne();
			    
			    $sqlal= "SELECT COUNT(*) FROM `lead` where assigned_to='".$_SESSION['user_array']['id']."'";
			    $resultlal = $conn->createCommand($sqlal)->queryOne();

                if ( $_SESSION['user_array']['user_level'] > 1 )
                {
    			    $leave_notify_sql= "SELECT COUNT(*) FROM leavedetail where eid='".$_SESSION['user_array']['id']."' AND (status = 1 OR status = 2)";
    			    $leave_notify_res = $conn->createCommand($leave_notify_sql)->queryOne();
    			    $total_notifications += $leave_notify_res['COUNT(*)'];
    			    
    			    $loan_notify_sql = "SELECT COUNT(*) FROM emp_loan where eid='".$_SESSION['user_array']['id']."' AND (status = 1 OR status = 2)";
    			    $loan_notify_res = $conn->createCommand($loan_notify_sql)->queryOne();
    			    $total_notifications += $loan_notify_res['COUNT(*)'];

                    $demand_notify_sql = "SELECT COUNT(*) FROM demand";
    			    $demand_notify_res = $conn->createCommand($demand_notify_sql)->queryOne();
    			    $total_notifications += $demand_notify_res['COUNT(*)'];
                }
                else
                {
                    $leave_notify_sql= "SELECT COUNT(*) FROM leavedetail WHERE status = 0";
    			    $leave_notify_res = $conn->createCommand($leave_notify_sql)->queryOne();
    			    $total_notifications += $leave_notify_res['COUNT(*)'];
    			    
    			    $loan_notify_sql= "SELECT COUNT(*) FROM emp_loan WHERE status = 0";
    			    $loan_notify_res = $conn->createCommand($loan_notify_sql)->queryOne();
    			    $total_notifications += $loan_notify_res['COUNT(*)'];

                    $demand_notify_sql = "SELECT COUNT(*) FROM demand";
    			    $demand_notify_res = $conn->createCommand($demand_notify_sql)->queryOne();
    			    $total_notifications += $demand_notify_res['COUNT(*)'];
                }
				
				?>
				
                <div id="navbar" class="navbar navbar-default ace-save-state">
  <div class="navbar-container ace-save-state" id="navbar-container">


    <div class="navbar-header pull-left"> <a href="index.php?r=" class="navbar-brand"> <small>  <?php echo $resultimg['companyname']; ?></small> </a> </div>

     <?php //print_r( $_SESSION['user_perm_array']);
     //echo $_SESSION['user_array']['usertype'];exit;
            if(isset($_SESSION['user_array'])) { ?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav pull-right">
					<li class="purple dropdown-modal"> 
                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true"> 
                        <i class="ace-icon fa fa-bell"></i>
                        </a>
                      	<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close" style="width: 320px; height: 253px; left: 631px; right: auto; top: 114px;">
                        <li class="dropdown-content ace-scroll" style="position: relative;">
                          <div class="scroll-content" style="">
                            <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                <?php  foreach($_SESSION['user_perm_array'] as $row){if($row['module_id']==42 && $row['save']==1 && $_SESSION['user_array']['usertype']==1){ ?>
                                <li>
                                    <a href="index.php?r=formgenerate/approve">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-blue fa fa-check"></i> 
                                    Form Approval
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $resultat12fa['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?r=memberplot/index2">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-success fa fa-pencil-square-o"></i> 
                                    Allotment Requests
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $resulta['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="index.php?r=memberplot/aprovalr">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-warning fa fa-exchange"></i> 
                                    Trasfer Requests
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $resultat['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="index.php?r=memberplot/indexp">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-danger fa fa-book"></i> 
                                    Possession Requests
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $resultat1['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                <?php }} ?>
                                <li>
                                    <a href="index.php?r=leavedetail/leave_notifications&user_id=<?php echo $_SESSION['user_array']['id'];?>">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-pink fa fa-wheelchair"></i> 
                                    Leave Notifications
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $leave_notify_res['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?r=emploan/loan_notifications&user_id=<?php echo $_SESSION['user_array']['id'];?>">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-yellow fa fa-usd"></i> 
                                    Loan Notifications
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $loan_notify_res['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?r=trans/demand_notifications&user_id=<?php echo $_SESSION['user_array']['id'];?>">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-blue fa fa-gavel"></i> 
                                    Demand Notifications
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $demand_notify_res['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?r=lead/index&LeadSearch[assigned_to]=<?php echo $_SESSION['user_array']['id'];?>">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-info fa fa-calendar"></i> 
                                    Latest Assinged Leads
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php echo $resultlal['COUNT(*)']; ?></span> 
                                    </div>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="index.php?r=lead/index&date=<?php echo date('Y-m-d') ?>">
                                    <div class="clearfix"> 
                                    <span class="pull-left"> 
                                    <i class="btn btn-xs no-hover btn-inverse fa fa-envelope-o"></i> 
                                   Today's Activities and Tasks
                                    </span> 
                                    <span class="pull-right badge badge-info"><?php  echo ($resultla['COUNT(*)']+$resultlt['COUNT(*)']); ?></span> 
                                    </div>
                                    </a>
                                </li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </li>
					
   
					
					<li class="light-blue user-profile">
						<a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">
                         	<?php if (file_exists("img/employee/".$_SESSION['user_array']['pic'])){?>
							<img src="img/employee/<?php echo $_SESSION['user_array']['pic']; ?>" class="nav-user-photo" alt="N/A"/>
                    		<?php }else{ ?>
                    		<img src="img/dummy.png"  class="nav-user-photo"/>
                            <?php } ?>
							<span id="user_info">
								<b>Welcome,</b> <?php echo $_SESSION['user_array']['name']; ?>
							</span>
							<i class="icon-caret-down"></i>
						</a>
						<ul id="user_menu" class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
							<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=memberplot/setting&id=<?php echo $_SESSION['user_array']['id']; ?>"><i class="icon-cog"></i> Settings</a></li>
							<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/profile&id=<?php echo $_SESSION['user_array']['id']; ?>"><i class="icon-user"></i> Profile</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=cdashboard/&uid=<?php echo $_SESSION['user_array']['id']; ?>"><i class="icon-user"></i>Customize Your Dashboard</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=/site/logout"><i class="icon-off"></i> Logout</a></li>
						</ul>
					</li>
			  </ul>
				</div>
                <?php } ?>     
    <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li> <a href="index.php?r=dashboard"> 
        	Real Estate Management System
        	<!-- eSystem -->
          &nbsp; </a> </li>
      </ul>
    </nav>
  </div>
</div>

					
              
			
		
<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			