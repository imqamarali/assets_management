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
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contract_payment">

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
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contract_revised">

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

<!-- Modal for Adding/Updating Record -->
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
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contract_sub">

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