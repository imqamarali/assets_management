
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
				$sql1= "SELECT qoutwin.*,winndow_raw_data.*,item.name as iname,origin.name as oname FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
				left join origin on(origin.id=qoutwin.profile_type)
				left join item on(item.id=qoutwin.glass)
			    WHERE qout_id='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				$ptotal=0;
				$sql2= "SELECT * FROM payment 
			    WHERE referanceid='".$_REQUEST['id']."' and pfor='2'";
			    $result2 = $conn->query($sql2);
				
				
				$sql3= "SELECT * FROM discount 
			    WHERE qoutid='".$_REQUEST['id']."'";
			    $result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
				
				
				$td=0;
				$sql4= "SELECT * FROM discount 
			    WHERE qoutid='".$_REQUEST['id']."'";
			    $result4 = $conn->query($sql4);
				$sql5= "SELECT distinct qoutwin.profile_type,origin.name as sname FROM qoutwin 
			    left join origin on(qoutwin.profile_type=origin.id)
				WHERE qoutwin.qout_id='".$_REQUEST['id']."'";
			    $result5 = $conn->query($sql5);
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
        <td class="meta-head">Type</td>
        <td id="date"><?php while ($row5 = $result5->fetch_assoc()){echo $row5['sname'].',';}?></td>
      </tr>
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
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Item</th>
      <th>Description</th>
      <th>Area/Qty</th>
      <th>Section Price</th>
      <th>Glass Price</th>
      <th>Quantity</th>
      <th colspan="2">Total Price</th>
    </tr>
    <?php
	$ins=0;$i=0;$qty=0;$tarea=0;$sp=0;$gp=0;
	 while ($row1 = $result1->fetch_assoc()){
		 $i=$i+1;
		 $qty=$qty+$row1['quantity'];
		 $tarea=$tarea+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']);
		 $sp=$sp+($row1['secprice']*$row1['quantity']);
		 $gp=$gp+($row1['glassprice']*$row1['quantity']);	 ?>
			
    <tr>
	  <td><?php echo $i;?></td>
      <td align="left"><img height="80" src="<?php echo $row1['windowimage']; ?>" /></td>
     <td align="left">
     Width:<?php echo $row1['width'] ?><br />
     Height:<?php echo $row1['height'] ?><br />
     Glazing:<?php echo $row1['glazing'] ?>
     <?php if($row1['type']=='W'){echo 'Window';}else{echo 'Door';} ?><br />
     Profile Type:<?php echo $row1['oname']; ?><br />
     Glass:<?php echo $row1['iname']; ?>
      </td>
      <td><?php echo number_format(($row1['height']/304.8)*($row1['width']/304.8),2) ?></td>
      <td class="cost"><?php echo number_format($row1['secprice'],2);?></td>
      <td><?php echo number_format($row1['glassprice'],2);?></td>
      <td class="qty"><?php echo $row1['quantity'];?></td>
      <td colspan="2"><span class="price"><?php echo number_format(($row1['secprice']+$row1['glassprice'])*$row1['quantity'],2);?></span></td>
    </tr>
    <?php  $gtotal=$gtotal+($row1['qoutamount']*$row1['quantity']); 
	$ins=$ins+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']);
	}?>
   <hr/>
    <tr>
      <td colspan="3" class="total-line">Total</td>
	   <td class="total-value"><div id="total"><?php echo number_format($tarea,2)?></div></td>
       <td class="total-value"><div id="total"><?php echo number_format($sp,2)?></div></td>
       <td class="total-value"><div id="total"><?php echo number_format($gp,2)?></div></td>
      <td class="total-value"><div id="total"><?php echo $qty?></div></td>
      <td class="total-value" colspan="2"><div id="total">
      <?php $ttotal=$gtotal;
	  echo number_format($ttotal,2)?>
      </div></td>
    </tr>
    <?php if($row['transpotation']!==''){ 
	
	?>
     <tr>
      <td colspan="7" class="total-line">Transportation</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row['transpotation'],2);?>
      </div></td>
      
    </tr>
    <?php } if($row['installation']!==''){?>
     <tr>
      <td colspan="7" class="total-line">Installation</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row['installation']*$ins,2);?>
      </div></td>
    </tr>
    <tr>
      <td colspan="7" class="total-line">Sales Tax</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row['tax'],2);?>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="7" class="total-line">Discount</td>
      <td class="total-value"><div id="total">
	  <?php echo number_format($row3['discount'],2);?>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="7" class="total-line" style="font-weight:bold; font-size:14px;">Total Amount</td>
      <td class="total-value"><div id="total" style="font-weight:bold; font-size:14px;">
	  <?php echo number_format(($ttotal=$row['transpotation']+($row['installation']*$ins)+$gtotal+$row['tax']-$td),2);?>
      </div></td>
    </tr>
    
     
    <tr>
    </tr>
    <?php } $ttotal=0;?>
  </table>
  
</div>
</body>
</html>