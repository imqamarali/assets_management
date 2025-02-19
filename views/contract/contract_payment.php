<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\models\Employee;
use app\models\Dashboardpermissions;

$conn = Yii::$app->getDb();

?>

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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contract
                        Payment</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing Contract Payment Table</p>
            </div>
            <?php if ($can['can_add'] == 1): ?>
            <button data-bs-toggle="modal" data-bs-target="#newItem" class="btn btn-outline-primary mt-2 mb-2"
                style="float: right" style="margin-left: 5px"> Add New<span
                    class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
        </div>
        <?php
        $fields = ['number', 'name', 'voucher No', 'instrument no', 'instrument date'];
        echo Yii::$app->Component->renderSearchForm($fields);

        ?>
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
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
                        foreach ($contract_pay_list as $item):
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
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <a class="green" data-bs-toggle="modal" data-bs-target="#newItem"
                                        onclick="update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if ($can['can_delete'] == 1): ?>
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <form id="deleteForm_<?php echo $item['id']; ?>"
                                        action="index.php?r=contract/contract_payment" method="POST"
                                        style="display: inline;">
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
    </div>
</div>

<script>
function confirmDelete(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById('deleteForm_' + itemId).submit();
    }
}

function update(item) {
    document.getElementById('modalId').value = item.id;
    document.getElementById('modalContract').value = item.contract_id; // The contract ID
    document.getElementById('modalPaymentType').value = item.type_of_payment; // Type of payment
    document.getElementById('Dated').value = item.dated; // Dated field
    document.getElementById('modalStatus').value = item.status; // Status (Active/Disabled)
    document.getElementById('modalVoucherno').value = item.voucher_no; // Voucher number
    document.getElementById('modalAmount').value = item.amount; // Amount
    document.getElementById('modalInstrument').value = item.intrument_no; // Instrument number
    document.getElementById('modalInstrumentDate').value = item.instrument_date; // Instrument date
}
</script>

<!-- Modal for Adding/Updating Record -->
<div class="modal fade modal-xl" id="newItem" tabindex="-1" aria-labelledby="newItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contract_payment">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="contract_id" id="modalContract" required>
                                <option value="">Select Contract</option>
                                <?php foreach ($contract_list as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['contractor_name'] ?>
                                    (<?= $item['contract_no'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalContract">Contract Contract<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="type_of_payment" id="modalPaymentType" required>
                                <option value="">Select Type of Payment</option>
                                <option value="1">Cash</option>
                                <option value="2">Bank</option>
                            </select>
                            <label for="modalPaymentType">Type of Payment<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="Dated" name="dated"
                                    type="text" placeholder="Dated" data-options="{&quot;disableMobile&quot;:true}"
                                    readonly="readonly">
                                <label class="ps-6" for="Dated">Dated</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="modalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="modalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalVoucherno" name="voucher_no" type="text"
                                placeholder="Voucherno No" required>
                            <label for="modalVoucherno">Voucherno No<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalAmount" name="amount" type="text" placeholder="Amount"
                                required>
                            <label for="modalAmount">Amount<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalInstrument" name="instrument_no" type="text"
                                placeholder="Instrument No" required>
                            <label for="modalInstrument">Instrument No<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="modalInstrumentDate"
                                    name="instrument_date" type="text" placeholder="Instrument Date"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="modalInstrumentDate">Instrument Date</label><span
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