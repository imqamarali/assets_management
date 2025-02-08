<?php 
//use Yii;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//print_r($_SESSION["user_per_array"]); exit; ?>
<div id="sidebar" class="sidebar responsive ace-save-state menu-min">

 <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-info" onclick="$('.sidebar_menu').toggle();"> <i class="ace-icon fa fa-close"></i> </button>
      <button class="btn btn-success" onclick="window.location.href='<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r='"> <i class="ace-icon fa fa-list"></i> </button>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini"> <span class="btn btn-success"></span> <span class="btn btn-info"></span> <span class="btn btn-warning"></span> <span class="btn btn-danger"></span> </div>
  </div> -->
  <!-- /.sidebar-shortcuts -->
  
  <ul class="nav nav-list">
       <!--Sales-->

  <?php 
 //Yii::$app->view->params['customParam'] = $_SESSION["user_array"]["s_id"];
  /*$all = 0;
  $tt = 0;
  $lib = 0;
  $book = 0;
  $cdate = 0;
  $vdate = 0;
  $examdetails = 0;
  $marks = 0;
  $id = 0;
  $hostel = 0;
  $attend = 0;
  $ri = 0;
  $notice = 0;
  $invent = 0;
  $cer = 0;
  $set = 0;
  foreach($_SESSION["user_per_array"] as $item){
          if($item['per_id']==1){ $all=1;} else { $all=0;}
          if($item['per_id']==8){ $tt=1;} else { $tt=0;}
          if($item['per_id']==9){ $lib=1;} else { $lib=0;}
          if($item['per_id']==10){ $book=1;} else { $book=0;}
          if($item['per_id']==11){ $cdate=1;} else { $cdate=0;}
          if($item['per_id']==12){ $vdate=1;} else { $vdate=0;}
          if($item['per_id']==13){ $examdetails=1;} else { $examdetails=0;}
          if($item['per_id']==14){ $marks=1;} else { $marks=0;}
          if($item['per_id']==15){ $id=1;}  else { $id=0;}
          if($item['per_id']==16){ $hostel=1;} else { $hostel=0;}
          if($item['per_id']==17){ $attend=1;}  else { $attend=0;}
          if($item['per_id']==18){ $ri=1;}  else { $ri=0;}
          if($item['per_id']==19){ $notice=1;} else { $notice=0;}  
          if($item['per_id']==20){ $invent=1;}  else { $invent=0;}
          if($item['per_id']==21){ $cer=1;} else { $cer=0;} 
          if($item['per_id']==22){ $set=1;}  else { $set=0;}
        
      
  ?>
    
  <?php 
        if($all == 1 || $tt == 1){ */
        ?>
 <!--Student-->
 <li class="sidebar_menu"> <a href="index.php" > <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text"> Dashboard </span> </a> <b class="arrow"></b>
      
    </li>
   <!-- <li class="sidebar_menu"> <a href="index.php?r=admissionstd/update&id=<?php //echo $_SESSION['user_array']['s_id']; ?>" > <i class="menu-icon fa fa-graduation-cap"></i> <span class="menu-text"> Student <?php ?></span>  </a> <b class="arrow"></b>
      
    </li> -->
  <!--Group-->
 <!-- <li class="sidebar_menu"> <a href="index.php?r=cgroup" > <i class="menu-icon fa fa-columns"></i> <span class="menu-text"> Groups </span> </a> <b class="arrow"></b>
      
    </li> -->
