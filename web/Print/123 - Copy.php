<?php 
$Frame80='';$Sash80='';$ScreenSash='';$Interlock80='';$SBead80='';$DBead80='';$Frame88='';   $Sash88='';$Interlock88='';$SBead88='';$DBead88='';$FixFrame80='';$FSbead='';$FDbead='';$Mullion80='';$OpenableFrame=''; $Sashoutward='';$Mulllian60='';$Openablescreen='';$OutwardSashDoor='';
$InwardSashDoor='';$Doubledoormolian='';$DoorPanel='';$MiddlayPipe='';$RoundPipe=''; $CornerPost60='';$Adopter80='';$Connector80to60='';
$Connetor80to80='';$SmallConnector='';$Pillar25mm='';$SquarePipe='';$TProfile='';$DecorativeBars='';$SmallPanel='';$SashMolian='';$WindowShutterGlazingBead='';$oldSashMolian70='';$VCutPulley='';  $DummyWheel='';$Buffer='';$Bursh881475='';$Ruber667='';$JaliRuber='';$StopperStrikesashfor88='';$WindbreakingBlockfor88='';$WhiteCrescentLockSmallHoock='';  $BrownCrescentLockSmallHoock='';$SmallShaftMoonLock='';$LongShaftMoonLock='';$FlatWheel='';$AlumuniumTrack19='';$MosquitoPullyJaliwheel='';$Transmission400='';$Transmission600='';$Transmission800='';$Transmission1200='';$Transmissin1600='';$DoorCornerhingeMiddle='';
$DoorCornerhingedown='';$DoorCornerhingeTop='';$CornerforAlmuniumspacer='';$Desicentfordoubleglass='';$Spacerfordoubleglass13=''; $Inward3hinge='';
$AnchorCap='';$WhiteLockCylinder='';$ButtonHolehandle='';$PlasticHandle='';
$Slidingbuiltintouchlo2='';$Singlepointshorthandle=''; 
 $KeyCylinder='';$Cylinder2='';$HookLock='';$GermanLockhandleChain='';$Exteriorspecial7Handle='';$WingOperator='';$Outsidecasementhandle='';$SinglePointHandle='';$ReiseaidsingleBlock='';$WindowHandle='';$EuropeonCasementDoorLock='';$MultifunctionalOWsmallerH='';$SmallUpliftingBlock10mm='';$StandardStraightTwinHandle='';$Inward13Handle='';$knotchFractionHinge18='';$Stay1012Inch='';$DrainageCap='';$JaliHingePVC='';$JaliLockOpenable='';$StandardCylinder='';$SlidingDoorLock='';$OutwarHinge='';$GlassCleaner='';$Silicon='';$Net345feet='';$SteelFramesashGI='';$SteeljaliMS='';$DoorSteel='';$Screw4x16='';$Screw4x20='';$Screw4x25='';$Screw4x30='';$Screw2x10='';$Rawalpluge='';$Screw1x10='';$DoorBolt='';$DastyAluminum='';  $BurshiDoor='';
?>

<?php
$tnos=1;
do{
$itnos=0;
$itnoss=0;
$wnos=0;$wnooa=0;$wnof=0;$wnoth=0;
do{
if($_POST['Design'.$tnos.$itnos]==1){$wnof=$wnof+1;}
if($_POST['Design'.$tnos.$itnos]==2){$wnooa=$wnooa+1;}
if($_POST['Design'.$tnos.$itnos]==3 or $_POST['Design'.$tnos.$itnos]==30){$wnos=$wnos+1;}
if($_POST['Design'.$tnos.$itnos]==4){$wnoth=$wnoth+1;}
    $itnos=$itnos+1;
	$itnoss=$itnoss+1;

	}while($_POST['noss'.$tnos] > $itnos);
$itnos=0;
 $_POST['Specification']=$_POST['speci'.$tnos];
 $_POST['Width']=$_POST['width'.$tnos];
 $_POST['Height']=$_POST['height'.$tnos];
 $_POST['qty']=$_POST['qty'];
 $_POST['Sliding(2psl3psl)']=$wnos;
 $_POST['Glazing']=$_POST['glazing'];
//$_POST['Mullion80']='Y';
 $_POST['Pannel/Leaf']=$itnoss;
 $_POST['Door/Windows']=$_POST['itype'];
//$_POST['Sash_outward']='0';
//$_POST['Inward_Sash_Door']='0';
//$_POST['60-80_Mullion']='60-V'; 
 $_POST['60-80_Mullion']=$_POST['noss'.$tnos];
 $_POST['Openable_Screen']='N';
 $_POST['Double_Door_Mullion']='N';
 $_POST['Connector']='V';
 $_POST['Installation']='Y';
//echo $_POST['Door_Pannel']=1;
echo $itnoss;
//exit;
?>

</div>

<div>
<?php

if($_POST['Specification']=='80')
{$Frame80=$Frame80+($_POST['Width']*2+12)/304.8+($_POST['Height']*2+12)/304.8;
if($_POST['Sliding(2psl3psl)'] > 1){$Sash80=$Sash80+((($_POST['Width']-12)*2)+(($_POST['Height']-78)*($_POST['Sliding(2psl3psl)']*2)))/304.8;}
if($_POST['Sliding(2psl3psl)'] > 1){$ScreenSash=$ScreenSash+((($_POST['Width']/2-13)*2)+($_POST['Height']-82)*(($_POST['Sliding(2psl3psl)']-1)*2))/304.8;}
if($_POST['Sliding(2psl3psl)'] > 1){$Interlock80=$Interlock80+((($_POST['Height']-84)*(($_POST['Sliding(2psl3psl)']-1)*2))/304.8);}
if($_POST['Glazing']=='SG'){$SBead80=$SBead80+((($_POST['Width']-200)*2)/304.8)+(($_POST['Height']-172)*4)/304.8;}
if($_POST['Glazing']=='DG'){$DBead80=$DBead80+((($_POST['Width']-200)*2)/304.8)+(($_POST['Height']-172)*4)/304.8;}
if($_POST['Sliding(2psl3psl)'] > 1){$VCutPulley=$VCutPulley+($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1){$DummyWheel=$DummyWheel+($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1){$StopperStrikesashfor88=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1 && $_POST['Height']<'800'){$SmallShaftMoonLock=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*1));}
if($_POST['Sliding(2psl3psl)'] > 1 && $_POST['Height']>'800'){$LongShaftMoonLock=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*1));}
if($_POST['Sliding(2psl3psl)']=='2'){$AlumuniumTrack19=($_POST['Width']/304.8);}
if($_POST['Sliding(2psl3psl)'] > 2){$AlumuniumTrack19=($_POST['Width']/304.8*(($_POST['Sliding(2psl3psl)']-2)*2));}
}

