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
                </svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com -->
                <svg class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contracts
                        Progress</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
            </div>
        </div>
        <hr class="bg-200">
        <div class="row g-5 mb-5">
            <div class="col-xl-8" style="padding: 0px;">

                <div class="card mb-3">
                    <div class="card-body" style="padding: 7px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th>Contract</th>
                                        <th>Area</th>
                                        <th>Type </th>
                                        <th>Scope</th>
                                        <th>Estimate</th>
                                        <th>Cost</th>
                                        <th>Unit</th>
                                        <th>Region</th>
                                        <th>Route</th>
                                        <th>District</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $index = 1;
                                    foreach ($contract_list as $item):
                                    ?>
                                    <tr>
                                        <td><?= $item['contract_no'] ?> (<?= $item['contractor_name'] ?>)</td>

                                        <td><?= $item['area'] ?></td>
                                        <td><?= $item['type_name'] ?></td>
                                        <td><?= $item['scope_name'] ?></td>
                                        <td><?= $item['engineer_estimate'] ?></td>
                                        <td><?= $item['bid_cost'] ?></td>
                                        <td><?= $item['unit_name'] ?></td>
                                        <td><?= $item['region_name'] ?></td>
                                        <td><?= $item['route_name'] ?></td>
                                        <td><?= $item['district_name'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="row gx-3">
                                    <h4 class="">Update Progress</h4>
                                    <hr class="bg-200">
                                    <div class="timeline-basic mb-9">
                                        <form action="index.php?r=contract/progress" method="post">
                                            <input type="hidden" name="_csrf"
                                                value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <input type="hidden" name="save_record" value="save_record" />
                                            <input type="hidden" name="total_contract"
                                                value="<?= count($contract_list) ?>" />
                                            <div class="timeline-item">
                                                <div class="col">
                                                    <label for="task">Task</label>
                                                    <input type="text" id="task" name="task" class="form-control"
                                                        placeholder="Enter task">
                                                </div>
                                                <div class="col mt-2">
                                                    <label for="details">Details</label>
                                                    <input type="text" id="details" name="details" class="form-control"
                                                        placeholder="Enter details">
                                                </div>
                                                <div class="col mt-2">
                                                    <label for="progress">Progress</label>
                                                    <input type="text" id="progress" name="progress"
                                                        class="form-control" placeholder="Enter progress">
                                                </div>
                                                <div class="row g-3 mt-2">
                                                    <div class="col mt-2">
                                                        <label for="start_date">Start Date</label>
                                                        <input class="form-control datetimepicker flatpickr-input"
                                                            id="start_date" name="start_date" type="text"
                                                            placeholder="Start Date" readonly="readonly">
                                                    </div>
                                                    <div class="col mt-2">
                                                        <label for="end_date">End Date</label>
                                                        <input class="form-control datetimepicker flatpickr-input"
                                                            id="end_date" name="end_date" type="text"
                                                            placeholder="End Date" readonly="readonly">
                                                    </div>
                                                </div>
                                                <?php foreach ($contract_list as $index => $item):
                                                    $index++; ?>
                                                <div class="col mt-2">

                                                    <input type="hidden" id="typeofwork_id<?= $index ?>"
                                                        name="typeofwork_id<?= $index ?>" class="form-control"
                                                        value="<?= $item['type_of_work'] ?>"
                                                        placeholder="Enter type of work">
                                                </div>
                                                <div class="col mt-2">

                                                    <input type="hidden" id="scopofword_id<?= $index ?>"
                                                        name="scopofword_id<?= $index ?>" class="form-control"
                                                        value="<?= $item['scope'] ?>" placeholder="Enter scope of work">
                                                </div>
                                                <div class="col">

                                                    <input type="hidden" id="contract_id<?= $index ?>"
                                                        name="contract_id<?= $index ?>" class="form-control"
                                                        value="<?= $item['contractor_id'] ?>"
                                                        placeholder="Enter contract ID">
                                                </div>
                                                <?php endforeach; ?>
                                                <!-- <div class="row g-3 mt-2">
                                                    <div class="col">
                                                        <label for="submission_date<? //= $index 
                                                                                    ?>">Submission
                                                            Date</label>
                                                        <input type="date" id="submission_date<? //= $index 
                                                                                                ?>"
                                                            name="submission_date[]" class="form-control">
                                                    </div>
                                                </div> -->
                                            </div>

                                            <?php if(count($contract_list)>0): ?>
                                            <button type="submit" class="btn btn-primary mt-3"
                                                style="width: 100%;">Submit</button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>