<!--Class-->
  <!-- <li class="sidebar_menu"> <a href="index.php?r=sclass" > <i class="menu-icon fa fa-database"></i> <span class="menu-text"> Class </span> </a> <b class="arrow"></b>
      
    </li> -->
   <!--Subject-->
    <!--   <li class="sidebar_menu"> <a href="index.php?r=subject" > <i class="menu-icon fa fa-book"></i> <span class="menu-text">Subject</span>  </a> <b class="arrow"></b></li>-->
    <!--Assignment-->
    <!--<li class="sidebar_menu"> <a href="index.php?r=assignment" > <i class="menu-icon fa fa-file"></i> <span class="menu-text">Assignment</span> </a> <b class="arrow"></b></li> -->

    <!--Faculty-->
 
  
 <!--  <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-users"></i> <span class="menu-text">Faculty </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
       <li class="sidebar_menu"> <a href="index.php?r=dept" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Department</span> </a> <b class="arrow"></b></li>
    <li class="sidebar_menu"> <a href="index.php?r=post" > <i class="menu-icon fa fa-user"></i> <span class="menu-text">Add Designation</span>  </a> <b class="arrow"></b></li> 
     <li class="sidebar_menu"> <a href="index.php?r=emp" > <i class="menu-icon fa fa-user"></i> <span class="menu-text">Staff</span> </a> <b class="arrow"></b></li>
 </ul>   
    </li> -->

    <!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-gears"></i> <span class="menu-text">CMS </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b> <ul class="submenu"> </li> <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-file-text"></i> <span class="menu-text"> Facilities</span> <b class="arrow fa fa-angle-down"></b> </a><b class="arrow"></b> <ul class="submenu"> <li class="sidebar_menu"> <a href="index.php?r=facilities" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Add  Facilities</span>  </a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=faccategory" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Add Categories</span>  </a> <b class="arrow"></b></li> </ul> </li> <li class="sidebar_menu"> <a href="index.php?r=starperformer" > <i class="menu-icon fa fa-users"></i> <span class="menu-text">Star Performer </span>  </a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-users"></i> <span class="menu-text">Alumni </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b> <ul class="submenu"> <li class="sidebar_menu"> <a href="index.php?r=alumnireg" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Add Alumni</span>  </a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=profession" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Add Profession</span> </a> <b class="arrow"></b></li> </ul> </li> <li class="sidebar_menu"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-users"></i> <span class="menu-text">Achievements </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu"> <li class="sidebar_menu"> <a href="index.php?r=achcategory" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Add Category</span>  </a> <b class="arrow"></b></li>
    <li class="sidebar_menu"> <a href="index.php?r=achievements" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Add Achievements</span> </a> <b class="arrow"></b></li> </ul></li><li class="sidebar_menu"> <a href="index.php?r=menu" > <i class="menu-icon fa fa-bars"></i> <span class="menu-text"> Menu </span>  </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-file-text"></i> <span class="menu-text"> Content </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b> <ul class="submenu"> <li class="sidebar_menu"> <a href="index.php?r=news" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> News </span></a> <b class="arrow"></b> </li> <li class="sidebar_menu"> <a href="index.php?r=pages" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Pages </span> </a> <b class="arrow"></b> </li> <li class="sidebar_menu"> <a href="index.php?r=documents" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text">Documents </span> </a> <b class="arrow"></b> </li>--><!-- <li class="sidebar_menu"> <a href="index.php?r=events" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Events </span>  </a> <b class="arrow"></b> </li></ul> </li> <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-film"></i> <span class="menu-text"> Media </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b> <ul class="submenu"> <li class="sidebar_menu"> <a href="index.php?r=videos" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Videos </span>  </a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=pagesgallery" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Gallery </span>  </a> <b class="arrow"></b> </li> <li class="sidebar_menu"> <a href="index.php?r=widgets" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Widgets </span>  </a> <b class="arrow"></b> </li><li class="sidebar_menu"> <a href="index.php?r=sliders" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Sliders </span></a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=images" > <i class="menu-icon fa fa-industry"></i> <span class="menu-text"> Images</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b></li>--><!--</ul> </li></ul> </li> -->
  

   <!-- Time Table -->
   <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-calendar"></i> <span class="menu-text">Time Table </span> <b class="arrow fa fa-angle-down"></b> </a><b class="arrow"></b> <ul class="submenu">
    <!--<li class="sidebar_menu"> <a href="index.php?r=timetable" > <i class="menu-icon fa fa-calendar-plus-o"></i> <span class="menu-text">New Time Table</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=ttc/trview" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Teacher's Time Table</span> </a> <b class="arrow"></b></li> -->
    <li class="sidebar_menu"> <a href="index.php?r=ttc/displaystd" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Class' Time Table</span> </a> <b class="arrow"></b></li>
     
