<?php 
  include "../db.php";

  $member_detail_sql = "SELECT *, ac.name as 'bank_name', m.name as 'member_name',
                        tr.amount as 'tras_amount', m.image as 'member_image',
                        tr.create_date as 'tras_cdate' FROM transaction tr 
                        LEFT JOIN members m ON tr.user_id = m.id
                        LEFT JOIN accounts ac ON tr.bank_id = ac.id
                        LEFT JOIN memberplot mp ON m.id = mp.member_id
                        LEFT JOIN plots p ON mp.plot_id = p.id
                        LEFT JOIN size_cat sc ON sc.id = p.size2
                        LEFT JOIN tbl_city c ON c.id = m.city_id
                        LEFT JOIN tbl_country coun ON coun.id = m.country_id
                        LEFT JOIN nexttokeen ntk ON ntk.mid = m.id
                        LEFT JOIN cat_plot cp ON cp.plot_id = p.id
                        LEFT JOIN categories cat ON cat.id = cp.id
                        LEFT JOIN streets str ON str.id = p.street_id
                        LEFT JOIN sectors sec ON sec.id = p.sector
                        WHERE tr.id = '".$_REQUEST['id']."'";
  $member_detail_result = $conn->query($member_detail_sql);
  $member_detail_row = $member_detail_result->fetch_assoc();
  // print_r($member_detail_row); exit();

	$sqlmem= "SELECT *,accounts.name as aname,accounts.id as acid,
  transaction.remarks as premarks,transaction.id as prid,transaction.create_date as tdate,
	transaction.user_id as usid,accounts.type as actype,transaction.status_type as tst from transaction
  left JOIN accounts ON transaction.pt_id = accounts.id  
	where transaction.id='".$_REQUEST['id']."'";
  $resultmem = $conn->query($sqlmem);
	$rowmem = $resultmem->fetch_assoc();
  // print_r($rowmem); exit();

  $bank_id = $rowmem['bank_id'];
  $bank_name_sql = "SELECT name FROM accounts WHERE id = $bank_id";
  $bank_name_result = $conn->query($bank_name_sql);
  $bank_name = $bank_name_result->fetch_assoc();
	 
	
	if($rowmem['tst']==5){
    $sql_res = "SELECT rno,name,cnic from plot_reserved_main
    left JOIN members ON (members.id = plot_reserved_main.member_id )
    where plot_reserved_main.id='".$rowmem['pt_id']."'";
    $sql_res1 = $conn->query($sql_res);
    $result_res = $sql_res1->fetch_assoc(); 
    $acc=$result_res['name'].'('.$result_res['cnic'].') '.$result_res['rno'];
  } else{
    $acc=$rowmem['aname'];
  }
  if(empty($rowmem['pt_id'])){
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
<?php 
  include "../db.php";

        $sqlmem= "SELECT *,accounts.name as aname,accounts.id as acid,transaction.remarks as premarks,transaction.id as prid,transaction.create_date as tdate,
        transaction.user_id as usid,accounts.type as actype from transaction 
                left JOIN accounts ON transaction.pt_id = accounts.id  
        where transaction.id='".$_REQUEST['id']."'";
          $resultmem = $conn->query($sqlmem);
        $rowmem = $resultmem->fetch_assoc();
        // print_r($rowmem); exit();
        
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

        <?php 
          $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; $cdate=''; 
      
          $sql2vdd= "SELECT * FROM payment 
            WHERE id='".$row2v['sid']."'";
          $result2vdd = $conn->query($sql2vdd);
          $row2vdd = $result2vdd->fetch_assoc();
      
          if(!empty($rowmem['cheque_no'])){$cdate=$rowmem['cheque_date'];}
          ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Transaction</title>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
  </head>
  <style>
    .copy{height:450px;}
  </style>

  <body style="background-color: aliceblue; ">
    <div id="page-wrap" style="background-color:#FFFFFF;background-image:url(images/transaction_pay_img.jpeg);background-size: 100%;">
      <div class="copy" style="height: 565px !important;">
        <div style=" position:absolute; margin:44px 0 0 310px">
          <!-- <img style="height: 50px;width: 160px;" src="images/logo.png"/> -->
        </div>
        <?php //print_r($rowmem); ?>
        <div style=" position:absolute; margin:95px 0 0 455px;"></div>
        <div style=" position:absolute; margin:187px 0 0 255px;"><?= $member_detail_row['plotno'] ?></div>
        <div style=" position:absolute; margin:152px 0 0 690px;"><?= $member_detail_row['vno']; ?></div>
        <div style="  position:absolute; margin:320px 0 0 615px;"><?= date("d M Y",strtotime($member_detail_row['cheque_date'])); ?></div>
        <div style="  position:absolute; margin:320px 0 0 350px;"><?= $member_detail_row['cheque_no']; ?></div>
        <div style="  position:absolute; margin:188px 0 0 628px;"><?= date("d M Y",strtotime($member_detail_row['tras_cdate'])); ?></div>
        <div style=" position:absolute; margin:221px 0 0 345px;"><?= $member_detail_row['member_name']; ?></div>
        <div style=" position:absolute; margin:253px 0 0 175px;"><?= $member_detail_row['sodowo']; ?></div>
        <div style=" position:absolute; margin:286px 0 0 202px;"><?= number_format(($row2v['amount']+$row2v['amount1']),2)?> (<?= ucwords(Word($row2v['amount']+$row2v['amount1'])); ?>) </div>
      <?php } ?>
        <div style=" position:absolute; margin:353px 0 0 130px;"><?= $member_detail_row['bank_name']; ?></div>
        <div style=" position:absolute; margin:453px 0 0 140px;"><b><?= number_format(($member_detail_row['tras_amount'])); ?>/-</b></div>

        <div style=" position:absolute; margin:419px 0 0 178px;"><?= $member_detail_row['plot_detail_address']; ?></div>
        <div style=" position:absolute; margin:419px 0 0 299px;"><?= $member_detail_row['sector_name']; ?></div>
        <div style=" position:absolute; margin:419px 0 0 392px;"><?= $member_detail_row['type']; ?></div>
        <div style=" position:absolute; margin:419px 0 0 500px;"><?= $member_detail_row['street']; ?></div>
        <div style=" position:absolute; margin:419px 0 0 660px;"><?= $member_detail_row['size']; ?></div>
        
        <!-- <div style=" position:absolute; margin:385px 0 0 245px;">&check;</div> -->
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