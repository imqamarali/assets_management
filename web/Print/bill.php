<?php   
    include "db.php";
    $where='';
    if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
    {
        $where.=" where memberplot.id='".$_REQUEST['id']."'";
    }
    $sql= "Select *,memberplot.id as mid from memberplot
    Left Join members ON (members.id=memberplot.member_id)
    Left Join plots ON (plots.id=memberplot.plot_id) $where";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Print</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>
<style>
td{text-align:center;}
</style>
<body>
<div id="page-wrap">
	
  <textarea id="header" readonly="readonly">Print</textarea>
  <div id="identity">
  </div>
  <div style="clear:both"></div>
  <div id="customer">
    <div id="customer-title" style="margin-left: 20px;">
        <p> Name: <b><u> <?php echo $row['name']; ?></u></b></p>
        <p> SO/DO/WO: <b><u> <?php echo $row['sodowo']; ?></u></b></p>
        <p> CNIC: <b> <u><?php echo $row['cnic']; ?></u></b></p>
    </div>
    <table id="meta" style="margin:10px;">
      <tr>
        <td class="meta-head">Plot #</td>
        <td id="date"><?php echo $row['plot_detail_address'] ?></td>
      </tr> 
      <tr>
        <td class="meta-head">Membership #</td>
        <td id="date"><?php echo $row['plotno'] ?></td>
      </tr> 
      <tr>
        <td class="meta-head">Dated</td>
        <td id="date"><?php echo $row['create_date'] ?></td>
      </tr> 
    </table> 
  </div>
  <h4>Connection Detail</h4>  
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Type</th>
      <th>Price</th>
      <th>Detail</th>
      <th>Status</th>
    </tr>
    <?php
    $i=0;
    $sql1="Select * from bills where mid='".$row['mid']."'";
    $result1 = $conn->query($sql1);
    while($row1=$result1->fetch_assoc())
    {$i=$i+1;
    ?>  
    <tr>
        <td><?php echo $i;?></td>
        <td><?php if($row1['type']==1){echo "Electricity";}if($row1['type']==2){echo "Gas";} ?></td>
        <td><?php echo $row1['price'];?></td>
        <td><?php echo $row1['comment'];?></td>
        <td><?php if($row1['status']==0){echo "Not Working";}if($row1['status']==1){echo "Working";};?></td>          
    </tr>
    <?php $total=$total+$row1['price'];
    }
    ?>  
  </table>  
</br>
  <h4>Extra Services Detail</h4>  
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Name</th>
      <th>Amount</th>
      <th>Detail</th>
    </tr>
    <?php
    $ii=0;
    $sql2="Select * from plotextraservices 
    Left Join extraservices On (extraservices.id=plotextraservices.sid)    
    where mid='".$row['mid']."'";
    $result2 = $conn->query($sql2);
    while($row2=$result2->fetch_assoc())
    {$ii=$ii+1;
    ?>  
    <tr>
        <td><?php echo $ii;?></td>
        <td><?php echo $row2['name'];?></td>
        <td><?php echo $row2['amount'];?></td>
        <td><?php echo $row2['comment'];?></td>    
    </tr>
    <?php $total=$total+$row2['amount'];
    }
    ?>  
  </table>  
</br>
  <h4>Applied Services</h4>  
  <table id="items">
    <tr>
      <th>S No.</th>
      <th>Name</th>
      <th>Amount</th>
    </tr>
    <?php
    $iii=0;$total=0;
    $sql2="Select * from applysc
    Left Join services_charges ON (services_charges.id=applysc.scid)
    where pid='".$row['mid']."'";
    $result2 = $conn->query($sql2);
    while($row2=$result2->fetch_assoc())
    {$iii=$iii+1;
    ?>  
    <tr>
        <td><?php echo $iii;?></td>
        <td><?php echo $row2['name'];?></td>   
        <td><?php echo $row2['amount'];?></td>   
    </tr>
    <?php $total=$total+$row2['amount'];
    }
    ?>  
  </table>  
  <div id="terms">
  	<table id="items">
    <tr>
      <th style="font-size:22px;">Total Amount</th>
      <th style="font-size:22px;"><?php echo $total;?></th>
    </tr>
  </table>
  </div>
  </div>
</div>
</body>
</html>
<?php
    }
?>