if($_POST['Specification']=='88')
{	$Frame88=$Frame88+((($_POST['Width']*2)+12)/304.8)+(($_POST['Height']*2)+12)/304.8;
if($_POST['Sliding(2psl3psl)'] >1){$Sash88=$Sash88+((($_POST['Width']-12)*2)+(($_POST['Height']-78)*($_POST['Sliding(2psl3psl)']*2)))/304.8;}
if($_POST['Sliding(2psl3psl)'] >1){$ScreenSash=$ScreenSash+((($_POST['Width']/2-13)*2)+($_POST['Height']-82)*(($_POST['Sliding(2psl3psl)']-1)*2))/304.8;}
if($_POST['Sliding(2psl3psl)'] >1){$Interlock88=$Interlock88+((($_POST['Height']-84)*(($_POST['Sliding(2psl3psl)']-1)*2))/304.8);}
if($_POST['Glazing']=='SG'){$SBead88=$SBead88+((($_POST['Width']-218)*2)/304.8)+((($_POST['Height']-184)*4)/304.8);}
if($_POST['Glazing']=='DG'){$DBead88=$DBead88+((($_POST['Width']-218)*2)/304.8)+((($_POST['Height']-184)*4)/304.8);}
if($_POST['Sliding(2psl3psl)'] > 1){$VCutPulley=$VCutPulley+($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1){$DummyWheel=$DummyWheel+($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1){$StopperStrikesashfor88=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*2));}
if($_POST['Sliding(2psl3psl)'] > 1 && $_POST['Height']<'800'){$SmallShaftMoonLock=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*1));}
if($_POST['Sliding(2psl3psl)'] > 1 && $_POST['Height']>'800'){$LongShaftMoonLock=($_POST['qty']*(($_POST['Sliding(2psl3psl)']-1)*1));}
if($_POST['Sliding(2psl3psl)']=='2'){$AlumuniumTrack19=($_POST['Width']/304.8);}
if($_POST['Sliding(2psl3psl)'] > 2){$AlumuniumTrack19=($_POST['Width']/304.8*(($_POST['Sliding(2psl3psl)']-2)*2));}
}
if($_POST['Specification']=='60')
{
$mar=0;	$mar1=0;	
if($_POST['Pannel/Leaf']>1){$mar=$mar+(30*($_POST['Pannel/Leaf']-1));$mar1=$mar1+(15*($_POST['Pannel/Leaf']-1));}	
if($_POST['Glazing']=='SG'){
if($_POST['Pannel/Leaf'] > 0){$FSbead=$FSbead+((($_POST['Width']-(174+($mar)))*2)/304.8)+((($_POST['Height']-174)*($_POST['Pannel/Leaf']*2))/304.8);}
if($_POST['Door/Windows']=='W'){$Inward3hinge=($_POST['qty']*($_POST['Pannel/Leaf']*3));
if($wnooa>0){$JaliLockOpenable=($_POST['qty']*($wnooa*1));}
if($wnoth > 0 && $wnooa>0){$JaliLockOpenable=($_POST['qty']*1);}
$WindowHandle=($_POST['qty']*($_POST['Pannel/Leaf']*1));
$Stay1012Inch=($_POST['qty']*($_POST['Pannel/Leaf']*1));
if($_POST['Openable_Screen']>0 ){$OutwarHinge=($_POST['qty']*($_POST['Pannel/Leaf']*($_POST['Pannel/Leaf']*3)));}
if($wnoth > 0){$knotchFractionHinge18=($_POST['qty']*2);
$Inward3hinge=($_POST['qty']*2);
$WindowHandle=($_POST['qty']*1);
$FSbead=((($_POST['Width']-(174+$mar))*2)/304.8)+((($_POST['Height']-174)*4)/304.8);
}
if($_POST['Door/Windows']=='D'){
$FSbead=($Sashoutward)+($InwardSashDoor);
if($_POST['Pannel/Leaf'] > 0 ){$EuropeonCasementDoorLock=($_POST['qty']*($_POST['Pannel/Leaf']*1));}
}
}
}
if($_POST['Glazing']=='DG'){
if($_POST['Pannel/Leaf']>0){$FDbead=((($_POST['Width']-(174+$mar))*2)/304.8)+((($_POST['Height']-174)*($_POST['Pannel/Leaf']*2))/304.8);}

if($wnoth>0 ){$FDbead=((($_POST['Width']-174)*2)/304.8)+((($_POST['Height']-174)*4)/304.8);}
if($_POST['Door/Windows']=='D'){$FDbead=($Sashoutward)+($InwardSashDoor);}
}
	
$OpenableFrame=$OpenableFrame+(($_POST['Width']+6)*2)/304.8+(($_POST['Height']+6)*2)/304.8;
if($_POST['Pannel/Leaf']>0 && $_POST['Door/Windows']=='W'){ $Sashoutward=$Sashoutward+(($_POST['Width']-(58+$mar1))*2)/304.8+(($_POST['Height']-58)*($_POST['Pannel/Leaf']*2))/304.8; }
if($wnoth>0 && $_POST['Door/Windows']=='W'){$Sashoutward=$Sashoutward+(($_POST['Width']-58)*2)/304.8+(($_POST['Height']-72)*2)/304.8;}

}


