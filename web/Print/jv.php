
<?php include "db.php";
				$sql= "SELECT *,customer.name as cname,employee.name as ename,customer.address as caddress,supplier.address as saddress,employee.address as eaddress,customer.mobile as cmob,employee.mobile as emob FROM transaction 
				LEFT JOIN customer ON (transaction.pt_id=customer.id)
				LEFT JOIN supplier ON (transaction.pt_id=supplier.id)
				LEFT JOIN employee ON (transaction.pt_id=employee.id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$sql2= "SELECT * FROM transaction 
				LEFT JOIN employee ON (transaction.user_id=employee.id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				$row2 = $result2->fetch_assoc();
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql1= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
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
<textarea id="header" style="height:25px !important;letter-spacing: 2px !important;font-size:20px;" readonly="readonly"><?php if($row['vtype']==1){echo 'Cash Payment';}if($row['vtype']==3){echo 'Cash Reciept';}?>
</textarea>
<div style="clear:both"></div>
<div id="customer">
<div id="customer-title" style="margin-left: 20px;">
      <img  src="images/logo.png" alt="logo" height="100px;" width="150px;"/> 
    </div>
  <div id="customer-title" style="margin-left: 200px;margin-top:5px;"> <span style="font-size:12px;">
  <?php if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;""><?php if($row['pttype']==1){echo $row['ename'];}if($row['pttype']==2){echo $row['contact_name'];}if($row['pttype']==3){echo $row['cname'];} ?></span>
    <hr/>
    <span style="font-size:12px;">Address: </span>
    <span style="color:#999;""><?php  if($row['pttype']==1){echo $row['eaddress'];}if($row['pttype']==2){echo $row['saddress'];}if($row['pttype']==3){echo $row['caddress'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Phone: </span>
    <span style="color:#999;""><?php if($row['pttype']==1){echo $row['emob'];}if($row['pttype']==2){echo $row['contactno'];}if($row['pttype']==3){echo $row['cmob'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Voucher # :</span>
    <span style="color:#999;""><?php echo $row['vno']; ?></span>
    <hr/>
  </div>
  <div id="meta" style="margin-left: 20px;"> <span style="font-size:12px;"> Amount :</span>
  <span style="color:#999;""><?php echo $row['amount']; ?></span>
    <hr/>
    <span style="font-size:12px;">Amount In Words :</span>
    <span style="color:#999;""><?php echo ucwords(Word($row['amount'])) ?></span>
    <hr/>
  </div>
  <div style="clear:both"></div>
  <table id="items">
    <tr>
      <th>Order No</th>
      <th>Date</th>
      <th>Detail</th>
      <th>Amount</th>
    </tr>
    <?php $total=0; while ($row1 = $result1->fetch_assoc()){?>
    <tr>
      <td><?php echo $row1['orderno'];?></td>
      <td><?php echo $row1['date'];?></td>
      <td><?php echo $row1['detail'];?></td>
      <td><?php echo $row1['pam'];?></td>
    </tr>
    <?php $total=$total+$row1['pam'];}?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value"   style="background-color:#0F3;"> Total : <?php echo $total;?></td>
    </tr>
  </table>
  <div style="clear:both"></div>
  <div id="meta" style="width:315px !important;">
<span><?php  if($row['vtype']==1 or $row['vtype']==2){echo 'Issued by:____________________________';}
if($row['vtype']==3 or $row['vtype']==4){echo 'Received By:__________________________';}?> </span>
<span>Dated: <?php echo date('d-M-y'); ?></span><br/>
<span>Generated By: <?php echo $row2['name']; ?></span>
</div>
</div>
<hr style="margin:5px 0px;" />
</div>
<div id="page-wrap" style="background-color:#FFFFFF;">
<textarea id="header" style="height:25px !important;letter-spacing: 2px !important;font-size:20px;" readonly="readonly"><?php if($row['vtype']==1){echo 'Cash Payment';}if($row['vtype']==3){echo 'Cash Reciept';}?>
</textarea>
<div style="clear:both"></div>
<div id="customer">
<div id="customer-title" style="margin-left: 20px;">
      <img  src="images/logo.jpg" alt="logo" height="80px;" width="100px;"/> 
    </div>
  <div id="customer-title" style="margin-left: 250px;margin-top:5px;"> <span style="font-size:12px;">
  <?php if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;""><?php if($row['pttype']==1){echo $row['ename'];}if($row['pttype']==2){echo $row['contact_name'];}if($row['pttype']==3){echo $row['cname'];} ?></span>
    <hr/>
    <span style="font-size:12px;">Address: </span>
    <span style="color:#999;""><?php  if($row['pttype']==1){echo $row['eaddress'];}if($row['pttype']==2){echo $row['saddress'];}if($row['pttype']==3){echo $row['caddress'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Phone: </span>
    <span style="color:#999;""><?php if($row['pttype']==1){echo $row['emob'];}if($row['pttype']==2){echo $row['contactno'];}if($row['pttype']==3){echo $row['cmob'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Voucher # : </span>
    <span style="color:#999;""><?php echo $row['vno']; ?></span>
    <hr/>
  </div>
  <div id="meta" style="margin-left: 20px;"> <span style="font-size:12px;"> Amount :</span>
  <span style="color:#999;""><?php echo $row['amount']; ?></span>
    <hr/>
    <span style="font-size:12px;">Amount In Words :</span>
    <span style="color:#999;""><?php echo ucwords(Word($row['amount'])) ?></span>
    <hr/>
  </div>
  <div style="clear:both"></div>
  <table id="items">
    <tr>
      <th>Order No</th>
      <th>Date</th>
      <th>Detail</th>
      <th>Amount</th>
    </tr>
    <?php $total=0; while ($row1 = $result1->fetch_assoc()){?>
    <tr>
      <td><?php echo $row1['orderno'];?></td>
      <td><?php echo $row1['date'];?></td>
      <td><?php echo $row1['detail'];?></td>
      <td><?php echo $row1['pam'];?></td>
    </tr>
    <?php $total=$total+$row1['pam'];}?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value"   style="background-color:#0F3;"> Total : <?php echo $total;?></td>
    </tr>
  </table>
  <div style="clear:both"></div>
  <div id="meta" style="width:315px !important;">
<span><?php  if($row['vtype']==1 or $row['vtype']==2){echo 'Issued by:____________________________';}
if($row['vtype']==3 or $row['vtype']==4){echo 'Received By:__________________________';}?> </span>
<span>Dated: <?php echo date('d-M-y'); ?></span><br/>
<span>Generated By: <?php echo $row2['name']; ?></span>
</div>
</div>
<hr style="margin:5px 0px;" />
</div>
<div id="page-wrap" style="background-color:#FFFFFF;">
<textarea id="header" style="height:25px !important;letter-spacing: 2px !important;font-size:20px;" readonly="readonly"><?php if($row['vtype']==1){echo 'Cash Payment';}if($row['vtype']==3){echo 'Cash Reciept';}?>
</textarea>
<div style="clear:both"></div>
<div id="customer">
<div id="customer-title" style="margin-left: 20px;">
      <img  src="images/logo.jpg" alt="logo" height="80px;" width="100px;"/> 
    </div>
  <div id="customer-title" style="margin-left: 250px;margin-top:5px;"> <span style="font-size:12px;">
  <?php if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;""><?php if($row['pttype']==1){echo $row['ename'];}if($row['pttype']==2){echo $row['contact_name'];}if($row['pttype']==3){echo $row['cname'];} ?></span>
    <hr/>
    <span style="font-size:12px;">Address: </span>
    <span style="color:#999;""><?php  if($row['pttype']==1){echo $row['eaddress'];}if($row['pttype']==2){echo $row['saddress'];}if($row['pttype']==3){echo $row['caddress'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Phone: </span>
    <span style="color:#999;""><?php if($row['pttype']==1){echo $row['emob'];}if($row['pttype']==2){echo $row['contactno'];}if($row['pttype']==3){echo $row['cmob'];} ?></span>
    <hr/>
    <span style="font-size:12px;"> Voucher # : </span>
    <span style="color:#999;""><?php echo $row['vno']; ?></span>
    <hr/>
  </div>
  <div id="meta" style="margin-left: 20px;"> <span style="font-size:12px;"> Amount :</span>
  <span style="color:#999;""><?php echo $row['amount']; ?></span>
    <hr/>
    <span style="font-size:12px;">Amount In Words :</span>
    <span style="color:#999;""><?php echo ucwords(Word($row['amount'])) ?></span>
    <hr/>
  </div>
  <div style="clear:both"></div>
  <table id="items">
    <tr>
      <th>Order No</th>
      <th>Date</th>
      <th>Detail</th>
      <th>Amount</th>
    </tr>
    <?php $total=0; while ($row1 = $result1->fetch_assoc()){?>
    <tr>
      <td><?php echo $row1['orderno'];?></td>
      <td><?php echo $row1['date'];?></td>
      <td><?php echo $row1['detail'];?></td>
      <td><?php echo $row1['pam'];?></td>
    </tr>
    <?php $total=$total+$row1['pam'];}?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value"   style="background-color:#0F3;"> Total : <?php echo $total;?></td>
    </tr>
  </table>
  <div style="clear:both"></div>
  <div id="meta" style="width:315px !important;">
<span><?php  if($row['vtype']==1 or $row['vtype']==2){echo 'Issued by:____________________________';}
if($row['vtype']==3 or $row['vtype']==4){echo 'Received By:__________________________';}?> </span>
<span>Dated: <?php echo date('d-M-y'); ?></span><br/>
<span>Generated By: <?php echo $row2['name']; ?></span>
</div>
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
   						return $words.' Only';}else if( ! ( ( int ) $num ) ){return 'Zero';}

    				return '';}
?>