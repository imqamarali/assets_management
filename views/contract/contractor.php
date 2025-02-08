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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contractors
                        List</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing Contractors Table</p>
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
                            <th class="sort border-top">Company Name</th>
                            <th class="sort border-top">Phone No</th>
                            <th class="sort border-top">Contact Person</th>
                            <th class="sort border-top">Mobile No</th>
                            <th class="sort border-top">Address</th>
                            <th class="sort border-top">Contractor No</th>
                            <th class="sort border-top">Secp No</th>
                            <th class="sort border-top">Pec No</th>
                            <th class="sort border-top">Area</th>
                            <th class="sort border-top">NTN No</th>
                            <th class="sort border-top">Status</th>
                            <th class="sort border-top">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($contractors_list as $item):
                            $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                        ?>
                        <!-- id, "company_name ", phone_no, contact_person, mobile_no, address, 
                             contractor_no, secp_no, pec_no, area, ntn_no, status -->
                        <tr>
                            <td class="center"><?= $index++ ?></td>
                            <td><?= $item['company_name '] ?></td>
                            <td><?= $item['phone_no'] ?></td>
                            <td><?= $item['contact_person'] ?></td>
                            <td><?= $item['mobile_no'] ?></td>
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['contractor_no'] ?></td>
                            <td><?= $item['secp_no'] ?></td>
                            <td><?= $item['pec_no'] ?></td>
                            <td><?= $item['area'] ?></td>
                            <td><?= $item['ntn_no'] ?></td>
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
                                        action="index.php?r=contract/contractor" method="POST" style="display: inline;">
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

<!-- Script to handle update functionality -->
<script>
function confirmDelete(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById('deleteForm_' + itemId).submit();
    }
}

function update(item) {
    console.log(item);
    document.getElementById('modalId').value = item.id;
    document.getElementById('modalTitle').value = item['company_name '];
    document.getElementById('modalNtn').value = item.ntn_no;
    document.getElementById('modalArea').value = item.area;
    document.getElementById('modalPhoneNo').value = item.phone_no;
    document.getElementById('modalContactPerson').value = item.contact_person;
    document.getElementById('modalMobileNo').value = item.mobile_no;
    document.getElementById('modalContractor').value = item.contractor_no;
    document.getElementById('modalSecpNo').value = item.secp_no;
    document.getElementById('modalPecNo').value = item.pec_no;
    document.getElementById('modalDetails').value = item.address;


    document.getElementById('modalStatus').value = item.status;

    document.querySelector('.modal-title').textContent = 'Update Record';
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
                <form class="row g-3 mb-6" method="post" action="index.php?r=contract/contractor">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />

                    <div class="col-sm-6 col-md-6">
                        <div class="form-floating">
                            <input class="form-control" id="modalTitle" name="title" type="text"
                                placeholder="Company Name" required>
                            <label for="modalTitle">Company Name <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalNtn" name="ntn" type="text" placeholder="NTN No"
                                required>
                            <label for="modalCode">NTN No <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalArea" name="area" type="text" placeholder="Area"
                                required>
                            <label for="modalArea">Area<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalPhoneNo" name="phone_no" type="text"
                                placeholder="Phone none" required>
                            <label for="modalTitle">Phone No<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalContactPerson" name="contact_person" type="text"
                                placeholder="Contact Person" required>
                            <label for="modalContactPerson">Contact Person<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalMobileNo" name="mobile_no" type="text"
                                placeholder="Mobile No" required>
                            <label for="modalMobileNo">Mobile No<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalContractor" name="contractor_no" type="text"
                                placeholder="Contractor No" required>
                            <label for="modalContractor">Contractor No<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalSecpNo" name="secp_no" type="text"
                                placeholder="Secp No" required>
                            <label for="modalSecpNo">Secp No<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalPecNo" name="pec_no" type="text" placeholder="Pec No"
                                required>
                            <label for="modalPecNo">Pec No<span style="color:red">*</span></label>
                        </div>
                    </div>



                    <div class="col-sm-8 col-md-8">
                        <div class="form-floating">
                            <textarea class="form-control" id="modalDetails" placeholder="Enter Short Details"
                                name="details" style=" height: 100px"></textarea>
                            <label for="modalDetails">Details</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="modalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="modalStatus">Status<span style="color:red">*</span></label>
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