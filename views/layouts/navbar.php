<?php

use yii\bootstrap\Nav;
?>
<?php
$total_notifications = 0;
$conn = Yii::$app->getDb();
$sqlimg = "SELECT * FROM config";
$resultimg = $conn->createCommand($sqlimg)->queryOne();


$sqlimg1 = "SELECT * FROM navbarlogo";
$resultimg1 = $conn->createCommand($sqlimg1)->queryOne();

$sqla = "SELECT COUNT(*) FROM memberplot
                where  memberplot.status='Sales'";
$resulta = $conn->createCommand($sqla)->queryOne();

$sqlat = "SELECT COUNT(*) FROM transferplot";
$resultat = $conn->createCommand($sqlat)->queryOne();

$sqlat1 = "SELECT COUNT(*) FROM possession where status=0";
$resultat1 = $conn->createCommand($sqlat1)->queryOne();

$sqlat12 = "SELECT COUNT(*) FROM transaction where isApp=0";
$resultat12 = $conn->createCommand($sqlat12)->queryOne();

$sqlat12fa = "SELECT COUNT(*) FROM form_generate_sub where isApprove=0";
$resultat12fa = $conn->createCommand($sqlat12fa)->queryOne();

//          $fmd_sql = "SELECT COUNT(*) AS total FROM jz_deal WHERE fmd_status = 0";
// $fmd_res = $conn->createCommand($fmd_sql)->queryOne();

// $fmd1_sql = "SELECT COUNT(*) AS total FROM jz_deal WHERE fmd_status = 1";
// $fmd1_res = $conn->createCommand($fmd1_sql)->queryOne(); 

$sqlla = "SELECT COUNT(*) FROM leadtask where startdate='" . date('Y-m-d') . "'";
$resultla = $conn->createCommand($sqlla)->queryOne();

// $sqlissueform= "SELECT COUNT(*) FROM deals where isApprove=0";
// $resultissueform = $conn->createCommand($sqlissueform)->queryOne();


//   $sqllt= "SELECT COUNT(*) FROM leadtask where startdate='".date('Y-m-d')."'";
//   $resultlt = $conn->createCommand($sqllt)->queryOne();

// $sqlal= "SELECT COUNT(*) FROM lead where assigned_to='".$_SESSION['user_array']['id']."'";
// $resultlal = $conn->createCommand($sqlal)->queryOne();

$sqlatdel = "SELECT COUNT(*) FROM ms_del where status=0";
$resultatdel = $conn->createCommand($sqlatdel)->queryOne();

