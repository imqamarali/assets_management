<?php 
use yii\bootstrap\Nav;

$conn=Yii::$app->getDb(); 
$sqlimg= "SELECT * FROM config";
$resultimg = $conn->createCommand($sqlimg)->queryOne();
?>
<div id="navbar" class="navbar navbar-default ace-save-state" style="height: 10px;">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left"> 
            <a href="index.php?r=dealerportal" class="navbar-brand"> <small>  
            <?php echo $resultimg['companyname']; ?></small>
            </a> 
        </div>
        <?php
        if(isset($_SESSION['dealer_session'])) 
        { 
        ?>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
    		<ul class="nav ace-nav pull-right"> 
    		    <li class="light-blue user-profile">
    			    <a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">
    					<span id="user_info">
    						<b>Welcome,</b> <?php echo $_SESSION['dealer_session']['contact_name']; ?>
    					</span>
    					<i class="icon-caret-down"></i>
    				</a>
    				<ul id="user_menu" class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
    					<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dealerportal/logout"><i class="icon-off"></i> Logout</a></li>
    				</ul>
    			</li>
    		 </ul>
    	</div>
        <?php 
        } 
        ?>     
        <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li> <a href="index.php?r=dashboard"> Real Estate Management System </a> </li>
            </ul>
        </nav>
    </div>
</div>
 
			 

			 