<?php 
    include "../db.php";
				$sqlmem= "SELECT *,accounts.name as aname,members.name as memname,accounts.id as acid,transaction.remarks as premarks,transaction.id as prid,
				transaction.create_date as tdate,transaction.user_id as usid,accounts.type as actype from transaction 
                left JOIN accounts ON transaction.pt_id = accounts.id  
                left JOIN memberplot ON accounts.ref = memberplot.id 
                left JOIN members ON members.id = memberplot.member_id 
                Left Join plots ON (plots.id=memberplot.plot_id)
                Left Join size_cat ON (size_cat.id=plots.size2)
                Left Join streets ON (streets.id=plots.street_id)
                Left Join sectors ON (sectors.id=streets.sector_id)
				where transaction.id='".$_REQUEST['id']."'";
			    $resultmem = $conn->query($sqlmem);
				$rowmem = $resultmem->fetch_assoc();
				if($rowmem['actype']==2){
    			 	$sqls= "SELECT * FROM supplier
    				left join accounts on (accounts.ref=supplier.id)
    				WHERE accounts.id='".$rowmem['pt_id']."'";
    			    $results = $conn->query($sqls);
    			    $rowmems  = $results->fetch_assoc(); 
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
				WHERE payment.referanceid='".$rowmem['acid']."' and remarks!='Discount'";
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
  <?php echo $s['adrress'];?>
  <?php echo '&#13;&#10;Reciept Voucher';?>
  

  </textarea>
  <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;"><b style="
    margin-left: 24px;
">Customer Copy</b></div>
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
    <?php  if($rowmem['actype']==1){ ?>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> MS # : </span> <span style="color:#999;"><?php echo $rowmem['plotno']; ?></span>
      <hr>  
    </div>
    <?php  } ?>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> Dated : </span> <span style="color:#999;"><?php echo $rowmem['tdate']; ?></span>
      <hr>  
    </div>
    <div style="clear:both"></div>
   
    <div style="margin-left: 50px;margin-top:5px;width:50%;display: inline-block;">
      <span> Received with thanks from : </span> <span style="color:#999;"><?php if(!empty($rowmem['memname'] && $rowmem['actype']==1)){ echo $rowmem['memname'].' ( '.$rowmem['cnic'].' )';}else{echo $rowmem['aname'];} ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:30%;display: inline-block;">
        <?php 
        $ph='';
        if($rowmem['actype']==2){
           $ph =$rowmems['contactno'];
        }else{
            if(!empty($rowmem['phone'])){ $ph= $rowmem['phone'];}else{$ph=$rowmem['phone1'];}
          
        }
        ?>
      <span >Cell # :</span> <span style="color:#999;"><?php echo $ph; ?></span>
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
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;"> <span>Amount: </span> <span style="color:#999;"><?php echo number_format($rowmem['amount'],0); ?></span> </div>
    </br>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;"><?php echo ucwords(Word($rowmem['amount'])); ?></span> </div>
    </br>
    <?php if($rowmem['actype']==1){ ?>
    <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span> Net Amount : </span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount)']); ?></span>
      <hr>  
    </div>
        <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span> Net Received: </span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount1)']); ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span >Balance :</span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount)']-$rowmem11['sum(amount1)']); ?></span>
      <hr>  
    </div>
    <?php } ?>
    </br></br></br>
    
    <?php if($rowmem['actype']==1){ ?>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Payment Of: </span> <span style="color:#999;">(<?php echo $rowmem['type'].'-'.$rowmem['plot_detail_address'].' , '. $rowmem['sector_name'].' , '.$rowmem['street']; ?>)</span> </div>
        </br></br></br></br>
        <?php } ?>
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
				$sqlmem= "SELECT *,accounts.name as aname,members.name as memname,accounts.id as acid,transaction.remarks as premarks,transaction.id as prid,transaction.create_date as tdate,transaction.user_id as usid,accounts.type as actype from transaction 
                left JOIN accounts ON transaction.pt_id = accounts.id  
                left JOIN memberplot ON accounts.ref = memberplot.id 
                left JOIN members ON members.id = memberplot.member_id 
                Left Join plots ON (plots.id=memberplot.plot_id)
                Left Join size_cat ON (size_cat.id=plots.size2)
                Left Join streets ON (streets.id=plots.street_id)
                Left Join sectors ON (sectors.id=streets.sector_id)
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
				WHERE payment.referanceid='".$rowmem['acid']."' and remarks!='Discount'";
			    $result2v11 = $conn->query($sql2v11);
				$rowmem11 = $result2v11->fetch_assoc();
			    
				
				?>

<div id="page-wrap" style="background-color:#FFFFFF;width:800px !important; ">
  <?php include('header.php');?>
  <?php echo $s['adrress'];?>
  <?php echo '&#13;&#10;Reciept Voucher';?>
  

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
    <?php  if($rowmem['actype']==1){ ?>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> MS # : </span> <span style="color:#999;"><?php echo $rowmem['plotno']; ?></span>
      <hr>  
    </div>
    <?php  } ?>
    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
      <span> Dated : </span> <span style="color:#999;"><?php echo $rowmem['tdate']; ?></span>
      <hr>  
    </div>
    <div style="clear:both"></div>
   
    <div style="margin-left: 50px;margin-top:5px;width:50%;display: inline-block;">
      <span> Received with thanks from : </span> <span style="color:#999;"><?php if(!empty($rowmem['memname']) && $rowmem['actype']==1){ echo $rowmem['memname'].' ( '.$rowmem['cnic'].' )';}else{echo $rowmem['aname'];} ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:30%;display: inline-block;">
      <span >Cell # :</span> <span style="color:#999;"><?php echo $ph; ?></span>
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
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;"> <span>Amount: </span> <span style="color:#999;"><?php echo number_format($rowmem['amount'],0); ?></span> </div>
    </br>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;"><?php echo ucwords(Word($rowmem['amount'])); ?></span> </div>
    </br>
    
    <?php if($rowmem['actype']==1){ ?>
    <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span> Net Amount : </span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount)']); ?></span>
      <hr>  
    </div>
        <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span> Net Received: </span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount1)']); ?></span>
      <hr>  
    </div>
    <div style="margin-left: 50px;margin-top:5px;width:25%;display: inline-block;">
      <span >Balance :</span> <span style="color:#999;"><?php echo number_format($rowmem11['sum(amount)']-$rowmem11['sum(amount1)']); ?></span>
      <hr>  
    </div>
    <?php } ?>
    </br></br></br>
    <?php if($rowmem['actype']==1){ ?>
    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Payment Of: </span> <span style="color:#999;">(<?php echo $rowmem['type'].'-'.$rowmem['plot_detail_address'].' , '. $rowmem['sector_name'].' , '.$rowmem['street']; ?>)</span> </div>
        </br></br></br></br>
        <?php } ?>
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