if ($_SESSION['user_array']['user_level'] > 1) {
    $leave_notify_sql = "SELECT COUNT(*) FROM leavedetail where eid='" . $_SESSION['user_array']['id'] . "' AND (status = 1 OR status = 2)";
    $leave_notify_res = $conn->createCommand($leave_notify_sql)->queryOne();
    $total_notifications += $leave_notify_res['COUNT(*)'];

    $loan_notify_sql = "SELECT COUNT(*) FROM emp_loan where eid='" . $_SESSION['user_array']['id'] . "' AND (status = 1 OR status = 2)";
    $loan_notify_res = $conn->createCommand($loan_notify_sql)->queryOne();
    $total_notifications += $loan_notify_res['COUNT(*)'];

    $demand_notify_sql = "SELECT COUNT(*) FROM demand";
    $demand_notify_res = $conn->createCommand($demand_notify_sql)->queryOne();
    $total_notifications += $demand_notify_res['COUNT(*)'];

    $tenent_notify_sql = "SELECT COUNT(*) FROM tenent_registration WHERE reg_status = 0";
    $tenent_notify_res = $conn->createCommand($tenent_notify_sql)->queryOne();
    $total_notifications += $tenent_notify_res['COUNT(*)'];

    $reallocation_sql = "SELECT COUNT(*) AS total FROM reallocation_history WHERE `status` = 0";
    $reallocation_res = $conn->createCommand($reallocation_sql)->queryOne();
    $total_notifications += $reallocation_res['total'];

    $conv_plot_sql = "SELECT COUNT(*) AS total FROM allot_a_plot WHERE `status` = 0";
    $conv_plot_res = $conn->createCommand($conv_plot_sql)->queryOne();
    $total_notifications += $conv_plot_res['total'];

    $cancel_req_sql = "SELECT COUNT(*) AS total FROM memberplot WHERE `status` = 'Cancel Request'";
    $cancel_req_res = $conn->createCommand($cancel_req_sql)->queryOne();
    $total_notifications += $cancel_req_res['total'];

    // $bill_notif_sql = "SELECT COUNT(*) AS total FROM tenent_main_bill WHERE `is_approved` = '0'";
    // $bill_notif_res = $conn->createCommand($bill_notif_sql)->queryOne();
    // $total_notifications += $bill_notif_res['total'];
} else {
    $leave_notify_sql = "SELECT COUNT(*) FROM leavedetail WHERE status = 0";
    $leave_notify_res = $conn->createCommand($leave_notify_sql)->queryOne();
    $total_notifications += $leave_notify_res['COUNT(*)'];

    $loan_notify_sql = "SELECT COUNT(*) FROM emp_loan WHERE status = 0";
    $loan_notify_res = $conn->createCommand($loan_notify_sql)->queryOne();
    $total_notifications += $loan_notify_res['COUNT(*)'];

    $demand_notify_sql = "SELECT COUNT(*) FROM demand";
    $demand_notify_res = $conn->createCommand($demand_notify_sql)->queryOne();
    $total_notifications += $demand_notify_res['COUNT(*)'];

    $tenent_notify_sql = "SELECT COUNT(*) FROM tenent_registration WHERE reg_status = 0";
    $tenent_notify_res = $conn->createCommand($tenent_notify_sql)->queryOne();
    $total_notifications += $tenent_notify_res['COUNT(*)'];

    $reallocation_sql = "SELECT COUNT(*) AS total FROM reallocation_history WHERE `status` = 0";
    $reallocation_res = $conn->createCommand($reallocation_sql)->queryOne();
    $total_notifications += $reallocation_res['total'];

    $conv_plot_sql = "SELECT COUNT(*) AS total FROM allot_a_plot WHERE `status` = 0";
    $conv_plot_res = $conn->createCommand($conv_plot_sql)->queryOne();
    $total_notifications += $conv_plot_res['total'];

    $cancel_req_sql = "SELECT COUNT(*) AS total FROM memberplot WHERE `status` = 'Cancel Request'";
    $cancel_req_res = $conn->createCommand($cancel_req_sql)->queryOne();
    $total_notifications += $cancel_req_res['total'];

    // $bill_notif_sql = "SELECT COUNT(*) AS total FROM tenent_main_bill WHERE `is_approved` = '0'";
    // $bill_notif_res = $conn->createCommand($bill_notif_sql)->queryOne();
    // $total_notifications += $bill_notif_res['total'];
}

