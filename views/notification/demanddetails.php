<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">
        <div class="d-flex" id="scrollspyEcommerce">
            <span class="fa-stack me-2 ms-n1">
                <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg>
                <svg class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
                    data-fa-transform="shrink-4" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                    style="transform-origin: 0.5625em 0.5em;">
                    <g transform="translate(288 256)">
                        <path fill="currentColor"
                            d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z">
                        </path>
                    </g>
                </svg>
            </span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Demand
                        Details</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Demand of Progress Submission</p>
            </div>
        </div>
        <hr class="bg-200">
        <div class="mb-2">
            <?php
            $status = $demand['demand_status'];
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
            <div class="card h-5">
                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Contract No:
                    </div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['contract_no'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Contractor Name:
                    </div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['contractor_name'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Area:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['area'] ?></div>
                </div>
                <div
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px; margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Type of Work:
                    </div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['type_name'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Scope:
                    </div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['scope_name'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Progress:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['progress'] ?></div>
                </div>

                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Contract Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['contract_date'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Engineer Estimate:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['engineer_estimate'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Bid Cost:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['bid_cost'] ?></div>
                </div>

                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Completion Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['date_of_completion'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Unit:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['unit_name'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Region:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['region_name'] ?></div>
                </div>
                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Route:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['route_name'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">District:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['district_name'] ?></div>


                </div>
            </div>

            <div class="card h-5">
                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Progress Task:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['task'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Progress Details:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['details'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Progress:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['progress'] ?></div>
                </div>
                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Start Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['start_date'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">End Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['end_date'] ?></div>

                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Status:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $current_status ?></div>
                </div>
                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Submitted By:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['submitted_by'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Submission Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['submission_date'] ?></div>
                </div>

            </div>

            <?php if ($demand['demand_id']) { ?>
                <?php
                $status = $demand['demand_status'];
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
                <div class="card h-5">

                    <div class="profile-user-info profile-user-info-striped"
                        style="display:flex; margin-top: 20px; font-size: smaller; margin:5px;margin-right:10px; width: 100%;">
                        <div style="width:12% ;background: #EDF3F4; padding: 5px">Title:</div>
                        <div style="width:20.5% ; padding: 5px"><?= $demand['demand_title'] ?></div>
                        <div style="width:12% ;background: #EDF3F4; padding: 5px">Bill Amount:</div>
                        <div style="width:20.5% ; padding: 5px"><?= $demand['bill_amount'] ?></div>
                        <div style="width:12% ;background: #EDF3F4; padding: 5px">Demand Date:</div>
                        <div style="width:20.5% ; padding: 5px"><?= $demand['demand_date'] ?></div>

                    </div>
                    <div class="profile-user-info profile-user-info-striped"
                        style="display:flex;font-size: smaller; margin-left:5px;margin-top:-5px;margin-right:10px; width: 100%;">

                        <div style="width: 12%;background: #EDF3F4; padding: 5px">File:</div>
                        <div style="width:20.5% ; padding: 5px">
                            <a href="<?= Yii::getAlias('@web') . '/' . $demand['file_path'] ?>" target="_blank">
                                <?= basename($demand['file_path']) ?>
                            </a>
                        </div>
                        <div style="width:12% ;background: #EDF3F4; padding: 5px">Comments:</div>
                        <div style="width:20.5% ; padding: 5px"><?= $demand['comments'] ?></div>

                        <div style="width:12% ;background: #EDF3F4; padding: 5px">Status:</div>
                        <div style="width:20.5% ; padding: 5px"><?= $current_status ?></div>



                    </div>
                </div>
            <?php } ?>
        </div>


        <!-- Form for Contract Status -->
        <form id="progressStatusForm"
            action="index.php?r=notification/demanddetails&referance=<?= $_REQUEST['referance'] ?>" method="POST">
            <input type="hidden" name="demand_id" value="<?= $_REQUEST['referance'] ?>">
            <input type="hidden" name="status" id="status">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="save_record" value="save_record" />
            <!-- <div class="mb-3">
                <textarea class="form-control" id="comment" name="comment" rows="2"
                    placeholder="Enter comments (Optional)"></textarea>
            </div> -->

            <?php
            $new_status = null;
            $reject_status = null;
            $demand_status = ''; // Default condition

            $status = $demand['demand_status']; // Current progress status
            $user_level = Yii::$app->session->get('user_array')['user_level'];

            if ($user_level == 1) {
                $new_status = 2;
                $reject_status = -2;
            } elseif ($user_level == 2) {
                $new_status = 3;
                $reject_status = -3;
            } elseif ($user_level == 3) {
                $new_status = 4;
                $reject_status = -4;
            } elseif ($user_level == 4) {
                $new_status = 5;
                $reject_status = -5;
            } elseif ($user_level == 5) {
                $new_status = 6;
                $reject_status = -6;
            }

            ?>

            <div class="mb-3" style="float: right;">
                <?php if ($new_status !== null): ?>
                    <button type="button" class="btn btn-primary" onclick="submitForm(<?= $new_status ?>)">Approve</button>
                <?php endif; ?>

                <?php if ($reject_status !== null): ?>
                    <button type="button" class="btn btn-warning"
                        onclick="submitForm(<?= $reject_status ?>)">Reject</button>
                <?php endif; ?>
            </div>

        </form>

        <script>
            function submitForm(status) {
                // alert(status);
                document.getElementById('status').value = status;
                document.getElementById('progressStatusForm').submit();
            }
        </script>

    </div>
</div>