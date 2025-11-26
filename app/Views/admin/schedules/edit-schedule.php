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
                                <a href="<?=site_url('schedules/manage')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="<?=site_url('schedules/manage')?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <i class="ti ti-arrow-left"></i>
                                </a>
                            </div>
                            <!-- BEGIN MODAL -->
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
                            <div class="card-title"><i class="ti ti-edit"></i>&nbsp;Edit</div>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="row g-3" id="frmCreate">
                                <?=csrf_field()?>
                                <?php
                                $startYear = date('Y');
                                $numberOfSemesters = 5;

                                $semesters = [];
                                for ($i = 0; $i < $numberOfSemesters; $i++) {
                                    $from = $startYear + $i;
                                    $to = $from + 1;
                                    $semesters[] = "$from-$to";
                                }
                                ?>
                                <input type="hidden" name="id" value="<?=$schedule['schedule_id']?>" />
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <label class="form-label">School Year</label>
                                            <select name="school_year" class="form-select">
                                                <option value="">Choose</option>
                                                <?php foreach ($semesters as $semester): ?>
                                                <option value="<?= $semester ?>"
                                                    <?=!empty($schedule['school_year']==$semester) ? 'selected': ''?>>
                                                    <?= $semester ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div id="school_year-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Semester</label>
                                            <input type="text" class="form-control" name="semester"
                                                placeholder="Enter here" value="<?=$schedule['semester']?>">
                                            <div id="semester-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Name/Title</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Name or Title" value="<?=$schedule['name']?>">
                                            <div id="name-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Code</label>
                                            <input type="text" class="form-control" name="code" placeholder="Enter here"
                                                value="<?=$schedule['code']?>">
                                            <div id="code-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Day of the Month</label>
                                            <input type="text" class="form-control" name="day" placeholder="Enter here"
                                                value="<?=$schedule['day']?>">
                                            <div id="day-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <label class="form-label">From</label>
                                            <input type="date" class="form-control" name="from_date"
                                                value="<?=$schedule['from_date']?>">
                                            <div id="from_date-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Time</label>
                                            <input type="time" class="form-control" name="from_time"
                                                value="<?=$schedule['from_time']?>">
                                            <div id="from_time-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">To</label>
                                            <input type="date" class="form-control" name="to_date"
                                                value="<?=$schedule['to_date']?>">
                                            <div id="to_date-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Time</label>
                                            <input type="time" class="form-control" name="to_time"
                                                value="<?=$schedule['to_time']?>">
                                            <div id="to_time-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Details</label>
                                    <textarea name="details" class="form-control"
                                        style="height:150px;"><?=$schedule['details']?></textarea>
                                    <div id="details-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">Choose</option>
                                        <option value="1">Active</option>
                                        <option value="0">Archive</option>
                                    </select>
                                    <div id="status-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary" id="btnSave">
                                        <i class="ti ti-device-floppy"></i>&nbsp;Save Changes
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
    $('#frmCreate').on('submit', function(e) {
        e.preventDefault();
        $('.error-message').html('');
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        let data = $(this).serialize();
        $.ajax({
            url: "<?=site_url('plans/update')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Save Changes'
                );
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: 'Successfully applied changes!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?=site_url('schedules/manage')?>";
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