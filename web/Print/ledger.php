
				<?php   
				include "db.php";
				$sql3= "SELECT * From payment where referanceid='".$_REQUEST['id']."' AND date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."' ORDER BY date,id ASC";
            	$result3 = $conn->query($sql3);
	            $total=0;$ref;$na;
	            
	            $sql1= "SELECT * From subaccount where id='".$_REQUEST['id']."'";
			    $result11 = $conn->query($sql1);
			    $result1 = $result11->fetch_assoc();
				
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
	
  <textarea id="header" readonly="readonly">Ledger</textarea>
  <div id="identity">

    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="400px;"/> </div>
  </div>
  <div style="clear:both"></div>
  
  <hr/>
  <div id="customer">
    <div id="customer-title" style="margin-left: 35%;">
	<p><span style="font-weight:bold;">Account Tittle : </span><?php echo $result1['name']; ?></p><hr/>
	<p><span style="font-weight:bold;">Dated : </span><?php echo $_REQUEST['from']; ?> AND <?php echo $_REQUEST['to']; ?></p><hr/>
    </div>
  </div>
  <table id="items">  
 <tr>
      <th>Date</th>
      <th>Explanation</th>
      <th>Ref #</th>
      <th>Narration</th>
      <th>Debit</th>
      <th>Credit</th>
      <th>Balance</th>
                    </tr>
    <?php $deb=0;$cre=0;$balance=0;
    while ($row = $result3->fetch_assoc()){	
		if($row['pfor']==1)
		{
			$sql= "SELECT * From transaction 
			left join subaccount on(transaction.pt_id=subaccount.id)
			where transaction.id='".$row['vid']."'";
			$result1 = $conn->query($sql);
			$result = $result1->fetch_assoc();
			$ref=$result['vno'];
		    $na=$result['name'];
		    
		}
		if($row['pfor']==2)
		{
			$sql= "SELECT * From quotations where id='".$row['vid']."'";
			$result1 = $conn->query($sql);
			$result = $result1->fetch_assoc();
			$ref=$result['quotationno'];
		}
		if($row['pfor']==3)
		{
			$sql= "SELECT * From mainpurchase where id='".$row['vid']."'";
			$result1 = $conn->query($sql);
			$result = $result1->fetch_assoc();
			$ref=$result['orderno'];
		}
		if($row['pfor']==5)
		{
			$sql= "SELECT * From mainpurchasee where id='".$row['vid']."'";
			$result1 = $conn->query($sql);
			$result = $result1->fetch_assoc();
			$ref=$result['orderno'];
		}
		if($row['pfor']==6)
		{
			$sql= "SELECT * From mainsale where id='".$row['vid']."'";
			$result1 = $conn->query($sql);
			$result = $result1->fetch_assoc();
			$ref=$result['orderno'];
		}
		if($row['pfor']==7)
		{
			$ref=$row['jvid'];
		}
		?>
                 <tr>
                    <td align="left" width="10%">
					<?php if($row['pfor']==1){ ?>
					<?php echo $row['date']?>
					<?php } ?>
                    <?php if($row['pfor']==2){ ?>
					<?php echo $row['date']?>
					<?php } ?>
                    <?php if($row['pfor']==3){ ?>
					<?php echo $row['date']?>
					<?php } ?>
                    <?php if($row['pfor']==4){ ?>
					<?php echo $row['date']?>
					<?php } ?>
                    <?php if($row['pfor']==5){ ?>
					<?php echo $row['date']?>
					<?php } ?>
					<?php if($row['pfor']==7){ ?>
					<?php echo $row['date']?>
					<?php } ?>
                    </td>
                    <td align="left" width="30%">
					<?php 
					if($row['pfor']==1)
					{
						if($result['vtype']==1){echo 'Cash Payment';}
						if($result['vtype']==2){echo 'Bank Payment'; echo ' - '; echo $result['cheque_no'];}
						if($result['vtype']==3){echo 'Cash Reciept';}
						if($result['vtype']==4){echo 'Bank Reciept'; echo ' - '; echo $result['cheque_no'];}
					echo '-'.$na;
					    
					}
					if($row['pfor']==2){echo 'Sale';}
					if($row['pfor']==3){echo 'Purchase';}
					if($row['pfor']==7){echo 'JV';}
					if($row['pfor']==5){echo 'Local Purchase';}
					?></td>                    
                    <td align="left" width="5%">
					<?php echo $ref;?>
                    </td>
                    <td align="left" width="10%"><?php echo $row['remarks']?></td>
                    <td align="right" width="5%"><?php echo number_format($row['amount'],2)?></td>
                    <td align="right" width="5%"><?php echo number_format($row['amount1'],2)?></td>
                    <td align="right" width="5%">
					<?php if($row['amount']>0){$total=$total+$row['amount'];}if($row['amount1']>0){$total=$total-$row['amount1'];} echo number_format($total,2);?>
                    </td>
                    </tr>
				   <?php $deb=$deb+$row['amount'];$cre=$cre+$row['amount1'];} ?>
				   
				   <tr>
      <td colspan="4" class="total-line" style="font-weight:bold; font-size:14px;">Total Amount</td>
      <td align="right" class="total-value"><div id="total" style="font-weight:bold; font-size:20px;"><?php echo number_format(($deb),2);?>
      </div></td>
      <td align="right" class="total-value"><div id="total" style="font-weight:bold; font-size:20px;"><?php echo number_format(($cre),2);?>
      </div></td>
      <td align="right" class="total-value"><div id="total" style="font-weight:bold; font-size:20px;"><?php echo number_format(($total),2);?>
      </div></td>
      
    </tr>
  </table>
</div>
</body>
</html>