<?php
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
    case 1:
        $progress_status = ''; //Show ALL
        break;
    case 2:
        $progress_status = ' AND (cp.status = 3 OR cp.status = -3)';
        break;
    case 3:
        $progress_status = ' AND (cp.status = 4 OR cp.status = -4)';
        break;
    case 4:
        $progress_status = ' AND (cp.status = 5 OR cp.status = -5)';
        break;
    case 5:
        $progress_status = ' AND (cp.status = 6 OR cp.status = -6)';
        break;
    default:
        $progress_status = '';
        break;
}

$contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name,
                    t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name,
                    cp.id as progress_id, cp.task,cp.details,
                    cp.progress, cp.start_date, cp.end_date, cp.status as progress_status,
                    cp.submission_date, emp.name as submitted_by
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    LEFT JOIN pub   lic."m_contract_progress" AS cp ON cont.id = cp.contract_id
                    LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                    WHERE cont.status=1 ' . $progress_status . '
                    ORDER BY cont.id ASC';
$contract_Q = 'SELECT
                    COUNT(*) AS total,
                    cp.status as progress_status,
                    cp.submission_date, cp.submitted_by, emp.name as submitted_by
                FROM public.m_contract_progress AS cp
                LEFT JOIN public."m_contract" as cont ON cont."contractor_id" = cp ."contract_id"
                LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                WHERE  cont.status=1  ' . $progress_status . '
                GROUP BY cp.submission_date,cp.submitted_by,cp.status,emp.name;';

$contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();

// echo $contract_Q;
// exit;


?>

<!--  Contract Notifications -->
<li class="nav-item dropdown">
    <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" data-bs-auto-close="outside">

        <span class="fas fa-bell  fs-5" style="height:20px;width:20px;"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
            <div class="card-header p-2">
                <div class="d-flex justify-content-between">
                    <h5 class="text-black mb-0">Progress Submission
                        <small>(<?= count($contract_list) ?> New Submissions)</small>
                    </h5>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="scrollbar-overlay" style="height: 27rem;">
                    <div class="border-300">
                        <?php
                        if (count($contract_list) == 0) { ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                    class="me-1 fs--2"></span>No Notification!<span
                                                    class="ms-2 text-400 fw-bold fs--2"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php  }
                        foreach ($contract_list as $notify):
                            $status = $notify['progress_status'];
                            $current_status = "Draft Saved";
                            if ($status == 2) {
                                $status = "Draft Submitted";
                            } elseif ($status == -2) {
                                $status = "Draft Rejected";
                            } elseif ($status == 3) {
                                $status = "Approved by RO";
                            } elseif ($status == -3) {
                                $status = "Rejected by RO";
                            } elseif ($status == 4) {
                                $status = "Approved by ZONE";
                            } elseif ($status == -4) {
                                $status = "Rejected by ZONE";
                            } elseif ($status == 5) {
                                $status = "Approved by RAMD";
                            } elseif ($status == -5) {
                                $status = "Rejected by RAMD";
                            } elseif ($status == 6) {
                                $status = "Approved by HO";
                            } elseif ($status == -6) {
                                $status = "Rejected by HO";
                            }
                        ?>
                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <!-- Notification content -->
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <h4 class="fs--1 text-black">
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                    <span class="me-1 fs--2">💬</span> New Progress Submitted </b>
                                                </p>
                                                <!-- Displaying Current Status -->
                                                <p class="text-800 fs--1 mb-0">
                                                    <span class="me-1 far fa-calendar-check"></span>
                                                    <span class="fw-bold"><?= $current_status ?></span>
                                                </p>
                                                <br>
                                                <!-- Displaying created date -->
                                                <p class="text-800 fs--1 mb-0">
                                                    <span class="me-1 fas fa-clock"></span>
                                                    <span
                                                        class="fw-bold"><?= date('h:i A', strtotime($notify['submission_date'])) ?>
                                                    </span>
                                                    <?= date('F j, Y', strtotime($notify['submission_date'])) ?>
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

                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</li>