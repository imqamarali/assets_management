
				<?php  
				include "db.php"; 
//				$sql= "SELECT *,quotations.id as quotid  FROM quotations 
//			    LEFT JOIN customer ON (quotations.customer_id=customer.id)
//				WHERE quotations.id='".$_REQUEST['id']."'";
//			    $result = $conn->query($sql);
//				$row = $result->fetch_assoc();
//				
//				$gtotal=0; 
//				$sql1= "SELECT * FROM qoutwin 
//				LEFT JOIN windows ON (qoutwin.win_id=windows.id)
//			    WHERE qout_id='".$_REQUEST['id']."'";
//			    $result1 = $conn->query($sql1);
//				
//				$ptotal=0;
//				$sql2= "SELECT * FROM payment 
//			    WHERE quot_id='".$_REQUEST['id']."'";
//			    $result2 = $conn->query($sql2);
//				
//				
//				$sql3= "SELECT * FROM discount 
//			    WHERE qoutid='".$_REQUEST['id']."'";
//			    $result3 = $conn->query($sql3);
//				$row3 = $result3->fetch_assoc();
//				?>
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
  <textarea id="header" readonly="readonly">Reporting</textarea>
  <div id="identity">

    <div> <img  src="images/logo.jpg" alt="logo" height="120px;" width="150px;" style="margin-left:300px;"/> </div>
  </div>
  <div style="clear:both"></div>
<!--<div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
	<p><?php ?></p><p style="font-weight:bold;">s/o </p><p><?php ?></p><hr/>
   <p> Address:  <?php ?></p>
    <p>Phone:    <?php ?></p>
    </div>
    <table id="meta" style="margin:10px;">
      <tr>
        <td class="meta-head">Quotation #</td>
        <td><?php  ?></td>
      </tr>
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php ?></td>
      </tr>
      
      <tr>
        <td class="meta-head">Amount Due</td>
        <td><div class="due"><?php ?>/-</div></td>
      </tr>
    </table>
  </div>-->
  <table id="items">
    <tr>
      <th>Item</th>
      <th>Description</th>
      <th>Unit Price</th>
      <th>Quantity</th>
      <th>Total Price</th>
    </tr>
    <?php ?>
			
    <tr>
      <td class="item-name">
         <?php ?></td>
      <td class="description"><?php ?></td>
      <td class="cost"><?php ?>/-</td>
      <td class="qty"><?php ?></td>
      <td><span class="price"><?php ?>/-</span></td>
    </tr>
    <?php  ?>
   
    <!--<tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Tax Applied</td>
      <td class="total-value"><div id="total">
	  <?php ?>/-
      </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Discount</td>
      <td class="total-value"><div id="total">
	  <?php ?>/-
      </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Total</td>
      <td class="total-value"><div id="total">
	  <?php ?>/-
      </div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line">Amount Paid</td>
      <td class="total-value"><div id="total">
	  <?php ?>/-</div></td>
    </tr>
    <tr>
      <td colspan="2" class="blank"></td>
      <td colspan="2" class="total-line balance" style="background-color:#F00;">Amount Return</td>
      <td class="total-value balance"style="background-color:#F00;"><div class="due"><?php ?>/-</div></td>
      <?php  ?>
       <td colspan="2" class="total-line balance">Balance Due</td>
      <td class="total-value balance"><div class="due"><?php ?>/-</div></td>
      <?php ?>
    </tr>-->
  </table>
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>