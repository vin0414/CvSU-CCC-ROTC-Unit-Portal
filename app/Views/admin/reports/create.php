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
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-3">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Create Report</div>
                                    <form method="POST" class="row g-2" id="form">
                                        <?= csrf_field() ?>
                                        <div class="col-lg-12">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title">
                                            <div id="title-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select" name="category">
                                                        <option value="">Choose</option>
                                                        <option value="Attire">Attire</option>
                                                        <option value="Attire">Attitude</option>
                                                        <option value="Appearance">Appearance</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <div id="category-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="form-label">Type of Report</label>
                                                    <select class="form-select" name="report">
                                                        <option value="">Choose</option>
                                                        <option value="Merits">Merits</option>
                                                        <option value="Demerits">Demerits</option>
                                                        <option value="Violations">Violations</option>
                                                    </select>
                                                    <div id="report-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Student Name</label>
                                                    <select class="form-select" name="student">
                                                        <option value="">Choose</option>
                                                        <?php foreach($student as $row): ?>
                                                        <option value="<?= $row['student_id'] ?>">
                                                            <?= $row['lastname'] ?>,&nbsp;<?= $row['firstname'] ?>&nbsp;<?= $row['middlename'] ?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <div id="student-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Details</label>
                                            <textarea name="details" class="form-control"
                                                style="height: 200px;"></textarea>
                                            <div id="details-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary" id="btnSave">
                                                <i class="ti ti-device-floppy"></i>&nbsp;Submit
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
    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        $.ajax({
            url: "<?=site_url('report/save')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Submit'
                );
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
                            $('#form')[0].reset();
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