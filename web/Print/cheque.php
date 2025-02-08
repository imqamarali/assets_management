<?php 
    include "../db.php";
   
				$sql= "SELECT *,accounts.name as bname,accounts.type as actype,transaction.create_date as tdate,transaction.status_type as tst FROM transaction 
				LEFT JOIN accounts On (accounts.id=transaction.bank_id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				//print_r($result);exit;
				$name='';
				
				$sqlemp= "SELECT * from accounts where id='".$row['pt_id']."'";
			    $resultemp = $conn->query($sqlemp);
				$rowemp = $resultemp->fetch_assoc();
				if($row['tst']==5)
        		{
                    $sql_res = "SELECT rno from plot_reserved_main where id='".$row['pt_id']."'";
                    $sql_res1 = $conn->query($sql_res);
				    $result_res = $sql_res1->fetch_assoc(); 
                    $name=$result_res['rno'];
        		}
                else
                {
				    $name=$rowemp['name'];
				    
				    $sqldb= "SELECT *,accounts.type as actype FROM payment 
				    left join accounts on(payment.referanceid=accounts.id) 
				    WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount1>0";
			        $sql_db = $conn->query($sqldb);
				    $result_db = $sql_db->fetch_assoc();
				    
				    
				    if($result_db['actype']==1)
                    {
                        $sqldb= "SELECT members.name as mname,members.cnic as mcnic FROM transaction 
                        left JOIN accounts ON transaction.pt_id = accounts.id  
                        left JOIN memberplot ON accounts.ref = memberplot.id 
                        left JOIN members ON members.id = memberplot.member_id  
    				    WHERE transaction.id='".$_REQUEST['id']."'";
    			        $sql_db = $conn->query($sqldb);
    				    $result_db = $sql_db->fetch_assoc(); 
                        
                        $name=$result_db['mname'].' ( '.$result_db['mcnic'].')';
                    }
                    if($result_db['actype']!=1)
                    {
                        $sqldb= "SELECT * FROM payment 
    				    left join accounts on(payment.referanceid=accounts.id) 
    				    WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount>0";
    			        $sql_db = $conn->query($sqldb);
    				    $result_db = $sql_db->fetch_assoc();
    				    
    				    $name=$result_db['name'];
                    }
                }
                
				
				$sql2= "SELECT * FROM transaction 
				LEFT JOIN employee ON (transaction.user_id=employee.id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				$row2 = $result2->fetch_assoc();
				
				$sql2v= "SELECT *,accounts.type as actype FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
			    $result2v = $conn->query($sql2v);
			    
			    $sql2v1= "SELECT *,accounts.type as actype FROM payment 
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
<div id="page-wrap">
    
<?php  include('header.php');?><?php
if($row['vtype']==3){echo 'Cash Reciept Voucher';}
if($row['vtype']==4){echo 'Bank Reciept Voucher';}
if($row['vtype']==1 || $row['vtype']==2){echo 'Payment Voucher';}
?>

</textarea>

<div style="clear:both"></div>
<div id="customer">

  <div id="customer-title" style="margin-left: 50px;margin-top:5px;width:300px;"> <span >
  <?php  if($row['vtype']==1 or $row['vtype']==2){echo 'Paid To:';}if($row['vtype']==3 or $row['vtype']==4){echo 'Paid By:';}?></span>
  <span style="color:#999;"><?php echo $name; ?></span>
    <hr/>
    <span > Voucher # : </span>
    <span style="color:#999;"><?php echo $row['vno']; ?></span>
    <hr/>
    <span > Dated : </span>
     <span style="color:#999;"><?php echo date("d M Y",strtotime($row['tdate'])); ?></span>
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
      <th style="text-align:right;">Debit</th>
      <th style="text-align:right;">Credit</th>
    </tr>
    

<?php $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; ?>    
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
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="total-value" align="right"> Total : <?php echo number_format($td,2);?></td>
        <td class="total-value"   align="right"> Total : <?php echo number_format($tc,2);?></td>
    </tr>  </table>
  <div style="clear:both"></div>
  <div style="margin-top: 1%;">
    <p style="font-size: 12px;">Generated By: <b><?php echo $row2['name']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;Printed By: <b><?php
     $sql2m= "SELECT * FROM employee WHERE id='".$_REQUEST['mem']."'";
     $result2m = $conn->query($sql2m);
        $mem = $result2m->fetch_assoc();         
        echo $mem['name'] ?></b> &nbsp;&nbsp; Print Date: <b><?php echo date('d-M-y'); ?></b>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    This is computer generated slip and doesnot require any signature.</p>
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
   						return $words.' Only';}else if( ! ( ( int ) $num ) ){return 'Zero';}

    				return '';}
?>