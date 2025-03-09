<style>
.dropdown-toggle {
    border: 0;
    background: #fff;
}

h4 {
    float: left;
}
</style>


<div class="row">
    <div class="col_12">
        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><svg
                    class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com --><svg
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2"> Condition Data
                    </span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
            </div>


            <?php if (true): ?>
            <button data-bs-toggle="modal" data-bs-target="#newItemModal" class="btn btn-outline-primary mt-2 mb-2"
                style="float: right; margin-left: 5px;">Import File
            </button>
            <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newItemModalLabel">Upload Excel File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="index.php?r=imports/conditiondata" method="POST"
                                enctype="multipart/form-data">
                                <!-- File Upload Field -->
                                <div class="mb-3">
                                    <label for="fileUpload" class="form-label">Choose Excel File</label>
                                    <input type="file" class="form-control" id="fileUpload" name="fileUpload"
                                        accept=".xlsx, .xls">
                                </div>

                                <!-- Batch Name Field -->
                                <div class="mb-3">
                                    <label for="batchName" class="form-label">Batch Name</label>
                                    <input type="text" class="form-control" id="batchName" name="batchName" required>
                                </div>

                                <div class="col-12 col-md-12 mb-3">
                                    <label for="organizerSingle2">Date</label>
                                    <div class="flatpickr-input-container">
                                        <div class="form-floating">
                                            <input class="form-control datetimepicker flatpickr-input" id="date"
                                                name="date" type="text" placeholder="Select Date" readonly="readonly">
                                            <label class="ps-6" for="date">Select Date</label>
                                            <span class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" style="float: right;">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php endif; ?>
        </div>
        <hr class="bg-200">
        <?php if (Yii::$app->session->hasFlash('info')): ?>
        <div id="flash-info" class="alert alert-info"
            style="transition: opacity 0.5s ease;height: 27px;text-align: left;vertical-align: middle;padding: 0px;width: 385px;font-size: small;color: black;border: none;padding: 4px;padding-left: 13px;background: #f2f2f2;">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div id="flash-info" class="alert alert-info"
            style="transition: opacity 0.5s ease;height: 27px;text-align: left;vertical-align: middle;padding: 0px;width: 385px;font-size: small;color: #050404;border: none;padding: 4px;padding-left: 13px;background: #ed200052;">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
        <?php endif; ?>

        <div class="row" style="margin: 0px -40px;">

            <div class="table-responsive" id="table1">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Sr</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Batch Name</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Date</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Created At</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        foreach ($condition_data as $data): ?>
                        <tr style="text-align: center; font-size: 8px;">
                            <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                <?php echo $index++; ?></td>
                            <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                <?php echo htmlspecialchars($data['batch_name']); ?></td>
                            <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                <?php echo htmlspecialchars($data['date']); ?></td>
                            <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                <?php echo htmlspecialchars($data['create_time']); ?></td>
                            <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                <?php if ($can['can_view'] == 1): ?>
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <a class="green" href="index.php?r=imports/details&referance=<?= $data['id'] ?> ">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if ($can['can_delete'] == 1): ?>
                                <div class="hidden-sm hidden-xs action-buttons"
                                    style="display: inline-flex; gap: 10px;">
                                    <form id="deleteForm_<?php echo $data['id']; ?>"
                                        action="index.php?r=imports/conditiondata" method="POST"
                                        style="display: inline;">
                                        <input type="hidden" name="_csrf"
                                            value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                        <input type="hidden" name="save_record" value="delete_record">
                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                        <button type="button" class="green" style="border: none; background: none;"
                                            onclick="confirmDelete(<?php echo $data['id']; ?>)">
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
    if (confirm('Are you sure you want to delete this batch?')) {
        document.getElementById('deleteForm_' + itemId).submit();
    }
}

function toggleTable() {
    var table = document.getElementById("table1");
    var icon = document.getElementById("toggleArrow").getElementsByTagName("i")[0];

    // Toggle table visibility
    if (table.style.display === "none") {
        table.style.display = "block";
        icon.classList.remove("fa-arrow-up");
        icon.classList.add("fa-arrow-down");
    } else {
        table.style.display = "none";
        icon.classList.remove("fa-arrow-down");
        icon.classList.add("fa-arrow-up");
    }
}
</script>