
				<?php   
				include "db.php";
				$sqlcc= "SELECT * FROM config";
			    $resultcc = $conn->query($sqlcc);
				$rowcc = $resultcc->fetch_assoc();
			
				$sql= "SELECT *,quotations.id as quotid,quotations.create_date as qcd  FROM quotations 
			    LEFT JOIN customer ON (quotations.customer_id=customer.id)
				WHERE quotations.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$user= "SELECT * FROM employee where id ='".$row['user_id']."'";
			    $users = $conn->query($user);
				$userss = $users->fetch_assoc();
				
				$gtotal=0; 
				$sql1c= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W' and qoutwin.profile_type IN (1) ";
			    $result1c = $conn->query($sql1c);
			    
				$sql2dc= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D' and qoutwin.profile_type IN (1)" ;
			    $result2dc = $conn->query($sql2dc);
			    
			    $sql1cz= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W' and qoutwin.profile_type IN (8) ";
			    $result1cz = $conn->query($sql1cz);
			    
				$sql2dcz= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D' and qoutwin.profile_type IN (8)" ;
			    $result2dcz = $conn->query($sql2dcz);
			    
			    

				$sql1v= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W' and qoutwin.profile_type IN (4,6)";
			    $result1v = $conn->query($sql1v);
				$sql2dv= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D' and qoutwin.profile_type IN (4,6)";
			    $result2dv = $conn->query($sql2dv);

				$sql1t= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W' and qoutwin.profile_type IN (2,7)" ;
			    $result1t = $conn->query($sql1t);
				$sql2dt= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D' and qoutwin.profile_type IN (2,7)";
			    $result2dt = $conn->query($sql2dt);
			    
			    	$sql1tc= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='W' and qoutwin.profile_type IN (9)" ;
			    $result1tc = $conn->query($sql1tc);
				$sql2dtc= "SELECT * FROM qoutwin 
				left join winndow_raw_data on(winndow_raw_data.window_id=qoutwin.id)
			    WHERE qout_id='".$_REQUEST['id']."' and qoutwin.type='D' and qoutwin.profile_type IN (9)";
			    $result2dtc = $conn->query($sql2dtc);

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
	
	
  <textarea id="header" readonly="readonly">Quotation</textarea>
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
        <td class="meta-head">Created By</td>
        <td><?php echo $userss['name']; ?></td>
      </tr><tr>
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
        <?php
        $gltotalbe=0;
        $ins=0;
        $areaw=0;$aread=0;$gltotalc=0;$gltotalv=0;$gltotalt=0;$gltotalz=0;$totalag=0;$glaz=0;$gtotaldc=0;$gtotaldv=0;$gtotaldt=0;$gtotaldz=0; $gtotaldco=0;$gltotalco=0;
        $totaldc=0;$totalac=0;
        $totaldv=0;$totalav=0;
        $totaldt=0;$totalat=0;
        $totaldz=0;$totalaz=0;
        $totaldco=0;$totalaco=0;
	    while($row2d = $result2dc->fetch_assoc()){
		if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
    		$totaldc=$totaldc+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
    		$totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
    		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
    		 $gtotaldc=$gtotaldc+($row2d['secprice']*$row2d['quantity']); 
		    $ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		}
		while($row2d = $result2dcz->fetch_assoc()){
		if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
    		$totaldz=$totaldz+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
    		$totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
    		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
    		 $gtotaldz=$gtotaldz+($row2d['secprice']*$row2d['quantity']); 
		    $ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		}
		
			    while($row2d = $result2dv->fetch_assoc()){
		if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
    		$totaldv=$totaldv+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
    		$totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
    		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
    		 $gtotaldv=$gtotaldv+($row2d['secprice']*$row2d['quantity']); 
		    $ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		}
			    while($row2d = $result2dt->fetch_assoc()){
		if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
    		$totaldt=$totaldt+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
    		$totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
    		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
    		 $gtotaldt=$gtotaldt+($row2d['secprice']*$row2d['quantity']); 
		    $ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		}
		while($row2d = $result2dtc->fetch_assoc()){
		if($row2d['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
    		$totaldco=$totaldco+((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity']);
    		$totalag=$totalag+(((($row2d['height']/304.8)*($row2d['width']/304.8))*$row2d['quantity'])*$glaz); 
    		 $gltotal=$gltotal+($row2d['glassprice']*$row2d['quantity']); 
    		 $gtotaldco=$gtotaldco+($row2d['secprice']*$row2d['quantity']); 
		    $ins=$ins+((($row2d['width']/304.8)*($row2d['height']/304.8))*$row2d['quantity']); 
		}
	 while ($row1 = $result1c->fetch_assoc()){
	$totalac=$totalac+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	     	$gtotalc=$gtotalc+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);
	 }
	 while ($row1 = $result1cz->fetch_assoc()){
	$totalaz=$totalaz+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	     	$gtotalz=$gtotalz+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);
	 }
	  while ($row1 = $result1v->fetch_assoc()){
	$totalav=$totalav+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	      	$gtotalv=$gtotalv+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);
	  }
	  while ($row1 = $result1t->fetch_assoc()){
	$totalat=$totalat+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	      	$gtotalt=$gtotalt+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);
	  }
	  	  while ($row1 = $result1tc->fetch_assoc()){
	$totalaco=$totalaco+((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity']); 
	if($row1['glazing']=='SG'){$glaz=1;}else{$glaz=2;}
	 if($row1['glass']==0 or $row1['glass']==''){}else{
	 $totalag=$totalag+(((($row1['height']/304.8)*($row1['width']/304.8))*$row1['quantity'])*$glaz); 
	 }
	      	$gtotalco=$gtotalco+($row1['secprice']*$row1['quantity']); 
	$gltotal=$gltotal+($row1['glassprice']*$row1['quantity']); 
	$gltotalbe=$gltotalbe+($row1['glassprice']*$row1['quantity']); 
	$ins=$ins+((($row1['width']/304.8)*($row1['height']/304.8))*$row1['quantity']);
	  }

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
      <?php if($totalac > 0){?>
      <tr>
      
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window Chinese</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totalac,2) ?></td>
         <td><?php echo number_format( $gtotalc/$totalac,2)?></td>
         <td align="right"><?php echo number_format($gtotalc,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totaldc > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door Chinese</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totaldc,2) ?></td>
         <td><?php echo number_format( $gtotaldc/$totaldc,2)?></td>
         <td align="right"><?php echo number_format($gtotaldc,2);?></td>
      </tr>
      
      <?php }
      if($totalav > 0){?>
      <tr>
      
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window German</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totalav,2) ?></td>
         <td><?php echo number_format( $gtotalv/$totalav,2)?></td>
         <td align="right"><?php echo number_format($gtotalv,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totaldv > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door German</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totaldv,2) ?></td>
         <td><?php echo number_format( $gtotaldv/$totaldv,2)?></td>
         <td align="right"><?php echo number_format($gtotaldv,2);?></td>
      </tr>
      
      <?php }
      if($totalat > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window Turkish</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totalat,2) ?></td>
         <td><?php echo number_format( $gtotalt/$totalat,2)?></td>
         <td align="right"><?php echo number_format($gtotalt,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totaldt > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door Turkish</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totaldt,2) ?></td>
         <td><?php echo number_format( $gtotaldt/$totaldt,2)?></td>
         <td align="right"><?php echo number_format($gtotaldt,2);?></td>
      </tr>
      <?php }
              if($totalaz > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window Zigzag</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totalaz,2) ?></td>
         <td><?php echo number_format( $gtotalz/$totalaz,2)?></td>
         <td align="right"><?php echo number_format($gtotalz,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totaldz > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door Zigzag</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totaldz,2) ?></td>
         <td><?php echo number_format( $gtotaldz/$totaldz,2)?></td>
         <td align="right"><?php echo number_format($gtotaldz,2);?></td>
      </tr>
      <?php }

              
      
            if($totalaco > 0){?>
      <tr>
      
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Window Chinese(Conch)</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totalaco,2) ?></td>
         <td><?php echo number_format( $gtotalco/$totalaco,2)?></td>
         <td align="right"><?php echo number_format($gtotalco,2);?></td>
      </tr>
      <?php } ?>
      <?php if($totaldco > 0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <?php echo '<td>Total Area of Door Chinese(Conch)</td>';?>
        <td>Sft</td>
        <td><?php echo number_format($totaldco,2) ?></td>
         <td><?php echo number_format( $gtotaldco/$totaldco,2)?></td>
         <td align="right"><?php echo number_format($gtotaldco,2);?></td>
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
        	  $totalag=$totalag+($gwind['glassarea']*$gwind['quantity']);
        }
        while($gwind=$glassqr1->fetch_assoc()){
    	$totalag=$totalag+($gwind['glassarea']*$gwind['quantity']);
    	}
	    $gltotalbe=$gltotalbe+($rowm['unitprice']*$totalag);
	    if($totalag>0){?>
      <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Total Area of <?php echo $rowm['name']?></td>
        <td id="date">Sft</td>
        <td id="date"><?php echo number_format((($totalag)),2);?></td>
        <td id="date"><?php echo number_format($rowm['unitprice'],2); ?></td>
        <td id="date" align="right"><?php echo number_format($gltotalbe,2); ?></td>
      </tr>
     <tr><?php }}?>
            <td style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Installation</td>
        <td>Sft</td>
        <td><?php echo number_format($totala+$totald+$totaldc+$totalac+
        $totaldv+$totalav+
        $totaldt+$totalat+
        $totaldz+$totalaz+
        $totaldco+$totalaco,2)?></td>
        <td><?php echo number_format($row['installation'],2);?></td>
        <td id="date" align="right"><?php echo number_format($row['installation']*$ins,2); ?></td>
      </tr>
     <tr>
      <td  style="background-color:#eee;"><?php echo $i=$i+1;?></td>
        <td>Transportation</td>
        <td id="date">LS</td>
        <td id="date">1</td>
        <td id="date"><?php echo number_format($row['transpotation'],2); ?></td>
        <td id="date" align="right"><?php echo number_format($row['transpotation'],2); ?></td>
      </tr>
      	<?php $ii=0;$ch=0;
    $sqlch= "SELECT * FROM qout_charges 
	WHERE window_id='".$_REQUEST['id']."'";
	$resultch = $conn->query($sqlch);
	while ($rowch = $resultch->fetch_assoc()){
	    $ii=$ii+1;
    ?>
    
     <tr>
      <td colspan="5" class="total-line"><?php echo $rowch['details'];?></td>
      <td class="total-value" align="right"><div id="total">
	 <?php echo number_format($rowch['charges'],2);?>
      </div></td>
      
    </tr>
    <?php $ch=$ch+$rowch['charges']; } ?>
     <tr>
      <td colspan="5" class="total-line">Sales Tax</td>
      <td class="total-value" align="right" ><div id="total">
	  <?php echo number_format($row['tax'],2);?>
      </div></td>
    </tr>
      
     <tr>
      <td colspan="5" class="total-line">Discount</td>
      <td class="total-value" align="right"><div id="total">
	  <?php echo number_format($td,2);?>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="5" class="total-line" style="font-weight:bold; font-size:14px;">Total</td>
      <td class="total-value" align="right"><div id="total" style="font-weight:bold; font-size:14px;">
      <?php $ttotal=$row['transpotation']+$gtotaldc+$gtotaldv+$gtotaldt+$gtotaldco+$gtotaldz+($row['installation']*$ins)+$gtotalc+$gtotalco+$gtotalz+$gtotalv+$gtotalt+$gltotal+$ch+$row['tax']-$td;
	   echo number_format($ttotal,2);
	  ?>
      </div></td>
    </tr> </table>
  <div id="terms">
    <h4 style="text-align:left;">Terms & Condition</h4>
   <div style="text-align:left;border: 1px solid black; padding:10px;">
    <?php echo $rowcc['note'] ?>
    </br>
    <b><?php echo $row['note'];?></b> after measurement of final sizes
    </div>
  </div>
</div>
</body>
</html>