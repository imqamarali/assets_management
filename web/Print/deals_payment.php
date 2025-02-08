<?php 
    include "../db.php";
    $sqlmem= "SELECT *,jz_deal.expiry as expirydate from deals 
    left JOIN supplier ON deals.did = supplier.id  
    left join jz_deal on (deals.deal_id=jz_deal.id)
    where deals.id='".$_REQUEST['id']."'";
    $resultmem = $conn->query($sqlmem);
    $rowmem = $resultmem->fetch_assoc();
    
    
    $sqlform= "SELECT * from  form_generate  
    Left Join size_cat ON (size_cat.id=form_generate.size)
    where form_generate.id IN (".$rowmem['files'].")";
    $resultform = $conn->query($sqlform);
    
    
    $sqlemp= "SELECT * from employee  
    where  id='".$_REQUEST['eid']."'";
    $resultemp = $conn->query($sqlemp);
    $rowemp = $resultemp->fetch_assoc();
    
    
    $sqlc= "SELECT * from config ";
    $resultc = $conn->query($sqlc);
    $rowc = $resultc->fetch_assoc();
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
            <div id="page-wrap" style="background-color:#FFFFFF;width:800px !important; margin-top:40px;">
                <?php include('header.php');?>
                <?php echo $s['adrress'];?>
                <?php echo '&#13;&#10;Forms Deal';?>
                </textarea>
                <style>
                    table td, table th {
                        border: 0;
                    }
                    #page-wrap {
                        width: 55%;
                    }
                    .page-break {
                    page-break-before: always;
                    }

                </style>
                <div style="clear:both"></div>
                <div id="customer">
                    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                        <span> Dated : </span> <span style="color:#999;"><?php echo date('d-M-Y',strtotime($rowmem['date'])); ?></span>
                        <hr>  
                    </div>
                      <div style="margin-left: 300px;margin-top:0px;width:26%;display: inline-block;">
                         <span style="font-weight: bold;"> OFFICE COPY </span>
                         
                    </div>
                    <div style="clear:both"></div>
       
                    <div style="margin-left: 50px;margin-top:5px;width:86%;display: inline-block;">
                        <span> Dealer Name : </span> 
                        <span style="color:#999;">
                            <?php  echo $rowmem['company_name'].' '.$rowmem['contact_name'];?>
                        </span>
                        <hr>  
                    </div>
                    <div style="clear:both"></div>
        
                    <table id="items" style="margin-left:50px;width:90%;display:none;">
                    <?Php if($rowmem['ptype']==1){ ?>    
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Due Amount</th>
                            <th style="text-align:left;">Paid Amount</th>
                            <th style="text-align:left;">Remaining Amount</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Cash';?></td>
                            <td><?php echo $rowmem['cash_amount']; ?></td>
                            <td><?php echo $rowmem['paid_amount']; ?></td>
                            <td><?php echo $rowmem['rem_amount']; ?></td>
                        </tr>
                    <?php } ?>
                    <?Php if($rowmem['ptype']==2){ ?>
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Adjust Item</th>
                            <th style="text-align:left;">Worth</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Adjustment';?></td>
                            <td><?php echo $rowmem['adjust_item']; ?></td>
                            <td><?php echo $rowmem['worth']; ?></td>
                        </tr>
                    <?php } ?>
                    <?Php if($rowmem['ptype']==3){ ?>    
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Due Amount</th>
                            <th style="text-align:left;">Paid Amount</th>
                            <th style="text-align:left;">Adjust Item</th>
                            <th style="text-align:left;">Worth</th>
                            <th style="text-align:left;">Remaining Amount</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Cash & Adjustment';?></td>
                            <td><?php echo $rowmem['cash_amount']; ?></td>
                            <td><?php echo $rowmem['paid_amount']; ?></td>
                            <td><?php echo $rowmem['adjust_item']; ?></td>
                            <td><?php echo $rowmem['worth']; ?></td>
                            <td><?php echo $rowmem['rem_amount']-$rowmem['worth']; ?></td>
                        </tr>
                    <?php } ?>
                    </table>
                    </br>
                    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: 0%;width:40%;display: inline-block;"> 
                        <span>Expiry Date: </span>
                        <span style="color:#999;"><?php echo date("d M Y",strtotime($rowmem['expirydate'])); ?></span>
                    </div>
                    </br>
                    <div id="customer-title" style="margin-left:502px;text-decoration: underline;margin-top: -2%;width:30%;display: inline-block;"> 
                        <span>Total Forms: </span>
                        <span style="color:#999;"><?php echo $rowmem['alloted_files']; ?></span>
                    </div>
                    </br>
                    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: 1%;">
                        <span>Remarks: </span>
                        <span style="color:#999;"><?php echo $rowmem['remarks'];//echo ucwords(Word($rowmem['paid_amount'])); ?></span>
                    </div>
        
                    <br><br>
                    <h3 style="margin-left: 50px !important;">Details of forms issued: </h3> 
                </div>
                <table id="items" style="margin-left:50px;width:90%;">
                    <tr>
                        <th style="text-align:left;">Security No</th>
                        <th style="text-align:left;">Size</th>
                        <th style="text-align:left;">Security No</th>
                        <th style="text-align:left;">Size</th>
                    </tr>
                    <?php $i=2; while($rowform = $resultform->fetch_assoc()){ ?>
                        <?Php if($i%2==0){  ?>
                            <tr>
                                <td><?php echo $rowform['serial_no']; ?></td>
                                <td><?php echo $rowform['size']; ?></td>
                        <?php }else{ ?>
                                <td><?php echo $rowform['serial_no']; ?></td>
                                <td><?php echo $rowform['size']; ?></td>
                            </tr>
                        <?php } ?>  
                    <?php $i++;} ?>
                </table>
                </br></br>
                <table  style="margin-left:30px;width:90%;">
                    <tr>
                        <td colspan="4" style="text-align: center;">
                            <b>Note:</b>These forms (numbers) are alloted to the sales partner with validity of decided date.End user registration against these forms is to be submitted within ten days of issuance
                        </td>
                    </tr>
                </table>
    
                </br></br></br>
                <div style="clear:both"></div>
                <table  style="margin-left:50px;width:90%;">
                    <tr>
                        <td style="text-align: center;">
                            <u><?php echo $rowemp['name'] ?></u>
                            <br><br>
                            <b style="font-size:14px;">Prepared By: </b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Accounts Manager:</br></b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Authorized By:</br></b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Received By:</br></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center;"> 
                            <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi"); echo $rowemp['name'] .' || Dated: '.date("d-M-Y H:i A") ?> Tel: <?php echo $rowc['phonenumber'];?></b>
                        </td>
                    </tr>
                </table><br><br>
            </div>
        </div>
       <br><br><br><br>
       <div class="page-break">
  <!-- Content for the first page -->
