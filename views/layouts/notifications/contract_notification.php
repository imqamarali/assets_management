<?php
$contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    WHERE cont.status<1';
$contract_notifications = Yii::$app->db->createCommand($contract_Q)->queryAll();



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
                    <h5 class="text-black mb-0">Contract Notificatons
                        <small>(<?= count($contract_notifications) ?>)</small>
                    </h5>
                    <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as read</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="scrollbar-overlay" style="height: 27rem;">
                    <div class="border-300">
                        <?php
                        if (count($contract_notifications) == 0) { ?>
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
                        foreach ($contract_notifications as $notify): ?>

                            <div
                                class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                <div class="d-flex align-items-center justify-content-between position-relative">
                                    <!-- Notification content -->
                                    <div class="d-flex">
                                        <div class="flex-1 me-sm-3">
                                            <h4 class="fs--1 text-black">
                                                <?= htmlspecialchars($notify['contractor_name']) ?></h4>
                                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                <span class="me-1 fs--2">💬</span>New Contract
                                                <?= htmlspecialchars($notify['type_name']) ?> Created
                                            </p>

                                            <!-- Displaying created date -->
                                            <p class="text-800 fs--1 mb-0">
                                                <span class="me-1 fas fa-clock"></span>
                                                <span class="fw-bold"><?= date('h:i A', strtotime($notify['created_at'])) ?>
                                                </span>
                                                <?= date('F j, Y', strtotime($notify['created_at'])) ?>
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

                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
            <div class="card-footer p-0 border-top border-0">
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="index.php">Notification
                        history</a></div>
            </div>
        </div>
    </div>
</li>