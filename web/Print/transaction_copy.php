<?php 
    include "../db.php";
				$sql= "SELECT *,accounts.name as bname,transaction.create_date as tdate,transaction.user_id as usid FROM transaction 
				LEFT JOIN accounts On (accounts.id=transaction.bank_id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				//print_r($result);exit;
				$name='';
				
				$sqlemp= "SELECT * from accounts where id='".$row['pt_id']."'";
			    $resultemp = $conn->query($sqlemp);
				$rowemp = $resultemp->fetch_assoc();
				$name=$rowemp['name'];
				
				$sql2= "SELECT * FROM transaction 
				LEFT JOIN employee ON (transaction.user_id=employee.id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				$row2 = $result2->fetch_assoc();
				
				$sql2v= "SELECT * FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND remarks='Tax Paid'";
			    $result2v = $conn->query($sql2v);
			    
			    $sql2v1= "SELECT * FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
			    $result2v1 = $conn->query($sql2v1);
				
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql1= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql2= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql3= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result3 = $conn->query($sql3);
			    
			    
			    $sqlmem2= "SELECT * FROM employee
				WHERE id='".$row['usid']."'";
			    $resultmem2 = $conn->query($sqlmem2);
			    $rowmem2  = $resultmem2->fetch_assoc();
				
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
<div id="page-wrap" style="background-color:#FFFFFF;">
<?php include('header.php');?><?php
if($row['vtype']==3){echo 'Cash Reciept Voucher';}if($row['vtype']==4){echo 'Bank Reciept Voucher';}?>
Payment Reciept
</textarea>

<div style="clear:both"></div>
<div id="customer">

  <div id="customer-title" style="margin-left: 50px;margin-top:5px;width:300px;"> <span >
  <?php if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;"><?php echo $name; ?></span>
    <hr/>
    <span > Voucher # : </span>
    <span style="color:#999;"><?php echo $row['vno']; ?></span>
    <hr/>
    <span > Dated : </span>
    <span style="color:#999;"><?php echo $row['tdate']; ?></span>
    <hr/>
    <span > Narration : </span>
    <span style="color:#999;"><?php echo $row['remarks']; ?></span>
    <hr/>
  </div>
  <div id="meta" style="margin-left: 20px;"> <span > Amount :</span>
  <span style="color:#999;"><?php echo $row['amount']; ?></span>
    <hr/>
    <span >Amount In Words :</span>
    <span style="color:#999;"><?php echo ucwords(Word($row['amount'])) ?></span>
    <hr/>
  </div>
  <div style="clear:both"></div>
  <table id="items">
    <tr>
      <th style="text-align:left;">S No.</th>
      <th style="text-align:left;">Account Title</th>
      <th style="text-align:left;">Account Code</th>
      <th style="text-align:left;">Narration</th>
      <th style="text-align:right;">Payable</th>
      <th style="text-align:right;">Deduction</th>
    </tr>
    <?php  $i=1; ?>
    <?php
    $td=0;$tc=0;$td1=0;$tc1=0;
    
    $sql2v1= "SELECT SUM(amount),SUM(amount1) FROM payment 
	left join accounts on(payment.referanceid=accounts.id) 
	WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND referanceid='".$rowemp['id']."'";
	$result2v1 = $conn->query($sql2v1);
	$row2v1 = $result2v1->fetch_assoc();
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $rowemp['name'];?></td>
      <td><?php echo $rowemp['code'];?></td>
      <td><?php echo $row['remarks'];?></td>
      <td align="right"><?php echo number_format($row2v1['SUM(amount)'],2)?></td>
      <td align="right"><?php echo number_format($row2v1['SUM(amount1)'],2)?></td>
      <?php $td1=$td1+$row2v1['SUM(amount)'];$tc1=$tc1+$row2v1['SUM(amount1)'];?>
    </tr>
    

<?php  while($row2v = $result2v->fetch_assoc()){$i=$i+1; ?>    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row2v['name'];?></td>
      <td><?php echo $row2v['code'];?></td>
      <td><?php echo $row2v['remarks'];?></td>
      <td align="right"><?php echo number_format($row2v['amount'],2)?></td>
      <td align="right"><?php echo number_format($row2v['amount1'],2)?></td>
     <?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
    </tr>
   <?php }?>
    <tr style="font-weight: bold;">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value" align="right"> Total Paid</td>
        <td class="total-value"   align="right"> <?php echo number_format(($td1-$tc),2);?></td>
    </tr>  </table>
    <div style="clear:both"></div>
    </br></br></br></br>
    <table  style="margin-left:50px;width:90%;">
      <tr>
        <td style="text-align: center;border: 0px;"> <u><?php echo $rowmem2['name'] ?></u><br>
          <br>
          <b style="font-size:14px;">Prepared By: </b></td>
        <td style="text-align: center;border: 0px;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Accounts Manager:</br></b></td>
        <td style="text-align: center;border: 0px;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Authorized By:</br></b></td>
        <td style="text-align: center;border: 0px;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Received By:</br></b></td>
      </tr>
    </table>
</div>
<hr style="margin:5px 0px;" />
</div>
</body>

</html>

<?php 
function Word($num){
    			$num    = ( string ) ( ( int ) $num );
				if( ( int ) ( $num ) && ctype_digit( $num ) ){
					 $words  = array( );
					 $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
					 $list1  = array('','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
					 $list2  = array('','ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety','hundred');
					 $list3  = array('','thousand','million','billion','trillion','quadrillion','quintillion','sextillion','septillion','octillion','nonillion','decillion','undecillion','duodecillion','tredecillion','quattuordecillion','quindecillion','sexdecillion','septendecillion','octodecillion','novemdecillion','vigintillion');	
					 $num_length = strlen( $num );
					 $levels = ( int ) ( ( $num_length + 2 ) / 3 );
					 $max_length = $levels * 3;
					 $num    = substr( '00'.$num , -$max_length );
					 $num_levels = str_split( $num , 3 );
					 foreach( $num_levels as $num_part ){
						 $levels--;
            			 $hundreds   = ( int ) ( $num_part / 100 );
            			 $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            			 $tens= ( int ) ( $num_part % 100 );
            		     $singles= '';
            				if( $tens < 20 ){
                				$tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );}
            				else{ 
                				$tens   = ( int ) ( $tens / 10 );
                				$tens   = ' ' . $list2[$tens] . ' ';
                				$singles    = ( int ) ( $num_part % 10 );
                				$singles    = ' ' . $list1[$singles] . ' ';}
            					$words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );}
        						$commas = count( $words );
        				if( $commas > 1 ){
            				$commas = $commas - 1;}
        				$words  = implode( ' ' , $words );
   						return $words.' Only';}else if( ! ( ( int ) $num ) ){return 'Zero';}

    				return '';}
?>