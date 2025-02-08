
<?php 
include "db.php";
				$sql= "SELECT *,department.name as dname,designation.designation as dd,employee.name as ename FROM salary 
				LEFT JOIN employee ON (salary.eid=employee.id)
				LEFT JOIN designation ON (designation.id=employee.designation)
				LEFT JOIN department ON (department.id=employee.department)
				WHERE salary.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$sqlt= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=1";
			    $rowt = $conn->query($sqlt);
			    $resultt = $rowt->fetch_assoc();
			    
			    $sqla= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=2";
			    $rowa = $conn->query($sqla);
			    $resulta = $rowa->fetch_assoc();
			    
			    $sqld= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=3";
			    $rowd = $conn->query($sqld);
			    $resultd = $rowd->fetch_assoc();
			    
			    $sqltax= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=4";
			    $rowtax = $conn->query($sqltax);
			    $resulttax = $rowtax->fetch_assoc();
			    
			    $sqll= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=5";
			    $rowl = $conn->query($sqll);
			    $resultl = $rowl->fetch_assoc();
			    
			    $sqlo= "SELECT SUM(amount) from salaryamount
				where sid='".$_REQUEST['id']."' AND status=6";
			    $rowo = $conn->query($sqlo);
			    $resulto = $rowo->fetch_assoc();
				
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Editable Invoice</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>

<body style="background-color: aliceblue;">
<div id="page-wrap" style="background-color:#FFFFFF;">
  <textarea id="header" readonly="readonly">Payroll</textarea>
  <div id="identity">
    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="350px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
  </div>
  <table id="items">
     <tbody>
      <tr>
        <td style="background-color:#eee;">Name</td>
        <td><?php echo $row['ename']; ?></td>
        <td style="background-color:#eee;">Employee #</td>
        <td><?php echo $row['cnic']; ?></td>
      </tr>
      <tr>
        <td style="background-color:#eee;">Designation</td>
        <td><?php echo $row['dd']; ?></td>
        <td style="background-color:#eee;">Slip #</td>
        <td><?php echo $row['slipno']; ?></td>
      </tr>
      <tr>
        <td style="background-color:#eee;">Department</td>
        <td><?php echo $row['dname']; ?></td>
        <td style="background-color:#eee;">Date</td>
        <td><?php echo date('d-M-Y'); ?></td>
      </tr>
    </tbody>
    </table>
<div style=" width:400px; float:left;">
  <table id="items">
    <tr>
      <th colspan="2">Earnings</th>
      
       </tr>
    <tr>
    <tr>
      <th style="text-align: left;">Details</th>
      <th style="text-align: right;">Amount</th>
    </tr>
    
    <tr>
      <td class="item-name">Salary</td>
      <td class="description"  style="text-align: right;"><?php echo number_format($resultt['SUM(amount)'],2);?></td>
    </tr>
    <tr>
      <td class="item-name">Allownces</td>
      <td class="description"  style="text-align: right;"><?php echo number_format($resulta['SUM(amount)'],2);?></td>
    </tr>
    <tr>
      <td class="item-name">Overtime</td>
      <td class="description"  style="text-align: right;"><?php echo number_format($resulto['SUM(amount)'],2);?></td>
    </tr>
    <tr>
      <th class="item-name" style="text-align: left;">Total</th>
      <th class="description" style="text-align: right;"><?php echo number_format(($resultt['SUM(amount)']+$resulta['SUM(amount)']+$resulto['SUM(amount)']),2);?></th>
    </tr>
  </table>
  </div>
  <div style=" width:400px;float:left;">
  <table id="items" >    
    <tr>
      <th colspan="2">Deduction</th>
    </tr>
    <tr>
      <th style="text-align: left;">Details</th>
      <th style="text-align: right;">Amount</th>
    </tr>
    <tr>
       <td class="item-name">Deduction</td>
       <td class="description"  style="text-align: right;"><?php echo number_format($resultd['SUM(amount)'],2);?></td>
    </tr>   
    <tr>
       <td class="item-name">Tax</td>
       <td class="description"  style="text-align: right;"><?php echo number_format($resulttax['SUM(amount)'],2);?></td>
    </tr>
    <tr>
       <td class="item-name">Leave</td>
       <td class="description"  style="text-align: right;"><?php echo number_format($resultl['SUM(amount)'],2);?></td>
    </tr>
    
    <tr>
      <th class="item-name" style="text-align: left;">Total</th>
      <th class="description" style="text-align: right;"><?php echo number_format(($resultd['SUM(amount)']+$resulttax['SUM(amount)']+$resultl['SUM(amount)']),2);?></th>
    </tr>
  </table>
  </div>
  
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>