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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contracts List</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing Contract Table</p>
            </div>
            <?php if ($can['can_add'] == 1): ?>
            <button data-bs-toggle="modal" data-bs-target="#newItem" class="btn btn-outline-primary mt-2 mb-2"
                style="float: right" style="margin-left: 5px"> Add New<span
                    class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
        </div>
        <?php
        $fields = ['contract_no', 'contractor_name', 'contract_date'];
        echo Yii::$app->Component->renderSearchForm($fields);

        ?>
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
                <table class=" table table-striped table-sm fs--1 mb-0 table-sm fs--1 leads-table simlee mt-3"
                    style="border: 1px solid #a9a9a954;">
                    <thead>
                        <tr style="margin: -3px;font-size: smaller;">
                            <th class="sort border-top">Contract No</th>
                            <th class="sort border-top">Finance Ref Code</th>
                            <th class="sort border-top">Contractor Name</th>
                            <th class="sort border-top">Contract Date</th>
                            <th class="sort border-top">Engineer Estimate</th>
                            <th class="sort border-top">Bid Cost</th>
                            <th class="sort border-top">Date of Completion</th>
                            <th class="sort border-top">Progress</th>
                            <th class="sort border-top" style="width:8%">Status</th>
                            <th class="sort border-top" style="width:8%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($contract_list as $item):
                            $status = ($item['status'] == 0) ? "Un-approved" : (($item['status'] == 1) ? "In-progress" : (($item['status'] == 2) ? "Discontinued" : (($item['status'] == 3) ? "Completed" : "N/A")));
                            $status_color = ($item['status'] == 0) ? "red" : (($item['status'] == 1) ? "green" : (($item['status'] == 2) ? "orange" : (($item['status'] == 3) ? "green" : "black")));
                        ?>
                        <tr style="margin: -3px;font-size: smaller;">
                            <td style="padding-left: 5px;"><?= $item['contract_no'] ?></td>
                            <td><?= $item['contractor_name'] ?></td>
                            <td><?= $item['finance_ref_code'] ?></td>
                            <td><?= $item['contract_date'] ?></td>
                            <td><?= $item['engineer_estimate'] ?></td>
                            <td><?= $item['bid_cost'] ?></td>
                            <td><?= $item['date_of_completion'] ?></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">
                                <?= $item['progress'] ?></td>
                            <td class="align-middle age" style="font-weight: bold;color: <?= $status_color ?>;">
                                <?= $status ?></td>

                            <td>
                                <?php if ($item['status'] > 0): ?>
                                <?php if ($can['can_view'] == 1): ?>
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <a class="green"
                                        href="index.php?r=contract/contractdetails&referance=<?= $item['id'] ?> "
                                        onclick=" update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
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
                                        action="index.php?r=contract/contract" method="POST" style="display: inline;">
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

<!-- Script to handle update functionality -->
<script>
function confirmDelete(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById('deleteForm_' + itemId).submit();
    }
}

function update(item) {
    console.log(item);
    document.getElementById('modalId').value = item.id; // ID field
    document.getElementById('modalContractno').value = item.contract_no.trim(); // Contract No
    document.getElementById('modalContractor').value = item.contractor_id; // Contractor
    document.getElementById('modalArea').value = item.area; // Area
    document.getElementById('modalType').value = item.type_of_work; // Type Of Work
    document.getElementById('modalScope').value = item.scope; // Scope
    document.getElementById('modalUnit').value = item.unit; // Unit
    document.getElementById('modalRegion').value = item.region_id; // Region
    document.getElementById('modalRoute').value = item.route_id; // Route
    document.getElementById('modalDistrict').value = item.district_id; // District
    document.getElementById('modalProgress').value = item.progress; // Progress
    document.getElementById('modalEstimate').value = item.engineer_estimate; // Engineer Estimate
    document.getElementById('modalBidCost').value = item.bid_cost; // Bid Cost
    document.getElementById('modalFinance_ref_code').value = item.finance_ref_code; // Finance Ref Code
    document.getElementById('contractDate').value = item.contract_date; // Contract Date
    document.getElementById('contractDateOfCom').value = item.date_of_completion; // Date of Completion
    document.querySelector('.modal-title').textContent = 'Update Record';
}
</script>
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
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contract">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalContractno" name="contract_no" type="text"
                                placeholder="Contract No" required>
                            <label for="modalContractno">Contract No <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="contractor_id" id="modalContractor" required>
                                <option value="">Select Contractor</option>
                                <?php foreach ($contractors_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['company_name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalContractor">Select Contractor<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalArea" name="area" type="text" placeholder="Area"
                                required>
                            <label for="modalArea">Area<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="typeofwork_id" id="modalType">
                                <option value="">Select Type Of Work</option>
                                <?php foreach ($type_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalType">Select Type Of Work<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="scope_id" id="modalScope">
                                <option value="">Select Scope</option>
                                <?php foreach ($scope_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalScope">Select Scope<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="unit_id" id="modalUnit">
                                <option value="">Select Unit</option>
                                <?php foreach ($unit_list as $item): ?> <option value="<?= $item['ID'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalUnit">Select Unit<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="region_id" id="modalRegion">
                                <option value="">Select Region</option>
                                <?php foreach ($region_list as $item): ?> <option value="<?= $item['ID'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalRegion">Select Region<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="route_id" id="modalRoute">
                                <option value="">Select Route</option>
                                <?php foreach ($route_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalRoute">Select Route<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="district_id" id="modalDistrict">
                                <option value="">Select District</option>
                                <?php foreach ($district_list as $item): ?>
                                <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalProvince">District<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalProgress" name="progress" type="text"
                                placeholder="Progress" required>
                            <label for="modalProgress">Progress<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalEstimate" name="engineer_estimate" type="text"
                                placeholder="Engineer Estimate" required>
                            <label for="modalEstimate">Engineer Estimate<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="contractDate"
                                    name="contract_date" type="text" placeholder="Contract Date"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="contractDate">Contract Date</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="contractDateOfCom"
                                    name="date_of_completion" type="text" placeholder="Date of Completion"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="contractDateOfCom">Date of Completion</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalBidCost" name="bid_cost" type="text"
                                placeholder="Bid Cost" required>
                            <label for="modalBidCost">Bid Cost<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalFinance_ref_code" name="finance_ref_code" type="text"
                                placeholder="Finance Ref Code" required>
                            <label for="modalFinance_ref_code">Finance Ref Code<span style="color:red">*</span></label>
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