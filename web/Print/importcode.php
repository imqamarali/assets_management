<!-- /.page-header -->
                    <div class="x_content">
                        <!-- content starts here -->
        <form class="form-horizontal well" action="" method="post" name="upload_excel" enctype="multipart/form-data">
          <fieldset>
            <center>
            <div class="control-group">
              
                <label>CSV File:</label>
              
              <div class="controls">
                <input type="file" multiple name="filename" id="filename" class="input-large">
              </div>
            </div>
            <br/> 
            <div class="control-group">
              
              <div class="controls">
              <button type="submit" id="submit" name="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
              <a href="index.php?r=/trattendance"><button type="button" class="btn btn-danger"><i class="fa fa-reply"></i> Back</button></a>
              </div>
            </div>
            </center>

            <br><br>

            <div class="control-group">
              Note: While uploading the attendance please follow the following directions.
              <ol>
                <li>The placement of Data in file should be as follows:
                  <ul>
                    <li>First column should contain the name of the Student.</li>
                    <li>Second column should contain the Roll numbers of the Student.</li>
                    <li>Third column is for Date/Time.</li>
                  
                  </ul></li>
              </ol>
              Regards
            </div>
          </fieldset>
        </form>
            
                        <!-- content ends here -->
                    </div>

<?php



if (isset($_POST['submit'])) 
{
require "db.php";

                $handle = fopen($_FILES['filename']['tmp_name'], "r");
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				echo $sqls = "SELECT * from sectors where sector_name ='".$data['2']."'";
				$result123 = mysqli_query($conn,$sqls);
				$row = mysqli_fetch_assoc($result123);
				$sector=0;$street=0;$size=0;
				//print_r($result123);
				//echo $row['id'];
				//echo count($row);exit;
				if(count($row)!==0){$sector=$row['id'];}else{
				$sql3= "INSERT INTO sectors( `project_id`, `sector_name`, `details`, `create_date`, `modify_date`) VALUES ('20','".$data['2']."','".$data['2']."','".date('Y-m-d')."','".date('Y-m-d')."')";
				if (mysqli_query($conn,$sql3) === TRUE) 
				{$sector = $conn->insert_id;}}
				
				$sqlsst = "SELECT * from streets where street='".$data['3']."'";
				$result123st = mysqli_query($conn,$sqlsst);	
				$row1 = mysqli_fetch_assoc($result123st);
				if(count($row1)!==0){$street=$row1['id'];}else{
		$sql3st= "INSERT INTO streets ( `project_id`, `sector_id`, `street`, `create_date`,`modify_date`) VALUES (20,'".$sector."','".$data['3']."','".date('Y-m-d')."','".date('Y-m-d')."')";
				if (mysqli_query($conn,$sql3st) === TRUE) 
				{$street = $conn->insert_id;}}
				
				$sqlss = "SELECT * from size_cat where size='".$data['4']."'";
				$result123s = mysqli_query($conn,$sqlss);	
				$row2 = mysqli_fetch_assoc($result123s);
				if(count($row2)!==0){$size=$row2['id'];}else{
		      $sql3s= "INSERT INTO size_cat( `size`, `code`, `area`, `unitid`) VALUES ('".$data['4']."','".$data['4']."','000',1)";
				if (mysqli_query($conn,$sql3s) === TRUE) 
				{$size = $conn->insert_id;}}
				//$shop='Shop';
				$sql3sp="INSERT INTO `plots`(`type`, `project_id`,`sector`,`street_id`, `plot_detail_address`, `plot_size`, `size2`,  `price`,  `create_date`) VALUES ('".$data['0']."',20,'".$sector."','".$street."','".$data['6']."','".$data['5']."','".$size."','".$data['7']."','".date('Y-m-d')."')";
				if (mysqli_query($conn,$sql3sp) === TRUE){echo 'inserted';}
				} 
fclose($handle);
}
?>