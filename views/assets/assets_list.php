<?php

use yii\widgets\LinkPager;

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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Assets List</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing District Table</p>
            </div>

            <?php if ($can['can_add'] == 1): ?>
            <button data-bs-toggle="modal" data-bs-target="#newItemModal" class="btn btn-outline-primary mt-2 mb-2"
                style="float: right" style="margin-left: 5px"> Add
                New<span class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
        </div>
        <?php
        $fields = ['name', 'province', 'district', 'tehsil', 'zone', 'unit', 'type', 'route', 'km_from', 'km_to'];
        echo Yii::$app->Component->renderSearchForm($fields);

        ?>
        <div class="row g-1  mb-5">
            <div id="tableExample2"
                data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
                <div class="table-responsive">

                    <table class=" table table-striped table-sm fs--1 mb-0 table-sm fs--1 leads-table simlee mt-3"
                        style="border: 1px solid #a9a9a954;">
                        <thead>
                            <tr style="margin: -3px;font-size: smaller;">
                                <th class="sort border-top ps-3">Sr No</th>
                                <th class="sort border-top">Name</th>
                                <th class="sort border-top">Province</th>
                                <th class="sort border-top">District</th>
                                <th class="sort border-top">Tehsil</th>
                                <th class="sort border-top">Zone</th>
                                <th class="sort border-top">Route</th>
                                <th class="sort border-top">Unit</th>
                                <th class="sort border-top">Type</th>
                                <th class="sort border-top">Location</th>
                                <th class="sort border-top">Longitude</th>
                                <th class="sort border-top">Latitude</th>
                                <th class="sort border-top">Elevation</th>
                                <th class="sort border-top">Status</th>
                                <th class="sort border-top">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $index = 1;
                            foreach ($assets_list as $item):
                                $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                                $status_color = ($item['status'] == 1) ? "green" : (($item['status'] == 0) ? "red" : "black");
                            ?>
                            <tr style="margin: -3px;font-size: smaller;">
                                <td style="padding-left: 5px;"><?= $index++ ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['province_name'] ?></td>
                                <td><?= $item['district_name'] ?></td>
                                <td><?= $item['tehsil_name'] ?></td>
                                <td><?= $item['zone_name'] ?></td>
                                <td><?= $item['route_name'] ?></td>
                                <td><?= $item['unit_name'] ?></td>
                                <td><?= $item['type_name'] ?></td>
                                <td><?= $item['Location'] ?></td>
                                <td><?= $item['longitude'] ?></td>
                                <td><?= $item['latitude'] ?></td>
                                <td><?= $item['elevation'] ?></td>
                                <td class="align-middle age" style="font-weight: bold;color: <?= $status_color ?>;">
                                    <?= $status ?></td>
                                <td>
                                    <?php if ($can['can_edit'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons"
                                        style="display: inline-flex; gap: 10px;">
                                        <a class="green" data-bs-toggle="modal" data-bs-target="#newItemModal"
                                            onclick="update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($can['can_delete'] == 1): ?>
                                    <div class="hidden-sm hidden-xs action-buttons"
                                        style="display: inline-flex; gap: 10px;">
                                        <form id="deleteForm_<?php echo $item['id']; ?>"
                                            action="index.php?r=assets/save" method="POST" style="display: inline;">
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

    // Assign values to the modal fields
    document.getElementById('modalId').value = item.id;
    document.getElementById('modalName').value = item.name;
    document.getElementById('modalProvince').value = item.province_id;
    document.getElementById('modalDistrict').value = item.district_id;
    document.getElementById('modalTehsil').value = item.techsil_id;
    document.getElementById('modalZone').value = item.zone_id;
    document.getElementById('modalMUnit').value = item.M_Unit_id;
    document.getElementById('modalLocation').value = item.Location;
    document.getElementById('modalSection').value = item.Section_id;
    document.getElementById('modalRoute').value = item.Route_id;
    document.getElementById('modalDirection').value = item.direction_id;
    document.getElementById('modalType').value = item.type_id;
    document.getElementById('modalAssetId').value = item.Asset_id;
    document.getElementById('modalUnit').value = item.unit;
    document.getElementById('modalLongitude').value = item.longitude;
    document.getElementById('modalLatitude').value = item.latitude;
    document.getElementById('modalElevation').value = item.elevation;
    document.getElementById('modalMetadata').value = item.metadata;
    document.getElementById('modalKmFrom').value = item.km_from;
    document.getElementById('modalKmTo').value = item.km_to;
    document.getElementById('modalRange').value = item.Range;
    document.getElementById('modalReference').value = item.reference;
    document.getElementById('modalAddress').value = item.address;
    document.getElementById('modalGeom').value = item.geom;
    document.getElementById('modalReg').value = item.Reg;
    document.getElementById('modalStatus').value = item.status;

    // Update the modal title
    document.querySelector('.modal-title').textContent = 'Update Record';

    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('newItemModal'));
    modal.show();
}
</script>


