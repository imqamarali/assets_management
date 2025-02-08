<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Transaction</title>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
</head>

<body style="background-color: aliceblue;">

    <?php
    include "../db.php";

    $sqlmem = "SELECT * from transaction 
	where id='" . $_REQUEST['id'] . "'";
    $resultmem = $conn->query($sqlmem);
    $rowmem = $resultmem->fetch_assoc();

    $sqlmemt = "SELECT * from plot_reserved_main 
	where trans_id='" . $_REQUEST['id'] . "'";
    $resultmemt = $conn->query($sqlmemt);
    $rowmemt = $resultmemt->fetch_assoc();

    $ref = '';
    $name = '';
    $token_detail = '';
    if (isset($rowmemt['id']) && $rowmemt['id'] > 0) {
        $sql_td = "SELECT * from plot_reserved 
        Left Join plots ON (plots.id=plot_reserved.plot_id)
        Left Join size_cat ON (size_cat.id=plots.size2)
        Left Join streets ON (streets.id=plots.street_id)
        Left Join sectors ON (sectors.id=plots.sector)
        WHERE plot_reserved.mid='" . $rowmemt['id'] . "'";
        $result_td = $conn->query($sql_td);
        $row_td = $result_td->fetch_assoc();

        $token_detail = $row_td['plot_detail_address'] . ' , ' . $row_td['sector_name'] . ' , ' . $row_td['street'] . '  , (' . $row_td['size'] . ')';
    }

    $sqlmemt1 = "SELECT * from payment
	Left Join plot_reserved_main  ON (plot_reserved_main.id=payment.msno)
	where payment.vid='" . $_REQUEST['id'] . "' AND amount>0";
    $resultmemt1 = $conn->query($sqlmemt1);
    $rowmemt1 = $resultmemt1->fetch_assoc();

    if ($rowmemt1['id'] > 0) {
        $sql_td = "SELECT * from plot_reserved 
        Left Join plots ON (plots.id=plot_reserved.plot_id)
        Left Join size_cat ON (size_cat.id=plots.size2)
        Left Join streets ON (streets.id=plots.street_id)
        Left Join sectors ON (sectors.id=plots.sector)
        WHERE plot_reserved.mid='" . $rowmemt1['id'] . "'";
        $result_td = $conn->query($sql_td);
        $row_td = $result_td->fetch_assoc();

        $token_detail = $row_td['plot_detail_address'] . ' , ' . $row_td['sector_name'] . ' , ' . $row_td['street'] . '  , (' . $row_td['size'] . ') ' . $rowmemt1['rno'];
    }

    if ($rowmem['status_type'] == 6) //Token
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	LEFT JOIN plot_reserved_main ON payment.msno = plot_reserved_main.id 
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
        $row_to = $result_to->fetch_assoc();

        $ref = $row_to['rno'];
        $name = $row_to['name'];
    }
    if ($rowmem['status_type'] == 7) //Adjustment
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
        $row_to = $result_to->fetch_assoc();

        $name = $row_to['name'];
    }
    if ($rowmem['status_type'] == 8) //Transfer
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	LEFT JOIN memberplot ON accounts.ref = memberplot.id 
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
        $row_to = $result_to->fetch_assoc();

        $ref = $row_to['plotno'];
        $name = $row_to['name'];
    }

    $sql_from = "SELECT *,accounts.type as actype from payment 
    LEFT JOIN accounts ON payment.referanceid = accounts.id
    left JOIN memberplot ON accounts.ref = memberplot.id
    Left Join plots ON (plots.id=memberplot.plot_id)
    Left Join size_cat ON (size_cat.id=plots.size2)
    Left Join streets ON (streets.id=plots.street_id)
    Left Join sectors ON (sectors.id=streets.sector_id)
    WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount1>0";
    $result_from = $conn->query($sql_from);


    $sqlmem1 = "SELECT * FROM employee
	WHERE id='" . $_REQUEST['mem'] . "'";
    $resultmem1 = $conn->query($sqlmem1);
    $rowmem1  = $resultmem1->fetch_assoc();

    $sqlmem2 = "SELECT * FROM employee
	WHERE id='" . $rowmem['user_id'] . "'";
    $resultmem2 = $conn->query($sqlmem2);
    $rowmem2  = $resultmem2->fetch_assoc();
    $sql = "SELECT *,accounts.name AS bname, transaction.create_date AS tdate FROM transaction 
			LEFT JOIN accounts ON (accounts.id = transaction.bank_id)
			WHERE transaction.id = '" . $_REQUEST['id'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>

    <div id="page-wrap" style="background-color:#FFFFFF;width:800px !important;page-break-after: always;">
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
                                    if ($row['vtype'] == 1)
                                    {
                                        echo 'Cash Payment Voucher';
                                    }
                                    if ($row['vtype'] == 2)
                                    {
                                        echo 'Bank Payment Voucher';
                                    }
                                    if ($row['vtype'] == 3)
                                    {
                                        echo 'Cash Reciept Voucher';
                                    }
                                    if ($row['vtype'] == 4)
                                    {
                                        echo 'Bank Reciept Voucher';
                                    }
                                    if ($row['vtype'] == 5)
                                    {
                                        echo 'Adjustment Voucher';
                                    }
                                ?>
                                -- Customer Copy
                            </b>
                        </p>
                    </div>
                    <div style="width:20%;float: left;margin-top: 15px; padding-bottom: 15px;"> <span> Voucher # : </span>
                        <span style="color:#999;"><?php echo $row['vno']; ?></span>
                        <hr />
                        <span> Dated : </span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($row['tdate'])); ?></span>
                        <hr />
                        <span> Amount :</span>
                        <span style="color:#999;"><?php echo $row['amount']; ?></span>
                        <hr />
                    </div>
        <!-- <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;"><b style="
    margin-left: 24px;
