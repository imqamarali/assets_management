<script>
function confirmDelete(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById('subDeleteForm_' + itemId).submit();
    }
}

function update(item) {
    document.getElementById('submodalId').value = item.id;
    document.getElementById('submodalTitle').value = item.amp_name;
    document.getElementById('submodalStatus').value = item.status;
    document.getElementById('submodalAmp').value = item.AMP_id;
    document.getElementById('submodalType').value = item.typeofwork_id;
    document.getElementById('submodalScope').value = item.scope_id;
    document.getElementById('submodalRegion').value = item.region_id;
    document.getElementById('submodalUnit').value = item.unit_id;
    document.getElementById('submodalRoute').value = item.route_id;
    document.getElementById('submodalZone').value = item.zone_id;
    document.getElementById('submodalDistrict').value = item.district_id;
    document.getElementById('submodalEstimate').value = item.engineer_estimate;
    document.getElementById('submodalCost').value = item.cost;
    document.getElementById('submodalRemarks').value = item.remarks;
    document.getElementById('submodalDetails').value = item.discription;
}
</script>
<!-- Modal for Adding/Updating Record -->
<div class="modal fade modal-xl" id="subnewItem" tabindex="-1" aria-labelledby="subnewItems" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Add New Record</h5>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times fs--1"></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" method="post" action="index.php?r=amp/amp_sub">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="submodalId" value="" />

                    <div class="col-sm-6 col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="submodalTitle" name="title" type="text" placeholder="Title"
                                required>
                            <label for="submodalTitle">Title <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="submodalStatus" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            <label for="submodalStatus">Status<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="amp_id" id="submodalAmp" required>
                                <option value="">Select AMP Main</option>
                                <<?php foreach ($amp_main as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['title']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalAmp">AMP Main<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="typeofwork_id" id="submodalType" required>
                                <option value="">Select Type Of Work</option>
                                <<?php foreach ($type_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalType">Select Type Of Work<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="scope_id" id="submodalScope" required>
                                <option value="">Select Scope</option>
                                <<?php foreach ($scope_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalScope">Select Scope<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="region_id" id="submodalRegion" required>
                                <option value="">Select Region</option>
                                <<?php foreach ($region_list as $item): ?> <option value="<?= $item['ID'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalRegion">Select Region<span style="color:red">*</span></label>
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="unit_id" id="submodalUnit" required>
                                <option value="">Select Unit</option>
                                <<?php foreach ($unit_list as $item): ?> <option value="<?= $item['ID'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalUnit">Select Unit<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="route_id" id="submodalRoute" required>
                                <option value="">Select Route</option>
                                <<?php foreach ($route_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalRoute">Select Route<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="zone_id" id="submodalZone" required>
                                <option value="">Select Zone</option>
                                <<?php foreach ($zone_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['Name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalZone">Select Zone<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="district_id" id="submodalDistrict" required>
                                <option value="">Select District</option>
                                <<?php foreach ($district_list as $item): ?> <option value="<?= $item['id'] ?>">
                                    <?= $item['name']  ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="submodalDistrict">Select District<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="submodalEstimate" name="engineer_estimate" type="text"
                                placeholder="Engineer Estimate" required>
                            <label for="submodalEstimate">Engineer Estimate <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="submodalCost" name="cost" type="text" placeholder="Cost"
                                required>
                            <label for="submodalCost">Cost<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="submodalRemarks" name="remarks" type="text"
                                placeholder="Remarks" required>
                            <label for="submodalRemarks">Remarks<span style="color:red">*</span></label>
                        </div>
                    </div>



                    <div class="col-12 gy-6">
                        <div class="form-floating">
                            <textarea class="form-control" id="submodalDetails" placeholder="Enter Short Details"
                                name="details" style=" height: 100px"></textarea>
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