</div>
       <?php 
    include "../db.php";
    $sqlmem1= "SELECT *,jz_deal.expiry as expirydate from deals 
    left JOIN supplier ON deals.did = supplier.id  
    left join jz_deal on (deals.deal_id=jz_deal.id)
    where deals.id='".$_REQUEST['id']."'";
    $resultmem1 = $conn->query($sqlmem1);
    $rowmem1 = $resultmem1->fetch_assoc();
    
    
    $sqlform1= "SELECT * from  form_generate  
    Left Join size_cat ON (size_cat.id=form_generate.size)
    where form_generate.id IN (".$rowmem1['files'].")";
    $resultform1 = $conn->query($sqlform1);
    
    
    $sqlemp1= "SELECT * from employee  
    where  id='".$_REQUEST['eid']."'";
    $resultemp1 = $conn->query($sqlemp1);
    $rowemp1 = $resultemp1->fetch_assoc();
    
    
    $sqlc1= "SELECT * from config ";
    $resultc1 = $conn->query($sqlc1);
    $rowc1 = $resultc1->fetch_assoc();
?>
       
       
         <div id="page-wrap" style="background-color:#FFFFFF;width:800px !important; margin-top:5px;">
                <?php include('header.php');?>
                <?php echo $s['adrress'];?>
                <?php echo '&#13;&#10;Forms Deal';?>
                </textarea>
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
                    <div style="margin-left: 50px;margin-top:5px;width:26%;display: inline-block;">
                        <span> Dated : </span> <span style="color:#999;"><?php echo date('d-M-Y',strtotime($rowmem1['date'])); ?></span>
                        <hr>  
                    </div>
                     <div style="margin-left: 300px;margin-top:0px;width:26%;display: inline-block;">
                         <span style="font-weight: bold;"> CUSTOMER COPY </span>
                         
                    </div>
                    <div style="clear:both"></div>
       
                    <div style="margin-left: 50px;margin-top:5px;width:86%;display: inline-block;">
                        <span> Dealer Name : </span> 
                        <span style="color:#999;">
                            <?php  echo $rowmem1['company_name'].' '.$rowmem1['contact_name'];?>
                        </span>
                        <hr>  
                    </div>
                    <div style="clear:both"></div>
        
                    <table id="items" style="margin-left:50px;width:90%;display:none;">
                    <?Php if($rowmem1['ptype']==1){ ?>    
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Due Amount</th>
                            <th style="text-align:left;">Paid Amount</th>
                            <th style="text-align:left;">Remaining Amount</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Cash';?></td>
                            <td><?php echo $rowmem1['cash_amount']; ?></td>
                            <td><?php echo $rowmem1['paid_amount']; ?></td>
                            <td><?php echo $rowmem1['rem_amount']; ?></td>
                        </tr>
                    <?php } ?>
                    <?Php if($rowmem1['ptype']==2){ ?>
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Adjust Item</th>
                            <th style="text-align:left;">Worth</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Adjustment';?></td>
                            <td><?php echo $rowmem1['adjust_item']; ?></td>
                            <td><?php echo $rowmem1['worth']; ?></td>
                        </tr>
                    <?php } ?>
                    <?Php if($rowmem1['ptype']==3){ ?>    
                        <tr>
                            <th style="text-align:left;">S No.</th>
                            <th style="text-align:left;">Type</th>
                            <th style="text-align:left;">Due Amount</th>
                            <th style="text-align:left;">Paid Amount</th>
                            <th style="text-align:left;">Adjust Item</th>
                            <th style="text-align:left;">Worth</th>
                            <th style="text-align:left;">Remaining Amount</th>
                        </tr>
                        <tr>
                            <td><?php echo 1; ?></td>
                            <td><?php echo 'Cash & Adjustment';?></td>
                            <td><?php echo $rowmem1['cash_amount']; ?></td>
                            <td><?php echo $rowmem1['paid_amount']; ?></td>
                            <td><?php echo $rowmem1['adjust_item']; ?></td>
                            <td><?php echo $rowmem1['worth']; ?></td>
                            <td><?php echo $rowmem1['rem_amount']-$rowmem1['worth']; ?></td>
                        </tr>
                    <?php } ?>
                    </table>
                    </br>
                    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: 0%;width:40%;display: inline-block;"> 
                        <span>Expiry Date: </span>
                        <span style="color:#999;"><?php echo date("d M Y",strtotime($rowmem1['expirydate'])); ?></span>
                    </div>
                    </br>
                    <div id="customer-title" style="margin-left:502px;text-decoration: underline;margin-top: -2%;width:30%;display: inline-block;"> 
                        <span>Total Forms: </span>
                        <span style="color:#999;"><?php echo $rowmem1['alloted_files']; ?></span>
                    </div>
                    </br>
                    <div id="customer-title" style="margin-left:50px;text-decoration: underline;margin-top: 1%;">
                        <span>Remarks: </span>
                        <span style="color:#999;"><?php echo $rowmem1['remarks'];//echo ucwords(Word($rowmem['paid_amount'])); ?></span>
                    </div>
        
                    <br><br>
                    <h3 style="margin-left: 50px !important;">Details of forms issued: </h3> 
                </div>
                <table id="items" style="margin-left:50px;width:90%;">
                    <tr>
                        <th style="text-align:left;">Security No</th>
                        <th style="text-align:left;">Size</th>
                        <th style="text-align:left;">Security No</th>
                        <th style="text-align:left;">Size</th>
                    </tr>
                    <?php $i=2; while($rowform1 = $resultform1->fetch_assoc()){ ?>
                        <?Php if($i%2==0){  ?>
                            <tr>
                                <td><?php echo $rowform1['serial_no']; ?></td>
                                <td><?php echo $rowform1['size']; ?></td>
                        <?php }else{ ?>
                                <td><?php echo $rowform1['serial_no']; ?></td>
                                <td><?php echo $rowform1['size']; ?></td>
                            </tr>
                        <?php } ?>  
                    <?php $i++;} ?>
                </table>
                </br></br>
                <table  style="margin-left:30px;width:90%;">
                    <tr>
                        <td colspan="4" style="text-align: center;">
                            <b>Note:</b>These forms (numbers) are alloted to the sales partner with validity of decided date.End user registration against these forms is to be submitted within ten days of issuance
                        </td>
                    </tr>
                </table>
    
                </br></br></br>
                <div style="clear:both"></div>
                <table  style="margin-left:50px;width:90%;">
                    <tr>
                        <td style="text-align: center;">
                            <u><?php echo $rowemp1['name'] ?></u>
                            <br><br>
                            <b style="font-size:14px;">Prepared By: </b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Accounts Manager:</br></b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Authorized By:</br></b>
                        </td>
                        <td style="text-align: center;">
                            ____________________
                            <br><br>
                            <b style="font-size:14px;">Received By:</br></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center;"> 
                            <b style="font-size:14px;">Printed By: <?php date_default_timezone_set("Asia/Karachi"); echo $rowemp['name'] .' || Dated: '.date("d-M-Y H:i A") ?> Tel: <?php echo $rowc['phonenumber'];?></b>
                        </td>
                    </tr>
                </table><br><br>
            </div>
        </div>
    </body>
</html>