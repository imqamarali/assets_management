<?php if(!isset($_SESSION["user_per_array"])){echo 'Please login again <a href="https://cheeseanddairy.com.pk/pp/web/index.php?r=">Login</a>;';exit;} ?>
<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-info" onclick="$('.sidebar_menu').toggle();"> <i class="ace-icon fa fa-close"></i> </button>
      <button class="btn btn-success" onclick="window.location.href='<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r='"> <i class="ace-icon fa fa-list"></i> </button>
      <button onclick="window.location.href='<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/profile&id=<?php echo $_SESSION['user_array']['id']; ?>'" class="btn btn-warning"> <i class="ace-icon fa fa-users"></i> </button>
      <button onclick="window.location.href='<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/setting&id=<?php echo $_SESSION['user_array']['id']; ?>'" class="btn btn-danger"> <i class="ace-icon fa fa-cogs"></i> </button>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini"> <span class="btn btn-success"></span> <span class="btn btn-info"></span> <span class="btn btn-warning"></span> <span class="btn btn-danger"></span> </div>
  </div>
  <!-- /.sidebar-shortcuts -->
  
  <ul class="nav nav-list">
    <?php 
				$inv=array('Items','Create Item','Itemtypes','Create Itemtype','Create Payment','Requsition','Supply Chain','Transfer Inventory');
				$curpage = $this->title; 
				$class2='';
				if(in_array($curpage, $inv)){$class2='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 3){
				?>
    <!--Inventory-->
    <li class="sidebar_menu <?php echo $class2;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-product-hunt"></i> <span class="menu-text">Inventory</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php if($curpage=='Items' or $curpage=='Create Item'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=item"> <i class="menu-icon fa fa-caret-right"></i> Items </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='Itemtypes' or $curpage=='Create Itemtype'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=itemtype"> <i class="menu-icon fa fa-caret-right"></i> Items Type </a> <b class="arrow"></b> </li>
      </ul>
    </li>
    <?php } 
				$reporting=array('General Ledger','Sale Report','Trail Balance','Purchase Report','Item Inventory 1','Production Report','Asset Report','HR Report','Supplier Report','Payable','Recieveable','Production Report2','Sale Report 2','Item Inventory','Item in Hand(Production)');
				$reporting1=array('General Ledger','Trail Balance','Payable','Recieveable');
				$reporting2=array('Sale Report','Sale Report 2');
				$reporting3=array('Purchase Report','Asset Report','HR Report','Supplier Report');
				$reporting4=array('Production Report','Production Report2');
				$reporting5=array('Asset Report','HR Report','Supplier Report');
				$reporting6=array('Item Inventory','Item in Hand(Production)','Item Inventory 1');
				$curpage = $this->title; 
				$class10='';$class12='';$class13='';$class14='';$class15='';$class16='';$class17='';
				if(in_array($curpage, $reporting)){$class10='open';}
				if(in_array($curpage, $reporting1)){$class12='open';}
				if(in_array($curpage, $reporting2)){$class13='open';}
				if(in_array($curpage, $reporting3)){$class14='open';}
				if(in_array($curpage, $reporting4)){$class15='open';}
				if(in_array($curpage, $reporting5)){$class16='open';}
				if(in_array($curpage, $reporting6)){$class17='open';}
				$sale=0;$inv=0;$pro=0;$fin=0;$pur=0;$as=0;$hr=0;$sup=0;
				
				foreach($_SESSION["user_per_array"] as $item){
					if($item['pid']==3){$inv=1;}
					if($item['pid']==1){$sale=1;;}
					if($item['pid']==2){$pro=1;}
					if($item['pid']==5){$fin=1;}
					if($item['pid']==13){$pur=1;}
					if($item['pid']==6){$as=1;}
					if($item['pid']==7){$hr=1;}
					if($item['pid']==9){$sup=1;}							
				}
				
				foreach($_SESSION["user_per_array"] as $item)
				if(isset($item['pid']) && $item['pid'] == 4){
				?>
    <!--Reporting-->
    <li class="sidebar_menu"> <a href="index.php?r=/subaccount/reporting" > <i class="menu-icon fa fa-info"></i> <span class="menu-text">Reporting</span> </a> 
    </li>
    <?php }
				$finance=array('Produced Item','Payments Verification','Sales Order','Accounts','Subaccounts','Transactions','Transactiontypes','Mainpurchases','Create Purchase','Create Mainpurchase','Purchase Detail','Update Sales Order','Create Transaction','Bankaccounts','Create Bankaccount','Payments For Verification','Verify Payment','Payment Invoices','Pay Salary','Generated Salary','Petty Cash','JV','Mainsales','Sale Detail','Create Mainsale','Mainpurchasese','Create Purchasee','Create Mainpurchasee' ,'Purchasee Detail');
				
		$sale=array('Sales Order','Mainsales','Sale Detail','Create Mainsale');
		$pur=array('Mainpurchases','Create Purchase','Create Mainpurchase' ,'Purchase Detail','Mainpurchasese','Create Purchasee','Create Mainpurchasee' ,'Purchasee Detail','Create Payment');
		$tran=array('Transactions','Create Transaction','JV','Petty Cash');
				$curpage = $this->title; 
				$class3='';$class32='';$class33='';$class34='';
				if(in_array($curpage, $finance)){$class3='open';}
				if(in_array($curpage, $sale)){$class32='open';}
				if(in_array($curpage, $pur)){$class33='open';}
				if(in_array($curpage, $tran)){$class34='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 5){
				?>
    <!--Finanace-->
    <li class="sidebar_menu <?php echo $class3;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cc-visa"></i> <span class="menu-text">Finance</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php if($curpage=='Accounts'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=accounts"> <i class="menu-icon fa fa-caret-right"></i>Account </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='Accounts'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=installmentplan"> <i class="menu-icon fa fa-caret-right"></i>Installment Plan </a> <b class="arrow"></b> </li>

        <li class="<?php if($curpage=='Accountcategories '){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=accountcategory"> <i class="menu-icon fa fa-caret-right"></i>Account Category</a> <b class="arrow"></b> </li>

        <li class="<?php if($curpage=='Accountgroups'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=accountgroup"> <i class="menu-icon fa fa-caret-right"></i>Account Group </a> <b class="arrow"></b> </li>
        
        <li class="<?php if($curpage=='Pay Salary' or $curpage=='Generated Salary'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=salary/paysalary"> <i class="menu-icon fa fa-caret-right"></i> Pay Salary </a> <b class="arrow"></b> </li>
         <li class="sidebar_menu <?php echo $class34;?>"> <a href="#" class="dropdown-toggle"> <span class="menu-text">Transaction</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php if($curpage=='Receive Payment' or $curpage=='Create Receive Payment'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=transaction"> <i class="menu-icon fa fa-caret-right"></i> Receive Payment </a> <b class="arrow"></b> </li>
         <li class="<?php if($curpage=='Pay Bill' or $curpage=='Create Pay Bill'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=transaction/index1"> <i class="menu-icon fa fa-caret-right"></i> Pay Bill </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='JV'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=transaction/jvlist"> <i class="menu-icon fa fa-caret-right"></i> JV </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='Petty Cash'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=payment/expense"> <i class="menu-icon fa fa-caret-right"></i> Petty Cash </a> <b class="arrow"></b> </li>
        </ul>
        </li>
        <li class="<?php if($curpage=='Accountgroups'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=subaccount/reconcile"> <i class="menu-icon fa fa-caret-right"></i>Account Reconcilation</a> <b class="arrow"></b> </li>
      </ul>
      
    </li>
    <?php }
				  $hr=array('Employees','Designations','Qualifications','Empdependents','Leavedetails','Overtimes','Salarydetails','EOBI && Social Security','Empattendances','Create Empattendance','Update Attendence','Salaries','Create Salary','Create Vacancy','Update Vacancy','Vacancies','Candidates', 'Create Candidate', 'Update Candidate', 'Candidate Selection List', 'Candidate Selection');
        $curpage = $this->title; 
        $class5='';
        if(in_array($curpage, $hr)){$class5='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == '7'){
        ?>
    <!--Human Resource-->
    <li class="sidebar_menu <?php echo $class5;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-users"></i> <span class="menu-text">Human Resource Managment</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php if($curpage=='Employees' or $curpage=='Qualifications' or $curpage=='Empdependents' or $curpage=='Leavedetails' or $curpage=='Overtimes' or $curpage=='Salarydetails' or $curpage=='EOBI && Social Security'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee"> <i class="menu-icon fa fa-caret-right"></i> Employee </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='Empattendances' or $curpage=='Create Empattendance' or $curpage=='Update Attendence'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=empattendance"> <i class="menu-icon fa fa-caret-right"></i> Employee Attendence </a> <b class="arrow"></b> </li>
         
        <li class="<?php if($curpage=='Designations'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=designation"> <i class="menu-icon fa fa-caret-right"></i> Designation </a> <b class="arrow"></b> </li>
        <li class="<?php if($curpage=='Salaries' or $curpage=='Create Salary'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=salary"> <i class="menu-icon fa fa-caret-right"></i> Pay Roll </a> <b class="arrow"></b> </li>
      </ul>
    </li>
    <?php }
				$cus=array('Customers','Occupations');
				$curpage = $this->title; 
				$class6='';
				if(in_array($curpage, $cus)){$class6='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 8){
				?>
    <!-- Customer-->
    <li class="sidebar_menu"> <a href="index.php?r=/customer/sales" > <i class="menu-icon fa fa-shopping-cart"></i> <span class="menu-text">Customer & Sales</span> </a> </li>
    
    <?php }
				$sup=array('Suppliers');
				$curpage = $this->title; 
				$class7='';
				if(in_array($curpage, $sup)){$class7='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 9){
				?>
    <!--Supplier-->
    <li class="sidebar_menu"> <a href="index.php?r=/supplier/purchase" > <i class="menu-icon fa fa-shopping-basket"></i> <span class="menu-text">Vendors & Purchase</span> </a> </li>
     <?php }
        $sup=array('Import');
        $curpage = $this->title; 
        $class7='';
        if(in_array($curpage, $sup)){$class7='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == 9){
        ?>
    <!--Supplier-->
    <li class="sidebar_menu <?php if($curpage=='Import'){echo 'active open';} ?>"> <a href="index.php?r=/config/importfile" > <i class="menu-icon fa fa-upload"></i> <span class="menu-text">Import</span> </a> </li>

   <?php } 
$sup=array('Reminders','Create Reminders', 'Update Reminders');
        $curpage = $this->title; 
        $class7='';
        if(in_array($curpage, $sup)){$class7='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == 9){
    ?>
    <li class="<?php if($curpage=='Reminders'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=reminders"> <i class="menu-icon fa fa-clock-o"></i> Reminders </a> <b class="arrow"></b> </li>

     <?php } 
$sup=array('Docmanagements','Create Docmanagements', 'Update Docmanagements');
        $curpage = $this->title; 
        $class7='';
        if(in_array($curpage, $sup)){$class7='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == 9){
    ?>
   <li class="<?php if($curpage=='Docmanagements'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=docmanagement"> <i class="menu-icon fa fa-file-o"></i> Document Management </a> <b class="arrow"></b> </li>



  <?php   } $sup=array('Calendar');
        $curpage = $this->title; 
        $class7='';
        if(in_array($curpage, $sup)){$class7='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == 9){
        ?>
    <!--Supplier-->
    <li class="sidebar_menu"> <a href="index.php?r=/reminders/calendar" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Calendar</span> </a> </li>
    
    
    
    <?php }
				$user=array('Employee','User','UserPermission');
				$curpage = $this->title; 
				$class8='';
				if(in_array($curpage, $user)){$class8='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 10 ){
				?>
    <!--User-->
    <li class="sidebar_menu <?php echo $class8;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-user"></i> <span class="menu-text">Users</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php if($curpage=='Employee' or $curpage=='User'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/userdetail"> <i class="menu-icon fa fa-caret-right"></i> Users </a> <b class="arrow"></b> </li>
      </ul>
    </li>
    <?php }
    
    ?>
    
    <!--User-->
    <li class="sidebar_menu <?php echo $class8;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-user"></i> <span class="menu-text">Members Bank</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class=""> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members"> <i class="menu-icon fa fa-caret-right"></i> List </a> <b class="arrow"></b> </li>
        <li class=""> <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/create"> <i class="menu-icon fa fa-caret-right"></i> Create </a> <b class="arrow"></b> </li>
      </ul>
    </li>
    <?php
				$setting=array('Configs','Cities','Countries','Departments','Permissions','Taxdefinations','Salaryranges','Create Taxdefination','Create Salaryrange','Salecenters','Charges','Config Year');
				$curpage = $this->title; 
				$class9='';
				if(in_array($curpage, $setting)){$class9='open';}
							foreach ($_SESSION["user_per_array"] as $item)
 					     	if (isset($item['pid']) && $item['pid'] == 11){
				?>
    <!--Setting-->
    <!--Setting-->
    <!-- <li class="sidebar_menu <?php //echo $class9;?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-wrench"></i> <span class="menu-text">Setting</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="<?php //if($curpage=='Configs'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php // echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=config"> <i class="menu-icon fa fa-caret-right"></i> Configuration </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Config Year'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=cyear"> <i class="menu-icon fa fa-caret-right"></i>Year Configuration </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Charges'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=charges"> <i class="menu-icon fa fa-caret-right"></i> Charges </a> <b class="arrow"></b> </li>
        <li class="<?php // if($curpage=='Configs'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=cconfig"> <i class="menu-icon fa fa-caret-right"></i>Account Configuration </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Cities'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php // echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=city"> <i class="menu-icon fa fa-caret-right"></i> City </a> <b class="arrow"></b> </li>
        <li class="<?php  //if($curpage=='Countries'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=country"> <i class="menu-icon fa fa-caret-right"></i> Country </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Departments'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=department"> <i class="menu-icon fa fa-caret-right"></i> Department </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Permissions'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=permission"> <i class="menu-icon fa fa-caret-right"></i> Permission </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Salecenters'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=salecenter"> <i class="menu-icon fa fa-caret-right"></i> Sale Center </a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Taxdefinations' or $curpage=='Create Taxdefination'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=taxdefination"> <i class="menu-icon fa fa-caret-right"></i>Tax Definations</a> <b class="arrow"></b> </li>
        <li class="<?php //if($curpage=='Salaryranges' or $curpage=='Create Salaryrange'){echo 'active';} ?>"> <a class="ajaxlink" href="<?php // echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=salaryrange"> <i class="menu-icon fa fa-caret-right"></i>Salary Range</a> <b class="arrow"></b> </li>
      </ul>
    </li> -->
    <?php } 
     $gear=array('Reminders','Reminder Types','Company Details','Config Year', 'POS Customer', 'Point of Sale');
        $curpage = $this->title; 
        $class9='';
        if(in_array($curpage, $setting)){$class9='open';}
              foreach ($_SESSION["user_per_array"] as $item)
                if (isset($item['pid']) && $item['pid'] == 11){
        ?>
    <!--Setting-->
<li class="sidebar_menu"> <a href="index.php?r=cyear" > <i class="menu-icon fa fa-gears"></i> <span class="menu-text">Setting</span> </a> </li>
    <?php } ?>
    <div id="search_nav">
      <?php if (isset($this->blocks['pagesidebar'])): ?>
      <?= $this->blocks['pagesidebar'] ?>
      <?php endif; ?>
    </div>
  </ul>
  <!-- /.nav-list -->
  
  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"> <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i> </div>
</div>
