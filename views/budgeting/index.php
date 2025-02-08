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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Budgeting
                        Management</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Find more cards which are dedicatedly made for E-commerce.</p>
            </div>
        </div>
        <hr class="bg-200">

        <!-- echo json_encode($submenus);
        exit; -->
        <div class="row g-5 mb-5">
            <div class="col-12 col-xl-8">
                <div class="row align-items-center g-4">

                    <?php if (isset($submenus[0]) && $submenus[0]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span
                                class="text-danger fas fa-file-signature fs-5"></span>
                            <div class="ms-3">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h4 class="mb-0">Budget (AMP)</h4>
                                </button>
                                <p class="text-800 fs--1 mb-0">Awating processing</p>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">


                                    <a class="dropdown-item" href="index.php?r=budgeting/amp_list">View List</a>

                                </div>

                            </div>
                        </div>

                    </div>

                    <?php endif; ?>
                    <?php if (isset($submenus[1]) && $submenus[1]['can_view'] == true): ?>

                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span
                                class="text-success fas fa-file-contract fs-6"></span>
                            <div class="ms-3">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h4 class="mb-0">Items (CSR)</h4>
                                </button>
                                <p class="text-800 fs--1 mb-0">Awating processing</p>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="#">View List</a>

                                </div>


                            </div>
                        </div>

                    </div>
                    <?php endif; ?>
                    <?php if (isset($submenus[2]) && $submenus[2]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span
                                class="text-success fas fa-user-astronaut fs-6"></span>
                            <div class="ms-3">
                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h4 class="mb-0"> Estimate</h4>
                                </button>
                                <p class="text-800 fs--1 mb-0">Engineer's estimate</p>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="#">View List</a>
                                </div>


                            </div>
                        </div>

                    </div>
                    <?php endif; ?>
                    <hr class="bg-200">
                </div>
                <div class="row align-items-center g-4">

                    <?php if (isset($submenus[3]) && $submenus[3]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span
                                class="text-success fas fab fa-buromobelexperte fs-3"></span>
                            <div class="ms-1">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h6 style="margin-top: 24%;" class="mb-0">Scope of Work </h6>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="index.php?r=budgeting/scope">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($submenus[4]) && $submenus[4]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span class="text-success fab fa-delicious fs-3"></span>
                            <div class="ms-1">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h6 style="margin-top: 24%;" class="mb-0">Type of Maintenance</h6>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="index.php?r=budgeting/maintenance">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($submenus[5]) && $submenus[5]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span class="text-success fab fa-flipboard fs-3"></span>
                            <div class="ms-1">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h6 style="margin-top: 24%;" class="mb-0">Financial Year</h6>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="index.php?r=budgeting/year">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!isset($submenus[6]) && $submenus[6]['can_view'] == true): ?>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center"><span class="text-danger fas fa-road fs-3"></span>
                            <div class="ms-1">

                                <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h6 style="margin-top: 24%;" class="mb-0">Expenditure</h6>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="disabledLinkExample">

                                    <a class="dropdown-item" href="#">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>


            </div>
            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-1000 me-2">Asset Category</h5>
                                            </div>
                                            <select class="form-select mb-3" aria-label="category">
                                                <option value="men-cloth">1</option>
                                                <option value="women-cloth">2</option>
                                                <option value="kid-cloth">3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-1000 me-2">Route</h5>
                                            </div>
                                            <select class="form-select mb-3" aria-label="category">
                                                <option value="men-cloth">NA-1</option>
                                                <option value="women-cloth">NA-1</option>
                                                <option value="kid-cloth">NA-1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <h5 class="mb-2 text-1000">Collection</h5>
                                            <input class="form-control mb-xl-3" type="text" placeholder="Collection">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h5 class="mb-0 text-1000 me-2">Tags</h5><a class="fw-bold fs--1 lh-sm"
                                                href="#!">View all tags</a>
                                        </div>
                                        <select class="form-select" aria-label="category">
                                            <option value="men-cloth">Men's Clothing</option>
                                            <option value="women-cloth">Womens's Clothing</option>
                                            <option value="kid-cloth">Kid's Clothing</option>
                                        </select>
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