<?php
// $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
//                     r.name AS region_name,u.name AS unit_name,
//                     rt.name AS route_name,d.name AS district_name
//                     FROM public."m_contract" as cont
//                     LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
//                     LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
//                     LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
//                     LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
//                     LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
//                     LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
//                     LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
//                     WHERE cont.status<1';
// $contract_notifications = Yii::$app->db->createCommand($contract_Q)->queryAll();




$contract_Q = 'SELECT COUNT(*) as total, MAX(cont.created_at) as last_date
                    FROM public."m_contract" as cont
                    WHERE cont.status<1';
$contract_notifications = Yii::$app->db->createCommand($contract_Q)->queryOne();


// User Levels
// "1"  "Admin Role"    "Admin"
// "2"  "RO Role"	    "RO"
// "3"  "ZONE Role"	    "ZONE"
// "4"  "RAMD Role"	    "RAMD"
// "5"  "HO Role"	    "HO"

// Approval Status
// "2"      "Draft Submitted";
// "-2"     "Draft Rejected";
// "3"      "Approved by RO";
// "-3"     "Rejected by RO";
// "4"      "Approved by ZONE";
// "-4"     "Rejected by ZONE";
// "5"      "Approved by RAMD";
// "-5"     "Rejected by RAMD";
// "6"      "Approved by HO";
// "-6"     "Rejected by HO";

// Status For Roles to Show

$user_level = Yii::$app->session->get('user_array')['user_level'];

$progress_status = '';
switch ($user_level) {
    case 1: // "1"  "Admin Role"    "Admin"
        $progress_status = ''; //Show ALL
        break;
    case 2: // "2"  "RO Role"	    "RO"
        $progress_status = ' AND (cp.status = 2 OR cp.status = -3)';
        break;
    case 3: // "3"  "ZONE Role"	    "ZONE"
        $progress_status = ' AND (cp.status = 3 OR cp.status = -4)';
        break;
    case 4: // "4"  "RAMD Role"	    "RAMD"
        $progress_status = ' AND (cp.status = 4 OR cp.status = -5)';
        break;
    case 5: // "5"  "HO Role"	    "HO"
        $progress_status = ' AND (cp.status = 5 OR cp.status = -6)';
        break;
    default:
        $progress_status = '';
        break;
}
// $status = $item['progress_status'];
// $current_status = "Draft Saved";
// if ($status == 2) {
//     $current_status = "Draft Submitted";
// } elseif ($status == -2) {
//     $current_status = "Draft Rejected";
// } elseif ($status == 3) {
//     $current_status = "Approved by RO";
// } elseif ($status == -3) {
//     $current_status = "Rejected by RO";
// } elseif ($status == 4) {
//     $current_status = "Approved by ZONE";
// } elseif ($status == -4) {
//     $current_status = "Rejected by ZONE";
// } elseif ($status == 5) {
//     $current_status = "Approved by RAMD";
// } elseif ($status == -5) {
//     $current_status = "Rejected by RAMD";
// } elseif ($status == 6) {
//     $current_status = "Approved by HO";
// } elseif ($status == -6) {
//     $current_status = "Rejected by HO";
// }

$progress_Q = 'SELECT
                    COUNT(cp.*) as total, MAX(cp.submission_date) as last_submission, 
                    MAX(emp.name) as last_submitted_by
                FROM public.m_contract_progress AS cp
                LEFT JOIN public.m_contract AS cont ON cont."id" = cp."contract_id"
                LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                WHERE cont.status = 1 ' . $progress_status . '
                HAVING COUNT(cp.*) > 0 ;';
// echo $progress_Q;

$progress_list = Yii::$app->db->createCommand($progress_Q)->queryOne();

$user_level = Yii::$app->session->get('user_array')['user_level'];

$progress_status = '';
switch ($user_level) {
    case 1: // "1"  "Admin Role"    "Admin"
        $progress_status = ' AND (cp.status !=0 )'; //Show ALL
        break;
    case 2: // "2"  "RO Role"	    "RO"
        $progress_status = ' AND (cp.status = 2 OR cp.status = -3)';
        break;
    case 3: // "3"  "ZONE Role"	    "ZONE"
        $progress_status = ' AND (cp.status = 3 OR cp.status = -4)';
        break;
    case 4: // "4"  "RAMD Role"	    "RAMD"
        $progress_status = ' AND (cp.status = 4 OR cp.status = -5)';
        break;
    case 5: // "5"  "HO Role"	    "HO"
        $progress_status = ' AND (cp.status = 5 OR cp.status = -6)';
        break;
    default:
        $progress_status = '';
        break;
}

