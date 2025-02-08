<?php

namespace Phppot;
use \Phppot\DataSource;
require_once 'class/DataSource.php';
$ds = new DataSource();
 


$options = array(
    'db_host'=> 'localhost',  //mysql host
    'db_uname' => 'root',  //user
    'db_password' => '', //pass
    'db_to_backup' => 'ns2creat_hdemo', //database name
    'db_backup_path' => '/demo', //where to backup
    'db_exclude_tables' => array() //tables to exclude
);
//$query=backup_mysql_database($options);

// function backup_mysql_database($options)
// {
//     $mtables = array(); $contents = "-- Database: `".$options['db_to_backup']."` --\n";
    
//     $mysqli = new mysqli($options['db_host'], $options['db_uname'], $options['db_password'], $options['db_to_backup']);
//     if ($mysqli->connect_error) 
//     {
//     	die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
//     }
    
//     $results = $mysqli->query("SHOW TABLES");
    
//     while($row = $results->fetch_array())
//     {
//         if (!in_array($row[0], $options['db_exclude_tables']))
//     	{
//             $mtables[] = $row[0];
//         }
//     }
    
//     foreach($mtables as $table)
//     {
//         $contents .= "-- Table `".$table."` --\n";
    
//         $results = $mysqli->query("SHOW CREATE TABLE ".$table);
//         while($row = $results->fetch_array())
//     	{
//             $contents .= $row[1].";\n\n";
//         }
    
//         $results = $mysqli->query("SELECT * FROM ".$table);
//         $row_count = $results->num_rows;
//         $fields = $results->fetch_fields();
//         $fields_count = count($fields);
    
//         $insert_head = "INSERT INTO `".$table."` (";
//         for($i=0; $i < $fields_count; $i++)
//     	{
//             $insert_head  .= "`".$fields[$i]->name."`";
//                 if($i < $fields_count-1)
//     			{
//     				$insert_head  .= ', ';
//     			}
//         }
//         $insert_head .=  ")";
//         $insert_head .= " VALUES\n";        
    
//         if($row_count>0)
//     	{
//             $r = 0;
//             while($row = $results->fetch_array())
//     		{
//                 if(($r % 400)  == 0)
//     			{
//                     $contents .= $insert_head;
//                 }
//                 $contents .= "(";
//                 for($i=0; $i < $fields_count; $i++)
//     			{
//                     $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));
    
//                     switch($fields[$i]->type)
//     				{
//                         case 8: case 3:
//                             $contents .=  $row_content;
//                             break;
//                         default:
//                             $contents .= "'". $row_content ."'";
//                     }
//                     if($i < $fields_count-1)
//     				{
//     					$contents  .= ', ';
//     				}
//                 }
//                 if(($r+1) == $row_count || ($r % 400) == 399)
//     			{
//     				$contents .= ");\n\n";
//                 }
//     			else
//     			{
//     				$contents .= "),\n";
//                 }
//                 $r++;
//             }
//         }
//     }
    
//     if (!is_dir ( $options['db_backup_path'] )) 
//     {
//     	mkdir ( $options['db_backup_path'], 0777, true );
//     }
    
//     $backup_file_name = $options['db_to_backup'] . " sql-backup- " . date( "d-m-Y--h-i-s").".sql";
    
//     $fp = fopen($options['db_backup_path'] . '/' . $backup_file_name ,'w+');
//     if (($result = fwrite($fp, $contents))) 
//     {
//         echo "Backup file created '--$backup_file_name' ($result)"; 
//     }
//     fclose($fp);
//     echo $backup_file_name;
//     return $backup_file_name;
// }

// echo $query;exit;