?>
<?php
$report_show  = "SELECT * from allotment_detail_permissions WHERE user_id = '" . $_SESSION['user_array']['user_level'] . "'";
$report_show_res = $conn->createCommand($report_show)->queryAll();
$notifi_counter = count($report_show_res);
$fa = false;
$ar = false;
$tr = false;
$pr = false;
$le = false;
$lo = false;
$dem = false;
$lead = false;
$act = false;
$deal_finance_approval = false;
$deal_admin_approval = false;
$tenant_requests = false;
$reallocation_requests = false;
$convert_to_plot_requests = false;
$cancellation_requests = false;
$tenant_bill_notifications = false;
foreach ($report_show_res as $row) {
    if ($row['allotment_detail_id'] == 24) {
        $fa = true;
    }
    if ($row['allotment_detail_id'] == 25) {
        $ar = true;
    }
    if ($row['allotment_detail_id'] == 26) {
        $tr = true;
    }
    if ($row['allotment_detail_id'] == 27) {
        $pr = true;
    }
    if ($row['allotment_detail_id'] == 28) {
        $le = true;
    }
    if ($row['allotment_detail_id'] == 29) {
        $lo = true;
    }
    if ($row['allotment_detail_id'] == 30) {
        $dem = true;
    }
    if ($row['allotment_detail_id'] == 31) {
        $lead = true;
    }
    if ($row['allotment_detail_id'] == 32) {
        $act = true;
    }
    if ($row['allotment_detail_id'] == 34) {
        $deal_finance_approval = true;
    }
    if ($row['allotment_detail_id'] == 35) {
        $deal_admin_approval = true;
    }
    if ($row['allotment_detail_id'] == 36) {
        $tenant_requests = true;
    }
    if ($row['allotment_detail_id'] == 37) {
        $reallocation_requests = true;
    }
    if ($row['allotment_detail_id'] == 38) {
        $convert_to_plot_requests = true;
    }
    if ($row['allotment_detail_id'] == 39) {
        $cancellation_requests = true;
    }
    if ($row['allotment_detail_id'] == 40) {
        $tenant_bill_notifications = true;
    }
}
?>
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">


        <div class="navbar-header pull-left"> <a href="index.php?r=" class="navbar-brand"> <small>
                    <?php echo $resultimg['companyname']; ?></small> </a> </div>

        <?php //print_r( $_SESSION['user_perm_array']);
        //echo $_SESSION['user_array']['usertype'];exit;
        if (isset($_SESSION['user_array'])) { ?>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav pull-right">
                <!--<li class="purple dropdown-modal"> -->
                <li class="purple dropdown-modal open">

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                        <i class="ace-icon fa fa-bell"></i>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close"
                        style="width: 320px; height: 253px; left: 631px; right: auto; top: 114px;">
                        <li class="dropdown-content ace-scroll" style="position: relative;">
                            <div class="scroll-content" style="">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                    <?php if ($notifi_counter <= 0) { ?>
                                    <li>
                                        <a>
                                            <div class="clearfix">
                                                <h5>No Nofication!</h5>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if ($fa) { ?>
                                    <li>
                                        <a href="index.php?r=formgenerate/approve">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-blue fa fa-check"></i>
                                                    Form Approval
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resultat12fa['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?r=deals/approve">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-yellow fa fa-check-square-o"
                                                        style="color: #000000 !important;"></i>
                                                    Issue Form Approval
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resultissueform['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>


                                    <?php } ?>
                                    <?php if ($ar) { ?>
                                    <li>
                                        <a href="index.php?r=memberplot/index2">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i
                                                        class="btn btn-xs no-hover btn-success fa fa-pencil-square-o"></i>
                                                    Allotment Requests
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resulta['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($cancellation_requests) { ?>
                                    <li>
                                        <a href="index.php?r=memberplot/cancel">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-inverse fa fa-ban"></i>
                                                    Cancellation Requests
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $cancel_req_res['total']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($reallocation_requests) { ?>
                                    <li>
                                        <a href="index.php?r=memberplot/reallocation_notifications">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-yellow fa fa-bell"
                                                        style="color: #000000 !important;"></i>
                                                    Reallocation Request
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $reallocation_res['total']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($convert_to_plot_requests) { ?>
                                    <li>
                                        <a href="index.php?r=memberplot/convert_to_plot_notifications">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-bell"></i>
                                                    Convert to Plot Request
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $conv_plot_res['total']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($tenant_requests) { ?>
                                    <li>
                                        <a
                                            href="index.php?r=tenent-registration/tenent_notifications&user_id=<?php echo $_SESSION['user_array']['id']; ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i
                                                        class="btn btn-xs no-hover btn-success fa fa-pencil-square-o"></i>
                                                    Tenent Request
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $tenent_notify_res['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($tenant_bill_notifications) { ?>
                                    <li>
                                        <a href="index.php?r=tenent-registration/tenant_bill_notifications">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-danger fa fa-file-text-o"></i>
                                                    Tenent Bill Notifications
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $bill_notif_res['total']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($tr) { ?>
                                    <li>
                                        <a href="index.php?r=memberplot/aprovalr">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-warning fa fa-exchange"></i>
                                                    Transfer Requests
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resultat['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($deal_finance_approval) { ?>
                                    <li>
                                        <a href="index.php?r=dealnew/fin_approval">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-inverse fa fa-envelope-o"></i>
                                                    Deal Finance Approval
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $fmd_res['total']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($le) { ?>
                                    <li>
                                        <a
                                            href="index.php?r=leavedetail/leave_notifications&user_id=<?php echo $_SESSION['user_array']['id']; ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-wheelchair"></i>
                                                    Leave Notifications
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $leave_notify_res['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if ($lo) { ?>
                                    <li>
                                        <a
                                            href="index.php?r=emploan/loan_notifications&user_id=<?php echo $_SESSION['user_array']['id']; ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-yellow fa fa-usd"></i>
                                                    Loan Notifications
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $loan_notify_res['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if ($dem) { ?>
                                    <li>
                                        <a
                                            href="index.php?r=trans/demand_listall&user_id=<?php echo $_SESSION['user_array']['id']; ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-blue fa fa-gavel"></i>
                                                    Demand Notifications
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $demand_notify_res['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if ($lead) { ?>
                                    <li>
                                        <a
                                            href="index.php?r=lead/index&LeadSearch[assigned_to]=<?php echo $_SESSION['user_array']['id']; ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-info fa fa-calendar"></i>
                                                    Latest Assinged Leads
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resultlal['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if ($act) { ?>
                                    <li>
                                        <a href="index.php?r=leadtask/to_do_list&date=<?php echo date('Y-m-d') ?>">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-inverse fa fa-envelope-o"></i>
                                                    Today's Activities and Tasks
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo ($resultla['COUNT(*)'] + $resultlt['COUNT(*)']); ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>


                                    <li>
                                        <a href="index.php?r=memberplot/del_membership_list">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-success fa fa-trash-o"></i>
                                                    Delete Membership
                                                </span>
                                                <span
                                                    class="pull-right badge badge-info"><?php echo $resultatdel['COUNT(*)']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>



                <li class="light-blue user-profile">
                    <a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php if (!empty($_SESSION['user_array']['pic'])) { ?>
                        <img src="img/employee/<?php echo $_SESSION['user_array']['pic']; ?>" class="nav-user-photo"
                            alt="N/A" />
                        <?php } else { ?>
                        <img src="img/dummy.png" class="nav-user-photo" />
                        <?php } ?>
                        <span id="user_info">
                            <b>Welcome,</b> <?php echo $_SESSION['user_array']['name'] ?? ''; ?>
                        </span>
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul id="user_menu" class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                        <li><a
                                href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=memberplot/setting&id=<?php echo $_SESSION['user_array']['id']; ?>"><i
                                    class="icon-cog"></i> Settings</a></li>
                        <li><a
                                href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=employee/profile&id=<?php echo $_SESSION['user_array']['id']; ?>"><i
                                    class="icon-user"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=/site/logout"><i
                                    class="icon-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php } ?>
        <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li> <a href="index.php?r=dashboard">
                        Real Estate Management System
                        <!-- eSystem -->
                        &nbsp;
                    </a> </li>
            </ul>
        </nav>
    </div>
</div>





<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
    try {
        ace.settings.loadState('main-container')
    } catch (e) {}
    </script>

    <div id="sidebar" class="sidebar ace-save-state h-sidebar navbar-collapse collapse">
        <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
        </script>

        <div class="sidebar-shortcuts" style=" width:150px;padding:5px !important;" id="sidebar-shortcuts">
            <img src="img/<?php echo $resultimg['logo']; ?>" alt="<?php echo $resultimg['companyname']; ?>"
                style="max-width: 68px;">
        </div><!-- /.sidebar-shortcuts -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'nav nav-list'],
                'items' => Yii::$app->Permission->getNavbar(),
            ]
        );
        ?>
    </div>