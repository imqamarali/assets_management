<?php
				$conn=Yii::$app->getDb(); 
				$sqlimg= "SELECT * FROM config";
			    $resultimg = $conn->createCommand($sqlimg)->queryOne();
			    ?>
                <div id="navbar" class="navbar navbar-default ace-save-state">
  <div class="navbar-container ace-save-state" id="navbar-container">


    <div class="navbar-header pull-left"> <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>" class="navbar-brand"> <small>  <?php echo $resultimg['companyname']; ?></small> </a> </div>
    
    <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li> <a href=""> eSystem
          &nbsp; </a> </li>
      </ul>
    </nav>
  </div>
</div>
