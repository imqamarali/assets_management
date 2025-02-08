<div >
 <?php   //$filename = '../attachments/logo';

      include "../db.php";

        $ms= "SELECT * FROM config"; 
          $m = $conn->query($ms);
        $s = $m->fetch_assoc();

        ?>

        <img  src="../img/<?php echo $s['logo'];?>" style="margin-top: 30px;" alt="logo" width="100px;"/> 
      <!-- <img  src="../attachments/2logo-resized.<?php // echo($ex)?>" style="margin-top: 30px;" alt="logo" width="100px;"/>  -->

    </div>
    <?php 

        ?>
    <!-- MULTI PROFESSIONALS COOPERAIVE HOUSING SOCIETY ISLAMABAD -->
<!-- &#13;&#10;APPLICATION FORM -->
<textarea id="header" style="height:80px !important;letter-spacing: .05px !important; font-size: 17px; margin-bottom: 0px; width: 65%;color: black; background: transparent;margin-left:140px;margin-top:-100px;" readonly="readonly"><?php echo $s['companyname']?> &#13;&#10; 