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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Budget (AMP)
                        Details</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing AMP Details</p>
            </div>
        </div>
        <hr class="bg-200">
        
        <div id="tableExample2">
            <div class="table-responsive">
               
                <table class="table table-striped table-hover table-sm fs--1 mb-0">
                    <thead>
                        <tr>
                            <th class="sort border-top ps-3">Sr No</th>
                            <th class="sort border-top" style="width:100px">AMP Main</th>
                            <th class="sort border-top">Type Of Work</th>
                            <th class="sort border-top">Scope</th>
                            <th class="sort border-top">Region</th>
                            <th class="sort border-top">Unit</th>
                            <th class="sort border-top">Route</th>
                            <th class="sort border-top">Zone</th>
                            <th class="sort border-top">District</th>
                            <th class="sort border-top">Engr Estimate</th>
                            <th class="sort border-top">Cost</th>
                            <th class="sort border-top">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $index = 1;
                        foreach ($main_info['amp_sub_list'] as $item):
                            $status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
                        ?>
                            <tr>
                                <td class="center"><?= $index++ ?></td>
                                <td><?= $item['amp_name'] ?></td>
                                <td style="width:100px"><?= $item['type_name'] ?></td>
                                <td style="width:100px"><?= $item['scope_name'] ?></td>
                                <td><?= $item['region_name'] ?></td>
                                <td><?= $item['unit_name'] ?></td>
                                <td><?= $item['route_name'] ?></td>
                                <td><?= $item['zone_name'] ?></td>
                                <td><?= $item['district_name'] ?></td>
                                <td><?= $item['engineer_estimate'] ?></td>
                                <td><?= $item['cost'] ?></td>
                                <td><?= $item['remarks'] ?></td>
                                



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

      
        <hr style="margin-top:10px" class="bg-200">
    </div>
</div>

<script>
    function confirmDelete(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('subDeleteForm_' + itemId).submit();
        }
    }

    function update1(item) {
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
           </div>
    </div>
</div>
<!-- Modal for Adding/Updating Record -->