if($_POST['Design'.$tnos.$itnos]==1){$FixFrame80=$FixFrame80+((($_POST['Width']-6)*2)/304.8)+((($_POST['Height']+6)*2)/304.8);}
if($_POST['Design'.$tnos.$itnos]=='FIX' && $_POST['Glazing']=='SG'){$FSbead=$FSbead+((($_POST['Width']-55)*2)/304.8)+((($_POST['Height']-55)*2)/304.8)+($Mullion80*2);}

if($_POST['Connector']=='Y-60-80'){$Connector80to60=$Connector80to60+($_POST['Width']/304.8);}
if($_POST['Connector']=='Y-80-80'){$Connector80to80=$Connector80to80+($_POST['Width']/304.8);}
if($_POST['60-80_Mullion']=='80-H'){$Mullion80=$Mullion80+($_POST['Width'])/304.8;}
if($_POST['60-80_Mullion']=='80-V'){$Mullion80=$Mullion80+($_POST['Height'])/304.8;}
if($_POST['60-80_Mullion']=='60-H'){$Mulllian60=$Mulllian60+($_POST['Width'])/304.8;}
if($_POST['60-80_Mullion']=='60-V'){$Mulllian60=$Mulllian60+($_POST['Height'])/304.8;}
if($_POST['Specification']=='FIX' && $_POST['Glazing']=='DG'){$FDbead=((($_POST['Width']-55)*2)/304.8)+((($_POST['Height']-55)*2)/304.8)+($Mullion80*2);}

if($wnooa>0){$Openablescreen=$Openablescreen+($Sashoutward);}

if($_POST['Door/Windows']=='D' && $wnof > 0){$Doubledoormolian=$Doubledoormolian+($_POST['Height']/304.8);}

if($_POST['Door/Windows']=='W' ){
if($_POST['Sliding(2psl3psl)']>1 && $_POST['Height']>'1400'){$Buffer=($_POST['qty']*($_POST['Sliding(2psl3psl)']*2));}
if($_POST['Sliding(2psl3psl)']>1){$Bursh881475=((($_POST['Width']-12)*4)/304.8)+((($_POST['Height']-78)*(2+($_POST['Sliding(2psl3psl)']*2)))/304.8);}
if($_POST['Specification']=='60' ){
if($_POST['Height']>'400' && $_POST['Height']<='600'){$Transmission400=($_POST['qty']*1);}
if($_POST['Height']>'400' && $_POST['Height']<='600' && $wnoth>0){$Transmission400=($_POST['qty']*1);}
if($_POST['Height']>'601' && $_POST['Height']<='800'){$Transmission600=($_POST['qty']*1);}
if($_POST['Height']>'801' && $_POST['Height']<='1200'){$Transmission800=($_POST['qty']*1);}
if($_POST['Height']>'801' && $_POST['Height']<='1200' && $_POST['Pannel/Leaf']=='T-HUNG'){$Transmission800=($_POST['qty']*1);}
if($_POST['Height']>'1201' && $_POST['Height']<='1600'){$Transmission1200=($_POST['qty']*1);}
if($_POST['Height']>'1201' && $_POST['Height']<='1600' && $wnoth>0){$Transmission1200=($_POST['qty']*1);}
if($_POST['Height']>'1601'){$Transmission1600=($_POST['qty']*1);}
if($_POST['Height']>'1601' && $wnoth>0){$Transmission1600=($_POST['qty']*1);}

}
}
if($_POST['Pannel/Leaf']>0 && $_POST['Door/Windows']=='D'){$OutwardSashDoor=$OutwardSashDoor+(($_POST['Width']-36)*2)/304.8+(($_POST['Height']-36)*($_POST['Pannel/Leaf']*2))/304.8;}
if($_POST['Pannel/Leaf']>0 && $_POST['Door/Windows']=='D'){$InwardSashDoor=$InwardSashDoor+(($_POST['Width']-36)*2)/304.8+(($_POST['Height']-36)*($_POST['Pannel/Leaf']*2))/304.8;}
if($_POST['Pannel/Leaf'] > 0){$DoorCornerhingeMiddle=($_POST['qty']*$_POST['Pannel/Leaf']);}
if($_POST['Pannel/Leaf']>0){$DoorBolt=($_POST['qty']*1);}
if($_POST['Glazing']=='DG'){
if($_POST['Sliding(2psl3psl)']==0){$CornerforAlmuniumspacer=($_POST['qty']*4);}
if($_POST['Sliding(2psl3psl)'] > 0){$CornerforAlmuniumspacer=($_POST['qty']*($_POST['Sliding(2psl3psl)']*4));}

if($wnoth > 0){$CornerforAlmuniumspacer=($_POST['qty']*4);}
if($_POST['Installation']=='YES'){$Silicon=($Spacerfordoubleglass13*19/325+($_POST['qty'])*1);}
if($_POST['Installation']=='YES'){$Silicon= ($_POST['qty']*1);}
if($_POST['Installation']=='NO'){$Silicon=($Spacerfordoubleglass13*19/325);}
}
if($_POST['Installation']=='YES'){ $Screw2x10=$AnchorCap;}
if($_POST['Width']+$_POST['Height']*2>=5500){$AnchorCap=($_POST['qty']*12);}
if($_POST['Width']>=1500){$DrainageCap=($_POST['qty']*2)*($_POST['qty']*3);}
if($Spacerfordoubleglass13>0){$GlassCleaner=($_POST['qty']*0.15);}

