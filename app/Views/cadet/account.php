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
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Basic Information</div>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-8">
                                                    <label class="form-label">Complete Name</label>
                                                    <p class="form-control"><?= session()->get('fullname') ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Student No</label>
                                                    <p class="form-control"><?=session()->get('student_number')?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-4">
                                                    <label class="form-label">School Year</label>
                                                    <p class="form-control"><?= $account['school_year'] ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Email Address</label>
                                                    <p class="form-control"><?= $account['email'] ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Student Status</label>
                                                    <p class="form-control">
                                                        <?= ($account['is_enroll']) ? 'ENROLLED' : 'N/A' ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Security Token</label>
                                            <p class="form-control"><?= $account['token'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Security</div>
                                    <form method="POST" class="row g-3" id="frmPassword">
                                        <?= csrf_field() ?>
                                        <div class="col-lg-12">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="current_password"
                                                name="current" minlength="8" maxlength="16" />
                                            <div id="current-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" minlength="8" maxlength="16" />
                                            <div id="new_password-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div cs="col-lg-12">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="cpassword"
                                                name="confirm_password" minlength="8" maxlength="16" />
                                            <div id="confirm_password-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="checkbox" class="form-check-input" id="showPassword" />
                                            &nbsp;<label>Show Password</label>
                                        </div>
                                        <div cs="col-lg-12">
                                            <button type="submit" class="btn btn-primary form-control">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BODY -->
        </div>
    </div>
    <?=view('cadet/templates/footer') ?>
    <script>
    $('#showPassword').change(function() {
        var x = document.getElementById("current_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        //new password
        var xx = document.getElementById("new_password");
        if (xx.type === "password") {
            xx.type = "text";
        } else {
            xx.type = "password";
        }
        //new password
        var xxx = document.getElementById("cpassword");
        if (xxx.type === "password") {
            xxx.type = "text";
        } else {
            xxx.type = "password";
        }
    });

    $('#frmPassword').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $.ajax({
            url: "<?=site_url('password/change')?>",
            method: "POST",
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#frmPassword')[0].reset();
                    Swal.fire({
                        title: "Great!",
                        text: "Successfully applied changes",
                        icon: "success"
                    });
                } else {
                    var errors = response.error;
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