
<?php 
include "db.php";
				$sql= "SELECT * FROM mainpurchasee 
				LEFT JOIN supplier ON (mainpurchasee.supplierid=supplier.id)
				WHERE mainpurchasee.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$gtotal=0;
				$dis=0;
				$sql1= "SELECT *,purchasee.quantity as sqty,
				purchasee.id as sid,purchasee.detail as sd,purchasee.unitprice as sp FROM purchasee
				LEFT JOIN item ON (purchasee.item_id=item.id)			   
				WHERE mid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				$sql2= "SELECT * FROM payment 
				WHERE referanceid='".$_REQUEST['id']."' and pfor='3'";
			    $result2 = $conn->query($sql2);
				
				$sql3="SELECT * FROM purchasee
				WHERE mid='".$_REQUEST['id']."'";
				$result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
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
  <textarea id="header" readonly="readonly">Invoice</textarea>
  <div id="identity">
    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="250px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
      <p> <?php echo $row['company_name']; ?> </p>
      <p style="font-weight:bold;">s/o </p>
      <p> <?php echo $row['contact_name']; ?> </p>
      <hr/>
      <p> Address: <?php echo $row['address']; ?> </p>
      <p>Phone: <?php echo $row['contactno']; ?> </p>
    </div>
    <table id="meta" style="margin:10px;">
      <!--<tr>
        <td class="meta-head">Invoice #</td>
        <td><?php  ?></td>
      </tr>-->
      <tr>
        <td class="meta-head">Order #</td>
        <td id="date"><?php echo $row['orderno']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['createdate']; ?></td>
      </tr>
      <?php 
	  $total=($row3['unitprice']*$row3['quantity'])+$row['tax']-$row3['discount'];
	  ?>
      <tr>
        <td class="meta-head">Amount Due</td>
        <td><div class="due"> <?php echo number_format($total,2); ?> </div></td>
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
    <?php $i=0; while ($row1 = $result1->fetch_assoc()){$i=$i+1;?>
    <tr>
      <td><?php echo $i;?></td>
      <td class="item-name"><?php echo $row1['name'];?></td>
      <td class="description"><?php echo $row1['sd'];?></td>
      <td class="cost"><?php echo number_format($row1['sp'],2);?></td>
      <td class="qty"><?php echo number_format($row1['sqty'],2);?></td>
      <td align="right"><span class="price"><?php echo number_format($row1['sp']*$row1['sqty'],2);?></span></td>
    </tr>
    <?php  
	$gtotal=$gtotal+($row1['sp']*$row1['sqty']);
	$dis=$dis+$row1['discount'];
	}?>
    <tr>
      <td colspan="3" class="blank"></td>
      <td colspan="2" class="total-line">Tax Applied</td>
      <td class="total-value"><div id="total" style="text-align: right;"> <?php echo number_format($row['tax'],2); ?>  </div></td>
    </tr>
    <tr>
      <td colspan="3" class="blank"></td>
      <td colspan="2" class="total-line">Discount</td>
      <td class="total-value"><div id="total" style="text-align: right;">
          <?php 
	  		echo number_format($dis,2); ?>
           </div></td>
    </tr>
    <tr>
      <td colspan="3" class="blank"></td>
      <td colspan="2" class="total-line">Total</td>
      <td class="total-value"><div id="total" style="text-align: right;">
          <?php
		  $gt=0;
		  echo $gt=number_format($gtotal+$row['tax']-$dis,2);?>
           </div></td>
    </tr>
  </table>
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>