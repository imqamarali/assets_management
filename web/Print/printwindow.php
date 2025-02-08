
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
				
				$sqlq= "SELECT * FROM qoutwin WHERE qout_id='".$_REQUEST['id']."'";
			    $resultq = $conn->query($sqlq);
				$rowq = $resultq->fetch_assoc();
				
				$ptotal=0;
				$sql2= "SELECT * FROM payment 
			    WHERE referanceid='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				
				
				$sql3= "SELECT * FROM discount 
			    WHERE qoutid='".$_REQUEST['id']."'";
			    $result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
				
				
				$td=0;
				$sql4= "SELECT * FROM discount 
			    WHERE qoutid='".$_REQUEST['id']."'";
			    $result4 = $conn->query($sql4);
				while ($row4 = $result4->fetch_assoc()){$td=$td+$row4['discount'];}
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
	<button  style="float:right;margin:5px 5px -10px 5px;"> 
     <a href="quotation2.php?id=<?php echo $_REQUEST['id']; ?>" style="text-decoration:none;color:#000;margin:5px 5px 5px 5px;" class="btn">Format 3</a>
     </button>
     <button  style="float:right;margin:5px 5px -10px 5px;"> 
     <a href="quotation1.php?id=<?php echo $_REQUEST['id']; ?>" style="text-decoration:none;color:#000;margin:5px 5px 5px 5px;" class="btn">Format 2</a>
     </button>
     <button  style="float:right;margin:5px 5px -10px 5px;"> 
     <a href="quotation.php?id=<?php echo $_REQUEST['id']; ?>" style="text-decoration:none;color:#000;margin:5px 5px 5px 5px;" class="btn">Format 1</a>
     </button>
	
  <textarea id="header" readonly="readonly">Quotataion</textarea>
  <div id="identity">

    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="200px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
	<p><span style="font-weight:bold;">Name : </span><?php echo $row['name']; ?></p><p><span style="font-weight:bold;">s/o : </span><?php echo $row['fname']; ?></p><hr/>
   <p> Address:  <?php echo $row['address']; ?></p>
    <p>Phone:    <?php echo $row['mobile'];  ?></p>
    </div>
    <table id="meta" style="margin:10px;">
      <tr>
        <td class="meta-head">Quotation No.</td>
        <td><?php echo $row['quotationno']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['create_date']; ?></td>
      </tr>
       <tr>
        <td class="meta-head">Note</td>
        <td id="date"><?php echo $row['details']; ?></td>
      </tr>
      
    </table>
    </div>
      <?php
	$ins=0;$areaw=0;$aread=0;
	 while ($row1 = $result1->fetch_assoc()){
	if($rowq['type']=='W'){	 
	$areaw=$areaw+(($row1['width']/304.8)*($row1['height']/304.8));}else{$aread=$aread+(($row1['width']/304.8)*($row1['height']/304.8));}
	$gtotal=$gtotal+($row1['qoutamount']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);}
	number_format($row['installation']*$ins,2);
	?>
    <table id="items">
    <tr>
        <th style="background-color:#eee;">S No.</td>
        <th style="background-color:#eee;">Discription</td>
        <th style="background-color:#eee;">Unit</td>
        <th style="background-color:#eee;">Quantity</td>
        <th style="background-color:#eee;">Rate/Quantity</td>
        <th style="background-color:#eee;">Amount</td>
       </tr>
      <tr>
      <td  style="background-color:#eee;">1</td>
        <?php if($rowq['type']=='W'){echo '<td>Total Area Of Windows</td>';}
		else{echo '<td>Total Area Of Doors</td>';}?>
        <td>Sft</td>
        <td><?php echo number_format((($rowq['height']/304.8)*($rowq['width']/304.8))*$rowq['quantity'],2); ?></td>
        <td><?php echo number_format($gtotal/((($rowq['height']/304.8)*($rowq['width']/304.8))*$rowq['quantity']),2) ?></td>
         <td><?php echo number_format($gtotal,2);?></td>
      </tr>
      <tr>
      <td  style="background-color:#eee;">2</td>
        <td>Total Area of Glass</td>
        <td id="date">Sft</td>
        <td id="date"><?php echo number_format((($rowq['height']/304.8)*($rowq['width']/304.8))*$rowq['quantity'],2);?></td>
        <td id="date"><?php echo number_format($rowq['glassprice']/((($rowq['height']/304.8)*($rowq['width']/304.8))*$rowq['quantity']),2)?></td>
        <td id="date"><?php echo number_format($rowq['glassprice'],2); ?></td>
      </tr>
     
      <td  style="background-color:#eee;">3</td>
        <td>Transportation</td>
        <td id="date">LS</td>
        <td id="date">1</td>
        <td id="date"><?php echo number_format($row['transpotation'],2); ?></td>
        <td id="date"><?php echo number_format($row['transpotation'],2); ?></td>
      </tr>
      <tr>
            <td style="background-color:#eee;">4</td>
        <td>Installation</td>
        <td>Sft</td>
        <td><?php echo number_format($row['installation'],2);?></td>
        <td><?php echo number_format((($rowq['height']/304.8)*($rowq['width']/304.8))*$rowq['quantity'],2)?></td>
        <td id="date"><?php echo number_format($row['installation']*$ins,2); ?></td>
      </tr>
     <tr>
      <td colspan="5" class="total-line">Tax Applied</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row['tax'],2);?>
      </div></td>
    </tr>
    <tr>
      <td colspan="5" class="total-line">Total</td>
      <td class="total-value"><div id="total">
      <?php $ttotal=$row['transpotation']+($row['installation']*$ins)+$gtotal+$row['tax']-$td;
	   echo number_format($ttotal,2);
	  ?>
      </div></td>
    </tr>
     <tr>
      <td colspan="5" class="total-line">Discount</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($td,2); ?></div></td></tr>
      <tr>
       <td colspan="5" class="total-line">Amount Paid</td>
      <td class="total-value"><div id="total">
	  <?php while ($row2 = $result2->fetch_assoc()){$ptotal=$ptotal+$row2['amount'];}
	  echo number_format($ptotal,2); ?></div></td>
    </tr>
    <tr>
     <?php if ($ptotal > $gtotal  ) { ?>
      <td colspan="5"  class="total-line balance" style="background-color:#F00;">Amount Return</td>
      <td class="total-value balance"style="background-color:#F00;"><div class="due"><?php echo number_format($ptotal-$gtotal,2);?></div></td>
      <?php } else { ?>
       <td colspan="5" class="total-line balance">Balance Due</td>
      <td  class="total-value balance"><div class="due"><?php echo number_format($ttotal-$ptotal,2);?></div></td>
      <?php }?>
    </tr>
  </table>
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>