<div class="modal fade modal-xl" id="newItemModal" tabindex="-1" aria-labelledby="newItemModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post" action="index.php?r=assets/save">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />

                    <!-- Name -->
                    <div class="col-sm-6 col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="modalName" name="name" type="text" placeholder="Name"
                                required>
                            <label for="modalName">Name <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Status -->
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

                    <!-- Province -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="province_id" id="modalProvince" required>
                                <option value="">Select Province</option>
                                <?php foreach ($province_list as $item): ?>
                                <option value="<?= $item['ID'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalProvince">Province<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="district_id" id="modalDistrict" required>
                                <option value="">Select District</option>
                                <?php foreach ($districts as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalDistrict">District<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Tehsil -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="techsil_id" id="modalTehsil" required>
                                <option value="">Select Tehsil</option>
                                <?php foreach ($tehsils as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalTehsil">Tehsil<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Zone -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="zone_id" id="modalZone" required>
                                <option value="">Select Zone</option>
                                <?php foreach ($zones as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalZone">Zone<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- M_Unit -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="M_Unit_id" id="modalMUnit" required>
                                <option value="">Select Unit</option>
                                <?php foreach ($units as $item): ?>
                                <option value="<?= $item['ID'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalMUnit">Unit<span style="color:red">*</span></label>
                        </div>
                    </div>


                    <!-- Type -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="type_id" id="modalType" required>
                                <option value="">Select Type</option>
                                <?php foreach ($types as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalType">Type<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-sm-6 col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="modalLocation" name="Location" type="text"
                                placeholder="Location" required>
                            <label for="modalLocation">Location <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Section -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalSection" name="Section_id" type="number" min="0"
                                placeholder="Section">
                            <label for="modalSection">Section</label>
                        </div>
                    </div>

                    <!-- Route -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="Route_id" id="modalRoute" required>
                                <option value="">Select Route</option>
                                <?php foreach ($routes as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalRoute">Route<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Direction -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalDirection" name="direction_id" type="text"
                                placeholder="Direction">
                            <label for="modalDirection">Direction</label>
                        </div>
                    </div>


                    <!-- Asset ID -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalAssetId" name="Asset_id" type="number" min="0"
                                placeholder="Asset ID">
                            <label for="modalAssetId">Asset ID</label>
                        </div>
                    </div>

                    <!-- Unit -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalUnit" name="unit" type="number" min="0"
                                placeholder="Unit">
                            <label for="modalUnit">Unit</label>
                        </div>
                    </div>

                    <!-- Longitude -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalLongitude" name="longitude" type="number" min="0"
                                placeholder="Longitude">
                            <label for="modalLongitude">Longitude</label>
                        </div>
                    </div>

                    <!-- Latitude -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalLatitude" name="latitude" type="number" min="0"
                                placeholder="Latitude">
                            <label for="modalLatitude">Latitude</label>
                        </div>
                    </div>

                    <!-- Elevation -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalElevation" name="elevation" type="number" min="0"
                                placeholder="Elevation">
                            <label for="modalElevation">Elevation</label>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="col-sm-6 col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="modalMetadata" name="metadata" type="text"
                                placeholder="Metadata">
                            <label for="modalMetadata">Metadata</label>
                        </div>
                    </div>

                    <!-- KM From -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalKmFrom" name="km_from" type="number" min="0"
                                placeholder="KM From">
                            <label for="modalKmFrom">KM From</label>
                        </div>
                    </div>

                    <!-- KM To -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalKmTo" name="km_to" type="number" min="0"
                                placeholder="KM To">
                            <label for="modalKmTo">KM To</label>
                        </div>
                    </div>

                    <!-- Range -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalRange" name="Range" type="text" placeholder="Range">
                            <label for="modalRange">Range</label>
                        </div>
                    </div>

                    <!-- Reference -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalReference" name="reference" type="text"
                                placeholder="Reference">
                            <label for="modalReference">Reference</label>
                        </div>
                    </div>

                    <!-- Geom -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalGeom" name="geom" type="text" placeholder="Geom">
                            <label for="modalGeom">Geom</label>
                        </div>
                    </div>

                    <!-- Reg -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalReg" name="Reg" type="text" placeholder="Reg">
                            <label for="modalReg">Reg</label>
                        </div>
                    </div>


                    <!-- Address -->
                    <div class="col-sm-6 col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="modalAddress" name="address" type="text"
                                placeholder="Address">
                            <label for="modalAddress">Address</label>
                        </div>
                    </div>



                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>