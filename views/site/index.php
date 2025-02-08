<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\models\Employee;
use app\models\Dashboardpermissions;

$conn = Yii::$app->getDb();
/* @var $this yii\web\View */

$this->title = 'HSMS';
?>
<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">
        <div class="col_12">
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
                    <!-- <i class="fa-inverse fa-stack-1x text-primary-soft fas fa-cart-plus" data-fa-transform="shrink-4"></i> Font Awesome fontawesome.com --></span>
                <div class="col">
                    <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contractor &amp;
                            Contract Dashboard</span><span
                            class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                    </h3>
                    <p class="mb-0">Find more cards which are dedicatedly made.</p>
                </div>
            </div>
            <hr class="bg-200">
            <div class="accordion" id="accordionExample">
                <div class="">
                    <h2 class="accordion-header" id="headingOne">

                        <button class="accordion-button collapsed" style="height: 0px !important;
  padding: 0px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne">
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse " id="collapseOne" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <form method="POST" action="">
                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Zone</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value="Central">Central</option>
                                            <option value="North">North</option>
                                            <option value="South">South</option>
                                            <option value="West">West</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Region</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value="Balochistan North">Balochistan North</option>
                                            <option value="Balochistan South">Balochistan South</option>
                                            <option value="Balochistan West Makran">Balochistan West Makran</option>
                                            <option value="Gilgit Baltistan">Gilgit Baltistan</option>
                                            <option value="KPK">KPK</option>
                                            <option value="Northern Areas">Northern Areas</option>
                                            <option value="Punjab North">Punjab North</option>
                                            <option value="Punjab South">Punjab South</option>
                                            <option value="Sindh North">Sindh North</option>
                                            <option value="Sindh South">Sindh South</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Unit</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value="Abbottabad">Abbottabad</option>
                                            <option value="Bahawalpur">Bahawalpur</option>
                                            <option value="Balakot">Balakot</option>
                                            <option value="Batkhela">Batkhela</option>
                                            <option value="Chilas">Chilas</option>
                                            <option value="Chitral">Chitral</option>
                                            <option value="D. G. Khan">D. G. Khan</option>
                                            <option value="D.I. Khan">D.I. Khan</option>
                                            <option value="Dadu">Dadu</option>
                                            <option value="Dalbandin">Dalbandin</option>
                                            <option value="Dir">Dir</option>
                                            <option value="Gwadar">Gwadar</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Karak">Karak</option>
                                            <option value="Khuzdar">Khuzdar</option>
                                            <option value="Kohat">Kohat</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Larkana">Larkana</option>
                                            <option value="Loralai">Loralai</option>
                                            <option value="Mingora (Swat)">Mingora (Swat)</option>
                                            <option value="Mirpur Khas">Mirpur Khas</option>
                                            <option value="Moro">Moro</option>
                                            <option value="Multan">Multan</option>
                                            <option value="Noshki">Noshki</option>
                                            <option value="Ormara">Ormara</option>
                                            <option value="Pattan/Dassu">Pattan/Dassu</option>
                                            <option value="Peshawar">Peshawar</option>
                                            <option value="Quetta">Quetta</option>
                                            <option value="Rahim Yar Khan">Rahim Yar Khan</option>
                                            <option value="Rajanpur">Rajanpur</option>
                                            <option value="Rawalpindi">Rawalpindi</option>
                                            <option value="Sahiwal">Sahiwal</option>
                                            <option value="Shikarpur">Shikarpur</option>
                                            <option value="Sibi">Sibi</option>
                                            <option value="Sukkur">Sukkur</option>
                                            <option value="Uthal">Uthal</option>
                                            <option value="Wazirabad">Wazirabad</option>
                                            <option value="Zhob">Zhob</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Route</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value="N-10">N-10</option>
                                            <option value="N-120">N-120</option>
                                            <option value="N-125">N-125</option>
                                            <option value="N-15">N-15</option>
                                            <option value="N-155">N-155</option>
                                            <option value="N-25">N-25</option>
                                            <option value="N-35">N-35</option>
                                            <option value="N-40">N-40</option>
                                            <option value="N-45">N-45</option>
                                            <option value="N-5">N-5</option>
                                            <option value="N-50">N-50</option>
                                            <option value="N-55">N-55</option>
                                            <option value="N-65">N-65</option>
                                            <option value="N-70">N-70</option>
                                            <option value="N-80">N-80</option>
                                            <option value="N-90">N-90</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">KM - FROM</label>

                                        <input class="form-control" id="exampleFormControlInput" type="email"
                                            placeholder="KM">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">KM - TO</label>

                                        <input class="form-control" id="exampleFormControlInput" type="email"
                                            placeholder="KM">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Year</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value=""></option>
                                            <option value="2018-19">2018-19</option>
                                            <option value="2019-20">2019-20</option>
                                            <option value="2020-21">2020-21</option>
                                            <option value="2021-22">2021-22</option>
                                            <option value="2022-23">2022-23</option>
                                            <option value="2023-24">2023-24</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="organizerSingle2">Scope of work</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected="">Please Select </option>
                                            <option value="ADMINISTRATIVE EXPENSES">ADMINISTRATIVE EXPENSES</option>
                                            <option value="BRIDGE/CULVERT STRUCTURAL MAINTENANCE">BRIDGE/CULVERT
                                                STRUCTURAL MAINTENANCE</option>
                                            <option value="CORRIDOR MANAGEMENT">CORRIDOR MANAGEMENT</option>
                                            <option value="EMERGENCY MAINTENANCE">EMERGENCY MAINTENANCE</option>
                                            <option value="HIGHWAY SAFETY">HIGHWAY SAFETY</option>
                                            <option value="SPECIAL MAINTENANCE ">SPECIAL MAINTENANCE </option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <input type="submit" name="add_faculty" class="btn btn-outline-primary mt-5"
                                            value="Search">

                                    </div>
                                    <div class="col-12 col-md-2">
                                        <a class="btn btn-outline-primary mt-5" href="exported.xls">Export To Excel<svg
                                                class="svg-inline--fa fa-angle-right ms-2 fs--2 text-center"
                                                aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 256 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                                                </path>
                                            </svg>
                                            <!-- <span class="fas fa-angle-right ms-2 fs--2 text-center"></span> Font Awesome fontawesome.com --></a>
                                    </div>

                                </div>
                            </form>
                            <hr class="bg-200">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-xl-5 col-xxl-6">
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-12">
                    <h4 class="text-1100 text-nowrap">Contracts Value Against Type Of Maintenance</h4>

                    <div class="d-flex align-items-center justify-content-between">



                    </div>
                    <hr class="bg-200 mb-2 mt-2">


                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">ADMINISTRATIVE EXPENSES</p>

                        <h5 class="mb-0 text-900">(922,085,029.0)</h5>
                    </div>

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">BRIDGE/CULVERT STRUCTURAL MAINTENANCE</p>

                        <h5 class="mb-0 text-900">(209,030,000.0)</h5>
                    </div>

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">CORRIDOR MANAGEMENT</p>

                        <h5 class="mb-0 text-900">(0.0)</h5>
                    </div>

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">EMERGENCY MAINTENANCE</p>

                        <h5 class="mb-0 text-900">(167,597,725.0)</h5>
                    </div>

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">HIGHWAY SAFETY</p>

                        <h5 class="mb-0 text-900">(277,760,000.0)</h5>
                    </div>

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-info-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">SPECIAL MAINTENANCE </p>

                        <h5 class="mb-0 text-900">(1,982,790,521.0)</h5>
                    </div>

                    <button class="btn btn-outline-primary mt-5">See Details<svg
                            class="svg-inline--fa fa-angle-right ms-2 fs--2 text-center" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                            </path>
                        </svg>
                        <!-- <span class="fas fa-angle-right ms-2 fs--2 text-center"></span> Font Awesome fontawesome.com --></button>
                </div>

            </div>
        </div>
        <div class="col-12 col-xl-3 col-xxl-6">
            <div class="position-relative mb-sm-4 mb-xl-0">
                <div class="echart-issue-chart"
                    style="min-height: 390px; width: 100%; user-select: none; position: relative;"
                    _echarts_instance_="ec_1737622260515">
                    <div
                        style="position: relative; width: 230px; height: 390px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                        <canvas
                            style="position: absolute; left: 0px; top: 0px; width: 230px; height: 390px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;"
                            data-zr-dom-id="zr_0" width="230" height="390"></canvas>
                    </div>
                    <div class=""
                        style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; transition: opacity 0.2s cubic-bezier(0.23, 1, 0.32, 1), visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1), transform 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgb(255, 255, 255); border-width: 1px; border-radius: 4px; color: rgb(102, 102, 102); font: 14px / 21px Microsoft YaHei; padding: 10px; top: 0px; left: 0px; transform: translate3d(-229px, 183px, 0px); border-color: rgb(96, 198, 255); pointer-events: none; visibility: hidden; opacity: 0;">
                        <div style="margin: 0px 0 0;line-height:1;">
                            <div style="font-size:14px;color:#666;font-weight:400;line-height:1;">Tasks assigned to me
                            </div>
                            <div style="margin: 10px 0 0;line-height:1;">
                                <div style="margin: 0px 0 0;line-height:1;"><span
                                        style="display:inline-block;margin-right:4px;border-radius:10px;width:10px;height:10px;background-color:#60c6ff;"></span><span
                                        style="font-size:14px;color:#666;font-weight:400;margin-left:2px">SPECIAL
                                        MAINTENANCE </span><span
                                        style="float:right;margin-left:20px;font-size:14px;color:#666;font-weight:900">1,982,790,521</span>
                                    <div style="clear:both"></div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 col-xxl-6">
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-12">
                    <h4 class="text-1100 text-nowrap ">Year Wise Contract cost</h4>

                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fw-bold">Year</p>

                        <p class="mb-0 fs--1">Amount (M) <span class="fw-bold"></span></p>
                    </div>
                    <hr class="bg-200 mb-2 mt-2">

                    <div class="d-flex align-items-center mb-1"><span
                            class="d-inline-block bg-success-300 bullet-item me-2"></span>
                        <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">2023-24</p>

                        <h5 class="mb-0 text-900">3,559,263,275.00</h5>
                    </div>

                    <button class="btn btn-outline-primary mt-5">See Details<svg
                            class="svg-inline--fa fa-angle-right ms-2 fs--2 text-center" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                            </path>
                        </svg>
                        <!-- <span class="fas fa-angle-right ms-2 fs--2 text-center"></span> Font Awesome fontawesome.com --></button>
                </div>

            </div>
        </div>
        <div id="tableExample2"
            data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:{&quot;innerWindow&quot;:2,&quot;left&quot;:1,&quot;right&quot;:1}}">
            <div class="table-responsive">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Contracts
                        details</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>

                <hr class="bg-200 mb-2 mt-2">
                <table class="table table-striped table-sm fs--1 mb-0">
                    <thead>
                        <tr>
                            <th class="sort border-top ps-3" data-sort="name">S NO,</th>
                            <th class="sort border-top" data-sort="email">Maintenance Unit

                            </th>
                            <th class="sort border-top" data-sort="age">Route</th>
                            <th class="sort border-top" scope="col">Contract No.</th>
                            <th class="sort border-top" scope="col">Financial Year</th>
                            <th class="sort border-top" scope="col">Progress</th>
                            <th class="sort border-top" scope="col">Remarks</th>

                            <th class="sort border-top" scope="col">Date of Award</th>
                            <th class="sort border-top" scope="col">Name of Contractor
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list">

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5 D.C Colony Rahwali Cantt on G.T Road</td>
                            <td class="align-middle age">HS-PN-23-05-01</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">50%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s MFG Engineering</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">2</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5 (Manga Mandi Bypass)</td>
                            <td class="align-middle age">HS-PN-23-05-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">85%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">03.04.2024</td>
                            <td class="align-middle age">M/s Utopia Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">3</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5 (NBC&amp;SBC)</td>
                            <td class="align-middle age">HS-PN-23-05-03</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">0%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Stay Order</td>

                            <td class="align-middle age">25.04.2024</td>
                            <td class="align-middle age">M/s MFG Engineering</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">4</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">SM-PN-23-05-06</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">30%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s SAM Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">5</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">SM-PN-23-05-07</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s SAM Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">6</td>
                            <td class="align-middle email">HIGHWAY SAFETY</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">SM-PN-23-05-09</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">95%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s Progressive Multi Engr</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 (NBC&amp;SBC)</td>
                            <td class="align-middle age">SM-PN-23-05-01</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">91%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">29.04.2024</td>
                            <td class="align-middle age">M/s Rozee Builders</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">2</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 (NBC)</td>
                            <td class="align-middle age">SM-PN-23-05-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">50%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">23.05.2024</td>
                            <td class="align-middle age">M/s Saadat Enterprises</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">3</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 (SBC)</td>
                            <td class="align-middle age">SM-PN-23-05-04</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">60%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">27.12.2023</td>
                            <td class="align-middle age">M/s Akbar Din Khattak &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">4</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 (NBC)</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">5</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-08</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">90%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">27.03.2024</td>
                            <td class="align-middle age">M/s Malik Amir Iqball Khan</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">6</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">SM-PN-23-05-07</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">10.05.2024</td>
                            <td class="align-middle age">M/s Maqsood Ahmed</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">7</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-10</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">09.04.2024</td>
                            <td class="align-middle age">M/s SS Builders</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">8</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">SM-PN-23-05-15</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">95%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s Mushtaq &amp; Sons</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">9</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-14</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">90%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">13.03.2024</td>
                            <td class="align-middle age">M/s Alpha Capital Enterprises</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">10</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC</td>
                            <td class="align-middle age">SM-PN-23-05-16</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">03.05.2024</td>
                            <td class="align-middle age">M/s South Asia Engineering Corporation</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">11</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-17</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">80%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">01.04.2024</td>
                            <td class="align-middle age">M/s Sh Usman Khalid &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">12</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-13</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">90%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">29.05.2024</td>
                            <td class="align-middle age">M/s Ch Tanveer Associates</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">13</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">SM-PN-23-05-12</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">35%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">22.04.2024</td>
                            <td class="align-middle age">M/s SH. Iqbal &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">14</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">SM-PN-23-05-11</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">03.05.2024</td>
                            <td class="align-middle age">M/s SH. Iqbal &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">15</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-18</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">65%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">09.07.2024</td>
                            <td class="align-middle age">M/s Khurram Nawaz &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">16</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC &amp; SBC</td>
                            <td class="align-middle age">SM-PN-23-05-19</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Completed</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s MFG Engineering Service</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">17</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 Gujranwala Bypass</td>
                            <td class="align-middle age">SM-PN-23-05-21</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">40%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">02.05.2024</td>
                            <td class="align-middle age">M/s Muhammad Zada &amp; Sons</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">18</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-22</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">75%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.04.2024</td>
                            <td class="align-middle age">M/s Progressive Multi Engr</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">19</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">20</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">67%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">06.05.2024</td>
                            <td class="align-middle age">M/s NLC</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">21</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">SM-PN-23-05-25</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">95%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">19.07.2024</td>
                            <td class="align-middle age">M/s Highway Constructors</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">22</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-26</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">10%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">25.07.2024</td>
                            <td class="align-middle age">M/s Nawaz &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">23</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">SM-PN-23-05-27</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">0%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Not Mobilized</td>

                            <td class="align-middle age">21.08.2024</td>
                            <td class="align-middle age">M/s Khan Construction - M/s Hammad Construction (JV)</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">24</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-31</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">40%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">01.08.2024</td>
                            <td class="align-middle age">M/s Rohail Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">25</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-05-30</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">45%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">01.08.2024</td>
                            <td class="align-middle age">M/s Rohail Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">26</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 </td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">27</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC Sara-e-Alamgir</td>
                            <td class="align-middle age">SM-PN-23-05-32</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">0%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Mobilzied</td>

                            <td class="align-middle age">22.08.2024</td>
                            <td class="align-middle age">M/s Rohail Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">28</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">29</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-5 NBC&amp;SBC (Imamia Colony to Shahdra)</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">30</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-80 (R/S)</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">31</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">N-80 </td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">32</td>
                            <td class="align-middle email">SPECIAL MAINTENANCE </td>
                            <td class="align-middle age">LEBP NBC&amp;SBC</td>
                            <td class="align-middle age">SM-PN-23-LEBP-20</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">92%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">26.03.2024</td>
                            <td class="align-middle age">M/s South Asia Engg. Corp</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">EM-PN-20-05-09</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Approved by Member (CZ)
                                on 27.06.2023</td>

                            <td class="align-middle age">27.06.2023</td>
                            <td class="align-middle age">M/s AAR Builders</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">2</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">EM-PN-20-05-08</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Approved by Member (CZ)
                                on 03.08.2023</td>

                            <td class="align-middle age">10.08.2023</td>
                            <td class="align-middle age">M/s AAR Builders</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">3</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Apoproved by Member CZ
                            </td>

                            <td class="align-middle age">18.08.2023</td>
                            <td class="align-middle age">M/s South Asia Engineering Corporation</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">4</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 NBC&amp;SBC</td>
                            <td class="align-middle age">EM-PN-22-05-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Apoproved by Member CZ
                            </td>

                            <td class="align-middle age">5.09.2023</td>
                            <td class="align-middle age">M/s South Asia Engineering Corporation</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">5</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 NBC</td>
                            <td class="align-middle age">EM-PN-23-05-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">80%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">In progress</td>

                            <td class="align-middle age">02.04.2024</td>
                            <td class="align-middle age">M/s Malik Amir Iqbal &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">6</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 NBC</td>
                            <td class="align-middle age">EM-PN-23-05-04</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">0%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Mobilzied</td>

                            <td class="align-middle age">11.07.2024</td>
                            <td class="align-middle age">M/s Ch Tanveer Associates</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">7</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">8</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">N-5 (Near Government Teaching Hospital Shahdra)</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">9</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">Baba Farid Bridge Pakpattan</td>
                            <td class="align-middle age">EM-PN-22-BFB-06</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Apoproved by Member CZ
                            </td>

                            <td class="align-middle age">22.08.2023</td>
                            <td class="align-middle age">M/s Nawaz &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">10</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">Baba Farid Bridge Pakpattan</td>
                            <td class="align-middle age">EM-PN-22-BFB-05</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">100%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Apoproved by Member CZ
                            </td>

                            <td class="align-middle age">21.08.2023</td>
                            <td class="align-middle age">M/s South Asia Engg. Cooporation</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">11</td>
                            <td class="align-middle email">EMERGENCY MAINTENANCE</td>
                            <td class="align-middle age">Baba Farid Bridge Pakpattan</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s M. Nawaz Engineers</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">BRIDGE/CULVERT STRUCTURAL MAINTENANCE</td>
                            <td class="align-middle age">N-5 Ghakhar Urban Area </td>
                            <td class="align-middle age">BC-PN-23-05-01</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">3%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Litigation at site</td>

                            <td class="align-middle age">19.04.24</td>
                            <td class="align-middle age">MFG Engineering Servcies</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">BRIDGE/CULVERT STRUCTURAL MAINTENANCE</td>
                            <td class="align-middle age">N-5 Ghakhar Urban Area </td>
                            <td class="align-middle age">BC-PN-23-05-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;">22%</td>
                            <td class="align-middle age" style="font-weight: bold;color: red;">Work in progress</td>

                            <td class="align-middle age">06.05.24</td>
                            <td class="align-middle age">M/s Nawaz &amp; Co</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">CORRIDOR MANAGEMENT</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">2</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">Regional Office NHA Lahore</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">3</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">Regional Office NHA Lahore</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">4</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">5</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">6</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">7</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">8</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">9</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">1</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2021-22-PN-10</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s GRL &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">2</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2019-20-PN-03</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Ugalco Construction CO.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">3</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">RH-2019-20-PN-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s PCMC JV</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">4</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2021-22-PN-12</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Wajid Construction (Pvt) Ltd.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">5</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2021-22-PN-12</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Wajid Construction (Pvt) Ltd.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">6</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">RH-2016-17-PN-01</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Techno Time (Pvt ) Ltd.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">7</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5 NBC</td>
                            <td class="align-middle age">PM-2021-22-PN-10</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s GRL &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">8</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">RH-2019-20-PN-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s PCMC JV</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">9</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age"></td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">10</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2020-21-PN-01</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Fast Track Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">11</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2020-21-PN-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Fast Track Construction</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">12</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5 NBC</td>
                            <td class="align-middle age">PM-2020-21-PN-06</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Wajid Iqbal &amp; Co.</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">13</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">Remodeling of Defece Chowk</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s NLC</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">14</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">RRWP Phase-II</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s FWO</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">15</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5</td>
                            <td class="align-middle age">PM-2019-20-PN-09</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s AA Memon</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">16</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-60</td>
                            <td class="align-middle age">PM-2018-19-PN-60-02</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s Mushtaq &amp; Sons</td>


                        </tr>

                        <tr>
                            <td class="align-middle ps-3 name">17</td>
                            <td class="align-middle email">ADMINISTRATIVE EXPENSES</td>
                            <td class="align-middle age">N-5 SBC</td>
                            <td class="align-middle age">PM-2020-21-PN-13</td>
                            <td class="align-middle age">2023-24</td>
                            <td class="align-middle age" style="font-weight: bold;color: green;"></td>
                            <td class="align-middle age" style="font-weight: bold;color: red;"></td>

                            <td class="align-middle age"></td>
                            <td class="align-middle age">M/s WIC JV Lawaghar</td>


                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-12 col-xl-5 col-xxl-6">
            <h3>Comparison</h3>
            <p class="text-700 mb-0 mb-xl-3">Revenue / Traffic / &amp; Maintenance</p>
            <div class="echart-zero-burnout-chart"
                style="min-height: 320px; width: 100%; user-select: none; position: relative;"
                _echarts_instance_="ec_1737622260514">
                <div
                    style="position: relative; width: 404px; height: 320px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                    <canvas
                        style="position: absolute; left: 0px; top: 0px; width: 404px; height: 320px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;"
                        data-zr-dom-id="zr_0" width="404" height="320"></canvas>
                </div>
                <div class=""></div>
            </div>
        </div>
    </div>
</div>