<?php

use yii\bootstrap\Nav;

$sidebarItems = Yii::$app->Permissions->getSidebar();
$home = false;
$home_assets = false;
$home_amp = false;
$home_contract = false;
$home_condition = false;
$contract_progress = false;

foreach ($sidebarItems as $module) {
    if ($module['module_id'] == 18) {
        foreach ($module['submenu'] as $submenu) {
            if ($submenu['id'] == 58) {  // Asset Dashboard
                $home_assets = true;
            }
            if ($submenu['id'] == 59) {  // AMP Dashboard
                $home_amp = true;
            }
            if ($submenu['id'] == 60) {  // Contract Dashboard
                $home_contract = true;
            }
            if ($submenu['id'] == 61) {  // Condition Dashboard
                $home_condition = true;
            }
        }
        $home = true;
    }
}
$assets_management = in_array(23, array_column($sidebarItems, 'module_id')) ?? false;
$contract_management = in_array(24, array_column($sidebarItems, 'module_id')) ?? false;
$contract_progress = in_array(32, array_column($sidebarItems, 'module_id')) ?? false;
$revenue_management = in_array(25, array_column($sidebarItems, 'module_id')) ?? false;
$traffic_management = in_array(26, array_column($sidebarItems, 'module_id')) ?? false;
$budgeting_management = in_array(27, array_column($sidebarItems, 'module_id')) ?? false;
$event_management = in_array(28, array_column($sidebarItems, 'module_id')) ?? false;
$reporting = in_array(29, array_column($sidebarItems, 'module_id')) ?? false;
$maintenance = in_array(30, array_column($sidebarItems, 'module_id')) ?? false;
$users_permission = in_array(31, array_column($sidebarItems, 'module_id')) ?? false;



$contract_Q = 'SELECT COUNT(*) as total, MAX(cont.created_at) as last_date
                    FROM public."m_contract" as cont
                    WHERE cont.status<1';
$contract_notifications = Yii::$app->db->createCommand($contract_Q)->queryOne();

?>