">Customer Copy</b></div> -->
        <style>
            table td,
            table th {
                border: 0px;
            }
            
            .cg_table td,
            .cg_table th {
                border: 1px solid !important;
            }

            #page-wrap {
                width: 55%;
            }
        </style>
        <div style="clear:both"></div>
        <div id="customer">
            <!-- <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                <span> Voucher # : </span> <span style="color:#999;"><?php //echo $rowmem['vno']; ?></span>
                <hr>
            </div>

            <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                <span> Dated : </span> <span style="color:#999;"><?php //echo date("d M Y", strtotime($rowmem['create_date'])); ?></span>
                <hr>
            </div> -->
            <div style="clear:both"></div>
            <?php if (!empty($token_detail)) { ?>
                <table id="items" style="margin-left:50px;width:90%;">
                    <tr>
                        <th colspan="5">
                            <h3>Token Detail</h3>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;">Address</th>
                    </tr>
                    <tr>
                        <td><?php echo $token_detail; ?></td>
                    </tr>
                </table>
            <?php } ?>
            <table id="items" class="cg_table" style="width:100%;">
                <tr>
                    <th colspan="5">
                        <h3>Paid To Detail</h3>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;">S No.</th>
                    <th style="text-align:left;">Paid To</th>
                    <th style="text-align:left;">Narration</th>
                    <th style="text-align:left;">Dated</th>
                    <th style="text-align:left;">Amount</th>
                </tr>
                <?php while ($row_from = $result_from->fetch_assoc()) { ?>
                    <tr>
                        <td>1</td>
                        <?php if ($row_from['actype'] == 1) { ?>
                            <td><?php echo $row_from['plotno'] . ' , ' . $row_from['type'] . '-' . $row_from['plot_detail_address'] . ' , ' . $row_from['sector_name'] . ' , ' . $row_from['street'] . '  , (' . $row_from['size'] . ')'; ?></td>
                        <?php } else { ?>
                            <td><?php echo $row_from['name']; ?></td>
                        <?php } ?>
                        <td><?php echo $rowmem['remarks']; ?></td>
                        <td><?php echo $row_from['date']; ?></td>
                        <td><?php echo number_format($row_from['amount1'], 0); ?></td>
                    </tr>
                <?php } ?>
            </table>

            </br></br></br></br>
            <div style="clear:both"></div>
            <table style="width:100%;">
                <tr>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Prepared By: <?php echo $rowmem2['name'] ?></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Accounts Manager:</br></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Authorized By:</br></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Received By:</br></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi");
                                                                echo $rowmem1['name'] . ' || Dated: ' . date("d-M-Y H:i A") ?></b>
                    </td>
                </tr>
            </table>
        </div>
        <hr style="margin:5px 0px;" />
    </div>



    <?php
    include "../db.php";

    $sqlmem = "SELECT * from transaction 
	where id='" . $_REQUEST['id'] . "'";
    $resultmem = $conn->query($sqlmem);
    $rowmem = $resultmem->fetch_assoc();

    $ref = '';
    $name = '';

    if ($rowmem['status_type'] == 6) //Token
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	LEFT JOIN plot_reserved_main ON payment.msno = plot_reserved_main.id 
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
        $row_to = $result_to->fetch_assoc();

        $ref = $row_to['rno'];
        $name = $row_to['name'];
    }
    if ($rowmem['status_type'] == 7) //Adjustment
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
        $row_to = $result_to->fetch_assoc();

        $name = $row_to['name'];
    }
    if ($rowmem['status_type'] == 8) //Transfer
    {
        $sql_to = "SELECT * from payment 
    	LEFT JOIN accounts ON payment.referanceid = accounts.id
    	LEFT JOIN memberplot ON accounts.ref = memberplot.id 
    	WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount>0";
        $result_to = $conn->query($sql_to);
    }

    $sql_from = "SELECT *,accounts.type as actype from payment 
    LEFT JOIN accounts ON payment.referanceid = accounts.id
    left JOIN memberplot ON accounts.ref = memberplot.id
    Left Join plots ON (plots.id=memberplot.plot_id)
    Left Join size_cat ON (size_cat.id=plots.size2)
    Left Join streets ON (streets.id=plots.street_id)
    Left Join sectors ON (sectors.id=streets.sector_id)
    WHERE payment.vid='" . $_REQUEST['id'] . "'  AND pfor=1 AND payment.amount1>0";
    $result_from = $conn->query($sql_from);


    $sqlmem1 = "SELECT * FROM employee
	WHERE id='" . $_REQUEST['mem'] . "'";
    $resultmem1 = $conn->query($sqlmem1);
    $rowmem1  = $resultmem1->fetch_assoc();

    $sqlmem2 = "SELECT * FROM employee
	WHERE id='" . $rowmem['user_id'] . "'";
    $resultmem2 = $conn->query($sqlmem2);
    $rowmem2  = $resultmem2->fetch_assoc();


    ?>

    <div id="page-wrap" style="background-color:#FFFFFF;width:768px !important;page-break-after: always;">
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
                                        if ($row['vtype'] == 1)
                                        {
                                            echo 'Cash Payment Voucher';
                                        }
                                        if ($row['vtype'] == 2)
                                        {
                                            echo 'Bank Payment Voucher';
                                        }
                                        if ($row['vtype'] == 3)
                                        {
                                            echo 'Cash Reciept Voucher';
                                        }
                                        if ($row['vtype'] == 4)
                                        {
                                            echo 'Bank Reciept Voucher';
                                        }
                                        if ($row['vtype'] == 5)
                                        {
                                            echo 'Adjustment Voucher';
                                        }
                                    ?>
                                    -- Office Copy
                                </b>
                            </p>
                        </div>
                        <div style="width:20%;float: left;margin-top: 15px; padding-bottom: 15px;"> <span> Voucher # : </span>
                            <span style="color:#999;"><?php echo $row['vno']; ?></span>
                            <hr />
                            <span> Dated : </span>
                            <span style="color:#999;"><?php echo date("d M Y", strtotime($row['tdate'])); ?></span>
                            <hr />
                            <span> Amount :</span>
                            <span style="color:#999;"><?php echo $row['amount']; ?></span>
                            <hr />
                        </div>
        <!-- <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;"><b style="
    margin-left: 24px;
