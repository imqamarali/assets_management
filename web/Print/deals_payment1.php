<?php 
    include "../db.php";
	$sqlmem= "SELECT * from deals 
    left JOIN supplier ON deals.did = supplier.id   
	where deals.id='".$_REQUEST['id']."'";
	$resultmem = $conn->query($sqlmem);
	$rowmem = $resultmem->fetch_assoc();
	
	$sqlform1= "SELECT * from  form_generate_sub where id='".$_REQUEST['id']."'";
	$resultform11 = $conn->query($sqlform1);
	$rowmem11 = $resultform11->fetch_assoc();
	
	$sqlform= "SELECT * from  form_generate  
	Left Join size_cat ON (size_cat.id=form_generate.size)
	where form_generate.id IN (".$rowmem11['mid'].")";
	$resultform = $conn->query($sqlform);
	
	
	$sqlemp= "SELECT * from employee  
	where  id='".$_REQUEST['eid']."'";
	$resultemp = $conn->query($sqlemp);
	$rowemp = $resultemp->fetch_assoc();
	
	
	$sqlc= "SELECT * from config ";
	$resultc = $conn->query($sqlc);
	$rowc = $resultc->fetch_assoc();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Transaction</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>

<body style="background-color: aliceblue;">


<div id="page-wrap" style="background-color:#FFFFFF;width:800px !important; margin-top:40px;page-break-before: always;">
    <?php include('header.php');?>
  
  <?php echo '&#13;&#10;Forms Deal';?>
  </textarea>

  <div style="clear:both"></div>
  <div id="customer"> 
    <div id="customer-title" style="margin-left:50px;margin-top: 1%;"> 
    <h3>Details of forms Genrated: </h3> 
    </div> 
    <table id="items" style="margin-left:50px;width:90%;">
      <tr>
        <th style="text-align:left;">Security No</th>
        <th style="text-align:left;">Size</th>
        <th style="text-align:left;">Price</th>
        <th style="text-align:left;">Security No</th>
        <th style="text-align:left;">Size</th>
         <th style="text-align:left;">Price</th>
      </tr>
      <?php $i=2; while($rowform = $resultform->fetch_assoc()){ ?>
        <?Php if($i%2==0){  ?>
        <tr>
          <td><?php echo $rowform['serial_no']; ?></td>
          <td><?php echo $rowform['size']; ?></td>
          <td><?php echo $rowform['price']; ?></td>
         
        <?php }else{ ?>
        <td><?php echo $rowform['serial_no']; ?></td>
        <td><?php echo $rowform['size']; ?></td>
        <td><?php echo $rowform['price']; ?></td>
        </tr> 
        <?php } ?>  
      <?php $i++;} ?>
    </table>
    </br>
    <table  style="margin-left:50px;width:90%;">
      <tr>
         <td colspan="4" style="text-align: center;"> 
         <b>Note:</b>These forms (numbers) are alloted to the sales partner with validity of decided date.End user registration against these forms is to be submitted within decided date of issuance
         </td>
      </tr>
    </table>
    </br></br></br>
    <div style="clear:both"></div>
    <table  style="margin-left:50px;width:90%;">
      <tr>
        <td style="text-align: center;"> <u><?php echo $rowemp['name'] ?></u><br>
          <br>
          <b style="font-size:14px;">Prepared By: </b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Accounts Manager:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Authorized By:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Received By:</br></b></td>
      </tr>
      <tr>
         <td colspan="4" style="text-align: center;"> 
          <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi"); echo $rowemp['name'] .' || Dated: '.date("d-M-Y H:i A") ?> Tel: <?php echo $rowc['phonenumber'];?></b></td>
      </tr>
    </table>
  </div>
</div>



</body>
</html>
