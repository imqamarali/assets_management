
<?php 
include "db.php";
				$sql= "SELECT *,mainpurchase.id as mid FROM mainpurchase 
				LEFT JOIN supplier ON (mainpurchase.supplierid=supplier.id)
				WHERE mainpurchase.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				
				$sql1= "SELECT * FROM purchase
				LEFT JOIN item ON (purchase.iid=item.id)			   
				WHERE mid='".$_REQUEST['id']."'";
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
  <textarea id="header" readonly="readonly">Demand</textarea>
  <div id="identity">
    <div> <img  src="images/logo.png" alt="logo" height="80px;" width="300px;"/> </div>
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
      <p> <?php echo $row['company_name']; ?> </p>
      <hr/>
      <p> Address: <?php echo $row['address']; ?> </p>
      <p>Phone: <?php echo $row['contactno']; ?> </p>
    </div>
    <table id="meta" style="margin:10px;">
      <tr>
        <td class="meta-head">Order #</td>
        <td id="date">Order # <?php echo $row['mid']; ?></td>
      </tr>
      <tr>
        <td class="meta-head">Date</td>
        <td id="date"><?php echo $row['createdate']; ?></td>
      </tr>
    </table>
  </div>
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Item Name</th>
      <th>Item Code</th>
      <th>Unit</th>
      <th>Weight(PU)</th>
      <th>Total Weight</th>
      <th>Quantity</th>
      <th>Cost</th>
    </tr>
    <?php $i=0; while ($row1 = $result1->fetch_assoc()){ $i=$i+1;?>
    <tr>
      <td><?php echo $i;?></td>
      <td class="item-name"><?php echo $row1['name'];?></td>
      <td><?php echo $row1['itemcode'];?></td>
      <td><?php if($row1['unit']==1){echo "Rft";}if($row1['unit']==2){echo "Mtr";}if($row1['unit']==3){echo "KG/M";}if($row1['unit']==4){echo "Pieces";}?></td>
      <td><?php echo number_format($row1['weight'],2);?></td>
      <td><?php echo number_format($row1['weight']*$row1['qty'],2)?></td>
      <td><?php echo number_format($row1['qty'],2);?></td>
      <td><?php echo number_format($row1['price'],2)?></td>
    </tr>
    <?php }?>
  </table>
  <div id="terms">
    <h5>Terms</h5>
    <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
  </div>
</div>
</body>
</html>