">Office Copy</b></div> -->
        <style>
            table td,
            table th {
                border: 0;
            }

            #page-wrap {
                width: 55%;
            }
        </style>
        <div style="clear:both"></div>
        <div id="customer">
            <!-- <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                <span> Voucher # : </span> <span style="color:#999;"><?php //echo $rowmem['vno']; ?></span>
                <hr>
            </div>

            <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                <span> Dated : </span> <span style="color:#999;"><?php //echo date("d M Y", strtotime($rowmem['create_date'])); ?></span>
                <hr>
            </div> -->


            <div style="clear:both"></div>

            <!-- <table id="items" style="margin-left:50px;width:90%;"></table> -->
            <!-- <table id="items" style="margin-left:50px;width:90%;">
                <tr>
                    <th colspan="5">
                        <h3>Paid From Detail</h3>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;">S No.</th>
                    <th style="text-align:left;">Paid From</th>
                    <th style="text-align:left;">Narration</th>
                    <th style="text-align:left;">Dated</th>
                    <th style="text-align:left;">Amount</th>
                </tr>
                <?php //while ($row_to = $result_to->fetch_assoc()) {
                    //$ref = $row_to['plotno'];
                    //$name = $row_to['name']; ?>
                    <tr>
                        <td>1</td>
                        <td><?php //echo $name . ' ' . $ref; ?></td>
                        <td><?php //echo $rowmem['remarks']; ?></td>
                        <td><?php //echo $row_to['date']; ?></td>
                        <td><?php //echo number_format($row_to['amount'], 0); ?></td>
                    </tr>
                <?php //} ?>

            </table> -->
            <table id="items" class="cg_table" style="width:100%;">
                <tr>
                    <th colspan="5">
                        <h3>Paid To Detail</h3>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;">S No.</th>
                    <th style="text-align:left;">Paid To</th>
                    <th style="text-align:left;">Narration</th>
                    <th style="text-align:left;">Dated</th>
                    <th style="text-align:left;">Amount</th>
                </tr>
                <?php while ($row_from = $result_from->fetch_assoc()) { ?>
                    <tr>
                        <td>1</td>
                        <?php if ($row_from['actype'] == 1) { ?>
                            <td><?php echo $row_from['plotno'] . ' , ' . $row_from['type'] . '-' . $row_from['plot_detail_address'] . ' , ' . $row_from['sector_name'] . ' , ' . $row_from['street'] . '  , (' . $row_from['size'] . ')'; ?></td>
                        <?php } else { ?>
                            <td><?php echo $row_from['name']; ?></td>
                        <?php } ?>
                        <td><?php echo $rowmem['remarks']; ?></td>
                        <td><?php echo $row_from['date']; ?></td>
                        <td><?php echo number_format($row_from['amount1'], 0); ?></td>
                    </tr>
                <?php } ?>
            </table>

            </br></br></br></br>
            <div style="clear:both"></div>
            <table style="width:100%;">
                <tr>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Prepared By: <?php echo $rowmem2['name'] ?></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Accounts Manager:</br></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Authorized By:</br></b>
                    </td>
                    <td style="text-align: center;"> ____________________<br>
                        <br>
                        <b style="font-size:14px;">Received By:</br></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi");
                                                                echo $rowmem1['name'] . ' || Dated: ' . date("d-M-Y H:i A") ?></b>
                    </td>
                </tr>
            </table>
        </div>
        <hr style="margin:5px 0px;" />
    </div>


</body>

</html>
<?php
function Word($num)
{
    $num    = (string) ((int) $num);
    if ((int) ($num) && ctype_digit($num)) {
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
        foreach ($num_levels as $num_part) {
            $levels--;
            $hundreds   = (int) ($num_part / 100);
            $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
            $tens = (int) ($num_part % 100);
            $singles = '';
            if ($tens < 20) {
                $tens   = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens   = (int) ($tens / 10);
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = (int) ($num_part % 10);
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
        }
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        $words  = implode(' ', $words);
        return $words . ' Only';
    } else if (!((int) $num)) {
        return 'Zero';
    }

    return '';
}
?>