//if($_POST['Screen Sach'] == '0' && $_POST['Opena Able Screen'] > '0'){$Net345feet=($_POST['Height']/304.8);}
 /*?>if($_POST['Specification']=='FIX'){echo '<br/>Fix Frame(80)<br/>';echo ((($_POST['Width']-6)*2)/304.8)+((($_POST['Height']+6)*2)/304.8);}<?php */
//if($_POST['Door/Windows']=='D')//{$DoorPanel=$DoorPanel+(($_POST['Width']-152)/304.8*($_POST['Height']-152)/304.8)/6.32*19*$_POST['Door_Pannel']*$_POST['qty'];}

if($ScreenSash > 0){$MosquitoPullyJaliwheel=$VCutPulley;}
$Ruber667=($Sash80+$SBead80+$DBead80+$Sash88+$SBead88+$DBead88+$FixFrame80+$FSbead+$FDbead+$Mullion80+$OpenableFrame+($Sashoutward*2)+($Sashoutward*2)+$Mulllian60+($InwardSashDoor*2));
$JaliRuber=($ScreenSash+$Openablescreen);
$DoorCornerhingedown=($DoorCornerhingeMiddle);
$DoorCornerhingeTop=($DoorCornerhingeMiddle);
$Desicentfordoubleglass=($Spacerfordoubleglass13*13.38/1000);
$Spacerfordoubleglass13=($DBead80+$DBead88+$FDbead);
$SteelFramesashGI=($Frame80+$Sash80+$Frame88+$Sash88+$FixFrame80+$Mullion80+$OpenableFrame+$Sashoutward+$Mulllian60+$SashMolian+$oldSashMolian70);
$SteelFramesashGI=(($SteelFramesashGI/100)*85);
$SteeljaliMS=(($ScreenSash+$Openablescreen)/100)*85;
$DoorSteel=($OutwardSashDoor+$InwardSashDoor+$Doubledoormolian)*90;
$Screw4x16=(($_POST['qty'])*45);
$Screw4x20=(($_POST['qty'])*5);
$Screw4x25=(($_POST['qty'])*5);
$Screw4x30=(($_POST['qty'])*5);
$Rawalpluge=($Screw2x10);
$DastyAluminum=($JaliLockOpenable);
$WindbreakingBlockfor88=($StopperStrikesashfor88);
$tnos=$tnos+1;
$itnos=$itnos+1;
}while($_POST['tnos'] > ($tnos-1) );
?>
</div>


<div></div>


<!--//Leave Door Pannel AO-->

