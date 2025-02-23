<?php

$conn = Yii::$app->getDb();

?>

<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">
        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><svg
                    class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg>
                <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com --><svg
                    class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
                    data-fa-transform="shrink-4" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                    data-fa-i2svg="" style="transform-origin: 0.5625em 0.5em;">
                    <g transform="translate(288 256)">
                        <g transform="translate(0, 0)  scale(0.75, 0.75)  rotate(0 0 0)">
                            <path fill="currentColor"
                                d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"
                                transform="translate(-288 -256)"></path>
                        </g>
                    </g>
                </svg>
                <!-- <i class="fa-inverse fa-stack-1x text-primary-soft fas fa-cart-plus" data-fa-transform="shrink-4"></i> Font Awesome fontawesome.com --></span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Progress
                        Submissions</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
            </div>
        </div>
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
                <div class="mx-n4 mx-lg-n6 border-bottom border-300 mt-4">

                    <?php $index = 1; ?>
                    <?php foreach ($contract_list as $item): ?>
                    <?php
                        $status = ($item['status'] == 0) ? "Un-approved" : (($item['status'] == 1) ? "Approved & In-progress" : (($item['status'] == 2) ? "Approved & Discontinued" : (($item['status'] == 3) ? "Completed" : "N/A")));
                        ?>

                    <div
                        class="d-flex align-items-center justify-content-between py-3 border-300 px-lg-6 px-4 notification-card border-top unread">
                        <div class="d-flex">
                            <div class="me-2 flex-1 mt-1 m-5">
                                <h4 class="fs--1 text-black"><?= htmlspecialchars($item['contractor_name']) ?>
                                    <span style="margin-left: 10px;font-size: x-small;">

                                        <span
                                            class="fw-bold"><?= htmlspecialchars(date("h:i A", strtotime($item['contract_date']))) ?>
                                        </span>
                                        <?= htmlspecialchars(date("F d, Y", strtotime($item['contract_date']))) ?>
                                    </span>
                                </h4>

                                <p class="fs--1 text-1000">
                                    <span class='me-1'>📄</span> Contract No: <span
                                        class="fw-bold"><?= htmlspecialchars($item['contract_no']) ?></span> |
                                    <span class='me-1'>📍</span> Area: <span
                                        class="fw-bold"><?= htmlspecialchars($item['area']) ?></span>
                                    <br>
                                    <span class='me-1'>🏗</span> Type: <span
                                        class="fw-bold"><?= htmlspecialchars($item['type_name']) ?></span> |
                                    <span class='me-1'>📜</span> Scope: <span
                                        class="fw-bold"><?= htmlspecialchars($item['scope_name']) ?></span>
                                    <br>
                                    <span class='me-1'>📅</span> Contract Date: <span
                                        class="fw-bold"><?= htmlspecialchars($item['contract_date']) ?></span>
                                    <br>
                                    <span class='me-1'>🏗</span> Progress: <span
                                        class="fw-bold"><?= htmlspecialchars($item['progress']) ?></span>
                                    <br>
                                    <span class='me-1'>✅</span> Status: <span
                                        class="fw-bold"><?= htmlspecialchars($status) ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="font-sans-serif">

                            <?php if ($can['can_edit'] == 1): ?>
                            <div class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle hidden-sm hidden-xs action-buttons"
                                style="display: inline-flex; gap: 10px;">
                                <a class="green"
                                    href="index.php?r=notification/contractdetails&referance=<?= $item['id'] ?> "
                                    onclick=" update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                    <i class="ace-icon fa fa-eye   fs--2 text-900"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <table class="table table-striped table-hover table-sm fs--1 mb-0 mt-3" style="display: none;">
                    <thead>
                        <tr>
                            <th class="sort border-top ps-3">Sr No</th>
                            <th class="sort border-top">Contract No</th>
                            <th class="sort border-top">Contractor Name</th>
                            <th class="sort border-top">Area</th>
                            <th class="sort border-top">Type of Work</th>
                            <th class="sort border-top">Scope</th>
                            <th class="sort border-top">Contract Date</th>
                            <th class="sort border-top">Engineer Estimate</th>
                            <th class="sort border-top">Bid Cost</th>
                            <th class="sort border-top">Date of Completion</th>
                            <th class="sort border-top">Progress</th>
                            <th class="sort border-top">Unit</th>
                            <th class="sort border-top">Region</th>
                            <th class="sort border-top">Route</th>
                            <th class="sort border-top">District</th>
                            <th class="sort border-top" style="width:8%">Status</th>
                            <th class="sort border-top" style="width:3%"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($contract_list as $item):
                            $status = ($item['status'] == 0) ? "Un-approved" : (($item['status'] == 1) ? "Approved & In-progress" : (($item['status'] == 2) ? "Approved & Discontinued" : (($item['status'] == 3) ? "Completed" : "N/A")));
                        ?>
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['contract_no'] ?></td>
                            <td><?= $item['contractor_name'] ?></td>
                            <td><?= $item['area'] ?></td>
                            <td><?= $item['type_name'] ?></td>
                            <td><?= $item['scope_name'] ?></td>
                            <td><?= $item['contract_date'] ?></td>
                            <td><?= $item['engineer_estimate'] ?></td>
                            <td><?= $item['bid_cost'] ?></td>
                            <td><?= $item['date_of_completion'] ?></td>
                            <td><?= $item['progress'] ?></td>
                            <td><?= $item['unit_name'] ?></td>
                            <td><?= $item['region_name'] ?></td>
                            <td><?= $item['route_name'] ?></td>
                            <td><?= $item['district_name'] ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <?php if ($can['can_edit'] == 1): ?>
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <a class="green"
                                        href="index.php?r=notification/contractdetails&referance=<?= $item['id'] ?> "
                                        onclick=" update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>