<?php 
    include "../db.php";
				$sqlmem= "SELECT *,accounts.name as aname,accounts.id as acid,transaction.remarks as premarks,transaction.id as prid,transaction.create_date as tdate,
				transaction.user_id as usid,accounts.type as actype,transaction.status_type as tst from transaction 
                left JOIN accounts ON transaction.pt_id = accounts.id  
				where transaction.id='".$_REQUEST['id']."'";
			    $resultmem = $conn->query($sqlmem);
				$rowmem = $resultmem->fetch_assoc();
				 
				
				if($rowmem['tst']==5)
        		{
                    $sql_res = "SELECT rno,name,cnic from plot_reserved_main
                    left JOIN members ON (members.id = plot_reserved_main.member_id )
                    where plot_reserved_main.id='".$rowmem['pt_id']."'";
                    $sql_res1 = $conn->query($sql_res);
				    $result_res = $sql_res1->fetch_assoc(); 
                    $acc=$result_res['name'].'('.$result_res['cnic'].') '.$result_res['rno'];
        		}
                else
                {
                    $acc=$rowmem['aname'];
                }
                
                if(empty($rowmem['pt_id']))
                {
                    $sqldb= "SELECT * FROM payment 
				    left join accounts on(payment.referanceid=accounts.id) 
				    WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount>0";
			        $sql_db = $conn->query($sqldb);
				    $result_db = $sql_db->fetch_assoc(); 
                    
                    $acc=$result_db['name'];
                }
				
				
				$sql2v= "SELECT * FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount1>0";
			    $result2v = $conn->query($sql2v);
			    
			    $sqlmem1= "SELECT * FROM employee
				WHERE id='".$_REQUEST['mem']."'";
			    $resultmem1 = $conn->query($sqlmem1);
			    $rowmem1  = $resultmem1->fetch_assoc();
			    
			    $sqlmem2= "SELECT * FROM employee
				WHERE id='".$rowmem['usid']."'";
			    $resultmem2 = $conn->query($sqlmem2);
			    $rowmem2  = $resultmem2->fetch_assoc();
			    
			    
			    
			    
			    
			    $sql2v11= "SELECT sum(amount),sum(amount1) FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.referanceid='".$rowmem['acid']."'";
			    $result2v11 = $conn->query($sql2v11);
				$rowmem11 = $result2v11->fetch_assoc();
			    
				
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
<div id="page-wrap" style="background-color:#FFFFFF;width:800px !important;page-break-after:always;">
  <?php include('header.php');?>
  <?php //echo $s['adrress'];?>
  <?php echo '&#13;&#10;Payment Voucher';?>
  

  </textarea>
  <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;"><b style="
    margin-left: 24px;
">Client Copy</b></div>
  <style>
    table td, table th 
    {
        border: 0;
    }
    #page-wrap {
    width: 55%;}