<nav class="navbar navbar-vertical navbar-expand-lg">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>



    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">


            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-home" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-home">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                <span class="nav-link-icon"><span data-feather="pie-chart"></span></span>
                                <span class="nav-link-text">Home</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent show" data-bs-parent="#navbarVerticalCollapse" id="nv-home">
                                <li class="collapsed-nav-item-title d-none">Home</li>

                                <?php if ($home_assets): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php" data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text">Asset Dashboard</span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($home_amp): ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php" data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text">AMP Dashboard</span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($home_contract): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php" data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text">Contract Dashboard</span>
                                                <span class="badge ms-2 badge badge-phoenix badge-phoenix-info">New</span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($home_condition): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php" data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text">Condition Dashboard</span>
                                                <span class="badge ms-2 badge badge-phoenix badge-phoenix-info">New</span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </li>

                <!-- Apps Section -->
                <li class="nav-item">
                    <p class="navbar-vertical-label">Apps</p>
                    <hr class="navbar-vertical-line">

                    <?php if ($assets_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=assets/index" role="button"
                                aria-expanded="false" aria-controls="nv-e-commerce">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="shopping-cart"></span></span>
                                    <span class="nav-link-text">Asset Management</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($contract_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=contract/index"
                                aria-expanded="false" aria-controls="nv-CRM">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="phone"></span></span>
                                    <span class="nav-link-text">Contract Management</span>
                                    <span class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                        style="font-size: 6px"></span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ($contract_progress): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=contract/progress"
                                aria-expanded="false" aria-controls="nv-CRM">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="phone"></span></span>
                                    <span class="nav-link-text">Contract Progress</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($revenue_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=revenue/index" role="button"
                                aria-expanded="false" aria-controls="nv-project-management">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="clipboard"></span></span>
                                    <span class="nav-link-text">Revenue Management</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($traffic_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="index.php?r=traffic/index" role="button"
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><span data-feather="message-square"></span></span>
                                    <span class="nav-link-text-wrapper"><span class="nav-link-text">Traffic
                                            Management</span></span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($budgeting_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=budgeting/index" role="button"
                                aria-expanded="false" aria-controls="nv-email">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="mail"></span></span>
                                    <span class="nav-link-text">Budgeting Management</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($event_management): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=events/index" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-events">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="bookmark"></span></span>
                                    <span class="nav-link-text">Events Management</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($reporting): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=reporting/index" role="button"
                                aria-expanded="false" aria-controls="nv-kanban">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="align-justify"></span></span>
                                    <span class="nav-link-text">Reporting</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($maintenance): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=maintenance/index"
                                role="button" aria-expanded="false" aria-controls="nv-support">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="settings"></span></span>
                                    <span class="nav-link-text">Maintenance</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($users_permission): ?>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="index.php?r=users/index" role="button"
                                aria-expanded="false" aria-controls="nv-users">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div>
                                    <span class="nav-link-icon"><span data-feather="users"></span></span>
                                    <span class="nav-link-text">Users Permissions</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                </li>
            </ul>

        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span
                class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span
                class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
    </div>
</nav>


<nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="index.php">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center"><img src="assets/img/icons/logo.png" alt="phoenix"
                            width="27">
                        <p class="logo-text ms-2 d-none d-sm-block">Road Assets Management System</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="search-box navbar-top-search-box d-none d-lg-block"
            data-list="{&quot;valueNames&quot;:[&quot;title&quot;]}" style="width:25rem;">
            <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                <input class="form-control search-input fuzzy-search rounded-pill form-control-sm" type="search"
                    placeholder="Search..." aria-label="Search">
                <span class="fas fa-search search-box-icon"></span>

            </form>
            <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
                data-bs-dismiss="search">
                <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
            </div>
        </div>
        <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                        data-theme-control="phoenixTheme" value="dark" id="themeControlToggle">
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                            data-feather="moon"></span></label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                            data-feather="sun"></span></label>
                </div>
            </li>

            <?php echo $this->render('notifications/progress_notification.php') ?>
            <?php echo $this->render('notifications/contract_notification.php') ?>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdownNindeDots" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="2" r="2" fill="currentColor"></circle>
                    </svg></a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-nide-dots shadow border border-300"
                    aria-labelledby="navbarDropdownNindeDots">
                    <div class="card bg-white position-relative border-0">
                        <div class="card-body pt-3 px-3 pb-0 overflow-auto scrollbar" style="height: 20rem;">
                            <div class="row text-center align-items-center gx-0 gy-0">
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/behance.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Behance</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/google-cloud.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Cloud</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/slack.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Slack</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/gitlab.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Gitlab</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/bitbucket.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">BitBucket</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/google-drive.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Drive</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/trello.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Trello</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/figma.webp" alt="" width="20">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Figma</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/twitter.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Twitter</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/pinterest.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Pinterest</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/ln.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Linkedin</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/google-maps.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Maps</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/google-photos.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Photos</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="assets/img/nav-icons/spotify.webp" alt="" width="30">
                                        <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Spotify</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-l ">
                        <img class="rounded-circle " src="assets/img/team/40x40/57.webp" alt="">

                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <img class="rounded-circle " src="assets/img/team/72x72/57.webp" alt="">

                                </div>
                                <h6 class="mt-2 text-black">Jerry Seinfield</h6>
                            </div>
                            <div class="mb-3 mx-3">
                                <input class="form-control form-control-sm" id="statusUpdateInput" type="text"
                                    placeholder="Update your status">
                            </div>
                        </div>
                        <div class="overflow-auto scrollbar" style="height: 10rem;">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="user"></span><span>Profile</span></a></li>
                                <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900"
                                            data-feather="pie-chart"></span>Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="lock"></span>Posts &amp; Activity</a></li>
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="settings"></span>Settings &amp; Privacy </a></li>
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="help-circle"></span>Help Center</a></li>
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="globe"></span>Language</a></li>
                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top">
                            <ul class="nav d-flex flex-column my-3">
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900"
                                            data-feather="user-plus"></span>Add another account</a></li>
                            </ul>
                            <hr>
                            <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                    href="index.php?r=site/signout">
                                    <span class="me-2" data-feather="log-out"> </span>Sign out</a></div>
                            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                    href="#">Privacy policy</a>•<a class="text-600 mx-1" href="#!">Terms</a>•<a
                                    class="text-600 ms-1" href="#!">Cookies</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>