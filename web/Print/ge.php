<?php
    include "../db.php";
   

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
                    <div style="width:60%;float: left; margin-top: 15px; padding-bottom: 15px;">
                        <p style="font-size: 22px;"> <?php echo $s['companyname']; ?> </p>
                        <p style="font-size: 15px;"> <?php echo $resultpr3['project_address']; ?> </p>
                        <p style="font-size: 15px;">
                            <b>
                                <?php
                                    $pfor=$_REQUEST['p'];
                                    $sql2v1 = "SELECT * FROM payment 
                                    LEFT JOIN accounts ON (payment.referanceid=accounts.id) 
                                    WHERE payment.pfor='".$pfor."' AND payment.vid='" . $_REQUEST['id'] . "' and payment.gl=1";
                                    $result2v1 = $conn->query($sql2v1);
                                    
                                     $sql2m = "SELECT *,accounts.name as accname,members.name as memname FROM payment 
                                    LEFT JOIN accounts ON (payment.referanceid=accounts.id) 
                                    LEFT JOIN members ON (members.id=accounts.ref and accounts.type=1)
                                    WHERE payment.pfor='".$pfor."' AND payment.vid='" . $_REQUEST['id'] . "' and amount1>0  ORDER BY `payment`.`amount1` ASC";
                                    $result2m = $conn->query($sql2m);
                                    $mem = $result2m->fetch_assoc();
    
                                    if ($pfor == 2)
                                    {
                                        echo 'Allotment';
                                    }
                                    if ($pfor == 3)
                                    {
                                        echo 'Invoice';
                                    }
                                     if ($pfor == 4)
                                    {
                                        echo 'Monthly Rental/Payable';
                                    }
                                    if ($pfor == 7)
                                    {
                                        echo 'Payroll';
                                    }
                                    if ($pfor == 10)
                                    {
                                        echo 'Commission on Sale';
                                    }
                                    if ($pfor == 11)
                                    {
                                        echo 'Tenant Bill';
                                    }
                                    if ($pfor == 12)
                                    {
                                        echo 'Tenant Commission';
                                    }
                                    if ($pfor == 13)
                                    {
                                        echo 'Depriciation';
                                    }
                                    if ($pfor == 14)
                                    {
                                        echo 'Deal';
                                    }
                                    if ($pfor == 15)
                                    {
                                        echo 'Land Purchase';
                                    }
                                   
                                ?>
                            </b>
                        </p>
                    </div>
                    <div style="width:20%;float: left;margin-top: 15px; padding-bottom: 15px;"> 
                       
                        <span> Dated : </span>
                        <span style="color:#999;"><?php echo date("d M Y", strtotime($mem['date'])); ?></span>
                        <hr />
                      
                    </div>
                    
                </div>
                
                </br></br></br></br>
                <div style="clear:both;"></div>
                     <div> 
                    <span>
                        <?php
                           if ($pfor == 4)
                                    {
                                    $name1=$mem['accname'];
                                    ?>
                                        
                                     <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1; ?> For the Month of  <?php echo date("M", strtotime($mem['date'])); ?></span>
                                    <?php 
                                        
                                    }
                        ?>
                    <?php
                           if ($pfor == 2)
                                    {
                                    $name1=$mem['accname'];
                                    ?>
                                        
                                 <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1; ?> <?php echo $mem['memname'];?></span>
                    <?php 
                                    }
                   
                            if ($pfor == 15)
                            {
                            $name1=$mem['accname'];
                            ?>
                            <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1; ?></span>
                    <?php 
                            
                            }
                 
                            $ten_sql = "SELECT *, t.name AS tenant_name, acc.name AS account_name, tmb.created_at, tmb.id AS bill_id
                            FROM tenent_registration tr
                            LEFT JOIN tenent t ON (t.id = tr.tenent_id)
                            LEFT JOIN accounts acc ON (acc.ref = tr.id AND acc.type = 6)
                            LEFT JOIN tenent_main_bill tmb ON (tmb.tr_id = tr.id)
                            WHERE tmb.id = '" . $_REQUEST['id'] . "'";
                            $ten_res = $conn->query($ten_sql);
                            $ten_res1 = $ten_res->fetch_assoc();
                    
                            if ($pfor == 11)
                            {
                            $name1=$ten_res1['account_name'] . ' - ' . $ten_res1['tenant_name'];
                            ?>
                            
                            <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1; ?> For the Month of  <?php echo date("M", strtotime($mem['date'])); ?></span>
                    <?php 
                            
                            } 
                            $ten_sql1 = "SELECT *,t.name AS tenant_name, acc.name AS account_name FROM `tenant_commission` 
                            left JOIN tenent_registration tr on (tr.id=tenant_commission.tenant_id)
                            LEFT JOIN tenent t ON (t.id = tr.tenent_id)
                            left join accounts acc on (acc.id=tenant_commission.party)
                            WHERE tenant_commission.id = '". $_REQUEST['id'] ."'"; 
                            
                            $ten_com = $conn->query($ten_sql1);
                            $ten_com2 = $ten_com->fetch_assoc();
                
                            if ($pfor == 12)
                            {
                            $name1=$ten_com2['account_name'] . ' - ' . $ten_com2['tenant_name'];
                            ?>
                            
                            <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1;?></span>
                    <?php 
                            
                            }
                        if($pfor==16)
                        {
                        // land commision
                        
                        $sql_land_sql= "SELECT *,accounts.name as accname FROM `landreg` 
                        LEFT join accounts on (landreg.Dealer=accounts.id)  where landreg.LandRegID='".$_REQUEST['id']."' and request_status=1"; 
                        $result_sql_land = $conn->query($sql_land_sql);
                        $result_sql_land1 = $result_sql_land->fetch_assoc();
                        $name1=$result_sql_land1['accname'];
                        $ref=$result_sql_land1['Ref_No'];
                        ?>
                        <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1 .'-'. $ref;?></span>
                        <?php 
                        }
                        if($pfor==10)
                        {
                        // land commision
                        $sql_commision= "SELECT *,accounts.name as accname From commission 
                        left JOIN memberplot ON memberplot.id = commission.mem_id 
                        left join accounts on commission.mid=accounts.id
                        where commission.id='".$_REQUEST['id']."'";
                        $result_comision = $conn->query($sql_commision);
                        $result_comision1 = $result_comision->fetch_assoc();
                   
                         $name1='Commission/Tax on Sale '.$result_comision1['name'].' Ledger';  
                
                        ?>
                        <span style="color:#999;border-bottom:2px solid #eee;"><?php echo $name1;?></span>
                        <?php 
                        }
                            
                            
                        ?>
                    </span>
               
           
                  
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
                            <th style="text-align:left;">Ac Code</th>
                            <th style="text-align:left;">Ac Title</th>
                            <th style="text-align:left;">Narration</th>
                            <th style="text-align:right;">Debit Rs.</th>
                            <th style="text-align:right;">Credit Rs.</th>
                        </tr>
                        <?php
                            $i = 0;
                            $td = 0;
                            $tc = 0;
                            while ($row2v = $result2v1->fetch_assoc())
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