<form action="?r=quotations/addboq" method="post">
<div style="background-color:#cdcdcd; ">
<div class="col-xs-12"><div class="col-xs-4">
<input type="hidden" name="qid" value="<?php echo $_POST['qid'];?>"/>
<?php if($Frame80!=='') {?><label>Frame 80</label></br><input class="form-control" name="Frame80" value="<?php echo $Frame80;?>"/></br><?php } ?>
<?php if($Sash80!=='') {?><label>Sash80</label></br><input class="form-control" name="Sash80" value="<?php echo $Sash80;?>"/></br><?php } ?>
<?php if($ScreenSash!=='') {?><label>Screen Sash</label></br><input class="form-control"name="ScreenSash" value="<?php echo $ScreenSash;?>"/></br><?php } ?>
<?php if($Interlock80!=='') {?><label>Interlock 80</label></br><input class="form-control"name="Interlock80" value="<?php echo $Interlock80;?>"/></br><?php } ?>
<?php if($SBead80!=='') {?><label>S/Bead 80</label></br><input class="form-control"name="S/Bead80" value="<?php echo $SBead80;?>"/></br><?php } ?>
<?php if($DBead80!=='') {?><label>D/Bead 80</label></br><input class="form-control"name="D/Bead80" value="<?php echo $DBead80;?>"/></br><?php } ?>
<?php if($Frame88!=='') {?><label>Frame 88</label></br><input class="form-control"name="Frame88" value="<?php echo $Frame88;?>"/></br><?php } ?>
<?php if($Sash88!=='') {?><label>Sash88</label></br><input class="form-control"name="Sash88" value="<?php echo $Sash88;?>"/></br><?php } ?>
<?php if($Interlock88!=='') {?><label>Interlock 88</label></br><input class="form-control"name="Interlock88" value="<?php echo $Interlock88;?>"/></br><?php } ?>
<?php if($SBead88!=='') {?><label>S/Bead 88</label></br><input class="form-control"name="S/Bead88" value="<?php echo $SBead88;?>"/></br><?php } ?>
<?php if($DBead88!=='') {?><label>D/Bead 88</label></br><input class="form-control"name="D/Bead88" value="<?php echo $DBead88;?>"/></br><?php } ?>
<?php if($FixFrame80!=='') {?><label>Fix Frame 80</label></br><input class="form-control"name="FixFrame80" value="<?php echo $FixFrame80;?>"/></br><?php } ?>
<?php if($FSbead!=='') {?><label>F-S/bead</label></br><input class="form-control"name="F-S/bead" value="<?php echo $FSbead;?>"/></br><?php } ?>
<?php if($FDbead!=='') {?><label>F-D/bead</label></br><input class="form-control"name="F-D/bead" value="<?php echo $FDbead;?>"/></br><?php } ?>
<?php if($Mullion80!=='') {?><label>Mullion 80</label></br><input class="form-control"name="Mullion80" value="<?php echo $Mullion80;?>"/></br><?php } ?>
<?php if($OpenableFrame!=='') {?><label>Openable Frame</label></br><input class="form-control"name="OpenableFrame" value="<?php echo $OpenableFrame;?>"/></br><?php } ?>
<?php if($Sashoutward!=='') {?><label>Sash outward</label></br><input class="form-control"name="Sashoutward" value="<?php echo $Sashoutward;?>"/></br><?php } ?>
<?php if($Mulllian60!=='') {?><label>Mulllian 60</label></br><input class="form-control"name="Mulllian60" value="<?php echo $Mulllian60;?>"/></br><?php } ?>
<?php if($Openablescreen!=='') {?><label>Openable screen</label></br><input class="form-control"name="Openablescreen" value="<?php echo $Openablescreen;?>"/></br><?php } ?>
<?php if($OutwardSashDoor!=='') {?><label>Out ward Sash Door</label></br><input class="form-control"name="OutwardSashDoor" value="<?php echo $OutwardSashDoor;?>"/></br><?php } ?>
<?php if($InwardSashDoor!=='') {?><label>Inward Sash Door</label></br><input class="form-control"name="InwardSashDoor" value="<?php echo $InwardSashDoor;?>"/></br><?php } ?>
<?php if($Doubledoormolian!=='') {?><label>Double door molian</label></br><input class="form-control"name="Doubledoormolian" value="<?php echo $Doubledoormolian;?>"/></br><?php } ?>
<?php if($DoorPanel!=='') {?><label>Door Panel</label></br><input class="form-control"name="DoorPanel" value="<?php echo $DoorPanel;?>"/></br><?php } ?>
<?php if($MiddlayPipe!=='') {?><label>Middlay Pipe</label></br><input class="form-control"name="MiddlayPipe" value="<?php echo $MiddlayPipe;?>"/></br><?php } ?>
<?php if($RoundPipe!=='') {?><label>Round Pipe</label></br><input class="form-control"name="RoundPipe" value="<?php echo $RoundPipe;?>"/></br><?php } ?>
<?php if($CornerPost60!=='') {?><label>60 Corner Post</label></br><input class="form-control"name="60CornerPost" value="<?php echo $CornerPost60;?>"/></br><?php } ?>
<?php if($Adopter80!=='') {?><label>Adopter 80</label></br><input class="form-control"name="Adopter80" value="<?php echo $Adopter80;?>"/></br><?php } ?>
<?php if($Connector80to60!=='') {?><label>Connector 80 to 60</label></br><input class="form-control"name="Connector80to60" value="<?php echo $Connector80to60;?>"/></br><?php } ?>
<?php if($Connetor80to80!=='') {?><label>Connetor 80 to 80</label></br><input class="form-control"name="Connetor80to80" value="<?php echo $Connetor80to80;?>"/></br><?php } ?>
<?php if($SmallConnector!=='') {?><label>Small Connector</label></br><input class="form-control"name="SmallConnector" value="<?php echo $SmallConnector;?>"/></br><?php } ?>
<?php if($Pillar25mm!=='') {?><label>Pillar    (25mm)</label></br><input class="form-control"name="Pillar(25mm)" value="<?php echo $Pillar25mm;?>"/></br><?php } ?>
<?php if($SquarePipe!=='') {?><label>Square Pipe</label></br><input class="form-control"name="SquarePipe" value="<?php echo $SquarePipe;?>"/></br><?php } ?>
<?php if($TProfile!=='') {?><label>T Profile</label></br><input class="form-control"name="TProfile" value="<?php echo $TProfile;?>"/></br><?php } ?>
<?php if($DecorativeBars!=='') {?><label>Decorative Bars</label></br><input class="form-control"name="DecorativeBars" value="<?php echo $DecorativeBars;?>"/></br><?php } ?>
<?php if($SmallPanel!=='') {?><label>Small Panel</label></br><input class="form-control"name="SmallPanel" value="<?php echo $SmallPanel;?>"/></br><?php } ?>
<?php if($SashMolian!=='') {?><label>Sash Molian</label></br><input class="form-control"name="SashMolian" value="<?php echo $SashMolian;?>"/></br><?php } ?>
</div><div class="col-xs-4">
<?php if($WindowShutterGlazingBead!=='') {?><label>Window Shutter Glazing Bead</label></br><input class="form-control"name="WindowShutterGlazingBead" value="<?php echo $WindowShutterGlazingBead;?>"/></br><?php } ?>
<?php if($oldSashMolian70!=='') {?><label>old Sash Molian 70</label></br><input class="form-control"name="oldSashMolian70" value="<?php echo $oldSashMolian70;?>"/></br><?php } ?>
<?php if($VCutPulley!=='') {?><label>V Cut Pulley  </label></br><input class="form-control"name="VCutPulley  " value="<?php echo $VCutPulley;?>"/></br><?php } ?>
<?php if($DummyWheel!=='') {?><label>Dummy Wheel</label></br><input class="form-control"name="DummyWheel" value="<?php echo $DummyWheel;?>"/></br><?php } ?>
<?php if($Buffer!=='') {?><label>Buffer</label></br><input class="form-control"name="Buffer" value="<?php echo $Buffer;?>"/></br><?php } ?>
<?php if($Bursh881475!=='') {?><label>Bursh 88 (1475)</label></br><input class="form-control"name="Bursh88(1475)" value="<?php echo $Bursh881475;?>"/></br><?php } ?>
<?php if($Ruber667!=='') {?><label>Ruber (667)</label></br><input class="form-control"name="Ruber(667)" value="<?php echo $Ruber667;?>"/></br><?php } ?>
<?php if($JaliRuber!=='') {?><label>Jali Ruber</label></br><input class="form-control"name="JaliRuber" value="<?php echo $JaliRuber;?>"/></br><?php } ?>
<?php if($StopperStrikesashfor88!=='') {?><label>Stopper Strike sash for 88</label></br><input class="form-control"name="StopperStrikesashfor88" value="<?php echo $StopperStrikesashfor88;?>"/></br><?php } ?>
<?php if($WindbreakingBlockfor88!=='') {?><label>Wind breaking Block for 88</label></br><input class="form-control"name="WindbreakingBlockfor88" value="<?php echo $WindbreakingBlockfor88;?>"/></br><?php } ?>
<?php if($WhiteCrescentLockSmallHoock!=='') {?><label>White Crescent Lock Small Hoock</label></br><input class="form-control"name="WhiteCrescentLockSmallHoock" value="<?php echo $WhiteCrescentLockSmallHoock;?>"/></br><?php } ?>
<?php if($BrownCrescentLockSmallHoock!=='') {?><label>Brown Crescent Lock Small Hoock</label></br><input class="form-control"name="BrownCrescentLockSmallHoock" value="<?php echo $BrownCrescentLockSmallHoock;?>"/></br><?php } ?>
<?php if($SmallShaftMoonLock!=='') {?><label>Small Shaft Moon Lock</label></br><input class="form-control"name="SmallShaftMoonLock" value="<?php echo $SmallShaftMoonLock;?>"/></br><?php } ?>
<?php if($LongShaftMoonLock!=='') {?><label>Long Shaft Moon Lock</label></br><input class="form-control"name="LongShaftMoonLock" value="<?php echo $LongShaftMoonLock;?>"/></br><?php } ?>
<?php if($FlatWheel!=='') {?><label>Flat Wheel</label></br><input class="form-control"name="FlatWheel" value="<?php echo $FlatWheel;?>"/></br><?php } ?>
<?php if($AlumuniumTrack19!=='') {?><label>Alumunium Track; 19</label></br><input class="form-control"name="AlumuniumTrack;19" value="<?php echo $AlumuniumTrack19;?>"/></br><?php } ?>
<?php if($MosquitoPullyJaliwheel!=='') {?><label>Mosquito Pully (Jali wheel)</label></br><input class="form-control"name="MosquitoPully(Jaliwheel)" value="<?php echo $MosquitoPullyJaliwheel;?>"/></br><?php } ?>
<?php if($Transmission400!=='') {?><label>Transmission (400 mm)</label></br><input class="form-control"name="Transmission(400mm)" value="<?php echo $Transmission400;?>"/></br><?php } ?>
<?php if($Transmission600!=='') {?><label>Transmission 600</label></br><input class="form-control"name="Transmission600" value="<?php echo $Transmission600;?>"/></br><?php } ?>
<?php if($Transmission800!=='') {?><label>Transmission (800 mm)</label></br><input class="form-control"name="Transmission(800mm)" value="<?php echo $Transmission800;?>"/></br><?php } ?>
<?php if($Transmission1200!=='') {?><label>Transmission (1200 mm)</label></br><input class="form-control"name="Transmission(1200mm)" value="<?php echo $Transmission1200;?>"/></br><?php } ?>
<?php if($Transmissin1600!=='') {?><label>Transmissin 1600</label></br><input class="form-control"name="Transmissin1600" value="<?php echo $Transmissin1600;?>"/></br><?php } ?>
<?php if($DoorCornerhingeMiddle!=='') {?><label>Door Corner hinge Middle</label></br><input class="form-control"name="DoorCornerhingeMiddle" value="<?php echo $DoorCornerhingeMiddle;?>"/></br><?php } ?>
<?php if($DoorCornerhingedown!=='') {?><label>Door Corner hinge down</label></br><input class="form-control"name="DoorCornerhingedown" value="<?php echo $DoorCornerhingedown;?>"/></br><?php } ?>
<?php if($DoorCornerhingeTop!=='') {?><label>Door Corner hinge Top</label></br><input class="form-control"name="DoorCornerhingeTop" value="<?php echo $DoorCornerhingeTop;?>"/></br><?php } ?>
<?php if($CornerforAlmuniumspacer!=='') {?><label>Corner for Almunium spacer</label></br><input class="form-control"name="CornerforAlmuniumspacer" value="<?php echo $CornerforAlmuniumspacer;?>"/></br><?php } ?>
<?php if($Desicentfordoubleglass!=='') {?><label>Desicent for double glass</label></br><input class="form-control"name="Desicentfordoubleglass" value="<?php echo $Desicentfordoubleglass;?>"/></br><?php } ?>
<?php if($Spacerfordoubleglass13!=='') {?><label>Spacer for double glass; 13</label></br><input class="form-control"name="Spacerfordoubleglass;13" value="<?php echo $Spacerfordoubleglass13;?>"/></br><?php } ?>
<?php if($Inward3hinge!=='') {?><label>Inward # 3 hinge</label></br><input class="form-control"name="Inward#3hinge" value="<?php echo $Inward3hinge;?>"/></br><?php } ?>
<?php if($AnchorCap!=='') {?><label>Anchor Cap</label></br><input class="form-control"name="AnchorCap" value="<?php echo $AnchorCap;?>"/></br><?php } ?>
<?php if($WhiteLockCylinder!=='') {?><label>White Lock Cylinder</label></br><input class="form-control"name="WhiteLockCylinder" value="<?php echo $WhiteLockCylinder;?>"/></br><?php } ?>
<?php if($ButtonHolehandle!=='') {?><label>Button Hole handle</label></br><input class="form-control"name="ButtonHolehandle" value="<?php echo $ButtonHolehandle;?>"/></br><?php } ?>
<?php if($PlasticHandle!=='') {?><label>Plastic Handle</label></br><input class="form-control"name="PlasticHandle" value="<?php echo $PlasticHandle;?>"/></br><?php } ?>
<?php if($Slidingbuiltintouchlo2!=='') {?><label># 2 Sliding built in touch lo</label></br><input class="form-control"name="#2Slidingbuiltintouchlo" value="<?php echo $Slidingbuiltintouchlo2;?>"/></br><?php } ?>
<?php if($Singlepointshorthandle!=='') {?><label>Single point short handle  </label></br><input class="form-control"name="Singlepointshorthandle" value="<?php echo $Singlepointshorthandle;?>"/></br><?php } ?>
<?php if($KeyCylinder!=='') {?><label>Key Cylinder</label></br><input class="form-control"name="KeyCylinder" value="<?php echo $KeyCylinder;?>"/></br><?php } ?>
</div><div class="col-xs-4">
<?php if($Cylinder2!=='') {?><label>Cylinder 2</label></br><input class="form-control"name="Cylinder2" value="<?php echo $Cylinder2;?>"/></br><?php } ?>
<?php if($HookLock!=='') {?><label>Hook Lock</label></br><input class="form-control"name="Hook Lock" value="<?php echo $HookLock;?>"/></br><?php } ?>
<?php if($GermanLockhandleChain!=='') {?><label>German Lock handle Chain</label></br><input class="form-control"name="GermanLockhandleChain" value="<?php echo $GermanLockhandleChain;?>"/></br><?php } ?>
<?php if($Exteriorspecial7Handle!=='') {?><label>Exterior special #7 Handle</label></br><input class="form-control"name="Exteriorspecial#7Handle" value="<?php echo $Exteriorspecial7Handle;?>"/></br><?php } ?>
<?php if($WingOperator!=='') {?><label>Wing Operator</label></br><input class="form-control"name="WingOperator" value="<?php echo $WingOperator;?>"/></br><?php } ?>
<?php if($Outsidecasementhandle!=='') {?><label>Out side casement handle</label></br><input class="form-control"name="Out side casement handle" value="<?php echo $Outsidecasementhandle;?>"/></br><?php } ?>
<?php if($SinglePointHandle!=='') {?><label>Single Point Handle</label></br><input class="form-control"name="Single Point Handle" value="<?php echo $SinglePointHandle;?>"/></br><?php } ?>
<?php if($ReiseaidsingleBlock!=='') {?><label>Reiseaid single Block</label></br><input class="form-control"name="ReiseaidsingleBlock" value="<?php echo $ReiseaidsingleBlock;?>"/></br><?php } ?>
<?php if($WindowHandle!=='') {?><label>Window Handle</label></br><input class="form-control"name="WindowHandle" value="<?php echo $WindowHandle;?>"/></br><?php } ?>
<?php if($EuropeonCasementDoorLock!=='') {?><label>Europeon Casement Door Lock</label></br><input class="form-control"name="EuropeonCasementDoorLock" value="<?php echo $EuropeonCasementDoorLock;?>"/></br><?php } ?>
<?php if($MultifunctionalOWsmallerH!=='') {?><label>Multi functional O/W smaller H</label></br><input class="form-control"name="MultifunctionalO/WsmallerH" value="<?php echo $MultifunctionalOWsmallerH;?>"/></br><?php } ?>
<?php if($SmallUpliftingBlock10mm!=='') {?><label>Small Uplifting Block 10 mm</label></br><input class="form-control"name="SmallUpliftingBlock10mm" value="<?php echo $SmallUpliftingBlock10mm;?>"/></br><?php } ?>
<?php if($StandardStraightTwinHandle!=='') {?><label>Standard Straight Twin Handle</label></br><input class="form-control"name="StandardStraightTwinHandle" value="<?php echo $StandardStraightTwinHandle;?>"/></br><?php } ?>
<?php if($Inward13Handle!=='') {?><label>Inward # 13 Handle</label></br><input class="form-control"name="Inward#13Handle" value="<?php echo $Inward13Handle;?>"/></br><?php } ?>
<?php if($knotchFractionHinge18!=='') {?><label>18 knotch Fraction Hinge</label></br><input class="form-control"name="18knotchFractionHinge" value="<?php echo $knotchFractionHinge18;?>"/></br><?php } ?>
<?php if($Stay1012Inch!=='') {?><label>Stay 10/12 Inch</label></br><input class="form-control"name="Stay10/12Inch" value="<?php echo $Stay1012Inch;?>"/></br><?php } ?>
<?php if($DrainageCap!=='') {?><label>Drainage Cap</label></br><input class="form-control"name="DrainageCap" value="<?php echo $DrainageCap;?>"/></br><?php } ?>
<?php if($JaliHingePVC!=='') {?><label>Jali Hinge PVC</label></br><input class="form-control"name="JaliHingePVC" value="<?php echo $JaliHingePVC;?>"/></br><?php } ?>
<?php if($JaliLockOpenable!=='') {?><label>Jali Lock Openable</label></br><input class="form-control"name="Jali Lock Openable" value="<?php echo $JaliLockOpenable;?>"/></br><?php } ?>
<?php if($StandardCylinder!=='') {?><label>Standard Cylinder</label></br><input class="form-control"name="StandardCylinder" value="<?php echo $StandardCylinder;?>"/></br><?php } ?>
<?php if($SlidingDoorLock!=='') {?><label>Sliding Door Lock</label></br><input class="form-control"name="SlidingDoorLock" value="<?php echo $SlidingDoorLock;?>"/></br><?php } ?>
<?php if($OutwarHinge!=='') {?><label>Outwar Hinge</label></br><input class="form-control"name="OutwarHinge" value="<?php echo $OutwarHinge;?>"/></br><?php } ?>
<?php if($GlassCleaner!=='') {?><label>Glass Cleaner</label></br><input class="form-control"name="GlassCleaner" value="<?php echo $GlassCleaner;?>"/></br><?php } ?>
<?php if($Silicon!=='') {?><label>Silicon</label></br><input class="form-control"name="Silicon" value="<?php echo $Silicon;?>"/></br><?php } ?>
<?php if($Net345feet!=='') {?><label>Net 3+4+5 feet</label></br><input class="form-control"name="Net3+4+5feet" value="<?php echo $Net345feet;?>"/></br><?php } ?>
<?php if($SteelFramesashGI!=='') {?><label>Steel Frame sash G-I</label></br><input class="form-control"name="SteelFramesashG-I" value="<?php echo $SteelFramesashGI;?>"/></br><?php } ?>
<?php if($SteeljaliMS!=='') {?><label>Steel jali   M S</label></br><input class="form-control"name="SteeljaliMS" value="<?php echo $SteeljaliMS;?>"/></br><?php } ?>
<?php if($DoorSteel!=='') {?><label>Door Steel</label></br><input class="form-control"name="DoorSteel" value="<?php echo $DoorSteel;?>"/></br><?php } ?>
<?php if($Screw4x16!=='') {?><label>Screw 4*16</label></br><input class="form-control"name="Screw4*16" value="<?php echo $Screw4x16;?>"/></br><?php } ?>
<?php if($Screw4x20!=='') {?><label>Screw 4*20</label></br><input class="form-control"name="Screw4*20" value="<?php echo $Screw4x20;?>"/></br><?php } ?>
<?php if($Screw4x25!=='') {?><label>Screw 4*25</label></br><input class="form-control"name="Screw4*25" value="<?php echo $Screw4x25;?>"/></br><?php } ?>
<?php if($Screw4x30!=='') {?><label>Screw 4*30</label></br><input class="form-control"name="Screw4*30" value="<?php echo $Screw4x30;?>"/></br><?php } ?>
<?php if($Screw2x10!=='') {?><label>Screw 2x10</label></br><input class="form-control"name="Screw2x10" value="<?php echo $Screw2x10;?>"/></br><?php } ?>
<?php if($Rawalpluge!=='') {?><label>Rawal pluge</label></br><input class="form-control"name="Rawalpluge" value="<?php echo $Rawalpluge;?>"/></br><?php } ?>
<?php if($Screw1x10!=='') {?><label>Screw 1.50x10</label></br><input class="form-control"name="Screw1.50x10" value="<?php echo $Screw1x10;?>"/></br><?php } ?>
<?php if($DoorBolt!=='') {?><label>Door Bolt</label></br><input class="form-control"name="DoorBolt" value="<?php echo $DoorBolt;?>"/></br><?php } ?>
<?php if($DastyAluminum!=='') {?><label>Dasty Aluminum</label></br><input class="form-control"name="DastyAluminum" value="<?php echo $DastyAluminum;?>"/></br><?php } ?>
<?php if($BurshiDoor!=='') {?><label>Burshi Door</label></br><input class="form-control"name="BurshiDoor" value="<?php echo $BurshiDoor;?>"/></br><?php } ?>
<input class="form-control"type="hidden" name="win_id" value="<?php echo $_POST['win_id'] ?>"
</div>
</div>
<input type="submit" class="btn" value=" Create BOQ" />
</form>
