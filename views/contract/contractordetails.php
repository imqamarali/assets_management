<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">

        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><svg
                    class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
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
            </span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contractor
                        Details</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Managing Contractor Details</p>
            </div>

            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                Contractor No:
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $contractor['contractor_no'] ?></b></span>
                </a>
            </div>
            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                &nbsp;|&nbsp;&nbsp;NTN No
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $contractor['ntn_no'] ?></b></span>
                </a>
            </div>

        </div>
    </div>
    <hr class="bg-200">


    <div class="mb-2">
        <div class="card h-5">
            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px;margin-right:10px; width: 100%;">

                <div style="width:12% ;background: #EDF3F4; padding: 5px">contractor Name:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['company_name '] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Phone:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['phone_no'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Contact Person</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['contact_person'] ?></div>
            </div>
            <div
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px; margin-right:10px; width: 100%;">

                <div style="width:12% ;background: #EDF3F4; padding: 5px">Mobile No:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['mobile_no'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Address:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['address'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">contractor No:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['contractor_no'] ?></div>
            </div>

            <div class="profile-user-info profile-user-info-striped"
                style="display:flex; margin-top: 20px; font-size: smaller; margin:5px; margin-top:-5px;margin-right:10px; width: 100%;">
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Secp No:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['secp_no'] ?></div>
                <div style="width: 12%;background: #EDF3F4; padding: 5px">Pec No:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['pec_no'] ?></div>
                <div style="width:12% ;background: #EDF3F4; padding: 5px">Area:</div>
                <div style="width:20.5% ; padding: 5px"><?= $contractor['area'] ?></div>
            </div>

        </div>
    </div>

</div>