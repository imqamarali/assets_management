<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<div class="widget-box" id="widget-box-1">
    <div class="d-flex" id="scrollspyEcommerce">
        <span class="fa-stack me-2 ms-n1">
            <!-- SVG Icons Here -->
        </span>
        <div class="col">
            <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Users</span>
                <span
                    class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
            </h3>
            <p class="mb-0">Managing Users</p>
        </div>
    </div>
    <hr class="bg-200">
    <div id="tableExample2">
        <div class="table-responsive">
            <?php if ($can['can_add'] == 1): ?>
            <button data-bs-toggle="modal" data-bs-target="#newItemModal" class="btn btn-outline-primary mt-2 mb-2"
                style="float: right" style="margin-left: 5px"> Add New<span
                    class="fas fa-angle-right ms-2 fs--2 text-center"></span></button>
            <?php endif; ?>
            <table class="table table-striped table-hover table-bordered table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th class="center">Sr #</th>
                        <th>Name</th>
                        <th>Job Description</th>
                        <th>User Type</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $key => $item): ?>


                    <!-- $employee = "SELECT id, name, pic, sodowo, cnic, email, address, country,
                    city, zip, job_discription, department, designation, username, password,
                    log_status, status, eobi, social, usertype, salecenter, user_id, create_date,
                    emis_id, gender, resign, resign_remarks, resign_date, resign_attachment, cadre,
                    scnic, user_level, doj, mobile, emp_code, passport_no, emg_no1, emg_no2, b_group,
                    religion, m_status, dob, permenant_address, topadmin, nok_name, nok_relation,
                    nok_phone, date_of_appointegerment, service_no, prob_start, prob_end,
                    expiry_of_contract, bank_name, account_title, account_number, branch, whatsapp_no, desk_id
                    FROM public.employee;"; -->
                    <tr class="menu-item" data-id="<?php echo $item['id']; ?>">
                        <td class="center"><?php echo $key + 1; ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['job_discription']); ?></td>
                        <td><?php echo htmlspecialchars($item['usertype']); ?></td>
                        <td><?php echo htmlspecialchars($item['username']); ?></td>
                        <td><?php echo htmlspecialchars($item['password']); ?></td>
                        <td>

                            <?php if ($can['can_view'] == 1): ?>
                            <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                <a class="green" href="#"
                                    onclick=" update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                    <i class="ace-icon fa fa-eye bigger-130"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if ($can['can_edit'] == 1): ?>
                            <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                <a class="green" data-bs-toggle="modal" data-bs-target="#newItem"
                                    onclick="update(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if ($can['can_delete'] == 1): ?>
                            <div class="hidden-sm hidden-xs action-buttons" style="display: inline-flex; gap: 10px;">
                                <form id="deleteForm_<?php echo $item['id']; ?>" action="index.php?r=users/userslist"
                                    method="POST" style="display: inline;">
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
<script>
function confirmDelete(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById('deleteForm_' + itemId).submit();
    }
}

