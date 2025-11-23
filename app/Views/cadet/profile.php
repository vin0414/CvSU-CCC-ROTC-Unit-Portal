<?=view('cadet/templates/header') ?>

<body>
    <div class="page">
        <!-- BEGIN GLOBAL THEME SCRIPT -->
        <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
        <!-- END GLOBAL THEME SCRIPT -->
        <!-- BEGIN NAVBAR  -->
        <?=view('cadet/templates/navbar') ?>
        <!-- END NAVBAR  -->
        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title"><?=$title?></h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <button type="button" class="btn btn-default" id="btnDownload">
                                    <i class="ti ti-download"></i>
                                </button>
                                <a href="<?=site_url('cadet/qr-code')?>" class="btn btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M7 17l0 .01" />
                                        <path
                                            d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M7 7l0 .01" />
                                        <path
                                            d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M17 7l0 .01" />
                                        <path d="M14 14l3 0" />
                                        <path d="M20 14l0 .01" />
                                        <path d="M14 14l0 3" />
                                        <path d="M14 20l3 0" />
                                        <path d="M17 17l3 0" />
                                        <path d="M20 17l0 3" />
                                    </svg>
                                    QR Code
                                </a>
                                <a href="<?=site_url('cadet/upload')?>"
                                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-up">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 18.004h-5.343c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.38 0 2.57 .811 3.128 1.986" />
                                        <path d="M19 22v-6" />
                                        <path d="M22 19l-3 -3l-3 3" />
                                    </svg>
                                    Upload
                                </a>
                                <a href="<?=site_url('cadet/upload')?>"
                                    class="btn btn-primary btn-6 d-sm-none btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-up">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 18.004h-5.343c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.38 0 2.57 .811 3.128 1.986" />
                                        <path d="M19 22v-6" />
                                        <path d="M22 19l-3 -3l-3 3" />
                                    </svg>
                                </a>
                            </div>
                            <!-- BEGIN MODAL -->
                            <!-- END MODAL -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-square-rounded">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                    <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                                </svg>
                                My Profile
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="row g-2" enctype="multipart/form-data" id="frmProfile">
                                <?=csrf_field()?>
                                <input type="hidden" name="cadet_id" value="<?=$cadet['cadet_id'] ?? '' ?>" />
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <label class="form-label">First name</label>
                                            <p class="form-control"><?= $student['firstname'] ?></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">M.I.</label>
                                            <p class="form-control"><?= $student['middlename'] ?></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Last name</label>
                                            <p class="form-control"><?= $student['lastname'] ?></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Student No</label>
                                            <p class="form-control"><?= $student['school_id'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-2">
                                            <label class="form-label">Birth Date</label>
                                            <input type="date" class="form-control" name="birth_date"
                                                value="<?=$cadet['birthdate'] ?? '' ?>">
                                            <div id="birth_date-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Height</label>
                                            <input type="text" class="form-control" name="height"
                                                value="<?=$cadet['height'] ?? '' ?>">
                                            <div id="height-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Weight</label>
                                            <input type="text" class="form-control" name="weight"
                                                value="<?=$cadet['weight'] ?? '' ?>">
                                            <div id="weight-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Blood Type</label>
                                            <input type="text" class="form-control" name="blood_type"
                                                value="<?=$cadet['blood_type'] ?? '' ?>">
                                            <div id="blood_type-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Gender</label>
                                            <select class="form-select" name="gender">
                                                <option value="">Choose</option>
                                                <option
                                                    <?= (!empty($cadet['gender']) && $cadet['gender'] === "Male") ? 'selected' : '' ?>>
                                                    Male
                                                </option>
                                                <option
                                                    <?= (!empty($cadet['gender']) && $cadet['gender'] === "Female") ? 'selected' : '' ?>>
                                                    Female
                                                </option>
                                            </select>
                                            <div id="gender-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Religion</label>
                                            <select class="form-select" name="religion">
                                                <option value="">Choose</option>
                                                <option
                                                    <?= (!empty($cadet['religion']) && $cadet['religion'] === "Catholic") ? 'selected' : '' ?>>
                                                    Catholic</option>
                                                <option
                                                    <?= (!empty($cadet['religion']) && $cadet['religion'] === "Christians") ? 'selected' : '' ?>>
                                                    Christians</option>
                                                <option
                                                    <?= (!empty($cadet['religion']) && $cadet['religion'] === "Protestante") ? 'selected' : '' ?>>
                                                    Protestante</option>
                                                <option
                                                    <?= (!empty($cadet['religion']) && $cadet['religion'] === "Iglesia Ni Kristo") ? 'selected' : '' ?>>
                                                    Iglesia Ni Kristo</option>
                                                <option
                                                    <?= (!empty($cadet['religion']) && $cadet['religion'] === "Others") ? 'selected' : '' ?>>
                                                    Others</option>
                                            </select>
                                            <div id="religion-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-3">
                                            <label class="form-label">House No</label>
                                            <input type="text" class="form-control" name="house_no"
                                                value="<?=$cadet['house_no'] ?? '' ?>">
                                            <div id="house_no-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Street</label>
                                            <input type="text" class="form-control" name="street"
                                                value="<?=$cadet['street'] ?? '' ?>">
                                            <div id="street-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Village/Subdivision</label>
                                            <input type="text" class="form-control" name="village"
                                                value="<?=$cadet['village'] ?? '' ?>">
                                            <div id="village-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Municipality</label>
                                            <input type="text" class="form-control" name="municipality"
                                                value="<?=$cadet['municipality'] ?? '' ?>">
                                            <div id="municipality-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Province</label>
                                            <input type="text" class="form-control" name="province"
                                                value="<?=$cadet['province'] ?? '' ?>">
                                            <div id="province-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Course</label>
                                            <input type="text" class="form-control" name="course"
                                                value="<?=$cadet['course'] ?? '' ?>">
                                            <div id="course-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-control" name="year"
                                                value="<?=$cadet['year'] ?? '' ?>">
                                            <div id="year-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Section</label>
                                            <input type="text" class="form-control" name="section"
                                                value="<?=$cadet['section'] ?? '' ?>">
                                            <div id="section-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">School Attended</label>
                                    <textarea name="school"
                                        class="form-control"><?=$cadet['school_attended'] ?? '' ?></textarea>
                                    <div id="school-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <label class="form-label">Contact No</label>
                                            <input type="phone" class="form-control" name="contact_no"
                                                value="<?=$cadet['contact_no'] ?? '' ?>">
                                            <div id="contact_no-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Facebook Account</label>
                                            <input type="text" class="form-control" name="fb_account"
                                                value="<?=$cadet['fb_account'] ?? '' ?>">
                                            <div id="fb_account-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email"
                                                value="<?=$cadet['email'] ?? '' ?>">
                                            <div id="email-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                    <div class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                        Other Informations
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-2">
                                            <label>Mother's Surname</label>
                                            <input type="text" class="form-control" name="m_surname"
                                                value="<?=$cadet['mother_sname'] ?? '' ?>">
                                            <div id="m_surname-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Mother's First Name</label>
                                            <input type="text" class="form-control" name="m_firstname"
                                                value="<?=$cadet['mother_fname'] ?? '' ?>">
                                            <div id="m_firstname-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Mother's Middlename</label>
                                            <input type="text" class="form-control" name="m_middlename"
                                                value="<?=$cadet['mother_mname'] ?? '' ?>">
                                            <div id="m_middlename-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Contact No</label>
                                            <input type="phone" class="form-control" name="m_contact_no"
                                                value="<?=$cadet['mother_contact'] ?? '' ?>">
                                            <div id="m_contact_no-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control" name="m_occupation"
                                                value="<?=$cadet['mother_work'] ?? '' ?>">
                                            <div id="m_occupation-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-2">
                                        <div class="col-lg-2">
                                            <label>Father's Surname</label>
                                            <input type="text" class="form-control" name="f_surname"
                                                value="<?=$cadet['father_sname'] ?? '' ?>">
                                            <div id="f_surname-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Father's First Name</label>
                                            <input type="text" class="form-control" name="f_firstname"
                                                value="<?=$cadet['father_fname'] ?? '' ?>">
                                            <div id="f_firstname-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Father's Middlename</label>
                                            <input type="text" class="form-control" name="f_middlename"
                                                value="<?=$cadet['father_mname'] ?? '' ?>">
                                            <div id="f_middlename-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Contact No</label>
                                            <input type="phone" class="form-control" name="f_contact_no"
                                                value="<?=$cadet['father_contact'] ?? '' ?>">
                                            <div id="f_contact_no-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control" name="f_occupation"
                                                value="<?=$cadet['father_work'] ?? '' ?>">
                                            <div id="f_occupation-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                    <div class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                                            <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M19.001 15.5v1.5" />
                                            <path d="M19.001 21v1.5" />
                                            <path d="M22.032 17.25l-1.299 .75" />
                                            <path d="M17.27 20l-1.3 .75" />
                                            <path d="M15.97 17.25l1.3 .75" />
                                            <path d="M20.733 20l1.3 .75" />
                                        </svg>
                                        Emergency
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="contact_firstname"
                                                value="<?=$cadet['contact_firstname'] ?? '' ?>">
                                            <div id="contact_firstname-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" name="contact_middlename"
                                                value="<?=$cadet['contact_middlename'] ?? '' ?>">
                                            <div id="contact_middlename-error"
                                                class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" name="contact_lastname"
                                                value="<?=$cadet['contact_lastname'] ?? '' ?>">
                                            <div id="contact_lastname-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Complete Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="<?=$cadet['emergency_address'] ?? '' ?>">
                                            <div id="address-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Relationship</label>
                                            <input type="text" class="form-control" name="relationship"
                                                value="<?=$cadet['relationship'] ?? '' ?>">
                                            <div id="relationship-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Contact No</label>
                                            <input type="text" class="form-control" name="contact_number"
                                                value="<?=$cadet['emergency_number'] ?? '' ?>" minlength="11"
                                                maxlength="11">
                                            <div id="contact_number-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p>
                                        <small>Upload supported documents. Accepted file types: zip, and
                                            pdf(25MB limit).
                                        </small>
                                    </p>
                                    <input type="file" name="file" class="form-control"
                                        accept=".zip,application/zip,application/pdf" />
                                    <div id="file-error" class="error-message text-danger text-sm">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary" id="btnSave">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        <?= !empty($cadet['cadet_id']) ? 'Save Changes' : 'Save Data' ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BODY -->
        </div>
    </div>
    <div class="modal" id="modal-loading" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <dotlottie-wc src="https://lottie.host/ed13f8d5-bc3f-4786-bbb8-36d06a21a6cb/XMPpTra572.lottie"
                            style="width: 100%;height: auto;" autoplay loop></dotlottie-wc>
                    </div>
                    <div>Loading</div>
                </div>
            </div>
        </div>
    </div>
    <?=view('cadet/templates/footer') ?>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <script>
    $('#frmProfile').on('submit', function(e) {
        e.preventDefault();
        $('.error-message').html('');
        let data = $(this).serialize();
        $('#modal-loading').modal('show');
        $.ajax({
            url: "<?=site_url('save-profile')?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#modal-loading').modal('hide');
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully saved",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            location.reload();
                        }
                    });
                } else {
                    var errors = response.errors;
                    // Iterate over each error and display it under the corresponding input field
                    for (var field in errors) {
                        $('#' + field + '-error').html('<p>' + errors[field] +
                            '</p>'); // Show the first error message
                        $('#' + field).addClass(
                            'text-danger'); // Highlight the input field with an error
                    }
                }
            }
        });
    });
    </script>
</body>

</html>