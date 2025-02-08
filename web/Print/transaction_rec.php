<?php
    include "../db.php";
    $sqlmem = "SELECT *,accounts.name AS aname, members.name AS memname, accounts.id AS acid, transaction.remarks AS premarks,
                transaction.id AS prid, transaction.create_date AS tdate, transaction.user_id AS usid,
                accounts.type AS actype FROM transaction

                LEFT JOIN accounts ON (transaction.pt_id = accounts.id)  
                LEFT JOIN memberplot ON (accounts.ref = memberplot.id)
                LEFT JOIN members ON (members.id = memberplot.member_id) 
                LEFT JOIN plots ON (plots.id = memberplot.plot_id)
                LEFT JOIN size_cat ON (size_cat.id = plots.size2)
                LEFT JOIN streets ON (streets.id = plots.street_id)
                LEFT JOIN sectors ON (sectors.id = streets.sector_id)
  				WHERE transaction.id = '" . $_REQUEST['id'] . "'";
    $resultmem = $conn->query($sqlmem);
    $rowmem = $resultmem->fetch_assoc();
    // print_r($rowmem); exit;
    if ($rowmem['actype'] == 2)
    {
        $sqls = "SELECT * FROM supplier
                LEFT JOIN accounts ON (accounts.ref = supplier.id)
                WHERE accounts.id = '" . $rowmem['pt_id'] . "'";
        $results = $conn->query($sqls);
        $rowmems  = $results->fetch_assoc();
    }
    $sql2v = "SELECT * FROM payment 
              LEFT JOIN accounts ON (payment.referanceid = accounts.id) 
              WHERE payment.pfor = 1 AND payment.vid = '" . $_REQUEST['id'] . "' AND amount1>0";
    $result2v = $conn->query($sql2v);

    $sqlmem1 = "SELECT * FROM employee WHERE id='" . $_REQUEST['mem'] . "'";
    $resultmem1 = $conn->query($sqlmem1);
    $rowmem1  = $resultmem1->fetch_assoc();

    $sqlmem2 = "SELECT * FROM employee WHERE id='" . $rowmem['usid'] . "'";
    $resultmem2 = $conn->query($sqlmem2);
    $rowmem2  = $resultmem2->fetch_assoc();

    $sql2v11 = "SELECT sum(payment.amount) ,sum(payment.amount1)  FROM payment 
                LEFT JOIN payment p1 ON (payment.sid = p1.id)
                LEFT JOIN accounts ON (payment.referanceid = accounts.id) 
                WHERE payment.sid>0 AND payment.referanceid='" . $rowmem['acid'] . "' AND payment.remarks!='Discount' AND (p1.party = '' or p1.party IS NULL) AND (payment.party = '' or payment.party IS NULL)";
    $result2v11 = $conn->query($sql2v11);
    $rowmem11 = $result2v11->fetch_assoc();

    $sql2v111 = "SELECT sum(payment.amount), sum(payment.amount1)  FROM payment 
                LEFT JOIN payment p1 ON (payment.sid = p1.id)
                LEFT JOIN accounts ON (payment.referanceid = accounts.id) 
                WHERE payment.pfor = 2 AND  payment.referanceid='" . $rowmem['acid'] . "' AND payment.remarks!='Discount' AND (p1.party = '' or p1.party IS NULL) AND (payment.party = '' or payment.party IS NULL)";
    $result2v111 = $conn->query($sql2v111);
    $rowmem111 = $result2v111->fetch_assoc();

    $sql = "SELECT *,accounts.name AS bname, transaction.create_date AS tdate FROM transaction 
			LEFT JOIN accounts ON (accounts.id = transaction.bank_id)
			WHERE transaction.id = '" . $_REQUEST['id'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

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
        <div id="page-wrap" style="background-color:#FFFFFF;width:800px !important;page-break-after:always;">
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
                    <!-- <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;background-color: black;color: white;padding: 5px;">
                        <b style=" margin-left: 24px;">Customer Copy</b>
                    </div> -->
                    <style>
                        table td,
                        table th {
                            border: 0;
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
                        <div style="margin-top: 5px; width: 100%; display: inline-block;">
                            <span> Received with thanks from : </span>
                            <span style="color:#999;">
                            <?php
                                if (!empty($rowmem['memname'] && $rowmem['actype'] == 1))
                                {
                                    echo $rowmem['memname'] . ' ( ' . $rowmem['cnic'] . ' )';
                                }
                                else
                                {
                                    echo $rowmem['aname'];
                                }
                            ?>
                            </span>
                            <hr>
                        </div>

                        <div style="clear:both"></div>
                        <?php if ($rowmem['actype'] == 1) { ?>
                            <div style="margin-top: 7px; width: 29%; display: inline-block;">
                                <span> MS # : </span> <span style="color:#999;"><?= $rowmem['plotno']; ?></span>
                                <hr>
                            </div>
                        <?php  } ?>
                        <div style="margin-left: 309px; margin-top: 7px; width: 30%; display: inline-block;">
                            <?php
                            $ph = '';
                            if ($rowmem['actype'] == 2)
                            {
                                $ph = $rowmems['contactno'];
                            }
                            else
                            {
                                if (!empty($rowmem['phone']))
                                {
                                    $ph = $rowmem['phone'];
                                }
                                else if ( !empty($rowmem['phone1']) )
                                {
                                    $ph = $rowmem['phone1'];
                                }
                            }
                            ?>
                            <?php if ($ph != ''){ ?>
                            <span>Cell # :</span> <span style="color:#999;"><?= $ph; ?></span>
                            <hr>
                            <?php } ?>
                        </div>
                        <div style="clear:both"></div>

                        <table id="items" class="cg_table" style="width:100%;">
                            <tr>
                                <th style="text-align:left;">S No.</th>
                                <th style="text-align:left;">Instruments</th>
                                <th style="text-align:left;">Narration</th>
                                <th style="text-align:left;">Due Date</th>
                                <th style="text-align:left;">Cheque #</th>
                                <th style="text-align:left;">Dated</th>
                                <th style="text-align:right;">Amount</th>
                            </tr>
                            <?php
                                $i = 0; $td = 0; $tc = 0;
                                while ($row2v = $result2v->fetch_assoc())
                                {
                                    $i = $i + 1;
                                    $cdate = '';

                                    $sql2vdd = "SELECT * FROM payment WHERE id='" . $row2v['sid'] . "'";
                                    $result2vdd = $conn->query($sql2vdd);
                                    $row2vdd = $result2vdd->fetch_assoc();

                                    if (!empty($rowmem['cheque_no']))
                                    {
                                        $cdate = $rowmem['cheque_date'];
                                    }
                            ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>
                                        <?php
                                            if ($rowmem['vtype'] == 1 || $rowmem['vtype'] == 3)
                                            {
                                                echo 'Cash';
                                            }
                                            else if ($rowmem['vtype'] == 2 || $rowmem['vtype'] == 4)
                                            {
                                                echo 'Online';
                                            }
                                            else
                                            {
                                                echo 'Adjustment';
                                            }
                                        ?>
                                    </td>
                                    <td><?= ucwords($rowmem['premarks']); ?></td>
                                    <td><?= (!empty($row2vdd['date'])?$row2vdd['date']:''); ?></td>
                                    <td><?= $rowmem['cheque_no']; ?></td>
                                    <td><?= $cdate; ?></td>
                                    <td align="right"><?= number_format(($row2v['amount'] + $row2v['amount1']), 2) ?></td>
                                    <?php $td = $td + $row2v['amount'];
                                    $tc = $tc + $row2v['amount1']; ?>
                                </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td colspan="6" align="center"><b>Total</b></td>
                                <td class="total-value" align="right"><?= number_format(($tc + $td), 2); ?></td>
                            </tr>
                        </table>
                        <br>

                        <div id="customer-title" style="text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;">
                            <span>Amount: </span>
                            <span style="color:#999;"><?= number_format($rowmem['amount'], 0); ?></span>
                        </div>
                        <br>

                        <div id="customer-title" style="text-decoration: underline;margin-top: -1%;">
                            <span>Amount In Words: </span>
                            <span style="color:#999;"><?= ucwords(Word($rowmem['amount'])); ?></span>
                        </div>
                        <br>

                        <?php
                            if ($rowmem['actype'] == 1)
                            {
                        ?>
                                <div style="margin-top:5px;width:25%;display: inline-block;">
                                    <span> Net Amount : </span>
                                    <span style="color:#999;"><?= number_format($rowmem111['sum(payment.amount)']); ?></span>
                                    <hr>
                                </div>

                                <div style="margin-left: 89px;margin-top:5px;width:25%;display: inline-block;">
                                    <span> Net Received: </span>
                                    <span style="color:#999;"><?= number_format($rowmem11['sum(payment.amount1)']); ?></span>
                                    <hr>
                                </div>

                                <div style="margin-left: 90px;margin-top:5px;width:25%;display: inline-block;">
                                    <span>Balance :</span> <span style="color:#999;"><?= number_format($rowmem111['sum(payment.amount)'] - $rowmem11['sum(payment.amount1)']); ?></span>
                                    <hr>
                                </div>
                        <?php
                            }
                        ?>
                        <br><br><br>

                        <?php
                            if ($rowmem['actype'] == 1)
                            {
                        ?>
                            <div id="customer-title" style="text-decoration: underline;margin-top: -1%;">
                                <span>Payment Of: </span>
                                <span style="color:#999;">(<?= $rowmem['type'] . '-' . $rowmem['plot_detail_address'] . ' , ' . $rowmem['sector_name'] . ' , ' . $rowmem['street']; ?>)</span>
                            </div>
                            <br><br><br><br>
                        <?php
                            }
                        ?>
                        <div style="clear:both"></div>
                        <table style="width:100%;">
                            <tr>
                                <td style="text-align: center;"> <u><?= $rowmem2['name'] ?></u><br>
                                    <br>
                                    <b style="font-size:14px;">Prepared By: </b>
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
                </div>
                <hr style="width: 104%; margin-left: -16px; margin-top: 10px;">

                <!-- Second Copy Start -->
                <?php
                    include "../db.php";
                    $sqlmem = "SELECT *,accounts.name AS aname, members.name AS memname, accounts.id AS acid,
                                transaction.remarks AS premarks, transaction.id AS prid, transaction.create_date AS tdate,
                                transaction.user_id AS usid, accounts.type AS actype FROM transaction

                                LEFT JOIN accounts ON (transaction.pt_id = accounts.id)  
                                LEFT JOIN memberplot ON (accounts.ref = memberplot.id)
                                LEFT JOIN members ON (members.id = memberplot.member_id) 
                                LEFT JOIN plots ON (plots.id = memberplot.plot_id)
                                LEFT JOIN size_cat ON (size_cat.id = plots.size2)
                                LEFT JOIN streets ON (streets.id = plots.street_id)
                                LEFT JOIN sectors ON (sectors.id = streets.sector_id)
                                WHERE transaction.id = '" . $_REQUEST['id'] . "'";
                    $resultmem = $conn->query($sqlmem);
                    $rowmem = $resultmem->fetch_assoc();

                    $sql2v = "SELECT * FROM payment 
                              LEFT JOIN accounts ON (payment.referanceid = accounts.id) 
                              WHERE payment.pfor = 1 AND payment.vid='" . $_REQUEST['id'] . "' AND amount1>0";
                    $result2v = $conn->query($sql2v);

                    $sqlmem1 = "SELECT * FROM employee WHERE id = '" . $_REQUEST['mem'] . "'";
                    $resultmem1 = $conn->query($sqlmem1);
                    $rowmem1  = $resultmem1->fetch_assoc();

                    $sqlmem2 = "SELECT * FROM employee WHERE id = '" . $rowmem['usid'] . "'";
                    $resultmem2 = $conn->query($sqlmem2);
                    $rowmem2  = $resultmem2->fetch_assoc();
                ?>

                <div id="page-wrap" style="background-color:#FFFFFF; width:768px !important;">
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
                        <!-- <div id="customer-title" style="float: right;font-size: 18px;margin-right: 4px;margin-top: 10px;
                                                        background-color: black;color: white;padding: 5px;">
                            <b style="margin-left: 24px;">Office Copy</b>
                        </div> -->

                        <style>
                            table td, table th {
                                border: 0;
                            }
                            #page-wrap {
                                width: 55%;
                            }
                        </style>
                        <div style="clear:both"></div>
                        <div id="customer">
                            <div style="margin-top: 5px; width: 100%; display: inline-block;">
                                <span> Received with thanks from : </span>
                                <span style="color:#999;">
                                <?php
                                    if (!empty($rowmem['memname'] && $rowmem['actype'] == 1))
                                    {
                                        echo $rowmem['memname'] . ' ( ' . $rowmem['cnic'] . ' )';
                                    }
                                    else
                                    {
                                        echo $rowmem['aname'];
                                    }
                                ?>
                                </span>
                                <hr>
                            </div>
                            <div style="clear:both"></div>
                            <?php
                                if ($rowmem['actype'] == 1)
                                {
                            ?>
                                    <div style="margin-top:7px; width:29%;display: inline-block;">
                                        <span> MS # : </span> <span style="color:#999;"><?= $rowmem['plotno']; ?></span>
                                        <hr>
                                    </div>
                            <?php
                                }
                            ?>
                            <div style="margin-left: 309px; margin-top: 7px; width: 30%; display: inline-block;">
                                <?php
                                    $ph = '';
                                    if ($rowmem['actype'] == 2)
                                    {
                                        $ph = $rowmems['contactno'];
                                    }
                                    else
                                    {
                                        if (!empty($rowmem['phone']))
                                        {
                                            $ph = $rowmem['phone'];
                                        }
                                        else if ( !empty($rowmem['phone1']) )
                                        {
                                            $ph = $rowmem['phone1'];
                                        }
                                    }
                                ?>
                                <?php if ($ph != '') { ?> 
                                <span>Cell # :</span> <span style="color:#999;"><?= $ph; ?></span>
                                <hr>
                                <?php } ?>
                            </div>
                            <div style="clear:both"></div>            

                            <table id="items" class="cg_table" style="width: 100%;">
                                <tr>
                                    <th style="text-align:left;">S No.</th>
                                    <th style="text-align:left;">Instruments</th>
                                    <th style="text-align:left;">Narration</th>
                                    <th style="text-align:left;">Due Date</th>
                                    <th style="text-align:left;">Cheque #</th>
                                    <th style="text-align:left;">Dated</th>
                                    <th style="text-align:right;">Amount</th>
                                </tr>
                                <?php
                                    $i = 0; $td = 0; $tc = 0;
                                    while ($row2v = $result2v->fetch_assoc())
                                    {
                                        $i = $i + 1;
                                        $cdate = '';

                                        $sql2vdd = "SELECT * FROM payment WHERE id = '" . $row2v['sid'] . "'";
                                        $result2vdd = $conn->query($sql2vdd);
                                        $row2vdd = $result2vdd->fetch_assoc();

                                        if (!empty($rowmem['cheque_no']))
                                        {
                                            $cdate = $rowmem['cheque_date'];
                                        }
                                ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td>
                                                <?php
                                                    if ($rowmem['vtype'] == 1 || $rowmem['vtype'] == 3)
                                                    {
                                                        echo 'Cash';
                                                    }
                                                    else if ($rowmem['vtype'] == 2 || $rowmem['vtype'] == 4)
                                                    {
                                                        echo 'Online';
                                                    }
                                                    else
                                                    {
                                                        echo 'Adjustment';
                                                    }
                                                ?>
                                            </td>
                                            <td><?= ucwords($rowmem['premarks']) ?></td>
                                            <td><?= (!empty($row2vdd['date'])?$row2vdd['date']:''); ?></td>
                                            <td><?= $rowmem['cheque_no']; ?></td>
                                            <td><?= $cdate; ?></td>
                                            <td align="right"><?= number_format(($row2v['amount'] + $row2v['amount1']), 2) ?></td>
                                            <?php $td = $td + $row2v['amount'];
                                            $tc = $tc + $row2v['amount1']; ?>
                                        </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <td colspan="6" align="center"><b>Total</b></td>
                                    <td class="total-value" align="right"><?= number_format(($tc + $td), 2); ?></td>
                                </tr>
                            </table>
                            <br>

                            <div id="customer-title" style="text-decoration: underline;margin-top: -1%;width:20%;display: inline-block;">
                                <span>Amount: </span> <span style="color:#999;"><?= number_format($rowmem['amount'], 0); ?></span>
                            </div>
                            <br>

                            <div id="customer-title" style="text-decoration: underline;margin-top: -1%;">
                                <span>Amount In Words: </span> <span style="color:#999;"><?= ucwords(Word($rowmem['amount'])); ?></span>
                            </div>
                            <br>

                            <?php
                                if ($rowmem['actype'] == 1)
                                {
                            ?>
                                    <div style="margin-top:5px; width: 25%; display: inline-block;">
                                        <span> Net Amount : </span> <span style="color:#999;"><?= number_format($rowmem111['sum(payment.amount)']); ?></span>
                                        <hr>
                                    </div>

                                    <div style="margin-left: 89px;margin-top:5px;width:25%;display: inline-block;">
                                        <span> Net Received: </span> <span style="color:#999;"><?= number_format($rowmem11['sum(payment.amount1)']); ?></span>
                                        <hr>
                                    </div>

                                    <div style="margin-left: 90px;margin-top:5px;width:25%;display: inline-block;">
                                        <span>Balance :</span> <span style="color:#999;"><?= number_format($rowmem111['sum(payment.amount)'] - $rowmem11['sum(payment.amount1)']); ?></span>
                                        <hr>
                                    </div>
                            <?php
                                }
                            ?>

                            <br><br><br>
                            <?php
                                if ($rowmem['actype'] == 1)
                                {
                            ?>
                                    <div id="customer-title" style="text-decoration: underline;margin-top: -1%;">
                                        <span>Payment Of: </span>
                                        <span style="color:#999;">(<?= $rowmem['type'] . '-' . $rowmem['plot_detail_address'] . ' , ' . $rowmem['sector_name'] . ' , ' . $rowmem['street']; ?>)</span>
                                    </div>
                                    <br><br><br><br>

                            <?php
                                }
                            ?>
                            <div style="clear:both"></div>
                            <table style="width:100%;">
                                <tr>
                                    <td style="text-align: center;"> <u><?= $rowmem2['name'] ?></u><br>
                                        <br>
                                        <b style="font-size:14px;">Prepared By: </b>
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
                    </div>
                </div>
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