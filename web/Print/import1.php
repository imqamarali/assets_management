<?php 
include "db.php";
$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);
while($row=$result->fetch_assoc())
{
	$max=0;
	$sql1 = "SELECT MAX(code) from subaccount where type='2'";
	$result1 = $conn->query($sql1);
	$row1 = $result1->fetch_assoc();
	$max=$row1['MAX(code)']+1;
	if($max==0){$max=1;}
	
	$sql = "INSERT INTO subaccount ( `name`, `type`, `ref`, `accounttype`, `level`, `code`, `discription`, `openingbal`, `createdate`)
	VALUES ('".$row['company_name']."-".$row['contact_name']."','2','".$row['id']."','0','4','".$max."','New Account','".$row['opening_balance']."','".date('Y-m-d')."')";

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
?>