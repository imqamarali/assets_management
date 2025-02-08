
				<?php   
				include "db.php";
			    $sql= "SELECT *,salary.id as sid,employee.name as en,employee.id as eid,department.name as dname,designation.designation as dd From salary 
				LEFT JOIN employee  ON (salary.eid=employee.id)
				LEFT JOIN department  ON (employee.department=department.id)
				LEFT JOIN designation  ON (employee.designation=designation.id)
				where salary.id='".$_REQUEST['id']."'";
			   	$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$sql1= "SELECT * From config";
			   	$result1 = $conn->query($sql1);
				$row1 = $result1->fetch_assoc();
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Editable Invoice</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>
<style>
.copy{height:450px;}
</style>

<body style="background-color: aliceblue; ">
<div id="page-wrap" style="background-color:#FFFFFF;background-image:url(images/payslip.jpg);background-size: 100%;">
<div class="copy">
<div style=" position:absolute; margin:44px 0 0 310px">
<img style="height: 50px;width: 160px;" src="images/logo.png"/> </div>
<div style=" position:absolute; margin:95px 0 0 455px;"><?php echo date('M-Y',strtotime($row['createdate'])); ?></div>
<div style=" position:absolute; margin:117px 0 0 255px;"><?php echo $row['eid']; ?></div>
<div style=" position:absolute; margin:135px 0 0 255px;"><?php echo $row['dname']; ?></div>
<div style="  position:absolute; margin:116px 0 0 610px;"><?php echo $row['en']; ?></div>
<div style="  position:absolute; margin:132px 0 0 610px;"><?php echo $row['dd'];?></div>
<div style="  position:absolute; margin:148px 0 0 610px;"><?php echo $row['createdate']; ?></div>
<div style=" position:absolute; margin:217px 0 0 335px;"><?php echo $row['paypm']; ?>/-</div>
<div style=" position:absolute; margin:298px 0 0 340px;"><?php echo $row['paypm']; ?>/-</div>
<div style=" position:absolute; margin:322px 0 0 615px;"><?php echo $row['paypm']; ?>/-</div>
</div>



</div>
</body>
</html>