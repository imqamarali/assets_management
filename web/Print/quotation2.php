
				<?php   
				include "db.php";
				$sql= "SELECT *,quotations.id as quotid  FROM quotations 
			    LEFT JOIN customer ON (quotations.customer_id=customer.id)
				WHERE quotations.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$gtotal=0; 
				$sql1= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Editable Invoice</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>

<body>
<div id="page-wrap" style="width:95%">
<div class="row">
      <div class="col-xs-12">
      <?php
	 while ($row1 = $result1->fetch_assoc()){?>
     <div class="col-xs-3" style="float:left;">
	 <?php echo '<img width="300px" src="'.$row1['windowimage'].'"/></br>';?>
     </div>
	 <?php }?>
</div>
</div>    
</div>
</body>
</html>