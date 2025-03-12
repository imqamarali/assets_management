<?php

use yii\widgets\LinkPager;

$conn = Yii::$app->getDb();

?>

<style>
.dropdown-toggle {
    border: 0;
    background: #fff;
}

h4 {
    float: left;
}
</style>

<div class="row">
    <div class="col_12">
        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><svg
                    class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com -->
                <svg class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
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
            </span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contracts
                        Progress</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Contract Progress Submission List</p>
            </div>
            <a href="index.php?r=contract/new_progress" style="text-decoration: none;">
                <button class="btn btn-outline-primary mt-2 mb-2" style="float: right" style="margin-left: 5px">
                    New Progress<span class="fas fa-angle-right ms-2 fs--2 text-center"></span>
                </button>
            </a>

        </div>
        <hr class="bg-200">

        <?php if (Yii::$app->session->hasFlash('info')): ?>
        <div id="flash-info" class="alert alert-info"
            style="transition: opacity 0.5s ease;height: 27px;text-align: left;vertical-align: middle;padding: 0px;width: 385px;font-size: small;color: black;border: none;padding: 4px;padding-left: 13px;background: #f2f2f2;">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div id="flash-info" class="alert alert-info"
            style="transition: opacity 0.5s ease;height: 27px;text-align: left;vertical-align: middle;padding: 0px;width: 385px;font-size: small;color: #050404;border: none;padding: 4px;padding-left: 13px;background: #ed200052;">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
        <?php endif; ?>
        <div class="row g-5 mb-5">
            <div class="col-xl-12" style="padding: 0px;">

                <div class="table-responsive">
                    <table class=" table table-striped table-sm fs--1 mb-0 table-sm fs--1 leads-table simlee mt-3"
                        style="border: 1px solid #a9a9a954;">
                        <thead>
                            <tr style="margin: -3px;font-size: smaller;">
                                <th>Contract</th>
                                <th>Area</th>
                                <th>Type </th>
                                <td>Task</td>
                                <td>Details</td>
                                <td>Progress</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Submission Date</td>
                                <td>Current Status</td>
                                <td>Demand of Bill</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $index = 1;
                            foreach ($contract_list as $item):
                                // if ($item['progress_status'] != 1) continue;
                                // if ($item['progress_status'] != 1) continue; //do not add draft contracts
                                $status = $item['progress_status'];
                                $current_status = "Draft Saved";
                                if ($status == 2) {
                                    $current_status = "Draft Submitted";
                                } elseif ($status == -2) {
                                    $current_status = "Draft Rejected";
                                } elseif ($status == 3) {
                                    $current_status = "Approved by RO";
                                } elseif ($status == -3) {
                                    $current_status = "Rejected by RO";
                                } elseif ($status == 4) {
                                    $current_status = "Approved by ZONE";
                                } elseif ($status == -4) {
                                    $current_status = "Rejected by ZONE";
                                } elseif ($status == 5) {
                                    $current_status = "Approved by RAMD";
                                } elseif ($status == -5) {
                                    $current_status = "Rejected by RAMD";
                                } elseif ($status == 6) {
                                    $current_status = "Approved by HO";
                                } elseif ($status == -6) {
                                    $current_status = "Rejected by HO";
                                }

                                $demand_color = 'red';
                                if (isset($item['demand_date']) && !empty($item['demand_date']))
                                    $demand_color = 'green';

                            ?>

                            <tr style="margin: -3px;font-size: smaller;">
                                <td style="padding-left: 5px;"><?= $item['contract_no'] ?>
                                    (<?= $item['contractor_name'] ?>)</td>
                                <td><?= $item['area'] ?></td>
                                <td><?= $item['type_name'] ?></td>
                                <td><?= $item['task'] ?></td>
                                <td><?= $item['details'] ?></td>
                                <td><?= $item['progress'] ?></td>
                                <td><?= $item['start_date'] ?></td>
                                <td><?= $item['end_date'] ?></td>
                                <td><?= $item['submission_date'] ?></td>
                                <td><?= $current_status ?></td>
                                <td style="font-weight: bold;color: <?= $demand_color ?>;">
                                    <?= $item['demand_date'] ?? 'Not Submitted' ?></td>
                                <td style="color: #3974ff; cursor: pointer"><a
                                        href="index.php?r=contract/demand_of_bill&id=<?= $item['progress_id'] ?>"><i
                                            class="fas fa-arrow-up"></i>
                                        Demand</a></td>

                            </tr>


                            <?php $index++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container text-center mt-3">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        'options' => ['class' => 'pagination justify-content-center'],
                        'prevPageLabel' => '&laquo; Previous',
                        'nextPageLabel' => 'Next &raquo;',
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'maxButtonCount' => 5,
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledPageCssClass' => 'disabled',
                        'prevPageCssClass' => 'page-item',
                        'nextPageCssClass' => 'page-item',
                        'firstPageCssClass' => 'page-item',
                        'lastPageCssClass' => 'page-item',
                        'activePageCssClass' => 'active',
                    ]); ?>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="modal fade modal-xl" id="history" tabindex="-1" aria-labelledby="history" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Progress Submission History</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="padding: 7px;">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm fs--1 mb-0">
                            <thead>
                                <tr>
                                    <th>Contract</th>
                                    <th>Area</th>
                                    <th>Region</th>
                                    <th>Type </th>
                                    <td>Task</td>
                                    <td>Details</td>
                                    <td>Progress</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Current Status</td>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $index = 1;
                                foreach ($contract_list as $item):
                                    if ($item['progress_status'] != 1) continue;
                                    if ($item['progress_status'] != 1) continue; //do not add draft contracts
                                    $status = $item['progress_status'];
                                    $current_status = "Draft Saved";
                                    if ($status == 2) {
                                        $current_status = "Draft Submitted";
                                    } elseif ($status == -2) {
                                        $current_status = "Draft Rejected";
                                    } elseif ($status == 3) {
                                        $current_status = "Approved by RO";
                                    } elseif ($status == -3) {
                                        $current_status = "Rejected by RO";
                                    } elseif ($status == 4) {
                                        $current_status = "Approved by ZONE";
                                    } elseif ($status == -4) {
                                        $current_status = "Rejected by ZONE";
                                    } elseif ($status == 5) {
                                        $current_status = "Approved by RAMD";
                                    } elseif ($status == -5) {
                                        $current_status = "Rejected by RAMD";
                                    } elseif ($status == 6) {
                                        $current_status = "Approved by HO";
                                    } elseif ($status == -6) {
                                        $current_status = "Rejected by HO";
                                    }

                                ?>
                                <tr>
                                    <td><?= $item['contract_no'] ?> (<?= $item['contractor_name'] ?>)</td>
                                    <td><?= $item['area'] ?></td>
                                    <td><?= $item['region_name'] ?></td>
                                    <td><?= $item['type_name'] ?></td>
                                    <td><?= $item['task'] ?></td>
                                    <td><?= $item['details'] ?></td>
                                    <td><?= $item['progress'] ?></td>
                                    <td><?= $item['start_date'] ?></td>
                                    <td><?= $item['end_date'] ?></td>
                                    <td><?= $current_status ?></td>
                                </tr>


                                <?php $index++;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (count($contract_list) < -121): // Hidden 
                        ?>
                        <button type="submit" class="btn btn-primary mt-3" style="float: right;">Save
                            Draft</button>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="submitprogress" tabindex="-1" aria-labelledby="submitprogress" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Submit Progress</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="padding: 7px;">
                    <div class="table-responsive">
                        <form action="index.php?r=contract/progress" method="post">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <input type="hidden" name="save_record" value="submit_draft" />
                            <input type="hidden" name="total_contract" value="<?= count($contract_list) ?>" />
                            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th>Contract</th>
                                        <th>Area</th>
                                        <th>Region</th>
                                        <th>Type </th>
                                        <td>Task</td>
                                        <td>Details</td>
                                        <td>Progress</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Current Status</td>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $index = 1;
                                    $to_save = false;
                                    foreach ($contract_list as $item):
                                        if ($item['progress_status'] != 1) continue; //do not add draft contracts
                                        $current_status = "Draft Saved";
                                        $to_save = true;
                                    ?>
                                    <tr>
                                        <td><?= $item['contract_no'] ?> (<?= $item['contractor_name'] ?>)</td>
                                        <td><?= $item['area'] ?></td>
                                        <td><?= $item['region_name'] ?></td>
                                        <td><?= $item['type_name'] ?></td>
                                        <td><?= $item['task'] ?></td>
                                        <td><?= $item['details'] ?></td>
                                        <td><?= $item['progress'] ?></td>
                                        <td><?= $item['start_date'] ?></td>
                                        <td><?= $item['end_date'] ?></td>
                                        <td><?= $current_status ?></td>
                                    </tr>
                                    <input type="hidden" name="progress_id<?= $index ?>"
                                        value="<?= $item['progress_id'] ?>" />
                                    <input type="hidden" name="status<?= $index ?>"
                                        value="<?= $item['progress_status'] ?>" />
                                    <?php $index++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <?php if ($to_save): // Hidden 
                            ?>
                            <button type="submit" class="btn btn-primary mt-3" style="float: right;">
                                Submit Draft
                            </button>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>