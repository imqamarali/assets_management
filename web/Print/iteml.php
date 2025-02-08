
				<?php   
				include "db.php";
				$sql1= "SELECT * from issueitems
				LEFT JOIN item ON (issueitems.item=item.id)
				Where cdate Between '".$_POST['from']."' AND '".$_POST['to']."' AND item='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
			    
			    $sqlcc= "SELECT * FROM config";
			    $resultcc = $conn->query($sqlcc);
				$rowcc = $resultcc->fetch_assoc();
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
<div id="page-wrap">
	
  <textarea id="header" readonly="readonly">Item Ledger</textarea>
  <div id="identity">

    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="400px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Item</th>
      <th>In Stock</th>
      <th>Sale</th>
      <th>Purchase</th>
      <th>Issue</th>
      <th>Reversal</th>
      <th>Closing</th>
    </tr>
    <?php $total=0;$i=0;
	 while ($row1 = $result1->fetch_assoc()){$i=$i+1;
	 $sqli= "SELECT SUM(qtyi) from issueitems
	 Where status=4 AND item='".$_REQUEST['id']."' AND cdate Between '".$_POST['from']."' AND '".$_POST['to']."'";
	 $resulti = $conn->query($sqli);
	 $rowi = $resulti->fetch_assoc();
	 
	 $sqls= "SELECT SUM(qty) from issueitems
	 Where status=3 AND item='".$_REQUEST['id']."' AND cdate Between '".$_POST['from']."' AND '".$_POST['to']."'";
	 $results = $conn->query($sqls);
	 $rows = $results->fetch_assoc();
	 
	 $sqlp= "SELECT SUM(qtyi) from issueitems
	 Where status=2 AND item='".$_REQUEST['id']."' AND cdate Between '".$_POST['from']."' AND '".$_POST['to']."'";
	 $resultp = $conn->query($sqlp);
	 $rowp = $resultp->fetch_assoc();
	 
	 $sqlis= "SELECT SUM(qty) from issueitems
	 Where status=1 AND item='".$_REQUEST['id']."' AND cdate Between '".$_POST['from']."' AND '".$_POST['to']."'";
	 $resultis = $conn->query($sqlis);
	 $rowis = $resultis->fetch_assoc();
	 
	 $sqlr= "SELECT SUM(qtyi) from issueitems
	 Where status=5 AND item='".$_REQUEST['id']."' AND cdate Between '".$_POST['from']."' AND '".$_POST['to']."'";
	 $resultr = $conn->query($sqlr);
	 $rowr = $resultr->fetch_assoc();
	 ?>
    <tr>
	  <td align="center"><?php echo $i;?></td>
      <td  align="center"><?php echo $row1['name'];?></td>
      <td  align="center"><?php echo number_format($rowi['SUM(qtyi)'],2);?></td>
      <td  align="center"><?php echo number_format($rows['SUM(qty)'],2);?></td>
      <td  align="center"><?php echo number_format($rowp['SUM(qtyi)'],2);?></td>
      <td  align="center"><?php echo number_format($rowis['SUM(qty)'],2);?></td>
      <td  align="center"><?php echo number_format($rowr['SUM(qtyi)'],2);?></td>
      <td  align="center"><?php echo number_format($rowi['SUM(qtyi)'],2);?></td>
    </tr>
    <?php $total=$total+($row1['quantity']*$row1['up']); }?>
  </table>
  
  
  
  <div id="terms">
   <h4 style="text-align:left;">Terms & Condition</h4>
   <div style="text-align:left;border: 1px solid black; padding:10px;">
    <?php echo $rowcc['note'] ?>
    </div>
  </div>
</div>
</body>
</html>