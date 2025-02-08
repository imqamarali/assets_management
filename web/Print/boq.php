
				<?php 
				include "db.php";
				$i=0;
				$sql= "SELECT * FROM requsition 
				LEFT JOIN item ON (requsition.item=item.id)
				WHERE requsition.qoutid='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				
				$sql1= "SELECT *,requsition.createdate as rdate FROM requsition 
				LEFT JOIN quotations ON (requsition.qoutid=quotations.id)
				LEFT JOIN customer ON (quotations.customer_id=customer.id)
				WHERE requsition.qoutid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				$row = $result1->fetch_assoc();
				
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
  <textarea id="header" readonly="readonly">Requisition</textarea>
  <div id="identity">
    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="200px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
      <p> <?php  echo $row['name']; ?> </p>
      <p style="font-weight:bold;">s/o </p>
      <p> <?php echo $row['fname']; ?> </p>
      <hr/>
      <p> Address: <?php echo $row['address']; ?> </p>
      <p>Phone: <?php echo $row['mobile']; ?> </p>
    </div>
    <table id="meta" style="margin:10px;">
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['createdate']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Sales Order #</td>
        <td id="date"><?php echo $row['salesorderno']; ?></td>
      </tr>
    </table>
  </div>
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Item</th>
      <th>Quantity</th>
      <th>Demand</th>
      <th>Comment</th>
    </tr>
    <?php while ($row1 = $result->fetch_assoc()){ $i=$i+1;?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row1['name'];?></td>
      <td><?php echo $row1['qty'];?></td>
      <td><?php echo $row1['demand'];?></td>
      <td><?php echo $row1['comment'];?></td>
    </tr>
    <?php } ?>
  </table>
  <div style="float:right;margin:10px 0 0 10px;">
    <h5 style="margin:5px 0 5px 0;">Recieved By</h5>
    <p>Name:      ___________________________________</p>
    <p>Signature: _________________________________</p>
  </div>
</div>
</body>
</html>