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
                            <h2 class="page-title"><?= $schedule['name'] ?> | Add/Update</h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?=site_url('gradebook')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="<?=site_url('gradebook')?>" class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <i class="ti ti-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="ti ti-list"></i>&nbsp;List of Students
                            </div>
                            <form method="POST" class="row g-3" id="form">
                                <?= csrf_field() ?>
                                <input type="hidden" name="year" value="<?= $schedule['school_year'] ?>">
                                <input type="hidden" name="semester" value="<?= $schedule['semester'] ?>">
                                <input type="hidden" name="subject" value="<?= $schedule['subject_id'] ?>">
                                <input type="hidden" name="schedule" value="<?= $schedule['schedule_id'] ?>">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table">
                                            <thead>
                                                <th>#</th>
                                                <th>School ID</th>
                                                <th>Fullname</th>
                                                <th>Course</th>
                                                <th>Year & Section</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($students as $row): ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="student[]"
                                                            style="width:20px;height:20px;"
                                                            value="<?= $row->student_id ?>" checked />
                                                    </td>
                                                    <td><?= $row->school_id ?></td>
                                                    <td><?= $row->fullname ?></td>
                                                    <td><?= $row->course ?></td>
                                                    <td><?= $row->year ?> - <?= $row->section ?></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="total[]" min="0"
                                                            max="100" value="<?= $row->total ?>" />
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
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
    $('#table').DataTable();
    $('#form').submit(function(e) {
        e.preventDefault();
        $('.error-message').html('');
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        let data = $(this).serialize();
        $.ajax({
            url: "<?= site_url('gradebook/grades/save') ?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Submit'
                );
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: 'Grades has been saved successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?=site_url('gradebook')?>";
                        }
                    });
                } else {
                    var errors = response.errors;
                    Swal.fire({
                        title: "Errors",
                        text: response.errors.total,
                        icon: "warning"
                    });
                }
            }
        });
    });
    </script>
</body>

</html>