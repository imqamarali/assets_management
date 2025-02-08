
<link href="../css/bootstrap.min.css" rel="stylesheet">

   <link href="../css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        
        <link href="../css/jquery-ui.custom.min.css" rel="stylesheet">
        <link href="../css/chosen.min.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <link href="../css/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="../css/daterangepicker.min.css" rel="stylesheet">
        <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="../css/colorpicker.min.css" rel="stylesheet">
        
        
        <link href="../https://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet">
        
        <link href="../css/ace.min.css" rel="stylesheet">
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../html2canvas.js"></script>
         <link href="../js/ace-extra.min.js" rel="stylesheet">
        <link href="../js/jquery.min.js" rel="stylesheet">
        <link href="../js/bootstrap.min.js" rel="stylesheet">
        <link href="../js/jquery-ui.custom.min.js" rel="stylesheet">
        <link href="../js/jquery.ui.touch-punch.min.js" rel="stylesheet">
        <link href="../js/chosen.jquery.min.js" rel="stylesheet">
        <link href="../js/fuelux/fuelux.spinner.min.js" rel="stylesheet">
        <link href="../js/date-time/bootstrap-datepicker.min.js" rel="stylesheet">
        <link href="../js/date-time/bootstrap-timepicker.min.js" rel="stylesheet">
        <link href="../js/date-time/moment.min.js" rel="stylesheet">
        <link href="../js/date-time/daterangepicker.min.js" rel="stylesheet">
        <link href="../js/date-time/bootstrap-datetimepicker.min.js" rel="stylesheet">
        <link href="../js/bootstrap-colorpicker.min.js" rel="stylesheet">
        <link href="../js/jquery.knob.min.js" rel="stylesheet">
        <link href="../js/autosize.min.js" rel="stylesheet">
        <link href="../js/jquery.inputlimiter.1.3.1.min.js" rel="stylesheet">
        <link href="../js/jquery.maskedinput.min.js" rel="stylesheet">
        <link href="../js/bootstrap-tag.min.js" rel="stylesheet">
        <link href="../js/ace-elements.min.js" rel="stylesheet">
        <link href="../js/ace.min.js" rel="stylesheet">
				<?php   
				include "db.php";
				
			
				?>
				<style>
.dropbtn {
    background-color: rgba(51,153,255,0.4);
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
	
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
	z-index: 1000;
    position: absolute;
    min-width: 160px;
   }
.page-content {
    background-color: #cecece !important;}
/* Links inside the dropdown */
.dropdown-content button {
    color: black;
   
    text-decoration: none;
    display: block;
}
.form-group {
    float: left;
    margin-bottom: 15px;
    width: 202px;
    margin-left: 15px;
}
/* Change color of dropdown links on hover */
.dropdown-content button:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}
.btn{
    display:none;
    
}
/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Editable Invoice</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>


<body>
	<div class="row">
      <div class="col-xs-12">
          <table><tbody>
      <style>
     .fade{opacity:1;}
     .form-group {
    float: left;
    margin-bottom: 0;
    width: 90px;
    margin-left: 0;
}
.form-control{
    width:40%;
    display: unset;
}
input{
    border-radius: 0 !important;
    color: #858585;
    background-color: #fff;
    border: 1px solid #d5d5d5;
    padding: 0px !important;
    font-size: 14px !important;
    font-family: inherit;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    -webkit-transition-duration: .1s;
    transition-duration: .1s;
    width: 40% !important;
}
      .modal{position: unset !important;
          
          display:block !important;}
      .modal-header{display:none;}
      .modal-footer{display:none;}
      .modal-body {
    position: relative;
    padding: 0px;
}
      .modal-dialog{width:90px !important; margin: 20% 10% !important; }
 
      </style>
      <?php 
      	$sql5= "SELECT *,qoutwin.type as qtype,qoutwin.itemcode as itemcode1,origin.name as oname,item.name as iname,qoutwin.id as idq,qoutwin.quantity as qty from qoutwin
							left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
							left join origin on(origin.id=qoutwin.profile_type)
							left join item on(item.id=qoutwin.glass)
							WHERE qoutwin.qout_id='".$_REQUEST['id']."'";
			    $result5 = $conn->query($sql5);
	
      while ($row5 = $result5->fetch_assoc()){ 
      $red=$row5['windowdata'];

      
      
    //  echo $str . "<br>";
      
      ?>
      
   <tr><td>
            <?php echo trim($red,"Add Section"); 
           
            ?>
                   
       </td>
       <td>
          <b> Item Code: <?php echo $row5['itemcode1']; ?></br>
           Widht:<?php echo $row5['width']; ?></br>   
           Height:<?php echo $row5['height']; ?></br>
           Glazing:<?php echo $row5['glazing']; ?></br>
           Quantity<?php echo $row5['quantity']; ?></br>
           Type:<?php echo $row5['qtype']; ?></br>
           Windows Details:<?php echo $row5['winddetails']; ?></br></b>
       </td>
       </tr>
       <?php } ?> 
       </tbody></table>
      </div>
    </div>  
 
</body>
</html>