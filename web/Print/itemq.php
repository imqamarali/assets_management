
				<?php   
				include "db.php";
				$sql1= "SELECT *,sale.unitprice as up,sale.detail as det FROM sale 
				LEFT JOIN item ON (sale.item_id=item.id)
				where customerid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
			    
			    $sqlcc= "SELECT * FROM config";
			    $resultcc = $conn->query($sqlcc);
				$rowcc = $resultcc->fetch_assoc();
				
				$sql= "SELECT *,mainsale.createdate as scd FROM mainsale 
			    LEFT JOIN customer ON (mainsale.customerid=customer.id)
				WHERE mainsale.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
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
        <td class="meta-head">Order No.</td>
        <td><?php echo $row['orderno']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['scd']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Note</td>
        <td id="date"><?php echo $row['detail']; ?></td>
      </tr>
      
    </table>
  </div>
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Item</th>
      <th>Description</th>
      <th>Unit Price</th>
      <th>Quantity</th>
      <th>Total Price</th>
    </tr>
    <?php $total=0;$i=0;
	 while ($row1 = $result1->fetch_assoc()){$i=$i+1;	 ?>
    <tr>
	  <td align="center"><?php echo $i;?></td>
      <td  align="center"><?php echo $row1['name'];?></td>
      <td  align="center"><?php echo $row1['det'];?></td>
      <td  align="center"><?php echo number_format($row1['up'],2);?></td>
      <td align="center"><?php echo number_format($row1['quantity'],2);?></td>
      <td align="center"><?php echo number_format($row1['quantity']*$row1['up'],2);?></td>
    </tr>
    
    <?php $total=$total+($row1['quantity']*$row1['up']); }?>
    <tr>
      <td colspan="5" class="total-line" style="font-weight:bold; font-size:14px;">Sales Tax</td>
      <td class="total-value" align="center"><div id="total" style="font-weight:bold; font-size:14px;">
	  <?php echo number_format($row['tax'],2);?>
      </div></td>
    </tr>
    
    <tr>
      <td colspan="5" class="total-line" style="font-weight:bold; font-size:14px;">Total Amount</td>
      <td class="total-value" align="center"><div id="total" style="font-weight:bold; font-size:14px;">
	  <?php echo number_format(($total+$row['tax']),2);?>
      </div></td>
    </tr>
  </table>
  
  
  
  <div id="terms">
   <h4 style="text-align:left;">Terms & Condition</h4>
   <div style="text-align:left;border: 1px solid black; padding:10px;">
    <?php echo $rowcc['note'] ?>
    </div>
  </div>
</div>
</body>
</html>