</ul>
<?php //}  if ($all == 1 || $lib == 1){?><!-- Library --><!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-bank"></i> <span class="menu-text">Library </span> <b class="arrow fa fa-angle-down"></b> </a><b class="arrow"></b> <ul class="submenu"> <?php // if ($all == 1 || $book == 1){?> <li class="sidebar_menu"> <a href="index.php?r=book" > <i class="menu-icon fa fa-book"></i> <span class="menu-text">Add Book</span> </a> <b class="arrow"></b></li> <?php //} ?> <li class="sidebar_menu"> <a href="index.php?r=/borrowbook/borrow" > <i class="menu-icon fa fa-book"></i> <span class="menu-text">Borrow Book</span></a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=returnbook" > <i class="menu-icon fa fa-book"></i> <span class="menu-text">Return Book</span> </a> <b class="arrow"></b></li> </ul>   
    </li> -->

<?php ////}  if ($all == 1 || $cdate == 1 || $vdate == 1 || $examdetails == 1|| $marks == 1){?>

     <!-- Library ends here -->
 
   <!-- Examination -->

       <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-bell"></i> <span class="menu-text">Examination </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
      <?php //if($cdate == 1 || $all == 1){ ?>
     <!--   <li class="sidebar_menu"> <a href="index.php?r=datesheet" > <i class="menu-icon fa fa-edit"></i> <span class="menu-text">Create Date Sheet</span> </a> <b class="arrow"></b></li> -->
        <?php //} if($vdate == 1 || $all == 1){ ?>
        <li class="sidebar_menu"> <a href="index.php?r=datesheet/select" > <i class="menu-icon fa fa-eye""></i> <span class="menu-text">View Date Sheet</span> </a> <b class="arrow"></b></li>
        <?php //} if($examdetails == 1 || $all == 1){ ?>
   <!--    <li class="sidebar_menu"> <a href="index.php?r=examtype" > <i class="menu-icon fa fa-fa fa-pencil-square"></i> <span class="menu-text">Add New Type</span> </a> <b class="arrow"></b></li>
    <li class="sidebar_menu"> <a href="index.php?r=conductexam" > <i class="menu-icon fa fa-edit"></i> <span class="menu-text">Create Exam</span>  </a> <b class="arrow"></b></li> 
    <?php //} if($marks == 1 || $all == 1){ ?>
     <li class="sidebar_menu"> <a href="index.php?r=exammarks" > <i class="menu-icon fa fa-sort-numeric-desc"></i> <span class="menu-text">Add Marks</span> </a> <b class="arrow"></b></li> -->
     <?php //} ?>
 </ul>   
    </li>
    <?php //} if ($id == 1 || $all == 1) { ?>

    <!-- ID Card -->


<!--li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-cc-amex"></i> <span class="menu-text">ID Card </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">
        <li class="sidebar_menu"> <a href="index.php?r=image" > <i class="menu-icon fa fa-edit"></i> <span class="menu-text">Card's Image</span> </a> <b class="arrow"></b></li>
        <li class="sidebar_menu"> <a href="index.php?r=staffid" > <i class="menu-icon fa fa-pencil-square"></i> <span class="menu-text">Staff's ID</span> </a> <b class="arrow"></b></li>
       <li class="sidebar_menu"> <a href="index.php?r=stdid" > <i class="menu-icon fa fa-pencil-square"></i> <span class="menu-text">Student's ID</span> </a> <b class="arrow"></b></li>

     
 </ul>   
    </li> -->
    <?php //} if ($hostel == 1 || $all == 1) { ?><!-- Hostel --><!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-building"></i> <span class="menu-text">Hostel </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu"><li class="sidebar_menu"> <a href="index.php?r=hostelbuilding" > <i class="menu-icon fa fa-building"></i> <span class="menu-text">Add Building</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=hostelroom" > <i class="menu-icon glyphicon glyphicon-th"></i> <span class="menu-text">Add Room</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=hostelbuilding/capacity" > <i class="menu-icon fa fa-bar-chart"></i> <span class="menu-text">Capacity</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=emproomallotment" > <i class="menu-icon fa fa-bed"></i> <span class="menu-text">Staff Allotment</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=stdroomallotment" > <i class="menu-icon fa fa-bed"></i> <span class="menu-text">Student Allotment</span> </a> <b class="arrow"></b></li></ul> </li> -->


    
    <?php //} if ($attend == 1 || $all == 1) { ?><!-- Attendence System -->
