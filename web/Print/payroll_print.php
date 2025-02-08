<?php
    include "../db.php";
    $where = '';
    if(isset($_GET['emp_id']) && !empty($_GET['emp_id']))
    {
        $where=" AND emp.id='".$_GET['emp_id']."'";
    }

    $sql = "SELECT * FROM payroll_details WHERE type = 1 ORDER BY id ASC";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM payroll_details WHERE type = 2 ORDER BY id ASC";
    $result1 = $conn->query($sql1);

    $emp = "SELECT *, emp.id AS eid, emp.designation AS 'e_designation',
    emp.salecenter AS esc FROM employee emp
    LEFT JOIN designation des ON (des.id = emp.designation) 
    LEFT JOIN accounts acc ON (acc.ref = emp.id AND type = 4)
    WHERE acc.id > 0 AND emp.status=1 $where GROUP BY emp.id";
    $empr = $conn->query($emp);
    $counter = 1; $emp = 0;

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
        <div id="page-wrap" style="background-color:#FFFFFF; width: 1120px !important;">
            <div style="min-height: 400px;border: 1px solid #000; padding: 15px;">
                <div>
                    <div style="width:14%;float: left; padding-bottom: 15px;">
                        <?php
                            //$filename = '../attachments/logo';
                            $ms = "SELECT * FROM config";
                            $m = $conn->query($ms);
                            $s = $m->fetch_assoc();
                        ?>
                        <img src="../img/<?php echo $s['logo']; ?>" style="margin-top: 15px;" alt="logo" width="100px;" />
                    </div>
                    <div style="width:66%;float: left; margin-top: 15px; padding-bottom: 15px;">
                        <p style="font-size: 22px;"> <?php echo $s['companyname']; ?> </p>
                        <p style="font-size: 15px;"> <?php echo $s['adrress']; ?> </p>
                        <p style="font-size: 15px;"><b>Payroll</b></p>
                    </div>
                </div>
                </br></br>
                <div style="clear:both;"></div>
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
                    <table id="items">
                        <tr>
                            <th rowspan="2" align="center">Sr #</th>
                            <th colspan="3" align="center"> Particulars of Employee</th>
                            <th colspan="<?php echo $result->num_rows; ?>" align="center"> Pay & Allowances</th>
                            <th rowspan="2">Gross Salary</th>
                            <th colspan="<?php echo $result1->num_rows; ?>" align="center"> Deductions</th>
                            <th rowspan="2"> Net Salary</th>
                        </tr>
                        <tr>
                            <th colspan="1" style="text-align: left;"> Emp #</th>
                            <th colspan="1" style="text-align: left;"> Name</th>
                            <th colspan="1" style="text-align: left;"> CNIC</th>
                            <?php
                            while ( $allowannce_th = $result->fetch_assoc() )
                            { ?>
                                <th colspan="1"> <?php echo $allowannce_th['title']; ?> </th>
                            <?php } 
                            while ( $deduction_th = $result1->fetch_assoc() )
                            { ?>
                                <th colspan="1"> <?php echo $deduction_th['title']; ?> </th>
                            <?php }
                            ?>
                        </tr>
                        <?php
                        while ( $payroll_row = $empr->fetch_assoc() )
                        {
                            $emp++;
                            $gross_salary = 0; $net_salary = 0; $deductions = 0; 

                            $all_sql = "SELECT * FROM  payroll_details pd WHERE pd.type = 1 ORDER BY pd.id ASC";
                            $all_result = $conn->query($all_sql);

                            $ded_sql = "SELECT * FROM  payroll_details pd WHERE pd.type = 2 ORDER BY pd.id ASC";
                            $ded_result = $conn->query($ded_sql);
                        ?>
                            <tr>
                                <td style="text-align: center;"> <?php echo $counter; ?> </td>
                                <td> <?php echo $payroll_row['code']; ?> </td>
                                <td> <?php echo $payroll_row['name']; ?> </td>
                                <td> <?php echo $payroll_row['cnic']; ?> </td>
                            <?php
                            $empa=0;
                            while ( $single_allowance_row = $all_result->fetch_assoc() )
                            {
                                $empa++; $all_td_sql = "";
                                $all_td_sql = "SELECT * FROM e_payroll ep 
                                WHERE ep.payrolldetails_id = '" . $single_allowance_row['id'] . "' 
                                AND ep.e_id = '" . $payroll_row['eid'] . "'";
                                $jz_result = $conn->query($all_td_sql);
                                $all_td_res = $jz_result->fetch_row();
                                $i = 1;
                            ?>
                                <td style="text-align: center;"> <?php echo $all_td_res[4]; ?> </td>
                            <?php
                                $gross_salary += $all_td_res[4];
                            }
                            ?>
                                <td style="text-align: center;"> <?php echo $gross_salary; ?> </td>
                            <?php
                            $empd=0;
                            while ( $single_deduction_row = $ded_result->fetch_assoc() )
                            {
                                $empd++; $ded_td_sql = "";
                                $ded_td_sql = "SELECT * FROM e_payroll ep 
                                WHERE ep.payrolldetails_id = '" . $single_deduction_row['id'] . "' 
                                AND ep.e_id = '" . $payroll_row['eid'] . "'";
                                $jz_result = $conn->query($ded_td_sql);
                                $ded_td_res = $jz_result->fetch_row();
                                $i = 1;
                            ?>
                                <td style="text-align: center;"> <?php echo $ded_td_res[4]; ?> </td>
                            <?php
                                $deductions += $ded_td_res[4];
                            }
                            ?>
                                <td style="text-align: center;"> <?php echo ($gross_salary - $deductions); ?> </td>
                            </tr>
                        <?php 
                            $counter++;
                        }
                        ?>
                    </table>
                    <div style="clear:both"></div>
                    <div style="margin-top: 1%;">
                        &nbsp;&nbsp; Print Date: <b><?php echo date('d-M-y'); ?></b>
                        <br><br>
                        <table style="  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
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