</style>
  <div style="clear:both"></div>
  <div id="customer">
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> Voucher # : </span> <span style="color:#999;"><?php echo $rowmem['vno']; ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> Dated : </span> <span style="color:#999;"><?php echo date("d M Y",strtotime($rowmem['tdate'])); ?></span>
      <hr>  
    </div>
    <div style="clear:both"></div>
   
    <div style="margin-left: 50px;margin-top:5px;width:50%;display: inline-block;">
      <span> Paid To : </span> <span style="color:#999;"><?php echo $acc; ?></span>
      <hr>  
    </div> 
    <div style="clear:both"></div>
    
    <table id="items" style="margin-left:50px;width:90%;">
      <tr>
        <th style="text-align:left;">S No.</th>
        <th style="text-align:left;">Instruments</th>
        <th style="text-align:left;">Narration</th>
        <th style="text-align:left;">Due Date</th>
        <th style="text-align:left;">Cheque #</th>
        <th style="text-align:left;">Dated</th>
        <th style="text-align:right;">Amount</th>
      </tr>
      <?php 
      
      
      $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; $cdate=''; 
      
      $sql2vdd= "SELECT * FROM payment 
				WHERE id='".$row2v['sid']."'";
			    $result2vdd = $conn->query($sql2vdd);
			    $row2vdd = $result2vdd->fetch_assoc();
      
      if(!empty($rowmem['cheque_no'])){$cdate=$rowmem['cheque_date'];} ?>
      <tr>
        <td><?php echo $i;?></td>
        <td>
            <?php
            if($rowmem['vtype']==1 || $rowmem['vtype']==3){echo 'Cash';}
            else if($rowmem['vtype']==2 || $rowmem['vtype']==4){echo 'Online';}else{echo 'Adjustment';}
            
            ?>    
        </td>
        <td><?php echo $rowmem['premarks'];?></td>
        <td><?php echo $row2vdd['date'];?></td>
        <td><?php echo $rowmem['cheque_no'];?></td>
        <td><?php echo $cdate;?></td>
        <td align="right"><?php echo number_format(($row2v['amount']+$row2v['amount1']),2)?></td>
        <?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
      </tr>
      <?php }?>
      <tr>
        <td colspan="7" class="total-value"   align="right"> Total : <?php echo number_format(($tc+$td),2);?></td>
      </tr>
    </table>
    </br>
    
    <?php
    $sqld= "SELECT SUM(amount1) FROM payment 
				WHERE vid='".$_REQUEST['id']."' AND pfor=1 AND type=1";
			    $resultd = $conn->query($sqld);
			    $rowd = $resultd->fetch_assoc();
			    
			    if($rowd['SUM(amount1)']>0)
			    {
    ?>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:40%;display: inline-block;"> <span>Deduction Amount: </span> <span style="color:#999;"><?php echo number_format($rowd['SUM(amount1)'],0); ?></span> </div>
    </br>
    <?php } ?>
    
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;"> <span>Paid Amount: </span> <span style="color:#999;"><?php echo number_format($rowmem['amount'],0); ?></span> </div>
    </br>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;"><?php echo ucwords(Word($rowmem['amount'])); ?></span> </div>
    </br></br></br></br>
    <div style="clear:both"></div>
    <table  style="margin-left:50px;width:90%;">
      <tr>
        <td style="text-align: center;"> <u><?php echo $rowmem2['name'] ?></u><br>
          <br>
          <b style="font-size:14px;">Prepared By: </b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Accounts Manager:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Authorized By:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Received By:</br></b></td>
      </tr>
      <tr>
         <td colspan="4" style="text-align: center;"> 
          <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi"); echo $rowmem1['name'] .' || Dated: '.date("d-M-Y H:i A") ?></b></td>
      </tr>
    </table>
  </div>
</div>


<?php 
    include "../db.php";
				$sqlmem= "SELECT *,accounts.name as aname,accounts.id as acid,transaction.remarks as premarks,transaction.id as prid,transaction.create_date as tdate,
				transaction.user_id as usid,accounts.type as actype from transaction 
                left JOIN accounts ON transaction.pt_id = accounts.id  
				where transaction.id='".$_REQUEST['id']."'";
			    $resultmem = $conn->query($sqlmem);
				$rowmem = $resultmem->fetch_assoc();
				
				$sql2v= "SELECT * FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount1>0";
			    $result2v = $conn->query($sql2v);
			    
			    $sqlmem1= "SELECT * FROM employee
				WHERE id='".$_REQUEST['mem']."'";
			    $resultmem1 = $conn->query($sqlmem1);
			    $rowmem1  = $resultmem1->fetch_assoc();
			    
			    $sqlmem2= "SELECT * FROM employee
				WHERE id='".$rowmem['usid']."'";
			    $resultmem2 = $conn->query($sqlmem2);
			    $rowmem2  = $resultmem2->fetch_assoc();
			    
			    
			    
			    
			    
			    $sql2v11= "SELECT sum(amount),sum(amount1) FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.referanceid='".$rowmem['acid']."'";
			    $result2v11 = $conn->query($sql2v11);
				$rowmem11 = $result2v11->fetch_assoc();
			    
				
				?>


<div id="page-wrap" style="background-color:#FFFFFF;width:800px !important;page-break-after:always;">
  <?php include('header.php');?>
  <?php //echo $s['adrress'];?>
  <?php echo '&#13;&#10;Payment Voucher';?>
  

  </textarea>
  <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;"><b style="
    margin-left: 24px;
