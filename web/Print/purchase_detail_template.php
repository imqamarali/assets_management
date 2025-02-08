<?php
    include "../db.php";
    $sqlt = "SELECT * from transaction_type WHERE tt_id = '".$_REQUEST['type']."'";
    $result1 = $conn->query($sqlt);
    $resultt = $result1->fetch_assoc();

    $name = '';

    $sqlemp = "SELECT * FROM accounts WHERE id='" . $row['pt_id'] . "'";
    $resultemp = $conn->query($sqlemp);
    $rowemp = $resultemp->fetch_assoc();
    $name = $rowemp['name'];
    if ($row['vtype'] == 5)
    {
        $member_detail_sql = "SELECT p.plot_detail_address, sec.sector_name, st.street AS street_name, sc.size AS size_name
        FROM memberplot mp
        LEFT JOIN members m ON (m.id = mp.member_id)
        LEFT JOIN plots p ON (p.id = mp.plot_id)
        LEFT JOIN sectors sec ON (sec.id = p.sector)
        LEFT JOIN streets st ON (st.id = p.street_id)
        LEFT JOIN size_cat sc ON (sc.id = p.size2)
        WHERE mp.id = '". $rowemp['ref'] ."'";
        $member_detail_cmd = $conn->query($member_detail_sql);
        $member_detail_res = $member_detail_cmd->fetch_assoc();
        
        $name = $rowemp['name'] . ', Plot-' . $member_detail_res['plot_detail_address'] . ', ' . $member_detail_res['sector_name'] . ', ' . $member_detail_res['street_name'] . ', (' . ucwords($member_detail_res['size_name']) . ')';
    }
    if ($row['vtype'] == 1 or $row['vtype'] == 2)
    {
        $name = $row['ahid'];
    }

    $sql2 = "SELECT * FROM transaction 
            LEFT JOIN employee ON (transaction.user_id=employee.id)
            WHERE transaction.id='" . $_REQUEST['id'] . "'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    // print_r($row2); exit;

    $sql2v = "SELECT * FROM payment 
              LEFT JOIN accounts ON (payment.referanceid=accounts.id) 
              WHERE payment.pfor=1 AND payment.vid='" . $_REQUEST['id'] . "' ORDER BY amount1 ASC";
    $result2v = $conn->query($sql2v);

    $sql2v1 = "SELECT * FROM payment 
			   LEFT JOIN accounts ON (payment.referanceid=accounts.id) 
			   WHERE payment.pfor=1 AND payment.vid='" . $_REQUEST['id'] . "'";
    $result2v1 = $conn->query($sql2v1);


    $jo = '';
    $ref = '';
    if ($row['pttype'] == 2)
    {
        $jo = 'Left join mainpurchase on(payment.referanceid=mainpurchase.id)';
    }
    if ($row['pttype'] == 3)
        {
        $jo = 'Left join mainsale on(payment.referanceid=mainsale.id)';
    }
    $sql1 = "SELECT *,payment.amount AS pam FROM payment $jo WHERE payment.vid='" . $_REQUEST['id'] . "'";
    $result1 = $conn->query($sql1);

    $jo = '';
    $ref = '';
    if ($row['pttype'] == 2)
    {
        $jo = 'Left join mainpurchase on(payment.referanceid=mainpurchase.id)';
    }
    if ($row['pttype'] == 3)
            {
        $jo = 'Left join mainsale on(payment.referanceid=mainsale.id)';
    }
    $sql2 = "SELECT *,payment.amount AS pam FROM payment $jo WHERE payment.vid='" . $_REQUEST['id'] . "'";
    $result2 = $conn->query($sql2);

    $jo = '';
    $ref = '';
    if ($row['pttype'] == 2)
    {
        $jo = 'Left join mainpurchase on(payment.referanceid=mainpurchase.id)';
    }
    if ($row['pttype'] == 3)
    {
        $jo = 'Left join mainsale on(payment.referanceid=mainsale.id)';
    }
    $sql3 = "SELECT *,payment.amount AS pam FROM payment $jo WHERE payment.vid='" . $_REQUEST['id'] . "'";
    $result3 = $conn->query($sql3);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Transaction</title>
        <link rel='stylesheet' type='text/css' href='css/style.css' />
        <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    </head>

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
                    <div style="width:52%;float: left; margin-top: 15px; padding-bottom: 15px;">
                        <p style="font-size: 22px;"> <?php echo $s['companyname']; ?> </p>
                        <p style="font-size: 15px;"> <?php echo $resultpr3['project_address']; ?> </p>
                        <p style="font-size: 15px;">
                            <b>
                                <?php
                                    if ( $resultt['main_type'] == 1 ) {
                                        echo 'Sales Quote';
                                    } else if ( $resultt['main_type'] == 2 ) {
                                        echo 'Purchase Quote';
                                    }
                                ?>
                            </b>
                        </p>
                    </div>
                    <div style="width:28%;float: left;margin-top: 15px; padding-bottom: 15px;"> <span> Quota/Order/Invoice # : </span>
                        <span style="color:#999;"><?php echo $row['vno']; ?></span>
                        <hr />
                        <span> Dated : </span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($row['tdate'])); ?></span>
                        <hr />
                        <span> Amount :</span>
                        <span style="color:#999;"><?php echo $row['amount']; ?></span>
                        <hr />
                    </div>
                </div>
                </br></br>
                <div style="clear:both;"></div>
                <div> 
                    <span> Name :</span>
                    <span style="color:#999;">Supplier Name</span>
                    <hr />
                    <span>Account :</span>
                    <span style="color:#999;">Account Name...</span>
                    <hr />
                </div>
                <div>
                    <div style="width:50%;float: left;">
                        <span>Company :</span>
                        <span style="color:#999;">Company</span>
                        <hr style="width: 97%;" />
                    </div>
                    <div style="width:50%; float: right;">
                        <span>Contact # :</span>
                        <span style="color:#999;">Phone Number</span>
                        <hr />
                    </div>
                </div>
                <?php if ( isset($row2['cheque_no']) && !empty($row2['cheque_no']) ) { ?>
                    <div style="clear:both;"></div>
                    <div id="customer-title" style="margin-left: 0px; margin-top: 5px; width: 300px;"> <span >
                        <span > Instrument # : </span>
                        <span style="color:#999;"><?php echo $row['cheque_no']; ?></span>
                        <hr/>
                    </div>
                    <div id="meta" style="margin-left: 20px; margin-top: 5px;">
                        <span > Instrument Date :</span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($row2['cheque_date'])); ?></span>
                        <hr/>
                    </div>
                <?php } ?>
                <div>
                    <div style="clear:both"></div>
                    <table id="items" style="margin: 15px 0 0 0;">
                        <tr>
                            <th style="text-align:left;">S #</th>
                            <th style="text-align:left;">Item</th>
                            <th style="text-align:left;">Cost/Unit</th>
                            <th style="text-align:left;">Quantity</th>
                            <th style="text-align:left;">Narration</th>
                            <th style="text-align:right;">Total Price</th>
                        </tr>
                        <?php
                            $i = 0;
                            $td = 0;
                            $tc = 0;
                            while ($row2v = $result2v->fetch_assoc())
                            {
                                $i = $i + 1;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row2v['code']; ?></td>
                            <td><?php echo $row2v['name']; ?></td>
                            <td><?php echo $row2v['remarks']; ?></td>
                            <td align="right"><?php echo number_format($row2v['amount'], 2) ?></td>
                            <td align="right"><?php echo number_format($row2v['amount1'], 2) ?></td>
                            <?php
                                $td = $td + $row2v['amount'];
                                $tc = $tc + $row2v['amount1'];
                            ?>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="4" style="text-align: center;"><b>Total</b></td>
                            <!-- <td></td>
                            <td></td>
                            <td></td> -->
                            <td class="total-value" align="right"><?php echo number_format($td, 2); ?></td>
                            <td class="total-value" align="right"><?php echo number_format($tc, 2); ?></td>
                        </tr>
                    </table>
                    <div style="clear:both"></div>
                    <div style="margin-top: 1%;">
                        <p style="font-size: 12px;">
                            <?php
                                $sql2m = "SELECT * FROM employee WHERE id='" . $_REQUEST['mem'] . "'";
                                $result2m = $conn->query($sql2m);
                                $mem = $result2m->fetch_assoc();
                            ?>
                        </p>
                        &nbsp;&nbsp; Print Date: <b><?php echo date('d-M-y'); ?></b>
                        <br><br>
                        <table style="  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
                            <tr>
                                <!-- position: absolute; left: 23%; width: 9%; -->
                                <th style="border: none;text-align:center; border-bottom: 2px solid #000000;"><?php echo $row2['name'] ?></th>
                                <th style="border: none;text-align:center;">____________</th>
                                <th style="border: none;text-align:center;">____________</th>
                                <th style="border: none;text-align:center;">____________</th>
                            </tr>
                            <tr>
                                <td style="border: none;text-align:center;">Prepared by</td>
                                <td style="border: none;text-align:center;">Checked By</td>
                                <td style="border: none;text-align:center;">Approved by</td>
                                <td style="border: none;text-align:center;"> Received by</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr style="margin:5px 0px;" />
            </div>
        </div>
    </body>
</html>

<?php
    function Word($num)
    {
        $num    = (string) ((int) $num);
        if ((int) ($num) && ctype_digit($num))
        {
            $words  = array();
            $num    = str_replace(array(',', ' '), '', trim($num));
            $list1  = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
            $list2  = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
            $list3  = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion', 'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion');
            $num_length = strlen($num);
            $levels = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num    = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);
            foreach ($num_levels as $num_part)
            {
                $levels--;
                $hundreds   = (int) ($num_part / 100);
                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
                $tens = (int) ($num_part % 100);
                $singles = '';
                if ($tens < 20)
                {
                    $tens   = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                }
                else
                {
                    $tens   = (int) ($tens / 10);
                    $tens   = ' ' . $list2[$tens] . ' ';
                    $singles    = (int) ($num_part % 10);
                    $singles    = ' ' . $list1[$singles] . ' ';
                }
                $words[]    = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1)
            {
                $commas = $commas - 1;
            }
            $words  = implode(' ', $words);
            return $words . ' Only';
        }
        else if (!((int) $num))
        {
            return 'Zero';
        }

        return '';
    }
?>