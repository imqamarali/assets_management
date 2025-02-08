
				<?php   
				include "db.php";
				$sqlcc= "SELECT * FROM config";
			    $resultcc = $conn->query($sqlcc);
				$rowcc = $resultcc->fetch_assoc();
				$sql= "SELECT *,quotations.id as quotid  FROM quotations 
			    LEFT JOIN customer ON (quotations.customer_id=customer.id)
				WHERE quotations.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$gtotal=0; 
				$sql1= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W'";
			    $result1 = $conn->query($sql1);
				
				$sql2d= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D'";
			    $result2d = $conn->query($sql2d);
				
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
     <a href="invoice1.php?id=<?php echo $_REQUEST['id']; ?>" style="text-decoration:none;color:#000;margin:5px 5px 5px 5px;" class="btn">Format 2</a>
     </button>
     <button  style="float:right;margin:5px 5px -10px 5px;"> 
     <a href="invoice.php?id=<?php echo $_REQUEST['id']; ?>" style="text-decoration:none;color:#000;margin:5px 5px 5px 5px;" class="btn">Format 1</a>
     </button>
  <textarea id="header" readonly="readonly">Invoice</textarea>
  <div id="identity">

    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="400px;"/> </div>
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
$gltotalbe=0;	$ins=0;$areaw=0;$aread=0;$totala=0;$gltotal=0;$totalag=0;$glaz=0;$totald=0;$gtotald=0;
	 while ($row2d = $result2d->fetch_assoc()){
		 if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
		 $totald=$totald+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
		 $totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
		 $gtotald=$gtotal+($row2d['secprice']*$row2d['quantity']); 
		$ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		 }
	 while ($row1 = $result1->fetch_assoc()){
	$totala=$totala+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	$gtotal=$gtotal+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);}
	number_format($row['installation']*$ins,2);
$i=0;
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
      <?php if($totala > 0){?>
      <tr>
      
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totala,2) ?></td>
         <td><?php echo number_format( $gtotal/$totala,2)?></td>
         <td><?php echo number_format($gtotal,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totald > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totald,2) ?></td>
         <td><?php echo number_format( $gtotald/$totald,2)?></td>
         <td><?php echo number_format($gtotald,2);?></td>
      </tr>
      <?php } 
	  			$glass= "SELECT * FROM item";
			    $glass1 = $conn->query($glass);
	  while ($rowm=$glass1->fetch_assoc()){
	$glassq= "SELECT * FROM qoutwin WHERE qout_id='".$_REQUEST['id']."' and (glass='".$rowm['id']."')";
	$glassqr = $conn->query($glassq);
    $glassq1= "SELECT * FROM qoutwin WHERE qout_id='".$_REQUEST['id']."' and (glass1='".$rowm['id']."')";
	$glassqr1 = $conn->query($glassq1);
$totalag=0;
$gltotalbe=0;
while($gwind=$glassqr->fetch_assoc()){
	$totalag=$totalag+((($gwind['height']/304.8)*($gwind['width']/304.8))*$gwind['quantity']);
}
while($gwind=$glassqr1->fetch_assoc()){
	$totalag=$totalag+((($gwind['height']/304.8)*($gwind['width']/304.8))*$gwind['quantity']);
	}
	$gltotalbe=$gltotalbe+($rowm['unitprice']*$totalag);
	if($totalag>0){?>
     
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Total Area of <?php echo $rowm['name']?></td>
        <td id="date">Sft</td>
        <td id="date"><?php echo number_format((($totalag)),2);?></td>
        <td id="date"><?php echo number_format($rowm['unitprice'],2); ?></td>
        <td id="date"><?php echo number_format($gltotalbe,2); ?></td>
      </tr>
     <tr><?php }}?>
            <td style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Installation</td>
        <td>Sft</td>
        <td><?php echo number_format($totala+$totald,2)?></td>
        <td><?php echo number_format($row['installation'],2);?></td>
        <td id="date"><?php echo number_format($row['installation']*$ins,2); ?></td>
      </tr>
     <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Transportation</td>
        <td id="date">LS</td>
        <td id="date">1</td>
        <td id="date"><?php echo number_format($row['transpotation'],2); ?></td>
        <td id="date"><?php echo number_format($row['transpotation'],2); ?></td>
      </tr>
      
     <tr>
      <td colspan="5" class="total-line">Sales Tax</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row['tax'],2);?>
      </div></td>
    </tr>
      
     <tr>
      <td colspan="5" class="total-line">Discount</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($td,2);?>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="5" class="total-line" style="font-weight:bold; font-size:14px;">Total</td>
      <td class="total-value"><div id="total" style="font-weight:bold; font-size:14px;">
      <?php $ttotal=$row['transpotation']+$gtotald+($row['installation']*$ins)+$gtotal+$gltotal+$row['tax']-$td;
	   echo number_format($ttotal,2);
	  ?>
      </div></td>
    </tr> </table>
  
</div>
</body>
</html>