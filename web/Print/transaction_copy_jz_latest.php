<?php
    include "../db.php";
   
				$sql= "SELECT *,accounts.name as bname,accounts.type as actype,transaction.create_date as tdate,transaction.status_type as tst FROM transaction 
				LEFT JOIN accounts On (accounts.id=transaction.bank_id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result = $conn->query($sql);
				$row = $result->fetch_assoc();
				// print_r($result);exit;
				$name='';
				
				$sqlemp= "SELECT * from accounts where id='".$row['pt_id']."'";
			    $resultemp = $conn->query($sqlemp);
				$rowemp = $resultemp->fetch_assoc();
				// print_r($rowemp); exit();
				if($row['tst']==5)
        		{
                    $sql_res = "SELECT rno from plot_reserved_main where id='".$row['pt_id']."'";
                    $sql_res1 = $conn->query($sql_res);
				    $result_res = $sql_res1->fetch_assoc(); 
                    $name=$result_res['rno'];
        		}
                else
                {
				    $name=$rowemp['name'];
				    
				    $sqldb= "SELECT *,accounts.type as actype FROM payment 
				    left join accounts on(payment.referanceid=accounts.id) 
				    WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount1>0";
			        $sql_db = $conn->query($sqldb);
				    $result_db = $sql_db->fetch_assoc();
				    
				    
				    if($result_db['actype']==1)
                    {
                        $sqldb= "SELECT members.name as mname,members.cnic as mcnic FROM transaction 
                        left JOIN accounts ON transaction.pt_id = accounts.id  
                        left JOIN memberplot ON accounts.ref = memberplot.id 
                        left JOIN members ON members.id = memberplot.member_id  
    				    WHERE transaction.id='".$_REQUEST['id']."'";
    			        $sql_db = $conn->query($sqldb);
    				    $result_db = $sql_db->fetch_assoc(); 
                        
                        $name=$result_db['mname'].' ( '.$result_db['mcnic'].')';
                    }
                    if($result_db['actype']!=1)
                    {
                        $sqldb= "SELECT * FROM payment 
    				    left join accounts on(payment.referanceid=accounts.id) 
    				    WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."' AND amount>0";
    			        $sql_db = $conn->query($sqldb);
    				    $result_db = $sql_db->fetch_assoc();
    				    
    				    $name=$result_db['name'];
                    }
                }
                
				
				$sql2= "SELECT * FROM transaction 
				LEFT JOIN employee ON (transaction.user_id=employee.id)
				WHERE transaction.id='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				$row2 = $result2->fetch_assoc();
				// print_r($row2); exit();
				
				$sql2v= "SELECT *,accounts.type as actype FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
			    $result2v = $conn->query($sql2v);
			    
			    $sql2v1= "SELECT *,accounts.type as actype FROM payment 
				left join accounts on(payment.referanceid=accounts.id) 
				WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
			    $result2v1 = $conn->query($sql2v1);
				
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql1= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result1 = $conn->query($sql1);
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql2= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
			    $result2 = $conn->query($sql2);
				
				$jo='';$ref='';
				if($row['pttype']==2){$jo='Left join mainpurchase on(payment.referanceid=mainpurchase.id)';}
				if($row['pttype']==3){$jo='Left join mainsale on(payment.referanceid=mainsale.id)';}
				 $sql3= "SELECT *,payment.amount as pam FROM payment 
				".$jo."
				WHERE payment.vid='".$_REQUEST['id']."'";
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

	<style type="text/css">
		#jz-table{
			font-family: arial, sans-serif;
			margin-top: -35px;
			border-collapse: collapse;
			border: 2px solid;
			margin-bottom: 10px;
		}
		#jz-table td{
			border: none !important;
			padding: 5px 20px 5px 20px;
		}

		#jz-table2{
			/*width: 50%;*/
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
			/*position: absolute;*/
			/*width: 45%;*/
			margin: -5px 0px 5px -50px;
			/*text-align: left;*/
		}
		.jz_co_name{
			display: flex;
			justify-content: end;
			padding:  45px 50px 0px 0px;
		}
		#segal_address{
			/*border: 1px solid;*/
			margin-top: 20px;
			text-align: center;
			padding: 10px 5px 10px 5px;
			font-size: 16px;
		}
	</style>

	<body style="background-color: aliceblue;">
		<div id="page-wrap" style="background-color:#FFFFFF;">
			<!-- <div id="customer-title" style="margin-left: 20px;">
 				<?php
      		// include "../db.php";
        // 	$ms= "SELECT * FROM config"; 
        //   $m = $conn->query($ms);
        // 	$s = $m->fetch_assoc();
        ?>
        <img  src="../img/<?php //echo $s['logo'];?>" style="margin-top: 30px;" alt="logo" width="100px;"/>
    	</div> -->
    	<div class="row">
    		<div class="col-sm-6">
    			<div id="customer-title" style="margin-left: 20px; padding-left: 30px;">
		 				<?php
		      		include "../db.php";
		        	$ms= "SELECT * FROM config"; 
		          $m = $conn->query($ms);
		        	$s = $m->fetch_assoc();
		        ?>
		        <img  src="../img/<?php echo $s['logo'];?>" style="margin-top: 30px;" alt="logo" width="100px;"/>
		    	</div>
    		</div>
    		<div class="col-sm-6 jz_co_name">
    			<h3>SIGAL DEVELOPMENTS (PVT) LTD</h3>
    		</div>
    	</div>
			<textarea id="header" readonly="readonly">
				<?php
					if($row['vtype']==3){echo 'Cash Reciept Voucher';}
					if($row['vtype']==4){echo 'Bank Reciept Voucher';}
					if($row['vtype']==1 || $row['vtype']==2){echo 'Payment Voucher';}
				?>
			</textarea>
			<div style="clear:both"></div>
			<div style="margin: 10px 50px 0px 50px; padding-bottom: 20px;">
				<div class="row">
					<div class="col-sm-6">
						<table id="jz-table2">
							<tbody>
								<tr>
									<td style="width: 20%">Cash/Bank</td>
									<td></td> <!-- Bank Name Goes Here -->
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-6" style="float: right;">
						<table id="jz-table">
							<tbody>
								<tr>
							    <td>Voucher # </td>
							    <td> <?= $row['vno']; ?> </td>
							  </tr>
							  <tr>
							    <td style="border-top: 2px solid !important;">Date </td>
							    <td style="border-top: 2px solid !important;"><?= date("d/m/Y",strtotime($row['tdate'])); ?></td>
							  </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<!-- <div style="padding-top: 10px">
					<h4>Address</h4>
					<hr style="width: 50%; margin-left: 60px;">
					<hr style="width: 50%; margin: 35px 0px 0px 105px;">
				</div> -->
				<div>
					<!-- <table id="jz-table2">
						<tbody>
							<tr>
								<td style="width: 20%">Cash/Bank</td>
								<td></td>
							</tr>
						</tbody>
					</table> -->
					<table id="jz-table3" frame="box">
						<tbody>
							<tr>
								<th style="width: 20%;">General Ledger Code</th>
								<th style="width: 50%;">Description</th>
								<th style="width: 15%;">Debit</th>
								<th style="width: 15%;">Credit</th>
							</tr>
							<?php $i=0; $td=0;$tc=0; while($row2v = $result2v->fetch_assoc()){$i=$i+1; ?>    
			    			<tr>
			    				<td style="border-right: 1px solid !important;"><?= $row2v['code'];?></td>
			      			<td style="border-right: 1px solid !important;"><?= $row2v['remarks'];?></td>
			      			<td style="border-right: 1px solid !important;" align="right"><?= number_format($row2v['amount'],2)?></td>
			      			<td style="border-right: 1px solid !important;" align="right"><?= number_format($row2v['amount1'],2)?></td>
			     				<?php $td=$td+$row2v['amount'];$tc=$tc+$row2v['amount1'];?>
			    			</tr>
	   					<?php }?>
	   					<?php
	   						$jz_sql= "SELECT COUNT(*),accounts.type as actype FROM payment 
												left join accounts on(payment.referanceid=accounts.id) 
												WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
				    		$jz_result = $conn->query($jz_sql);
				    		$jz_row = $jz_result->fetch_assoc();
								for($i = 34; $i > $jz_row['COUNT(*)']; $i--) {
							?>
		   					<tr class="blank_row">
		   						<td style="border-right: 1px solid !important;"></td>
		   						<td style="border-right: 1px solid !important;"></td>
		   						<td style="border-right: 1px solid !important;"></td>
		   						<td style="border-right: 1px solid !important;"></td>
		   					</tr>
	   					<?php } ?>
	   					<tr style="border: 1px solid;">
	   						<td
	   							style="border-right: 1px solid !important;"
	   							colspan="2">
	   							Rupees:- <?= ucwords(Word($row['amount'])) ?>
	   						</td>
	   						<td
	   							style="border-right: 1px solid !important;"
	   							align="right">
	   							<?= number_format($td,2);?>
	   						</td>
	   						<td
	   							style="border-right: 1px solid !important;"
	   							align="right">
	   							<?= number_format($tc,2);?>
	   						</td>
	   					</tr>
						</tbody>
					</table>
					<?php 
						$paid_to_query = "SELECT *,accounts.type as actype FROM payment 
						left join accounts on(payment.referanceid=accounts.id) 
						WHERE payment.pfor=1 and payment.vid='".$_REQUEST['id']."'";
			    	$paid_to_result = $conn->query($paid_to_query);
			    	$paid_to_acc = $paid_to_result->fetch_assoc();
			    ?>
					<table id="jz-table4">
						<tr>
	 						<td style="width: 50%;">Narration:- <?= $paid_to_acc['name']; ?></td>
	 						<td style="width: 30%;">By Cheque No:-</td>
	 						<td style="width: 20%;">Date:- <?= date("d/m/Y",strtotime($row['tdate'])); ?></td>
	   				</tr>
					</table>
				</div>
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
				<div class="row">
					<div class="col-sm-12">
						<?php
							$address_query = "SELECT adrress FROM config WHERE id = 1";
							$address_result = $conn->query($address_query);
							$address_row = $address_result->fetch_assoc();
						?>
							<p id="segal_address"><?= $address_row['adrress']; ?></p>
						<?php ?>
					</div>
				</div>
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