<?php


use yii\widgets\LinkPager;
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Demand
                        Submissions</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
            </div>
        </div>
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
                <table class="table table-sm fs--1 leads-table simlee mt-3" style="border: 1px solid #a9a9a954;">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Demand Amount</th>
                            <th>Date</th>
                            <th>File Submitted</t>
                            <th>comments</td>
                            <th>Current Status</td>
                            <th>Submitted By</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($demand_list as $item):
                            // if ($item['progress_status']) {
                            //     if ($item['progress_status'] != 1) continue; //do not add draft contracts
                            // }
                            $status = $item['demand_status'];
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
                            <tr style="margin: -3px;font-size: smaller;">
                                <td style="padding-left: 5px;"><?= $item['demand_title'] ?></td>
                                <td><?= $item['bill_amount'] ?></td>

                                <td><?= $item['demand_date'] ?></td>
                                <td><a href="<?= Yii::getAlias('@web') . '/' . $item['file_path'] ?>" target="_blank">
                                        <?= basename($item['file_path']) ?>
                                    </a></td>

                                <td><?= $item['comments'] ?? '-' ?></td>
                                <td><?= $current_status ?></td>
                                <td><?= $item['submitted_by'] ?></td>
                                <td style="text-align: left;">
                                    <?php if ($can['can_edit'] == 1): ?>
                                        <div class=" btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle hidden-sm hidden-xs action-buttons"
                                            style="display: inline-flex; gap: 0px;padding:0px">
                                            <a class="green"
                                                href="index.php?r=notification/demanddetails&referance=<?= $item['demand_id'] ?> ">
                                                <i class="ace-icon fa fa-eye   fs--2 text-900"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </td>
                            </tr>


                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- Add pagination links here -->
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