if($_REQUEST['id']==1)
{
    $query = "SELECT plotno as Membership_No,mem.name as Member_Name,mem.sodowo as SO_DO_WO,mem.cnic as CNIC,mem.address as Address,mem.phone as Mobile_No,
    mn.name as Nominee_Name,mn.sodowo as Nominee_SO_DO_WO,mn.cnic as Nominee_CNIC,
    sector_name as Block,street as Floor,plot_detail_address as Unit_No,memberplot.create_date as Allotment_Date from memberplot
    Left Join members mem ON (mem.id=memberplot.member_id)
    Left Join nexttokeen ON (nexttokeen.msid=memberplot.id)
    Left Join members mn ON (mn.id=nexttokeen.mid)
    Left Join plots ON (plots.id=memberplot.plot_id)
    Left Join streets ON (streets.id=plots.street_id)
    Left Join sectors ON (sectors.id=plots.sector) Group By memberplot.id Order By memberplot.plotno DESC";
    
    $filename = 'Membership Detail.xls';
}
if($_REQUEST['id']==2)
{
    $query = "SELECT payment.id as Ref_Id,memberplot.plotno as Membership_No,payment.amount as Amount,payment.date as Date,payment.remarks as Remarks from payment
    Left Join accounts ON (accounts.id=payment.referanceid AND accounts.type=1)
    Left Join memberplot ON (memberplot.id=accounts.ref) 
    Where pfor=2 
    and memberplot.id is not NULL 
    AND memberplot.status!='cancel' 
    AND payment.party IS NULL 
    AND (payment.sid IS NULL or payment.sid=0) 
    and amount>0 Order By payment.id ASC";
    $filename = 'Due Installment Plan Detail.xls';
}
if($_REQUEST['id']==3)
{
    $query = "SELECT transaction.vno as Voucher_no,transaction.create_date as Voucher_date, payment.sid as Ref_Id,memberplot.plotno as Membership_No,payment.amount1 as Amount,payment.date as Date,payment.remarks as Remarks from payment
    Left Join accounts ON (accounts.id=payment.referanceid AND accounts.type=1)
    Left Join transaction ON (transaction.id=payment.vid)
    Left Join memberplot ON (memberplot.id=accounts.ref) 
    Where pfor=1 AND amount1>0 AND memberplot.id>0 Order By payment.sid ASC";
    
    $filename = 'Paid Installment Plan Detail.xls';
}
if($_REQUEST['id']==4)
{
    $query = "SELECT transaction.vno as Voucher_No,accounts.type as ACtype,payment.pfor as Ttype,transaction.amount as Voucher_Amount,accounts.name as Voucher_Against,payment.amount as Debit_Amount,
    payment.amount1 as Credit_Amount,payment.date as Voucher_Date,payment.remarks as Remarks 
    from payment
    Left Join accounts ON (accounts.id=payment.referanceid)
    Left Join transaction ON (payment.vid=transaction.id) Where pfor!=2 Order By payment.id ASC";
    
    $filename = 'Voucher Detail.xls';
}

if($_REQUEST['id']==5)
{
    $query = "SELECT sectors.sector_name as Block,streets.street as Floor,plots.plot_detail_address as Unit_No,plots.status as Unit_Status,size_cat.size as Unit_Size from plots
    Left Join streets ON (streets.id=plots.street_id)
    Left Join sectors ON (sectors.id=plots.sector)
    Left Join size_cat ON (size_cat.id=plots.size2)
    Order By plots.plot_detail_address DESC";
    
    $filename = 'Inventory Detail.xls';
}

if($_REQUEST['id']==6)
{
    $query = "SELECT `transaction`.vno as Voucher_No,accounts.type as ACtype,payment.pfor as Ttype,transaction.amount as Voucher_Amount,accounts.name as Voucher_Against, 
    payment.amount as Debit_Amount,payment.amount1 as Credit_Amount,payment.date as Voucher_Date,payment.remarks as Remarks,memberplot.plotno as MS_No,
    members.name as Member_Name from payment Left Join accounts ON (accounts.id=payment.referanceid AND accounts.type=1) 
    Left Join memberplot ON (memberplot.id=accounts.ref) Left Join members ON (memberplot.member_id=members.id) 
    Left Join `transaction` ON (payment.vid=transaction.id) 
    Where pfor!=2 AND memberplot.id>0 Order By payment.id ASC";
    
    $filename = 'Voucher Detail Latest.xls';
}

if($_REQUEST['id']==10)
{
    $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'creative_GW'";
    $filename = 'DB.xls';
    $result = $ds->select($query);

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
            
    $isPrintHeader = false;
    foreach ($result as $row) 
    {
        $query1 = "SELECT * FROM ".$row['table_name']."";
        $result1 = $ds->select($query1);
        foreach ($result1 as $row1) 
        {
        if (! $isPrintHeader) 
        {
            echo implode("\t", array_keys($row1)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row1)) . "\n";
        }
    }
    exit();
}

$result = $ds->select($query);


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
        
$isPrintHeader = false;
foreach ($result as $row) 
{
    if (! $isPrintHeader) 
    {
        echo implode("\t", array_keys($row)) . "\n";
        $isPrintHeader = true;
    }
    echo implode("\t", array_values($row)) . "\n";
}
exit();
?>