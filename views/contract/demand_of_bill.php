<? //= json_encode($demand); 
?>
<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">
        <div class="d-flex" id="scrollspyEcommerce">
            <span class="fa-stack me-2 ms-n1">
                <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg>
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Demand Of Bill</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Save Demand for Progress Submission</p>
            </div>
        </div>
        <hr class="bg-200">
        <div class="mb-2">
            <?php
            $status = $demand['progress_status'];
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

                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Scope:
                    </div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['scope_name'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Progress:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['progress'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Contract Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['contract_date'] ?></div>
                </div>

                <div class="profile-user-info profile-user-info-striped"
                    style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Engineer Estimate:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['engineer_estimate'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">Bid Cost:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['bid_cost'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Completion Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['date_of_completion'] ?></div>
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
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Bill Amount:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['bill_amount'] ?></div>
                    <div style="width:12% ;background: #EDF3F4; padding: 5px">Demand Date:</div>
                    <div style="width:20.5% ; padding: 5px"><?= $demand['demand_date'] ?></div>
                    <div style="width: 12%;background: #EDF3F4; padding: 5px">File:</div>
                    <div style="width:20.5% ; padding: 5px">
                        <a href="<?= Yii::getAlias('@web') . '/' . $demand['file_path'] ?>" target="_blank">
                            <?= basename($demand['file_path']) ?>
                        </a>
                    </div>



                </div>
            </div>
            <?php } ?>
        </div>
        <form id="progressStatusForm" action="index.php?r=contract/demand_of_bill&id=<?= $demand['progress_id'] ?>"
            method="POST" enctype="multipart/form-data">

            <input type="hidden" name="demand_id" value="<?= $demand['demand_id'] ?? '' ?>">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="save_record" value="save_record" />
            <input type="hidden" name="status" value="1" />

            <!-- Row 1: Bill Amount & Demand Date -->
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="mb-3">
                        <label for="bill_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="bill_title" name="bill_title"
                            value="<?= $demand['demand_title'] ?? '' ?>" required>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="mb-3">
                        <label for="bill_amount" class="form-label">Bill Amount</label>
                        <input type="number" min="0" class="form-control" id="bill_amount" name="bill_amount"
                            value="<?= $demand['bill_amount'] ?? '' ?>" required>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="mb-3">
                        <label for="demand_date" class="form-label">Demand Date</label>
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="date" name="date"
                                    type="text" placeholder="Select Date" readonly="readonly"
                                    value="<?= $demand['demand_date'] ?? '' ?>">
                                <label class="ps-6" for="date">Select Date</label>
                                <span class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="file_path" class="form-label">Upload Demand File</label>
                        <input type="file" class="form-control" id="file_path" name="file_path"
                            accept=".pdf,.doc,.docx,.jpg,.png">
                    </div>

                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <input type="text" class="form-control" id="comments" name="comments"
                            value="<?= $demand['comments'] ?? '' ?>" required>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary" style="float: right;">Submit Demand</button>
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