<!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-edit"></i> <span class="menu-text">Attendence </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu"><li class="sidebar_menu"> <a href="index.php?r=classattendance" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Class' Attendence</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=trattendance" > <i class="menu-icon fa fa-gear"></i> <span class="menu-text">Staff's Attendence</span> </a> <b class="arrow"></b></li>
<li class="sidebar_menu"> <a href="index.php?r=leavelimit" > <i class="menu-icon fa fa-gear"></i> <span class="menu-text">Allowed Leave days</span> </a> <b class="arrow"></b></li></ul></li> -->

<!-- Reports -->

<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-list-alt"></i> <span class="menu-text">Reports </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">

   <!-- <li class="sidebar_menu"> <a href="index.php?r=classattendance/attendreport" > <i class="menu-icon fa fa-database"></i> <span class="menu-text">Students' Attendance Monthly</span> </a> <b class="arrow"></b></li>-->

    <li class="sidebar_menu"> <a href="index.php?r=classattendance/grandreport" > <i class="menu-icon fa fa-database"></i> <span class="menu-text">Students' Attendance Yearly</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=classattendance/weekreport" > <i class="menu-icon fa fa-database"></i> <span class="menu-text">Students' Attendance Weekly</span> </a> <b class="arrow"></b></li>

   <!-- <li class="sidebar_menu"> <a href="index.php?r=trattendance/trattendreport" > <i class="menu-icon fa fa-database"></i> <span class="menu-text">Teachers' Attendance</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=feestd/feereport" > <i class="menu-icon fa fa-users"></i> <span class="menu-text">Student Fee</span> </a> <b class="arrow"></b></li> -->
  </ul>
</li>

<?php //} if ($ri == 1 || $all == 1) { ?><!-- Dispatch Information --><!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-gg"></i> <span class="menu-text">R&amp;I </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu"><li class="sidebar_menu"> <a href="index.php?r=disgroup" > <i class="menu-icon fa fa-cubes"></i> <span class="menu-text">Add New Group</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=dispatch" > <i class="menu-icon fa fa-gear"></i> <span class="menu-text">New Dispatch Entry</span> </a> <b class="arrow"></b></li></ul></li>-->

<?php //} if ($notice == 1 || $all == 1) { ?>

<!-- Notice Board -->

<li class="sidebar_menu"> <a href="index.php?r=noticeboard" > <i class="menu-icon fa fa-clipboard"></i> <span class="menu-text"> Notice Board </span> </a> <b class="arrow"></b>
      
    </li>
    <?php //} if ($invent == 1 || $all == 1) { ?><!-- Inventory --><!--<li class="sidebar_menu"> <a href="index.php?r=inventory" > <i class="menu-icon fa fa-archive"></i> <span class="menu-text"> Inventory </span> </a> <b class="arrow"></b></li>-->

    <?php //} if ($cer == 1 || $all == 1) { ?>

    <!-- Certificates -->