function update(item) {
    // Populate hidden and input fields
    document.getElementById('modalId').value = item.id;
    document.getElementById('modalname').value = item.name || '';
    document.getElementById('modalsodowo').value = item.sodowo || '';
    document.getElementById('modalcnic').value = item.cnic || '';
    document.getElementById('modalemail').value = item.email || '';
    document.getElementById('modalmobile').value = item.mobile || '';
    document.getElementById('modalzip').value = item.zip || '';
    document.getElementById('modaldepartment').value = item.department || '';
    document.getElementById('modaltype').value = item.type || '';
    document.getElementById('modalcountry').value = item.country || '';
    document.getElementById('modalrole').value = item.user_level || '';
    document.getElementById('modalmeritalstatus').value = item.merital_status || '';
    document.getElementById('modalgender').value = item.gender || '';
    document.getElementById('modaldateofbirth').value = item.dob || '';
    document.getElementById('modalbloodgroup').value = item.b_group || '';
    document.getElementById('modalreligion').value = item.religion || '';
    document.getElementById('modalpassport').value = item.passport || '';
    document.getElementById('modaldiscription').value = item.job_discription || '';
    document.getElementById('modaladdress').value = item.address || '';
    document.getElementById('modalusername').value = item.username || '';
    document.getElementById('modalpassword').value = item.password || '';

    // Show the modal
    new bootstrap.Modal(document.getElementById('newItemModal')).show();
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
                <form class="row g-3 mb-6" method="post" action="index.php?r=users/userslist">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="save_record" value="save_record" />
                    <input type="hidden" name="id" id="modalId" value="" />

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalname" name="name" type="text" placeholder="Name"
                                required>
                            <label for="modalname">Name <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalsodowo" name="sodowo" type="text"
                                placeholder="Father/Spouse's Name" required>
                            <label for="modalsodowo">Father/Spouse's Name <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalcnic" name="cnic" type="text" placeholder="CNIC"
                                required>
                            <label for="modalcnic">CNIC <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalemail" name="email" type="text" placeholder="Email"
                                required>
                            <label for="modalemail">Email <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalmobile" name="mobile" type="text"
                                placeholder="Mobile No" required>
                            <label for="modalmobile">Mobile No <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalzip" name="zip" type="text" placeholder="Zip" required>
                            <label for="modalzip">Zip <span style="color:red">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modaldepartment" name="department" type="text"
                                placeholder="Department" required>
                            <label for="modaldepartment">Department <span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="type" id="modaltype">
                                <option value="">Select Type</option>
                                <option value="1">Admin</option>
                                <option value="2">Non Admin</option>
                            </select>
                            <label for="modaltype">Status<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="country" id="modalcountry" required>
                                <option value="">Select a Country</option>
                                <option value="1">PAKISTAN</option>
                                <option value="2">SAUDIA ARABIA</option>
                                <option value="3">SPAIN</option>
                                <option value="4">ENGLAND </option>
                                <option value="5">Punjab</option>
                            </select>
                            <label for="modalcountry">Country<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="user_level" id="modalrole" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $item): ?>
                                <option value="<?= $item['role_id'] ?>"><?= $item['role_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="modalrole">Role<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="merital_status" id="modalmeritalstatus">
                                <option value="">Select a Marital Status</option>
                                <option value="1">Married</option>
                                <option value="2">Unmarried</option>
                            </select>
                            <label for="modalmeritalstatus">Marital Status<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="gender" id="modalgender">
                                <option value="">Select a Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <label for="modalgender">Marital Status<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="flatpickr-input-container">
                            <div class="form-floating">
                                <input class="form-control datetimepicker flatpickr-input" id="modaldateofbirth"
                                    name="dob" type="text" placeholder="BOB"
                                    data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                                <label class="ps-6" for="modaldateofbirth">DOB</label><span
                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalbloodgroup" name="bloodgroup" type="text"
                                placeholder="Blood Group" required>
                            <label for="modalbloodgroup">Blood Group<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalreligion" name="religion" type="text"
                                placeholder="Religion" required>
                            <label for="modalreligion">Religion<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="modalpassport" name="passport" type="text"
                                placeholder="Passport Number">
                            <label for="modalpassport">Passport Number<span style="color:red">*</span></label>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-sm-6 col-md-12">
                        <div class="form-floating">
                            <input class="form-control" id="modaldiscription" name="discription" type="text"
                                placeholder="Job Discription">
                            <label for="modaldiscription">Job Discription</label>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-sm-6 col-md-12 ">
                        <div class="form-floating">
                            <input class="form-control" id="modaladdress" name="address" type="text"
                                placeholder="Address">
                            <label for="modaladdress">Address</label>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalusername" name="username" type="text"
                                placeholder="Username" required>
                            <label for="modalusername">Username<span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="modalpassword" name="password" type="password"
                                placeholder="Password" required>
                            <label for="modalpassword">Password<span style="color:red">*</span></label>
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