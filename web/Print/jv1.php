<?php
    include "../db.php";

    $sql2v= "SELECT *,accounts.type as actype FROM payment 
            LEFT JOIN accounts ON (payment.referanceid = accounts.id)  
            WHERE payment.pfor in (1,6) AND payment.vid = '".$_REQUEST['id']."'";
    $result2v = $conn->query($sql2v);
    // print_r($result2v->fetch_assoc()); exit();
          
    $sql= "SELECT *, accounts.name AS bname, transaction.create_date AS tdate FROM transaction 
        LEFT JOIN accounts ON (accounts.id = transaction.bank_id)
        WHERE transaction.id = '".$_REQUEST['id']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // $row = $result2v->fetch_assoc();

    $sql2= "SELECT * FROM transaction 
            LEFT JOIN accounts ON (accounts.id = transaction.bank_id)
            WHERE transaction.id = '".$_REQUEST['id']."'";
    $result2 = $conn->query($sql2);

    $sql2= "SELECT * FROM transaction 
            LEFT JOIN employee ON (transaction.user_id = employee.id)
            WHERE transaction.id = '".$_REQUEST['id']."'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
  
  
    $sql2= "SELECT * FROM transaction 
            LEFT JOIN employee ON (transaction.user_id = employee.id)
            WHERE transaction.id = '".$_REQUEST['id']."'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();

    $sql2m= "SELECT * FROM employee WHERE id = '".$_REQUEST['mem']."'";
    $result2m = $conn->query($sql2m);
    $mem = $result2m->fetch_assoc();

    $sql1212 = "SELECT *, accounts.name AS bname, transaction.create_date AS tdate FROM transaction 
                LEFT JOIN accounts ON (accounts.id = transaction.bank_id)
                WHERE transaction.id = '" . $_REQUEST['id'] . "'";
    $result1212 = $conn->query($sql1212);
    $row1212 = $result1212->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Transaction</title>
        <link rel='stylesheet' type='text/css' href='css/style.css' />
        <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    </head>

  <style type="text/css">
        #jz-table{
            font-family: arial, sans-serif;
            margin-top: -20px;
            border-collapse: collapse;
            border: 2px solid;
        }
        #jz-table td{
            border: none !important;
            padding: 5px 20px 5px 20px;
        }

        #jz-table2{
            width: 100%;
            margin-top: 20px;
        }

        #jz-table3{
            width: 100%;
            margin-top: -1px;
            border: 1px solid;
        }
        #jz-table3 th{
            text-align: center;
        }
        #jz-table3 td{
            border: none !important;
        }
        /*#jz-table3 tr:nth-last-child(2){
            height: 300px;
            vertical-align: top;
        }*/

        #jz-table4{
            width: 100%;
            margin-top: -1px;
            border: 1px solid;
        }
        #jz-table4 td{
            border: none !important;
        }

        #jz-table5{
            width: 100%;
            margin-top: 3px;
        }
        #jz-table5 td{
            border: none;
        }

        #jz-table6{
            width: 100%;
            margin-bottom: 3px;
        }
        #jz-table6 td{
            border: none;
        }

        .blank_row{
            height: 20px !important; /* overwrites any other rules */
            background-color: #FFFFFF;
        }

        #address_line1{
            position: absolute;
            margin:-18px 0 0 65px;
        }
        #address_line2{
            position: absolute;
            margin:17px 0 0 107px;
        }

        #header{
            letter-spacing: .05px !important; font-size: 17px; margin-bottom: 0px; color: black; background: transparent;
            position: absolute;
            width: 45%;
            margin: 60px 0px 0px 297px;
            text-align: left;
            padding-left: 112px;
        }
  </style>

    <body style="background-color: aliceblue;">
        <div id="page-wrap" style="background-color:#FFFFFF;">
            <div style="min-height: 400px;border: 1px solid #000; padding: 15px;">
                <div>
                    <div style="width:20%;float: left; padding-bottom: 15px;">
                        <?php
                            //$filename = '../attachments/logo';
                            $ms = "SELECT * FROM config";
                            $m = $conn->query($ms);
                            $s = $m->fetch_assoc();
                        ?>
                        <img src="../img/<?php echo $s['logo']; ?>" style="margin-top: 15px;" alt="logo" width="100px;" />
                    </div>
                    <div style="width:60%;float: left; margin-top: 15px; padding-bottom: 15px;">
                        <p style="font-size: 22px;"> <?php echo $s['companyname']; ?> </p>
                        <p style="font-size: 15px;"> <?php echo $s['adrress']; ?> </p>
                        <p style="font-size: 15px;">
                            <b>
                                <?php
                                    if ($row1212['vtype'] == 1)
                                    {
                                        echo 'Cash Payment Voucher';
                                    }
                                    if ($row1212['vtype'] == 2)
                                    {
                                        echo 'Bank Payment Voucher';
                                    }

                                    if ($row1212['vtype'] == 3)
                                    {
                                        echo 'Cash Reciept Voucher';
                                    }
                                    if ($row1212['vtype'] == 4)
                                    {
                                        echo 'Bank Reciept Voucher';
                                    }
                                    if ($row1212['vtype'] == 7)
                                    {
                                        echo 'Journal Voucher';
                                    }
                                ?>
                            </b>
                        </p>
                    </div>
                    <div style="width:20%;float: left;margin-top: 15px; padding-bottom: 15px;">
                        <span> Voucher # : </span>
                        <span style="color:#999;"><?php echo $row1212['vno']; ?></span>
                        <hr />
                        <span> Dated : </span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($row1212['tdate'])); ?></span>
                        <hr />
                        <span> Amount :</span>
                        <span style="color:#999;"><?php echo $row1212['amount']; ?></span>
                        <hr />
                    </div>
                    <div>
                        <table id="jz-table3" frame="box">
                            <tbody>
                                <tr>
                                    <th style="width: 15%; text-align: left;">COA Code</th>
                                    <th style="width: 20%; text-align: left;">Name</th>
                                    <th style="width: 45%; text-align: left;">Description</th>
                                    <th style="width: 10%; text-align: right;">Debit</th>
                                    <th style="width: 10%; text-align: right;">Credit</th>
                                </tr>
                                <?php 
                                $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; 
                                $name=$row2v['name'];
                                if($row2v['actype']==1)
                                {
                                    $sql2m= "SELECT * FROM memberplot
                                    JOIN members ON (members.id=memberplot.member_id)
                                    WHERE memberplot.id = '".$row2v['ref']."'";
                                    $result2m = $conn->query($sql2m);
                                    $mem = $result2m->fetch_assoc();
                                    
                                    $name=$mem['name'].' - '.$mem['plotno'];
                                }
                                ?>
                                <tr>
                                    <td style="border-right: 1px solid !important;"><?= $row2v['code'];?></td>
                                    <td style="border-right: 1px solid !important;"><?= $name;?></td>
                                    <td style="border-right: 1px solid !important;"><?= $row2v['remarks'];?></td>
                                    <td style="border-right: 1px solid !important;" align="right"><?= number_format($row2v['amount'],2)?></td>
                                    <td style="border-right: 1px solid !important;" align="right"><?= number_format($row2v['amount1'],2)?></td>
                                    <?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
                                </tr>
                                <?php }?>

                                <?php
                                $jz_sql= "SELECT COUNT(*), accounts.type AS actype FROM payment 
                                        LEFT JOIN accounts ON (payment.referanceid = accounts.id) 
                                        WHERE payment.pfor in (1,6) AND payment.vid = '".$_REQUEST['id']."'";
                                $jz_result = $conn->query($jz_sql);
                                for($i = 15; $i > $jz_result->field_count; $i--)
                                {
                                ?>

                                <tr class="blank_row">
                                    <td style="border-right: 1px solid !important;"></td>
                                    <td style="border-right: 1px solid !important;"></td>
                                    <td style="border-right: 1px solid !important;"></td>
                                    <td style="border-right: 1px solid !important;"></td>
                                </tr>
                                <?php } ?>

                                <tr style="border: 1px solid;">
                                    <td style="border-right: 1px solid !important;" colspan="3">
                                        Rupees:- <?= ucwords(Word($row['amount'])) ?>
                                    </td>
                                    <td style="border-right: 1px solid !important;" align="right">
                                        <?= number_format($td,2);?>
                                    </td>
                                    <td style="border-right: 1px solid !important;" align="right">
                                        <?= number_format($tc,2);?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table id="jz-table4">
                            <tr>
                                <td style="width: 100%;">Narration:- <?= $row['remarks']; ?></td>
                            </tr>
                        </table>
                    </div>

                    <p style="padding-top: 6px;">Print Date: <b><?php echo date('d-M-y'); ?></b></p>

                    <div style="padding-top: 30px;">
                        <table id="jz-table6">
                            <tr>
                                <td><b><?= $row2['name']; ?></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <hr>
                        <table id="jz-table5">
                            <tr>
                                <td>Prepared By</td>
                                <td>Checked By</td>
                                <td>Approved By</td>
                                <td>Received By</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    function Word($num)
    {
        $num    = ( string ) ( ( int ) $num );
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
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
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens= ( int ) ( $num_part % 100 );
                $singles= '';
                if( $tens < 20 )
                {
                    $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
                }
                else
                { 
                	$tens   = ( int ) ( $tens / 10 );
                	$tens   = ' ' . $list2[$tens] . ' ';
                	$singles    = ( int ) ( $num_part % 10 );
                	$singles    = ' ' . $list1[$singles] . ' ';
                }
            	$words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
            }
    		$commas = count( $words );
            if( $commas > 1 )
            {
            	$commas = $commas - 1;
            }
            $words  = implode( ' ' , $words );
            return $words.' Only';
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }
?>