<!--<li class="sidebar_menu"> <a href="index.php?r=certificate" > <i class="menu-icon fa fa-certificate"></i> <span class="menu-text"> Certificates </span> </a> <b class="arrow"></b>
      
    </li>-->
    <?php //} if ($set == 1 || $all == 1) { ?><!-- Setting --><!-- <li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-gear"></i> <span class="menu-text">Setting </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu"><li class="sidebar_menu"> <a href="index.php?r=allowedbook" > <i class="menu-icon fa fa-book"></i> <span class="menu-text">Set Allowed Books</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=alloweddays" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Set Allowed Days</span>  </a> <b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=category" > <i class="menu-icon fa fa-cubes"></i> <span class="menu-text">Set Category</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=penalty" > <i class="menu-icon fa fa-rupee"></i> <span class="menu-text">Set Penalty</span> </a> <b class="arrow"></b></li><li class="sidebar_menu"> <a href="index.php?r=prmsn" > <i class="menu-icon fa fa-lock"></i> <span class="menu-text">Permission</span> </a> <b class="arrow"></b></li></ul></li> </ul> </li>-->
      
    
<li class="sidebar_menu"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-desktop"></i><span class="menu-text">LMS</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu"> <li class="sidebar_menu"><a href="index.php?r=assignmentsubmit/display"><i class="menu-icon fa fa-caret-right"></i>Submit Assignment</a><b class="arrow"></b></li> <!--<li class="sidebar_menu"> <a href="index.php?r=assignment"> <i class="menu-icon fa fa-caret-right"></i>Add Assignment</a><b class="arrow"></b></li> <li class="sidebar_menu"><a href="index.php?r=assignmentsubmit/marks"><i class="menu-icon fa fa-caret-right"></i>Mark</a><b class="arrow"></b></li>--><li class="sidebar_menu"><a href="#"><i class="menu-icon fa fa-caret-right"></i>CBT (Coming Soon) </a><b class="arrow"></b> </li> <li class="sidebar_menu"> <a href="#"><i class="menu-icon fa fa-caret-right"></i>Interactive (Coming Soon) </a><b class="arrow"></b></li> <li class="sidebar_menu"> <a href="index.php?r=sections"> <i class="menu-icon fa fa-caret-right"></i>Story Boarding (Coming Soon)</a><b class="arrow"></b></li><li class="sidebar_menu"><a href="#"><i class="menu-icon fa fa-caret-right"></i>VBL (Coming Soon)</a> <b class="arrow"></b></li>  </ul></li>


  <!-- Fee  -->

<!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-money"></i> <span class="menu-text">Fee </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">

    <li class="sidebar_menu"> <a href="index.php?r=feeparticular" > <i class="menu-icon fa fa-cubes"></i> <span class="menu-text">Add New Particular</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=feedetails" > <i class="menu-icon fa fa-list-alt"></i> <span class="menu-text">New Details</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=feestd" > <i class="menu-icon fa fa-users"></i> <span class="menu-text">Student Fee</span> </a> <b class="arrow"></b></li>
  </ul>
</li> -->


  <!-- Setting -->
<!--<li class="sidebar_menu"> <a href="index.php?r=menu" class="dropdown-toggle"> <i class="menu-icon fa fa-dollar"></i> <span class="menu-text">Pay </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
      <ul class="submenu">

    <li class="sidebar_menu"> <a href="index.php?r=annualleave" > <i class="menu-icon fa fa-calendar-check-o"></i> <span class="menu-text">Add Annual Leaves</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=allowance" > <i class="menu-icon fa fa-money"></i> <span class="menu-text">Add New Allowance</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=deduction" > <i class="menu-icon fa fa-ban"></i> <span class="menu-text">Add Pay Deduction</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=paydetails/pay" > <i class="menu-icon fa fa-check-circle"></i> <span class="menu-text">Generate Pay</span> </a> <b class="arrow"></b></li>

    <li class="sidebar_menu"> <a href="index.php?r=paydetails" > <i class="menu-icon fa fa-money"></i> <span class="menu-text">Faculty Pay</span> </a> <b class="arrow"></b></li>
  </ul>
</li> -->

      
   
   <!-- <div id="search_nav">
      <?php if (isset($this->blocks['pagesidebar'])): ?>
      <?= $this->blocks['pagesidebar'] ?>
      <?php endif; ?>
    </div>
  </ul> -->
  <?php //}
//}?>
  <!-- /.nav-list -->
  
  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"> <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i> </div>

</div>
