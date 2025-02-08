
				<?php   
				include "db.php";
				$sqlcc= "SELECT * FROM config";
			    $resultcc = $conn->query($sqlcc);
				$rowcc = $resultcc->fetch_assoc();
				
				$sql= "SELECT *,quotations.create_date as qcd,quotations.id as quotid  FROM quotations 
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
	
  <textarea id="header" readonly="readonly">Item List for Production</textarea>
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
        <td id="date"><?php echo $row['qcd']; ?></td>
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
      <th>Quantity</th>
         </tr>
    <?php
	$ins=0;$i=0;$qty=0;$tarea=0;$sp=0;$gp=0;
	 while ($row1 = $result1->fetch_assoc()){
	     $glass1  = "SELECT * from item where id='".$row1['glass1']."'";
		    $glass1r = $conn->query($glass1);
			$glass11 = $glass1r->fetch_assoc();
		 $i=$i+1;
		 $qty=$qty+$row1['quantity'];
		 $tarea=$tarea+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']);
		 $sp=$sp+($row1['secprice']*$row1['quantity']);
		 $gp=$gp+($row1['glassprice']*$row1['quantity']);	 ?>
			
    <tr>
	  <td><?php echo $i;?></td>
      <td align="left"><img height="120" style="max-width:250px;" src="<?php echo $row1['windowimage']; ?>" />
     
      </td>
      
     <td align="left">
    Item Code: <?php echo $row1['itemcode']; ?><br />
     Width:<?php echo $row1['width'] ?><br />
     Height:<?php echo $row1['height'] ?><br />
     Glazing:<?php echo $row1['glazing'] ?>
     <?php if($row1['type']=='W'){echo 'Window';}else{echo 'Door';} ?><br />
     Profile Type:<?php echo $row1['oname']; ?><br />
     Glass:<?php echo $row1['iname']; 
     if($row1['glass1']>0){echo '<br/>Glass:'.$glass11['name'];}
     if($row1['mainwind']>0){
                              $sqlmw1= "SELECT * FROM qoutwin where id='".$row1['mainwind']."'";
                              $sqlmw11 = $conn->query($sqlmw1);
			$sqlmw111 = $sqlmw11->fetch_assoc();
			   	//	$resultmw1 = $conn->createCommand($sqlmw1)->queryOne();
                          echo '<br /><div style="background-color:red; color:#fff;">Part of '.$sqlmw111['itemcode'].'</div>';
                          }
     ?>
      </td>
      <td align="center"><?php echo number_format(($row1['height']/304.8)*($row1['width']/304.8),2) ?></td>
      <td align="center"><?php echo $row1['quantity'];?></td>
         </tr>
    <?php  $gtotal=$gtotal+($row1['secprice']+$row1['glassprice'])*$row1['quantity']; 
	$ins=$ins+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']);
	}?>
   <hr/>
    
	<?php $ii=0;$ch=0;
    $sqlch= "SELECT * FROM qout_charges 
	WHERE window_id='".$_REQUEST['id']."'";
	$resultch = $conn->query($sqlch);
	while ($rowch = $resultch->fetch_assoc()){
	    $ii=$ii+1;
    ?>
    
    <?php $ch=$ch+$rowch['charges']; } ?>
    <?php if($row['transpotation']!==''){ 
	
	?>
    <?php } if($row['installation']!==''){?>
    
    
    
     
    <tr>
    </tr>
    <?php } $ttotal=0;?>
  </table>
  
  
  
  <div id="terms">
   <h4 style="text-align:left;">Instructions</h4>
   <div style="text-align:left;border: 1px solid black; padding:10px;">
    </br></br></br></br></br></br></br></br>
    </div>
  </div>
</div>
</body>
</html>