$demand_Q = 'SELECT
                    COUNT(cp.*) as total, MAX(cp.date) as last_submission, 
                    MAX(emp.name) as last_submitted_by
                FROM public.demand_of_bill AS cp
                LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                WHERE 1=1 ' . $progress_status . '
                HAVING COUNT(cp.*) > 0 ;';
// echo $progress_status;
// exit;
$demand_list = Yii::$app->db->createCommand($demand_Q)->queryOne();


?>

<!--  Contract Notifications -->
<li class="nav-item dropdown">
    <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell"
            style="height:20px;width:20px;"></span></a>

    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
            <div class="card-header p-2">
                <div class="d-flex justify-content-between">
                    <h5 class="text-black mb-0">Notificatons
                    </h5>
                    <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as read</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="scrollbar-overlay" style="height: 27rem;">
                    <div class="border-300">
                        <?php if ($contract_notifications) { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <!-- Notification content -->
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                <span class="me-1 fs--2">💬</span> <?= $contract_notifications['total'] ?>
                                                New Contracts Created
                                            </p>

                                            <!-- Displaying created date -->
                                            <p class="text-800 fs--1 mb-0">
                                                <small>Last Created At</small>
                                            </p>
                                            <p class="text-800 fs--1 mb-0">
                                                <span class="me-1 fas fa-clock"></span>
                                                <span
                                                    class="fw-bold"><?= date('h:i A', strtotime($contract_notifications['last_date'])) ?>
                                                </span>
                                                <?= date('F j, Y', strtotime($contract_notifications['last_date'])) ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Notification actions (button) -->
                                    <div class="font-sans-serif d-none d-sm-block">
                                        <a href="index.php?r=notification/contractnotifications"
                                            class="btn fs--2 btn-sm transition-none notification-dropdown-toggle"
                                            type="button">
                                            <span class="ace-icon fa fa-eye bigger-130"></span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        <?php } else { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                    class="me-1 fs--2"></span>No Contract Notification!<span
                                                    class="ms-2 text-400 fw-bold fs--2"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($progress_list) { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <!-- Notification content -->
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                <span class="me-1 fs--2">💬</span> <?= $progress_list['total'] ?>
                                                New Progress Submissions
                                            </p>

                                            <!-- Displaying created date -->
                                            <p class="text-800 fs--1 mb-0">
                                                <small>Last Submission At</small>
                                            </p>
                                            <p class="text-800 fs--1 mb-0">
                                                <span class="me-1 fas fa-clock"></span>
                                                <span
                                                    class="fw-bold"><?= date('h:i A', strtotime($progress_list['last_submission'])) ?>
                                                </span>
                                                <?= date('F j, Y', strtotime($progress_list['last_submission'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Notification actions (button) -->
                                    <div class="font-sans-serif d-none d-sm-block">
                                        <a href="index.php?r=notification/progressnotifications"
                                            class="btn fs--2 btn-sm transition-none notification-dropdown-toggle"
                                            type="button">
                                            <span class="ace-icon fa fa-eye bigger-130"></span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        <?php } else { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                    class="me-1 fs--2"></span>No Progress Notification!<span
                                                    class="ms-2 text-400 fw-bold fs--2"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($demand_list) { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <!-- Notification content -->
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                <span class="me-1 fs--2">💬</span> <?= $demand_list['total'] ?>
                                                New Demand Submissions
                                            </p>

                                            <!-- Displaying created date -->
                                            <p class="text-800 fs--1 mb-0">
                                                <small>Last Submission At</small>
                                            </p>
                                            <p class="text-800 fs--1 mb-0">
                                                <span class="me-1 fas fa-clock"></span>
                                                <span
                                                    class="fw-bold"><?= date('h:i A', strtotime($demand_list['last_submission'])) ?>
                                                </span>
                                                <?= date('F j, Y', strtotime($demand_list['last_submission'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Notification actions (button) -->
                                    <div class="font-sans-serif d-none d-sm-block">
                                        <a href="index.php?r=notification/demandnotifications"
                                            class="btn fs--2 btn-sm transition-none notification-dropdown-toggle"
                                            type="button">
                                            <span class="ace-icon fa fa-eye bigger-130"></span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        <?php } else { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                    class="me-1 fs--2"></span>No Demand Notification!<span
                                                    class="ms-2 text-400 fw-bold fs--2"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="card-footer p-0 border-top border-0">
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                        href="index.php">Notification</a></div>
            </div>
        </div>
    </div>
</li>