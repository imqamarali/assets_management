<?php 
    include "../db.php";
   
				$sql= "SELECT *,accounts.name as bname,transaction.create_date as tdate FROM transaction 
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
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
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
<div id="customer-title" style="margin-left: 20px;">
    <img src="../img/logo.jpg" style="margin-top: 30px;" alt="logo" width="150px;">  
</div>
<textarea id="header" style="height:80px !important;letter-spacing: .05px !important; font-size: 17px; margin-bottom: 0px; width: 54%;color: black; background: white;" 
readonly="readonly">KGN Builders &amp; Developers 
<?php
if($row['vtype']==3){echo 'Cash Reciept Voucher';}if($row['vtype']==4){echo 'Bank Reciept Voucher';}
if($row['vtype']==1){echo 'Cash Payment Voucher';}if($row['vtype']==2){echo 'Bank Payment Voucher';}?>
</textarea>
<div id="meta" style="width: 200px;margin-top: -87px;"> 
    <img src="../img/logoimage.jpg"  alt="logo" width="180px;"> 
</div>
<div style="clear:both"></div>
</br></br>
<div id="customer">

  <div id="customer-title" style="margin-left: 50px;margin-top:5px;width:90%;"> <span>
  <?php if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;"><?php echo $name; ?></span>
    <hr/></br>
    <span > Voucher # : </span>
    <span style="color:#999;"><?php echo $row['vno']; ?></span>
    <hr/></br>
    <span > Dated : </span>
    <span style="color:#999;"><?php echo date("d M Y",strtotime($row['tdate'])); ?></span>
    <hr/></br>
  </div>
  <div style="clear:both"></div></br> 
  <table id="items" style="width: 90%;margin-left: 6%;">
    <tr>
      <th style="text-align:left;width: 6%;">S No.</th>
      <th style="text-align:left;width: 15%;">Account Title</th>
      <th style="text-align:left;width: 15%;">Account Code</th>
      <th style="text-align:left;width: 40%;">Narration</th>
      <th style="text-align:right;width: 10%;">Debit</th>
      <th style="text-align:right;width: 10%;">Credit</th>
    </tr>
    

<?php $i=0; $td=0;$tc=0; while($row2v = $result2v1->fetch_assoc()){$i=$i+1; ?>    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row2v['name'];?></td>
      <td><?php echo $row2v['code'];?></td>
      <td><?php echo $row2v['remarks'];?></td>
      <td align="right"><?php echo number_format($row2v['amount'],0)?></td>
      <td align="right"><?php echo number_format($row2v['amount1'],0)?></td>
     <?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
    </tr>
   <?php }?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value" align="right">Total</td>
      <td class="total-value" align="right">    <?php echo number_format($td,0);?></td>
        <td class="total-value"   align="right">  <?php echo number_format($tc,0);?></td>
    </tr>  </table>

  </br></br>
  <div id="customer-title" style="margin-left: 50px;margin-top:5px;width:90%;"> <span > Amount :</span>
  <span style="color:#999;"><?php echo $row['amount']; ?></span>
    <hr/></br>
    <span >Amount In Words :</span>
    <span style="color:#999;"><?php echo ucwords(Word($row['amount'])) ?></span>
    <hr/>
  </div>        
    
  <div style="clear:both"></div>
  <div style="margin-top: 1%;text-align:center;width: 98%;">
    </br></br></br></br>
    <p style="margin-top: 3%;">Prepared by:_______________________________ Checked By:_______________________________</p></br></br></br>
    <p style="margin-top: 3%;">Approved by:_______________________________ Received By:_______________________________</p>
    
    </br></br></br>
    <p style="font-size: 12px;">Generated By: <b><?php echo $row2['name']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;Printed By: <b><?php
     $sql2m= "SELECT * FROM employee WHERE id='".$_REQUEST['mem']."'";
         $result2m = $conn->query($sql2m);
        $mem = $result2m->fetch_assoc();
         echo $mem['name'] ?></b> &nbsp;&nbsp; Print Date: <b><?php echo date('d-M-y'); ?></b></p>
 </div>
</div> 
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