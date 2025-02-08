<?php
include "../db.php";
$sqlmem= "SELECT *,accounts.name as aname,accounts.id as acid,accounts.code as acode,transaction.remarks as premarks,transaction.id as prid,
transaction.create_date as tdate,transaction.user_id as usid,accounts.type as actype,plots.type as ptype from transaction 
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

if( $rowmem['com_res'] == 'Res'){
    $cccat='Residential';
} else {
    $cccat='Commercial';
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

$cdate='';
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Transaction</title>
        <link rel='stylesheet' type='text/css' href='css/style.css' />
        <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    </head>

    <body style="background-color: aliceblue; font-size: 17px; font-weight: bold;" >
    <div id="page-wrap" style="width:800px !important; background-image: url('../img/mowreceipt.jpg');">
  <br><br><br><br><br><br>
        <!-- <php echo $s['adrress'];?> -->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!--        <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;">-->
<!--            <b style="margin-left: 24px;-->
<!--">Customer Copy</b></div>-->
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
            <div style="margin-left: 100px;margin-top:2px;width:26%;display: inline-block;">
                <span>  </span> <span><?php echo $rowmem['vno']; ?></span>
            </div>

            <div style="margin-left: 650px;margin-top:-22px;width:26%;display: inline-block;">
                <span> </span> <span ><?php echo date("d-M-Y", strtotime($rowmem['tdate'])); ?></span>
            </div>
            <div style="clear:both"></div>

            <div style="margin-left: 251px;margin-top:18px;width:89%;display: inline-block;">
                <span>&nbsp; &nbsp; &nbsp;</span> <span><?php $ac=explode('-',$rowmem['aname']); echo $ac[0]; ?></span>

            </div>

            <div style="margin-left: 136px;margin-top:15px;width:75%;display: inline-block;line-height: 39px;min-height: 76px;">
                <span> &nbsp; &nbsp; &nbsp;</span> <span ><?php echo ucwords(Word($rowmem['amount']));?>/-</span>

            </div>
            
            <?Php
            $cashY='';
            if($rowmem['ttype'] == 1)
            {
                $cashY='Cash';
            }
            if($rowmem['ttype'] == 2)
            {
                $cashY='Online';
            }
            if($rowmem['ttype'] == 3)
            {
                $cashY='Pay Order';
            }
            if($rowmem['ttype'] == 4)
            {
                $cashY='Cheque # '.$rowmem['cheque_no'];
            }
            if($rowmem['ttype'] == 5)
            {
                $cashY='Demand Draft';
            }
            if($rowmem['ttype'] == 6)
            {
                $cashY='Price Bond';
            }
            ?>

            <div style="margin-left: 428px;margin-top:10px;width:89%;display: inline-block;"><span >  <?php echo $cashY;?> </span>
            </div>

            <div style="margin-left: 484px;margin-top:-23px;width:89%;display: inline-block;">
                <span style="margin-left: 150px;"><?php echo date("d-M-Y", strtotime($rowmem['tdate'])); ?></span>
            </div>





            <div style="margin-left: 180px;margin-top:20px;width:30%;display: inline-block;">
                <span>  </span> <span><?php echo $rowmem['plot_detail_address']; ?> </span>
            </div>
            <div style="margin-left: -9px;margin-top:23px;width:40%;display: inline-block;text-align: right"><span><?php echo $rowmem['ptype']; ?></span>
            </div>


            <div style="clear:both"></div>
            </br>
            <div id="customer-title" style="margin-left:105px;margin-top: 114px;width:20%;
            font-size:20px;display: inline-block;"> <span> </span> <span ><?php echo number_format($rowmem['amount'],0); ?>/-</span> </div>
            </br>
<!--            <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;">--><?php //echo ucwords(Word($rowmem['amount'])); ?><!--</span> </div>-->
            </br></br></br></br>

            <div style="clear:both"></div>
        </div>


<!--        down reciept-->

                <div id="customer">
            <div style="margin-left: 100px;margin-top:189px;width:26%;display: inline-block;">
                <span>  </span> <span><?php echo $rowmem['vno']; ?></span>
            </div>

            <div style="margin-left: 650px;margin-top:-25px;width:26%;display: inline-block;">
                <span> </span> <span ><?php echo date("d-M-Y", strtotime($rowmem['tdate'])); ?></span>
            </div>
            <div style="clear:both"></div>

            <div style="margin-left: 251px;margin-top:18px;width:89%;display: inline-block;">
                <span>&nbsp; &nbsp; &nbsp;</span> <span><?php  $ac=explode('-',$rowmem['aname']); echo $ac[0]; ?></span>

            </div>

            <div style="margin-left: 136px;margin-top:9px;width:75%;display: inline-block;line-height: 39px;min-height: 76px;">
                <span> &nbsp; &nbsp; &nbsp;</span> <span ><?php echo ucwords(Word($rowmem['amount']));?>/-</span>

            </div>
            
            <?Php
            $cashY='';
            if($rowmem['ttype'] == 1)
            {
                $cashY='Cash';
            }
            if($rowmem['ttype'] == 2)
            {
                $cashY='Online';
            }
            if($rowmem['ttype'] == 3)
            {
                $cashY='Pay Order';
            }
            if($rowmem['ttype'] == 4)
            {
                $cashY='Cheque # '.$rowmem['cheque_no'];
            }
            if($rowmem['ttype'] == 5)
            {
                $cashY='Demand Draft';
            }
            if($rowmem['ttype'] == 6)
            {
                $cashY='Price Bond';
            }
            ?>
            

            <div style="margin-left: 428px;margin-top:13px;width:89%;display: inline-block;"> <span>  <?php echo $cashY;?> </span>
            </div>
            
             <div style="margin-left: 484px;margin-top:-23px;width:89%;display: inline-block;">
                <span style="margin-left: 150px;"><?php echo date("d-M-Y", strtotime($rowmem['tdate'])); ?></span>
            </div>







            <div style="margin-left: 180px;margin-top:20px;width:30%;display: inline-block;">
                <span>  </span> <span><?php echo $rowmem['plot_detail_address']; ?> </span>
            </div>
            <div style="margin-left: -9px;margin-top:20px;width:40%;display: inline-block;text-align: right">
                <span ><?php echo $rowmem['ptype']; ?></span>
            </div>


            <div style="clear:both"></div>
            </br>
            <div id="customer-title" style="margin-left:118px;margin-top: 114px;width:20%;
            font-size:20px;display: inline-block;"> <span> </span> <span ><?php echo number_format($rowmem['amount'],0); ?>/-</span> </div>
            </br>
<!--            <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: -1%;"> <span>Amount In Words: </span> <span style="color:#999;">--><?php //echo ucwords(Word($rowmem['amount'])); ?><!--</span> </div>-->
            </br></br></br></br>

     
            <div style="clear:both"></div></br>
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