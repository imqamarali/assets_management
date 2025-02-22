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
            </span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contract
                        Details</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing Contract Details</p>
            </div>
            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                Contract No:
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $contract['contract_no'] ?></b></span>
                </a>
            </div>
            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                &nbsp;|&nbsp;&nbsp;Finance Ref Code
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $contract['finance_ref_code'] ?></b></span>
                </a>
            </div>

        </div>
    </div>
    <hr class="bg-200">
    <div class="mb-2">
        <div class="card h-5">
            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px;margin-right:10px; width: 100%;">
                <!-- <div style="width:12% ;background: #EDF3F4; padding: 5px">Contract No:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['contract_no'] ?></div> -->
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Contractor Name:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['contractor_name'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Area:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['area'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Type of Work:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['type_name'] ?></div>
            </div>
            <div
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px; margin-right:10px; width: 100%;">

                <div style="width:12% ;background: #EDF3F4; padding: 5px">Scope:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['scope_name'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Progress:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['progress'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Contract Date:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['contract_date'] ?></div>
            </div>

            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Engineer Estimate:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['engineer_estimate'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Bid Cost:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['bid_cost'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Completion Date:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['date_of_completion'] ?></div>
            </div>

            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Unit:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['unit_name'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Region:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['region_name'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Route:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['route_name'] ?></div>
            </div>
            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">

                <div style="width:12% ;background: #EDF3F4; padding: 5px">District:
                </div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['district_name'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Finance Ref Code:
                </div>
                <div style="width:20.5% ; padding: 5px"><?= $contract['finance_ref_code'] ?></div>

            </div>
        </div>
    </div>
    <div id="tableExample2">
        <div class="table-responsive">
            <button class="btn  mt-2 mb-2" style="float: left;font-size:medium; margin-left: 5px">Contract
                Progress</button>
            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th>Contract</th>
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
                    foreach ($contract['contract_progress'] as $item):
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
        </div>
    </div>

    <div id="tableExample2">
        <div class="table-responsive">
            <button class="btn  mt-2 mb-2" style="float: left;font-size:medium; margin-left: 5px">Contract
                Sub</button>
            <?php if ($can['can_add'] == 1): ?>
                <button data-bs-toggle="modal" data-bs-target="#modalSub" class="btn btn-outline-primary mt-2 mb-2"
                    style="float: right" style="margin-left: 5px"> Add New<span
                        class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th class="sort border-top ps-3">Sr No</th>
                        <th class="sort border-top">Contract No</th>
                        <th class="sort border-top">Company Name</th>
                        <th class="sort border-top">Km From</th>
                        <th class="sort border-top">Km To</th>
                        <th class="sort border-top">Direction</th>
                        <th class="sort border-top">Type of Work</th>
                        <th class="sort border-top">Treatment</th>
                        <th class="sort border-top">Length</th>
                        <th class="sort border-top">Location From</th>
                        <th class="sort border-top">Location To</th>
                        <th class="sort border-top">Status</th>
                        <th class="sort border-top">Description</th>
                        <th class="sort border-top">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php $index = 1;
                    foreach ($contract['contract_sub'] as $item):
                        $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                    ?>
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['contract_no'] ?></td>
                            <td><?= $item['company_name '] ?></td>
                            <td><?= $item['km_from'] ?></td>
                            <td><?= $item['Km_to'] ?></td>
                            <td><?= $item['direction'] ?></td>
                            <td><?= $item['type_name'] ?></td>
                            <td><?= $item['treatment_name'] ?></td>
                            <td><?= $item['lenght'] ?></td>
                            <td><?= $item['location_from'] ?></td>
                            <td><?= $item['location_to'] ?></td>
                            <td><?= $item['disc'] ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <?php if ($can['can_edit'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <a class="green" data-bs-toggle="modal" data-bs-target="#modalSub"
                                            onclick="update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($can['can_delete'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <form id="subdeleteForm_<?php echo $item['id']; ?>"
                                            action="index.php?r=contract/contract_cub" method="POST" style="display: inline;">
                                            <input type="hidden" name="_csrf"
                                                value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <input type="hidden" name="save_record"
                                                value="delete_record&referance=<?= $_REQUEST['referance'] ?>">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <button type="button" class="green" style="border: none; background: none;"
                                                onclick="confirmDelete(<?php echo $item['id']; ?>)">
                                                <i class="ace-icon fa fa-trash bigger-130" style="color: red;"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>



                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tableExample2">
        <div class="table-responsive">
            <button class="btn  mt-2 mb-2" style="float: left;font-size:medium; margin-left: 5px">Revised
                Contract</button>
            <?php if ($can['can_add'] == 1): ?>
                <button data-bs-toggle="modal" data-bs-target="#modalRev" class="btn btn-outline-primary mt-2 mb-2"
                    style="float: right" style="margin-left: 5px"> Add New<span
                        class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th class="sort border-top ps-3">Sr No</th>
                        <th class="sort border-top">Contract No</th>
                        <th class="sort border-top">Contractor Name</th>
                        <th class="sort border-top">Type</th>
                        <th class="sort border-top">Revised Amount</th>
                        <th class="sort border-top">Revised Date</th>
                        <th class="sort border-top">Remarks</th>
                        <th class="sort border-top">Create Date</th>
                        <th class="sort border-top">Status</th>
                        <th class="sort border-top">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php $index = 1;
                    foreach ($contract['contract_revised'] as $item):
                        $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                    ?>
                        <!-- id, contract_id, type, revised_amount, revised_date, remarks, create_date, status
                            -->
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['contract_no'] ?></td>
                            <td><?= $item['company_name'] ?></td>
                            <td><?= $item['type_name'] ?></td>
                            <td><?= $item['revised_amount'] ?></td>
                            <td><?= $item['revised_date'] ?></td>
                            <td><?= $item['remarks'] ?></td>
                            <td><?= $item['create_date'] ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <?php if ($can['can_edit'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <a class="green" data-bs-toggle="modal" data-bs-target="#modalRev"
                                            onclick="update1(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($can['can_delete'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <form id="revdeleteForm_<?php echo $item['id']; ?>"
                                            action="index.php?r=contract/contract_revised&referance=<?= $_REQUEST['referance'] ?>"
                                            method="POST" style="display: inline;">
                                            <input type="hidden" name="_csrf"
                                                value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <input type="hidden" name="save_record" value="delete_record">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <button type="button" class="green" style="border: none; background: none;"
                                                onclick="confirmDelete1(<?php echo $item['id']; ?>)">
                                                <i class="ace-icon fa fa-trash bigger-130" style="color: red;"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>



                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tableExample2">
        <div class="table-responsive">
            <button class="btn  mt-2 mb-2" style="float: left;font-size:medium; margin-left: 5px">Payment</button>
            <?php if ($can['can_add'] == 1): ?>
                <button data-bs-toggle="modal" data-bs-target="#modalPay" class="btn btn-outline-primary mt-2 mb-2"
                    style="float: right" style="margin-left: 5px"> Add New<span
                        class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th class="sort border-top ps-3">Sr No</th>
                        <th class="sort border-top">Contract No</th>
                        <th class="sort border-top">Company Name</th>
                        <th class="sort border-top">Type Of Payment</th>
                        <th class="sort border-top">Dated</th>
                        <th class="sort border-top">Voucher No</th>
                        <th class="sort border-top">Amount</th>
                        <th class="sort border-top">Instrument No</th>
                        <th class="sort border-top">Instrument Date</th>
                        <th class="sort border-top">Status</th>
                        <th class="sort border-top">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php $index = 1;
                    foreach ($contract['contract_payment'] as $item):
                        $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                    ?>
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['contract_no'] ?></td>
                            <td><?= $item['company_name '] ?></td>
                            <td><?= $item['type_of_payment'] ?></td>
                            <td><?= $item['dated'] ?></td>
                            <td><?= $item['voucher_no'] ?></td>
                            <td><?= $item['amount'] ?></td>
                            <td><?= $item['intrument_no'] ?></td>
                            <td><?= $item['instrument_date'] ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <?php if ($can['can_edit'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <a class="green" data-bs-toggle="modal" data-bs-target="#modalPay"
                                            onclick="update2(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($can['can_delete'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                        <form id="paydeleteForm_<?php echo $item['id']; ?>"
                                            action="index.php?r=contract/contract_payment&referance=<?= $_REQUEST['referance'] ?>"
                                            method="POST" style="display: inline;">
                                            <input type="hidden" name="_csrf"
                                                value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <input type="hidden" name="save_record" value="delete_record">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <button type="button" class="green" style="border: none; background: none;"
                                                onclick="confirmDelete(<?php echo $item['id']; ?>)">
                                                <i class="ace-icon fa fa-trash bigger-130" style="color: red;"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>



                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php //echo json_encode($contract); exit; 
    ?>
    <hr style="margin-top:10px" class="bg-200">
</div>
</div>



<script>
    function confirmDelete(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('subdeleteForm_' + itemId).submit();
        }
    }

    function update(item) {
        // Populate the modal fields with the selected row's data
        document.getElementById('submodalId').value = item.id;
        document.getElementById('submodalContract').value = item.contract_id; // Ensure the key matches the data structure
        document.getElementById('submodalTreatment').value = item.treatment; // Ensure the key matches the data structure
        document.getElementById('submodalType').value = item.type_of_work; // Ensure the key matches the data structure
        document.getElementById('submodalKmfrom').value = item.km_from;
        document.getElementById('submodalKmto').value = item.Km_to;
        document.getElementById('submodalLocationFrom').value = item.location_from;
        document.getElementById('submodalLocationTo').value = item.location_to;
        document.getElementById('submodalDirection').value = item.direction;
        document.getElementById('submodalLength').value = item.lenght;
        document.getElementById('submodalStatus').value = item.status; // 0 or 1 for disabled or active
        document.getElementById('submodalDetails').value = item.disc; // Make sure 'disc' is the correct key for details
    }

    function confirmDelete1(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('revdeleteForm_' + itemId).submit();
        }
    }

    function update1(item) {

        document.getElementById('revmodalId').value = item.id; // ID field
        document.getElementById('revmodalContract').value = item.contract_id; // Contractor ID (linked to contract)
        document.getElementById('revmodalStatus').value = item.status; // Status
        document.getElementById('revmodalType').value = item.type; // Type of Work ID
        document.getElementById('revmodalRevisedAmount').value = item.revised_amount; // Revised Amount
        document.getElementById('revrevisedDate').value = item.revised_date; // Revised Date
        document.getElementById('revmodalRemarks').value = item.remarks; // Remarks
        document.querySelector('.modal-title').textContent = 'Update Revised Contract';
    }

    function confirmDelete2(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('paydeleteForm_' + itemId).submit();
        }
    }

    function update2(item) {
        document.getElementById('paymodalId').value = item.id;
        document.getElementById('paymodalContract').value = item.contract_id;
        document.getElementById('paymodalPaymentType').value = item.type_of_payment;
        document.getElementById('paymodalDated').value = item.dated;
        document.getElementById('paymodalStatus').value = item.status;
        document.getElementById('paymodalVoucherno').value = item.voucher_no;
        document.getElementById('paymodalAmount').value = item.amount;
        document.getElementById('paymodalInstrument').value = item.intrument_no;
        document.getElementById('paymodalInstrumentDate').value = item.instrument_date;
    }
</script>

<div class="modal fade modal-xl" id="modalPay" tabindex="-1" aria-labelledby="modalPay" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post"
                    action="index.php?r=contract/contract_payment&referance=<?= $_REQUEST['referance'] ?>">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="paymodalId" value="" />

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="contract_id" id="paymodalContract" required>
                                <option value="">Select Contract</option>
                                <?php //foreach ($contract as $item): 
                                ?>
                                <option value="<?= $contract['id'] ?>"><?= $contract['contractor_name'] ?>
                                    (<?= $contract['contract_no'] ?>)</option>
                                <?php //endforeach; 
                                ?>
                            </select>
                            <label for="paymodalContract">Contract Contract<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="type_of_payment" id="paymodalPaymentType" required>
                                <option value="">Select Type of Payment</option>
                                <option value="1">Cash</option>
                                <option value="2">Bank</option>
                            </select>
                            <label for="paymodalPaymentType">Type of Payment<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="paymodalDated"
                                    name="dated" type="text" placeholder="Dated"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="paymodalDated">Dated</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="paymodalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="paymodalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="paymodalVoucherno" name="voucher_no" type="text"
                                placeholder="Voucherno No" required>
                            <label for="paymodalVoucherno">Voucherno No<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="paymodalAmount" name="amount" type="text"
                                placeholder="Amount" required>
                            <label for="paymodalAmount">Amount<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="paymodalInstrument" name="instrument_no" type="text"
                                placeholder="Instrument No" required>
                            <label for="paymodalInstrument">Instrument No<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="paymodalInstrumentDate"
                                    name="instrument_date" type="text" placeholder="Instrument Date"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="paymodalInstrumentDate">Instrument Date</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-xl" id="modalRev" tabindex="-1" aria-labelledby="modalRev" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post"
                    action="index.php?r=contract/contract_revised&referance=<?= $_REQUEST['referance'] ?>">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="revmodalId" value="" />


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="contract_id" id="revmodalContract" required>
                                <option value="">Select Contract</option>
                                <?php //foreach ($contract as $item): 
                                ?>
                                <option value="<?= $contract['id'] ?>"><?= $contract['contractor_name'] ?>
                                    (<?= $contract['contract_no'] ?>)</option>
                                <?php //endforeach; 
                                ?>
                            </select>
                            <label for="revmodalContractor">Select Contract<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="revmodalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="revmodalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="typeofwork_id" id="revmodalType" required>
                                <option value="">Select Type Of Work</option>
                                <<?php foreach ($type_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="revmodalType">Select Type Of Work<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="revmodalRevisedAmount" name="revised_amount" type="text"
                                placeholder="Revised Amount" required>
                            <label for="revmodalRevisedAmount">Revised Amount<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="revrevisedDate"
                                    name="revised_date" type="text" placeholder="Contract Date"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="revrevisedDate">Revised Date</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="revmodalRemarks" name="remarks" type="text"
                                placeholder="Remarks" required>
                            <label for="modalRemarks">Remarks<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-xl" id="modalSub" tabindex="-1" aria-labelledby="modalSub" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post"
                    action="index.php?r=contract/contract_sub&referance=<?= $_REQUEST['referance'] ?>">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="submodalId" value="" />

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="contract_id" id="submodalContract" required>
                                <option value="">Select Contract</option>
                                <?php //foreach ($contract as $item): 
                                ?>
                                <option value="<?= $contract['id'] ?>"><?= $contract['contractor_name'] ?>
                                    (<?= $contract['contract_no'] ?>)</option>
                                <?php //endforeach; 
                                ?>
                            </select>
                            <label for="submodalContract"> Contract<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="treatment_id" id="submodalTreatment" required>
                                <option value="">Select Treatment</option>
                                <?php foreach ($treatment_list as $item): ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="submodalTreatment">Treatment<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="typeofwork_id" id="submodalType" required>
                                <option value="">Select Type of Work</option>
                                <?php foreach ($type_list as $item): ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="submodalType">Select Type of Work<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="submodalKmfrom" name="km_from" type="text"
                                placeholder="Kilometer From" required>
                            <label for="submodalKmfrom">Kilometer From <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="submodalKmto" name="km_to" type="text"
                                placeholder="Kilometer To" required>
                            <label for="submodalKmto">Kilometer To <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="submodalLocationFrom" name="location_from" type="text"
                                placeholder="Location From" required>
                            <label for="submodalLocationFrom">Location From<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="submodalLocationTo" name="location_to" type="text"
                                placeholder="Location To" required>
                            <label for="submodalLocationTo">Location To<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="submodalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="submodalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="submodalDirection" name="direction" type="text"
                                placeholder="Direction" required>
                            <label for="submodalDirection">Direction<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="submodalLength" name="length" type="text"
                                placeholder="Length" required>
                            <label for="submodalLength">Length<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-12 gy-6">
                        <div class="form-floating">
                            <textarea class="form-control" id="submodalDetails" placeholder="Enter Short Details"
                                name="details" style="height: 100px"></textarea>
                            <label for="submodalDetails">Details</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>