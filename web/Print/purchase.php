
<?php 
include "db.php";
				$sql= "SELECT * FROM mainpurchase 
				LEFT JOIN supplier ON (mainpurchase.supplierid=supplier.id)
				WHERE mainpurchase.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$gtotal=0;
				$dis=0;
				$sql1= "SELECT *,purchase.quantity as sqty,
				purchase.id as sid,purchase.detail as sd,purchase.unitprice as sp FROM purchase
				LEFT JOIN item ON (purchase.item_id=item.id)			   
				WHERE mid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				$sql2= "SELECT * FROM payment 
				WHERE referanceid='".$_REQUEST['id']."' and pfor='3'";
			    $result2 = $conn->query($sql2);
				
				$sql3="SELECT * FROM purchase
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
    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="200px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
      <p> <?php echo $row['contact_name']; ?> </p>
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
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['createdate']; ?></td>
      </tr>
      <?php 
	  $total=($row3['unitprice']*$row3['quantity'])+$row['tax']-$row3['discount'];
	  ?>
      <tr>
        <td class="meta-head">Amount Due</td>
        <td><div class="due"> <?php echo $total; ?> /-</div></td>
      </tr>
    </table>
  </div>
  <table id="items">
    <tr>
      <th>Item</th>
      <th>Description</th>
      <th>Unit Price</th>
      <th>Quantity</th>
      <th>Total Price</th>
    </tr>
    <?php while ($row1 = $result1->fetch_assoc()){?>
    <tr>
      <td class="item-name"><?php echo $row1['name'];?></td>
      <td class="description"><?php echo $row1['sd'];?></td>
      <td class="cost"><?php echo $row1['sp'];?>/-</td>
      <td class="qty"><?php echo $row1['sqty'];?></td>
      <td><span class="price"><?php echo $row1['sp']*$row1['sqty'];?>/-</span></td>
    </tr>
    <?php  
	$gtotal=$gtotal+($row1['sp']*$row1['sqty']);
	$dis=$dis+$row1['discount'];
	}?>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Tax Applied</td>
      <td class="total-value"><div id="total"> <?php echo $row['tax']; ?> /- </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Discount</td>
      <td class="total-value"><div id="total">
          <?php 
	  		echo $dis; ?>
          /- </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Total</td>
      <td class="total-value"><div id="total">
          <?php
		  $gt=0;
		  echo $gt=$gtotal+$row['tax']-$dis;?>
          /- </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Amount Paid</td>
      <td class="total-value"><div id="total">
          <?php 
		  $ptotal=0;
		  $btotal=0;
		  while ($row2 = $result2->fetch_assoc()){$ptotal=$ptotal+$row2['paidamount'];}
	  	 echo $ptotal; ?>
          /-</div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <?php if ($ptotal > $gtotal  ) { ?>
      <td colspan="2" class="total-line balance" style="background-color:#F00;">Amount Return</td>
      <td class="total-value balance"style="background-color:#F00;"><div class="due"><?php echo $ptotal-$gtotal;?>/-</div></td>
      <?php } else { ?>
      <td colspan="2" class="total-line balance">Balance Due</td>
      <td class="total-value balance"><div class="due"><?php echo $btotal=$gt-$ptotal;?>/-</div></td>
      <?php }?>
    </tr>
  </table>
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>