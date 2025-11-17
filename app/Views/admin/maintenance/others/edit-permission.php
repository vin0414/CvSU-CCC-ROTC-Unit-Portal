<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <title>CvSU-CCC ROTC Unit Portal</title>
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/demo.min.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
    <style>
    @import url("https://rsms.me/inter/inter.css");
    </style>
</head>

<body>
    <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
    <div class="page">
        <!--  BEGIN SIDEBAR  -->
        <?= view('admin/templates/sidebar')?>
        <!--  END SIDEBAR  -->
        <!-- BEGIN NAVBAR  -->
        <?= view('admin/templates/header')?>
        <!-- END NAVBAR  -->
        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">CvSU-CCC ROTC Unit Portal</div>
                            <h2 class="page-title"><?=$title?></h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?=site_url('maintenance/settings')?>" class="btn btn-primary">
                                    <i class="ti ti-arrow-left"></i> Back
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
                    <div class="row g-3">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title"><i class="ti ti-edit"></i>&nbsp;<?=$title?></div>
                                    <form method="POST" class="row g-3" id="frmEdit">
                                        <?=csrf_field()?>
                                        <input type="hidden" name="id" value="<?=$permission['role_id']?>" />
                                        <div class="col-lg-12">
                                            <label class="form-label">Role Name</label>
                                            <input type="text" class="form-control" name="role"
                                                value="<?=$permission['role_name']?>" placeholder="Enter here">
                                            <div id="role-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <label class="form-label">Cadet Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="cadet" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="cadet" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="cadet-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Schedules Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="schedule" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="schedule" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="schedule-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Attendance Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="attendance" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="attendance" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="attendance-error"
                                                        class="error-message text-danger text-sm"></div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Gradebook Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="grade" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="grade" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="grade-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Inventory Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="inventory" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="inventory" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="inventory-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Reports Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="report" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="report" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="report-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Announcement Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="announcement" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="announcement" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="announcement-error"
                                                        class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Maintenance Module</label>
                                                    <div class="form-selectgroup-boxes row mb-3">
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="maintenance" value="1"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">Yes</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="maintenance" value="0"
                                                                    class="form-selectgroup-input" />
                                                                <span
                                                                    class="form-selectgroup-label d-flex align-items-center p-3">
                                                                    <span class="me-3">
                                                                        <span class="form-selectgroup-check"></span>
                                                                    </span>
                                                                    <span class="form-selectgroup-label-content">
                                                                        <span
                                                                            class="form-selectgroup-title strong mb-1">No</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="maintenance-error"
                                                        class="error-message text-danger text-sm"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary" id="btnCreate">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BODY -->
            <!--  BEGIN FOOTER  -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; <?= date('Y')?>
                                    <a href="." class="link-secondary">CvSU-CCC ROTC Unit Portal</a>. All rights
                                    reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="link-secondary" rel="noopener"> v1.1.1 </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!--  END FOOTER  -->
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url('assets/js/tabler.min.js')?>" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="<?=base_url('assets/js/demo.min.js')?>" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $('#frmEdit').on('submit', function(e) {
        e.preventDefault();
        $('.error-message').html('');
        let data = $(this).serialize();
        $.ajax({
            url: "<?=site_url('edit-permission')?>",
            method: "POST",
            data: data,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully saved changes",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            location.href = "<?=base_url('maintenance/settings')?>";
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