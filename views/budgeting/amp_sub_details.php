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

        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1">
                <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Budget
                        (AMP)</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Find more cards which are dedicatedly made for E-commerce.</p>
            </div>
        </div>
        <hr class="bg-200">
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
                <?php if ($can['can_add'] == 1): ?>
                <button data-bs-toggle="modal" data-bs-target="#newItem" class="btn btn-outline-primary mt-2 mb-2"
                    style="float: right" style="margin-left: 5px"> Add New<span
                        class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
                <?php endif; ?>
                <table class="table table-striped table-hover table-sm fs--1 mb-0">
                    <thead>
                        <tr>
                            <th class="sort border-top ps-3">Sr No</th>
                            <th class="sort border-top">AMP Main</th>
                            <th class="sort border-top">AMP Sub</th>
                            <th class="sort border-top">Km From</th>
                            <th class="sort border-top">Km To</th>
                            <th class="sort border-top">Direction</th>
                            <th class="sort border-top">Type of Work</th>
                            <th class="sort border-top">Treatment</th>
                            <th class="sort border-top">Length</th>
                            <th class="sort border-top">Location From</th>
                            <th class="sort border-top">Location To</th>
                            <th class="sort border-top">Description</th>
                            <th class="sort border-top">Status</th>

                            <th class="sort border-top">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($amp_details_list as $item):
                            $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                        ?>
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['amp_main_name'] ?></td>
                            <td><?= $item['asub_name'] ?></td>
                            <td><?= $item['km_from'] ?></td>
                            <td><?= $item['km_to'] ?></td>
                            <td><?= $item['direction'] ?></td>
                            <td><?= $item['type_name'] ?></td>
                            <td><?= $item['treatment_name'] ?></td>
                            <td><?= $item['lenght'] ?></td>
                            <td><?= $item['location_from'] ?></td>
                            <td><?= $item['location_to'] ?></td>
                            <td><?= $item['discription'] ?></td>
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
                                        action="index.php?r=amp/amp_sub_details" method="POST" style="display: inline;">
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
    // Populate modal fields with the selected item's data
    document.getElementById('modalId').value = item.id;
    document.getElementById('modalAmp').value = item.AMP_main_id; // Ensure the key is correct
    document.getElementById('modalAmpSub').value = item.AMP_sub_id; // Ensure this field exists
    document.getElementById('modalTreatment').value = item.treatment; // Ensure correct key
    document.getElementById('modalType').value = item.type_of_work;
    document.getElementById('modalKmfrom').value = item.km_from;
    document.getElementById('modalKmto').value = item.km_to;
    document.getElementById('modalLocationFrom').value = item.location_from;
    document.getElementById('modalLocationTo').value = item.location_to;
    document.getElementById('modalDirection').value = item.direction;
    document.getElementById('modalLength').value = item.lenght; // Make sure the correct field is used
    document.getElementById('modalStatus').value = item.status;
    document.getElementById('modalDetails').value = item.discription; // Ensure this is the correct key
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
                <form class="row g-3 mb-6" method="post" action="index.php?r=amp/amp_sub_details">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="amp_id" id="modalAmp" required>
                                <option value="">Select AMP Main</option>
                                <<?php foreach ($amp_main as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['title']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="modalAmp">AMP Main<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="amp_sub_id" id="modalAmpSub" required>
                                <option value="">Select AMP Main Sub</option>
                                <<?php foreach ($amp_sub_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="modalAmpSub">Select AMP Main Sub<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="treatment_id" id="modalTreatment" required>
                                <option value="">Select Treatment</option>
                                <<?php foreach ($treatment_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="modalTreatment">Treatment<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="typeofwork_id" id="modalType" required>
                                <option value="">Select Type of Work</option>
                                <<?php foreach ($type_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="modalType">Select Type of Work<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalKmfrom" name="km_from" type="text"
                                placeholder="Kilometer From" required>
                            <label for="modalKmfrom">Kilometer From <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalKmto" name="km_to" type="text"
                                placeholder="Kilometer To" required>
                            <label for="modalKmfrom">Kilometer To <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalLocationFrom" name="location_from" type="text"
                                placeholder="Location From" required>
                            <label for="modalLocationFrom">Location From<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalLocationTo" name="location_to" type="text"
                                placeholder="Location To" required>
                            <label for="modalLocationTo">Location To<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalDirection" name="direction" type="text"
                                placeholder="Direction" required>
                            <label for="modalDirection">Direction<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalLength" name="length" type="text" placeholder="Length"
                                required>
                            <label for="modalLength">Length<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="modalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="modalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-12 gy-6">
                        <div class="form-floating">
                            <textarea class="form-control" id="modalDetails" placeholder="Enter Short Details"
                                name="details" style=" height: 100px"></textarea>
                            <label for="modalDetails">Details</label>
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