<?php
    include "../db.php";
    $sql = "SELECT * FROM payment
            LEFT JOIN payroll_details ON (payroll_details.id = payment.party)
            LEFT JOIN accounts acc ON (acc.id = payment.referanceid AND acc.type = 4)
            WHERE payment.vid = '".$_REQUEST['id']."' AND pfor = 7 ORDER BY payment.id DESC";
    $result = $conn -> query($sql);

    $slip_details_sql = "SELECT *, sal.slipno, sal.createdate AS salary_date FROM payment pay
                        LEFT JOIN salary sal ON (sal.id = pay.vid)
                        WHERE pay.vid = '".$_REQUEST['id']."' AND pay.pfor = 7 ORDER BY pay.id ASC";
    $slip_details_res = $conn -> query($slip_details_sql);
    $sd_row = $slip_details_res -> fetch_assoc();

    $emp_id = $_GET['emp_id'];
    $sql1 = "SELECT *, dep.name AS dep_name, desi.designation AS desig, emp.name AS emp_name
            FROM employee emp
            LEFT JOIN department dep ON (dep.id = emp.department)
            LEFT JOIN designation desi ON (desi.id = emp.designation)
            WHERE emp.id = '$emp_id'";
    $result1 = $conn -> query($sql1);
    $row1 = $result1 -> fetch_assoc();
    // print_r($row1); exit;

    // while ($row = $result->fetch_assoc()){
    //     print_r($row);
    // }exit;
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
        #first_table{
            width: 100%;
        }
        #first_table td{
            border: 0px !important;
        }

        #second_table{
            width: 100%;
        }
        #second_table td{
            border: 0px !important;
        }
        /* Create two equal columns that floats next to each other */
        .column {
          float: left;
          width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
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
                        <p style="font-size: 15px;"><b> Payslip </b></p>
                    </div>
                    <div style="width:20%;float: left;margin-top: 15px; padding-bottom: 15px;">
                        <span> Payslip # : </span>
                        <span style="color:#999;"><?php echo $sd_row['slipno']; ?></span>
                        <hr />
                        <span> Dated : </span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($sd_row['salary_date'])); ?></span>
                        <hr />
                        <span> Amount :</span>
                        <span style="color:#999;"><?php echo $sd_row['amount']; ?></span>
                        <hr />
                    </div>
                </div>
                </br></br>
                <div style="clear:both;"></div>

                <div id="customer-title" style="margin-left: 0px; margin-top: 5px; width: 300px;">
                    <table id="first_table">
                        <tr>
                            <td>Employee Name:</td>
                            <td><?php echo $row1['emp_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Department:</td>
                            <td><?php echo (!empty($row1['dep_name'])?$row1['dep_name']:'N/A'); ?></td>
                        </tr>
                    </table>
                </div>
                <div id="meta" style="margin-left: 20px; margin-top: 5px;">
                    <table id="second_table">
                        <tr>
                            <td style="text-align: left;">CNIC:</td>
                            <td><?php echo $row1['cnic']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Designation:</td>
                            <td><?php echo $row1['desig'] ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div style="clear:both"></div>

                    <table id="items">
                        <tr>
                            <th>Type</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                        <?php
                            foreach ($result as $row) 
                            {
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['title'].$row['name'] ?></td>
                            <td style="text-align: center;"><?php if($row['amount']>0){echo $row['amount'];}else{echo '-';} ?></td>
                            <td style="text-align: center;"><?php if($row['amount1']>0){echo $row['amount1'];}else{echo '-';} ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>

                    <!-- <div class="row">
                        <div class="column">
                            <table id="items">
                                <tr>
                                    <th>Earnings</th>
                                    <th>Amount</th>
                                </tr>
                                <tr>
                                    <td>sldkfj</td>
                                    <td style="text-align: right;">23</td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Total Earnings</td>
                                    <td style="text-align: right;">180.90</td>
                                </tr>
                                <tr><td style="height: 15px !important;"></td><td></td></tr>
                            </table>
                        </div>
                        <div class="column">
                            <table id="items" style="margin-left: -1px !important;">
                                <tr>
                                    <th>Deductions</th>
                                    <th>Amount</th>
                                </tr>
                                <tr>
                                    <td>sldkfj</td>
                                    <td style="text-align: right;">23</td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Total Deductions</td>
                                    <td style="text-align: right;">890.00</td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Net Pay</td>
                                    <td style="text-align: right;">90893.10</td>
                                </tr>
                            </table>
                        </div>
                    </div> -->

                    <div style="clear:both"></div>
                    <div style="margin-top: 1%;">
                        &nbsp;&nbsp; Print Date: <b><?php echo date('d-M-y'); ?></b>
                        <br><br>
                        <table style="  font-family: arial, sans-serif; border-collapse: collapse; width: 100%; margin-top: 30px;">
                            <tr>
                                <!-- position: absolute; left: 23%; width: 9%; -->
                                <th style="border: none;text-align:center;">____________</th>
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