<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Phoenix</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../vendors/simplebar/simplebar.min.js"></script>
    <script src="../assets/js/config.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../vendors/choices/choices.min.css" rel="stylesheet">
    <link href="../vendors/dhtmlx-gantt/dhtmlxgantt.css" rel="stylesheet">
    <link href="../vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="../vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="../assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="../assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="../assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="../assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <style>
    .navbar-top {
        background: #60c6ff;
    }

    .content {
        background-color: #fff;
    }

    .bg-soft {

        background-color: #fff !important;
    }
    </style>
    <script>
    var phoenixIsRTL = window.config.config.phoenixIsRTL;
    if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
    }
    </script>
</head>
<style>
.dropdown-toggle {
    border: 0;
    background: #fff;
}

h4 {
    float: left;
}
</style>

<body>


    <div class="content">

        <div class="row">
            <div class="col_12">
                <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1">
                <svg
                            class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="circle" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
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
                        <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Asset
                                Management</span><span
                                class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                        </h3>
                        <p class="mb-0">Find more cards which are dedicatedly made for E-commerce.</p>
                    </div>
                </div>
                <hr class="bg-200">
                <div class="row g-5 mb-5">
                    <div class="col-12 col-xl-8">
                        <div class="row align-items-center g-4">
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-danger fas fa-road fs-6"></span>
                                    <div class="ms-3">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h4 class="mb-0">Assets</h4>
                                        </button>
                                        <p class="text-800 fs--1 mb-0">Awating processing</p>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>

                                            <a class="dropdown-item" href="#">View List</a>

                                        </div>
                                        <div class="modal fade modal-xl" id="scrollingLong2" tabindex="-1"
                                            aria-labelledby="scrollingLongModalLabel2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="scrollingLongModalLabel2">
                                                            Modal title</h5>
                                                        <button class="btn p-1" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"><span
                                                                class="fas fa-times fs--1"></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3 mb-6">
                                                            <div class="col-sm-6 col-md-8">
                                                                <div class="form-floating">
                                                                    <input class="form-control" id="floatingInputGrid"
                                                                        type="text" placeholder="Project title">
                                                                    <label for="floatingInputGrid">Project
                                                                        title</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="floatingSelectTask">
                                                                        <option selected="selected">Select task
                                                                            view</option>
                                                                        <option value="1">technical</option>
                                                                        <option value="2">external</option>
                                                                        <option value="3">organizational
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectTask">Defult task
                                                                        view</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectPrivacy">
                                                                        <option selected="selected">Select
                                                                            privacy</option>
                                                                        <option value="1">Data Privacy One
                                                                        </option>
                                                                        <option value="2">Data Privacy Two
                                                                        </option>
                                                                        <option value="3">Data Privacy Three
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectPrivacy">Project
                                                                        privacy</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="floatingSelectTeam">
                                                                        <option selected="selected">Select team
                                                                        </option>
                                                                        <option value="1">Team One</option>
                                                                        <option value="2">Team Two</option>
                                                                        <option value="3">Team Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectTeam">Team
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectAssignees">
                                                                        <option selected="selected">Select
                                                                            assignees </option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectAssignees">People
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectAdmin">
                                                                        <option selected="selected">Select admin
                                                                        </option>
                                                                        <option value="1">Data Privacy One
                                                                        </option>
                                                                        <option value="2">Data Privacy Two
                                                                        </option>
                                                                        <option value="3">Data Privacy Three
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectAdmin">Project
                                                                        Lead</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="flatpickr-input-container">
                                                                    <div class="form-floating">
                                                                        <input
                                                                            class="form-control datetimepicker flatpickr-input"
                                                                            id="floatingInputStartDate" type="text"
                                                                            placeholder="end date"
                                                                            data-options="{&quot;disableMobile&quot;:true}"
                                                                            readonly="readonly">
                                                                        <label class="ps-6"
                                                                            for="floatingInputStartDate">Start
                                                                            date</label><span
                                                                            class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="flatpickr-input-container">
                                                                    <div class="form-floating">
                                                                        <input
                                                                            class="form-control datetimepicker flatpickr-input"
                                                                            id="floatingInputDeadline" type="text"
                                                                            placeholder="deadline"
                                                                            data-options="{&quot;disableMobile&quot;:true}"
                                                                            readonly="readonly">
                                                                        <label class="ps-6"
                                                                            for="floatingInputDeadline">Deadline</label><span
                                                                            class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control"
                                                                        id="floatingProjectOverview"
                                                                        placeholder="Leave a comment here"
                                                                        style="height: 100px"></textarea>
                                                                    <label for="floatingProjectOverview">project
                                                                        overview</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 gy-6">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectClient">
                                                                        <option selected="selected">Select
                                                                            client</option>
                                                                        <option value="1">Client One</option>
                                                                        <option value="2">Client Two</option>
                                                                        <option value="3">Client Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectClient">client</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 gy-6">
                                                                <div class="form-floating">
                                                                    <input class="form-control" id="floatingInputBudget"
                                                                        type="text" placeholder="Budget">
                                                                    <label for="floatingInputBudget">Budget</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="choices" data-type="select-multiple"
                                                                    role="combobox" aria-autocomplete="list"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <div class="choices__inner"><select
                                                                            class="form-select choices__input"
                                                                            id="organizerMultiple"
                                                                            data-choices="data-choices"
                                                                            multiple="multiple"
                                                                            data-options="{&quot;removeItemButton&quot;:true,&quot;placeholder&quot;:true}"
                                                                            hidden="" tabindex="-1"
                                                                            data-choice="active"></select>
                                                                        <div
                                                                            class="choices__list choices__list--multiple">
                                                                        </div><input type="text"
                                                                            class="choices__input choices__input--cloned"
                                                                            autocomplete="off" autocapitalize="off"
                                                                            spellcheck="false" role="textbox"
                                                                            aria-autocomplete="list"
                                                                            aria-label="Add tags" placeholder="Add tags"
                                                                            style="min-width: 9ch; width: 1ch;">
                                                                    </div>
                                                                    <div class="choices__list choices__list--dropdown"
                                                                        aria-expanded="false">
                                                                        <div class="choices__list"
                                                                            aria-multiselectable="true" role="listbox">
                                                                            <div id="choices--organizerMultiple-item-choice-2"
                                                                                class="choices__item choices__item--choice choices__item--selectable is-highlighted"
                                                                                role="option" data-choice="" data-id="2"
                                                                                data-value="Biology" data-select-text=""
                                                                                data-choice-selectable=""
                                                                                aria-selected="true">Biology
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-3"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="3"
                                                                                data-value="Brainlessness"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Brainlessness</div>
                                                                            <div id="choices--organizerMultiple-item-choice-4"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="4"
                                                                                data-value="Jerry" data-select-text=""
                                                                                data-choice-selectable="">Jerry
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-5"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="5"
                                                                                data-value="Neurology"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Neurology</div>
                                                                            <div id="choices--organizerMultiple-item-choice-6"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="6"
                                                                                data-value="Not_the_mouse"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Not_the_mouse</div>
                                                                            <div id="choices--organizerMultiple-item-choice-7"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="7"
                                                                                data-value="Rick" data-select-text=""
                                                                                data-choice-selectable="">Rick
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-8"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="8"
                                                                                data-value="Stupidity"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Stupidity</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="row g-3 justify-content-end">
                                                                    <div class="col-auto">
                                                                        <button
                                                                            class="btn btn-phoenix-primary px-5">Cancel</button>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button
                                                                            class="btn btn-primary px-5 px-sm-15">Create
                                                                            Project</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="button">Okay</button>
                                                        <button class="btn btn-outline-primary" type="button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fa-dice-d20 fs-6"></span>
                                    <div class="ms-3">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h4 class="mb-0">Amenities</h4>
                                        </button>
                                        <p class="text-800 fs--1 mb-0">Awating processing</p>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>

                                            <a class="dropdown-item" href="#">View List</a>

                                        </div>
                                        <div class="modal fade modal-xl" id="scrollingLong2" tabindex="-1"
                                            aria-labelledby="scrollingLongModalLabel2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="scrollingLongModalLabel2">
                                                            Modal title</h5>
                                                        <button class="btn p-1" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"><span
                                                                class="fas fa-times fs--1"></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3 mb-6">
                                                            <div class="col-sm-6 col-md-8">
                                                                <div class="form-floating">
                                                                    <input class="form-control" id="floatingInputGrid"
                                                                        type="text" placeholder="Project title">
                                                                    <label for="floatingInputGrid">Project
                                                                        title</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="floatingSelectTask">
                                                                        <option selected="selected">Select task
                                                                            view</option>
                                                                        <option value="1">technical</option>
                                                                        <option value="2">external</option>
                                                                        <option value="3">organizational
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectTask">Defult task
                                                                        view</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectPrivacy">
                                                                        <option selected="selected">Select
                                                                            privacy</option>
                                                                        <option value="1">Data Privacy One
                                                                        </option>
                                                                        <option value="2">Data Privacy Two
                                                                        </option>
                                                                        <option value="3">Data Privacy Three
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectPrivacy">Project
                                                                        privacy</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="floatingSelectTeam">
                                                                        <option selected="selected">Select team
                                                                        </option>
                                                                        <option value="1">Team One</option>
                                                                        <option value="2">Team Two</option>
                                                                        <option value="3">Team Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectTeam">Team
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectAssignees">
                                                                        <option selected="selected">Select
                                                                            assignees </option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectAssignees">People
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectAdmin">
                                                                        <option selected="selected">Select admin
                                                                        </option>
                                                                        <option value="1">Data Privacy One
                                                                        </option>
                                                                        <option value="2">Data Privacy Two
                                                                        </option>
                                                                        <option value="3">Data Privacy Three
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingSelectAdmin">Project
                                                                        Lead</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="flatpickr-input-container">
                                                                    <div class="form-floating">
                                                                        <input
                                                                            class="form-control datetimepicker flatpickr-input"
                                                                            id="floatingInputStartDate" type="text"
                                                                            placeholder="end date"
                                                                            data-options="{&quot;disableMobile&quot;:true}"
                                                                            readonly="readonly">
                                                                        <label class="ps-6"
                                                                            for="floatingInputStartDate">Start
                                                                            date</label><span
                                                                            class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="flatpickr-input-container">
                                                                    <div class="form-floating">
                                                                        <input
                                                                            class="form-control datetimepicker flatpickr-input"
                                                                            id="floatingInputDeadline" type="text"
                                                                            placeholder="deadline"
                                                                            data-options="{&quot;disableMobile&quot;:true}"
                                                                            readonly="readonly">
                                                                        <label class="ps-6"
                                                                            for="floatingInputDeadline">Deadline</label><span
                                                                            class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control"
                                                                        id="floatingProjectOverview"
                                                                        placeholder="Leave a comment here"
                                                                        style="height: 100px"></textarea>
                                                                    <label for="floatingProjectOverview">project
                                                                        overview</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 gy-6">
                                                                <div class="form-floating">
                                                                    <select class="form-select"
                                                                        id="floatingSelectClient">
                                                                        <option selected="selected">Select
                                                                            client</option>
                                                                        <option value="1">Client One</option>
                                                                        <option value="2">Client Two</option>
                                                                        <option value="3">Client Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectClient">client</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 gy-6">
                                                                <div class="form-floating">
                                                                    <input class="form-control" id="floatingInputBudget"
                                                                        type="text" placeholder="Budget">
                                                                    <label for="floatingInputBudget">Budget</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="choices" data-type="select-multiple"
                                                                    role="combobox" aria-autocomplete="list"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <div class="choices__inner"><select
                                                                            class="form-select choices__input"
                                                                            id="organizerMultiple"
                                                                            data-choices="data-choices"
                                                                            multiple="multiple"
                                                                            data-options="{&quot;removeItemButton&quot;:true,&quot;placeholder&quot;:true}"
                                                                            hidden="" tabindex="-1"
                                                                            data-choice="active"></select>
                                                                        <div
                                                                            class="choices__list choices__list--multiple">
                                                                        </div><input type="text"
                                                                            class="choices__input choices__input--cloned"
                                                                            autocomplete="off" autocapitalize="off"
                                                                            spellcheck="false" role="textbox"
                                                                            aria-autocomplete="list"
                                                                            aria-label="Add tags" placeholder="Add tags"
                                                                            style="min-width: 9ch; width: 1ch;">
                                                                    </div>
                                                                    <div class="choices__list choices__list--dropdown"
                                                                        aria-expanded="false">
                                                                        <div class="choices__list"
                                                                            aria-multiselectable="true" role="listbox">
                                                                            <div id="choices--organizerMultiple-item-choice-2"
                                                                                class="choices__item choices__item--choice choices__item--selectable is-highlighted"
                                                                                role="option" data-choice="" data-id="2"
                                                                                data-value="Biology" data-select-text=""
                                                                                data-choice-selectable=""
                                                                                aria-selected="true">Biology
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-3"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="3"
                                                                                data-value="Brainlessness"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Brainlessness</div>
                                                                            <div id="choices--organizerMultiple-item-choice-4"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="4"
                                                                                data-value="Jerry" data-select-text=""
                                                                                data-choice-selectable="">Jerry
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-5"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="5"
                                                                                data-value="Neurology"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Neurology</div>
                                                                            <div id="choices--organizerMultiple-item-choice-6"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="6"
                                                                                data-value="Not_the_mouse"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Not_the_mouse</div>
                                                                            <div id="choices--organizerMultiple-item-choice-7"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="7"
                                                                                data-value="Rick" data-select-text=""
                                                                                data-choice-selectable="">Rick
                                                                            </div>
                                                                            <div id="choices--organizerMultiple-item-choice-8"
                                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                                role="option" data-choice="" data-id="8"
                                                                                data-value="Stupidity"
                                                                                data-select-text=""
                                                                                data-choice-selectable="">
                                                                                Stupidity</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 gy-6">
                                                                <div class="row g-3 justify-content-end">
                                                                    <div class="col-auto">
                                                                        <button
                                                                            class="btn btn-phoenix-primary px-5">Cancel</button>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button
                                                                            class="btn btn-primary px-5 px-sm-15">Create
                                                                            Project</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="button">Okay</button>
                                                        <button class="btn btn-outline-primary" type="button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <hr class="bg-200">
                        </div>
                        <div class="row align-items-center g-4">
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-info far fa-circle fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Zone</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fab fa-buromobelexperte fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Region </h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fab fa-delicious fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Province</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fab fa-flipboard fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">District</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-danger fas fa-road fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Route</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fa-chart-area-d20 fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Section</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fa-layer-group fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Layer's</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-danger fab fa-unity fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Units</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fa-dice-d20 fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Media</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="d-flex align-items-center"><span
                                        class="text-success fas fa-dice-d20 fs-3"></span>
                                    <div class="ms-1">

                                        <button class="dropdown-toggle" id="disabledLinkExample" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h6 style="margin-top: 24%;" class="mb-0">Amenities</h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="disabledLinkExample">
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#scrollingLong2">Add New
                                                Asset</a>
                                            <a class="dropdown-item" href="#">View List</a>
                                        </div>
                                    </div>
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
                                            <div class="row gx-3">
                                                <h4 class="">Asset Update</h4>
                                                <hr class="bg-200">
                                                <div class="timeline-basic mb-9">
                                                    <div class="timeline-item">
                                                        <div class="row g-3">
                                                            <div class="col-auto">
                                                                <div class="timeline-item-bar position-relative">
                                                                    <div
                                                                        class="icon-item icon-item-md rounded-7 border">
                                                                        <svg class="svg-inline--fa fa-clipboard text-success fs--1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="fas" data-icon="clipboard"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 384 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M336 64h-53.88C268.9 26.8 233.7 0 192 0S115.1 26.8 101.9 64H48C21.5 64 0 85.48 0 112v352C0 490.5 21.5 512 48 512h288c26.5 0 48-21.48 48-48v-352C384 85.48 362.5 64 336 64zM192 64c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S160 113.7 160 96C160 78.33 174.3 64 192 64zM272 224h-160C103.2 224 96 216.8 96 208C96 199.2 103.2 192 112 192h160C280.8 192 288 199.2 288 208S280.8 224 272 224z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-solid fa-clipboard text-success fs--1"></span> Font Awesome fontawesome.com -->
                                                                    </div><span
                                                                        class="timeline-bar border-end border-dashed border-300"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex mb-2">
                                                                        <h6
                                                                            class="lh-sm mb-0 me-2 text-800 timeline-item-title">
                                                                            Upload Changes / Draft <br
                                                                                class="d-sm-none"> </h6>
                                                                    </div>
                                                                    <p
                                                                        class="text-500 fs--1 mb-0 text-nowrap timeline-time">
                                                                        <svg class="svg-inline--fa fa-clock me-1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="far" data-icon="clock"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-regular fa-clock me-1"></span> Font Awesome fontawesome.com -->4:33pm
                                                                    </p>
                                                                </div>
                                                                <h6 class="fs--2 fw-normal mb-3">From <a
                                                                        class="fw-semi-bold" href="#!"> DEO</a>
                                                                </h6>
                                                                <p class="fs--1 text-800 w-sm-60 mb-5"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item">
                                                        <div class="row g-3">
                                                            <div class="col-auto">
                                                                <div class="timeline-item-bar position-relative">
                                                                    <div
                                                                        class="icon-item icon-item-md rounded-7 border">
                                                                        <svg class="svg-inline--fa fa-envelope text-danger fs--1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="fas" data-icon="envelope"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-solid fa-envelope text-danger fs--1"></span> Font Awesome fontawesome.com -->
                                                                    </div><span
                                                                        class="timeline-bar border-end border-dashed border-300"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex mb-2">
                                                                        <h6
                                                                            class="lh-sm mb-0 me-2 text-800 timeline-item-title">
                                                                            Approval / <br class="d-sm-none">
                                                                            Verification</h6>
                                                                    </div>
                                                                    <p
                                                                        class="text-500 fs--1 mb-0 text-nowrap timeline-time">
                                                                        <svg class="svg-inline--fa fa-clock me-1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="far" data-icon="clock"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-regular fa-clock me-1"></span> Font Awesome fontawesome.com -->6:30pm
                                                                    </p>
                                                                </div>
                                                                <h6 class="fs--2 fw-normal mb-3">From <a
                                                                        class="fw-semi-bold" href="#!">
                                                                        M-Unit</a></h6>
                                                                <p class="fs--1 text-800 w-sm-60 mb-5"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item">
                                                        <div class="row g-3">
                                                            <div class="col-auto">
                                                                <div class="timeline-item-bar position-relative">
                                                                    <div
                                                                        class="icon-item icon-item-md rounded-7 border">
                                                                        <svg class="svg-inline--fa fa-video text-info fs--1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="fas" data-icon="video"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 576 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M384 112v288c0 26.51-21.49 48-48 48h-288c-26.51 0-48-21.49-48-48v-288c0-26.51 21.49-48 48-48h288C362.5 64 384 85.49 384 112zM576 127.5v256.9c0 25.5-29.17 40.39-50.39 25.79L416 334.7V177.3l109.6-75.56C546.9 87.13 576 102.1 576 127.5z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-solid fa-video text-info fs--1"></span> Font Awesome fontawesome.com -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex mb-2">
                                                                        <h6
                                                                            class="lh-sm mb-0 me-2 text-800 timeline-item-title">
                                                                            Summary</h6>
                                                                    </div>
                                                                    <p
                                                                        class="text-500 fs--1 mb-0 text-nowrap timeline-time">
                                                                        <svg class="svg-inline--fa fa-clock me-1"
                                                                            aria-hidden="true" focusable="false"
                                                                            data-prefix="far" data-icon="clock"
                                                                            role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                                            <path fill="currentColor"
                                                                                d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z">
                                                                            </path>
                                                                        </svg>
                                                                        <!-- <span class="fa-regular fa-clock me-1"></span> Font Awesome fontawesome.com -->9:33pm
                                                                    </p>
                                                                </div>
                                                                <h6 class="fs--2 fw-normal false"><a
                                                                        class="fw-semi-bold" href="#!">Head
                                                                        Office Reporting</a></h6>
                                                                <p class="fs--1 text-800 w-sm-60 mb-0"></p>
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
                    </div>
                </div>
            </div>

        </div>

    </div>



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../vendors/popper/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/anchorjs/anchor.min.js"></script>
    <script src="../vendors/is/is.min.js"></script>
    <script src="../vendors/fontawesome/all.min.js"></script>
    <script src="../vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../vendors/list.js/list.min.js"></script>
    <script src="../vendors/feather-icons/feather.min.js"></script>
    <script src="../vendors/dayjs/dayjs.min.js"></script>
    <script src="../vendors/choices/choices.min.js"></script>
    <script src="../vendors/echarts/echarts.min.js"></script>
    <script src="../vendors/dhtmlx-gantt/dhtmlxgantt.js"></script>
    <script src="../assets/js/phoenix.js"></script>
    <script src="../assets/js/projectmanagement-dashboard.js"></script>

</body>

</html>