">Office Copy</b></div>
  <style>
    table td, table th 
    {
        border: 0;
    }
    #page-wrap {
    width: 55%;}
</style>
  <div style="clear:both"></div>
  <div id="customer">
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> Voucher # : </span> <span style="color:#999;"><?php echo $rowmem['vno']; ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
        <span> Dated : </span> <span style="color:#999;"><?php echo date("d M Y",strtotime($rowmem['tdate'])); ?></span>
      <hr>  
    </div>
    <div style="clear:both"></div>
   
    <div style="margin-left: 50px;margin-top:5px;width:50%;display: inline-block;">
      <span> Paid To : </span> <span style="color:#999;"><?php echo $acc; ?></span>
      <hr>  
    </div> 
    <div style="clear:both"></div>
    
    <table id="items" style="margin-left:50px;width:90%;">
      <tr>
        <th style="text-align:left;">S No.</th>
        <th style="text-align:left;">Instruments</th>
        <th style="text-align:left;">Narration</th>
        <th style="text-align:left;">Due Date</th>
        <th style="text-align:left;">Cheque #</th>
        <th style="text-align:left;">Dated</th>
        <th style="text-align:right;">Amount</th>
      </tr>
      <?php 
      
      
      $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; $cdate=''; 
      
      $sql2vdd= "SELECT * FROM payment 
				WHERE id='".$row2v['sid']."'";
			    $result2vdd = $conn->query($sql2vdd);
			    $row2vdd = $result2vdd->fetch_assoc();
      
      if(!empty($rowmem['cheque_no'])){$cdate=$rowmem['cheque_date'];} ?>
      <tr>
        <td><?php echo $i;?></td>
        <td>
            <?php
            if($rowmem['vtype']==1 || $rowmem['vtype']==3){echo 'Cash';}
            else if($rowmem['vtype']==2 || $rowmem['vtype']==4){echo 'Online';}else{echo 'Adjustment';}
            
            ?>    
        </td>
        <td><?php echo $rowmem['premarks'];?></td>
        <td><?php echo $row2vdd['date'];?></td>
        <td><?php echo $rowmem['cheque_no'];?></td>
        <td><?php echo $cdate;?></td>
        <td align="right"><?php echo number_format(($row2v['amount']+$row2v['amount1']),2)?></td>
        <?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
      </tr>
      <?php }?>
      <tr>
        <td colspan="7" class="total-value"   align="right"> Total : <?php echo number_format(($tc+$td),2);?></td>
      </tr>
    </table>
    </br>
    <?php
    $sqld= "SELECT SUM(amount1) FROM payment 
				WHERE vid='".$_REQUEST['id']."' AND pfor=1 AND type=1";
			    $resultd = $conn->query($sqld);
			    $rowd = $resultd->fetch_assoc();
			    
			    if($rowd['SUM(amount1)']>0)
			    {
    ?>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:40%;display: inline-block;"> <span>Deduction Amount: </span> <span style="color:#999;"><?php echo number_format($rowd['SUM(amount1)'],0); ?></span> </div>
    </br>
    <?php } ?>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;"> <span>Paid Amount: </span> <span style="color:#999;"><?php echo number_format($rowmem['amount'],0); ?></span> </div>
    </br>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;"><?php echo ucwords(Word($rowmem['amount'])); ?></span> </div>
    </br></br></br></br>
    <div style="clear:both"></div>
    <table  style="margin-left:50px;width:90%;">
      <tr>
        <td style="text-align: center;"> <u><?php echo $rowmem2['name'] ?></u><br>
          <br>
          <b style="font-size:14px;">Prepared By: </b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Accounts Manager:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Authorized By:</br></b></td>
        <td style="text-align: center;"> ____________________<br>
          <br>
          <b style="font-size:14px;">Received By:</br></b></td>
      </tr>
      <tr>
         <td colspan="4" style="text-align: center;"> 
          <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi"); echo $rowmem1['name'] .' || Dated: '.date("d-M-Y H:i A") ?></b></td>
      </tr>
    </table>
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