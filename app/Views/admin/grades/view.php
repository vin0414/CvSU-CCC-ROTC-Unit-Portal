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
                            <h2 class="page-title"><?=$schedule['name'] ?></h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <button type="button" class="btn btn-default upload">
                                    <i class="ti ti-upload"></i>&nbsp;Upload Files
                                </button>
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
                        <div class="card-header">
                            <div class="card-title">
                                <i class="ti ti-clipboard"></i>&nbsp;<?= $schedule['code'] ?> - <?= $schedule['name'] ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-list"></i>&nbsp;Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-files-8" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-files"></i>&nbsp;Files
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <br />
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control"><?= $schedule['details'] ?></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-3">
                                                    <label class="form-label">Day of the Month</label>
                                                    <p class="form-control"><?= $schedule['day'] ?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">From</label>
                                                    <p class="form-control">
                                                        <?= date('h:i:s a',strtotime($schedule['from_time'])) ?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">To</label>
                                                    <p class="form-control">
                                                        <?= date('h:i:s a',strtotime($schedule['to_time'])) ?></p>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label class="form-label">Assigned Officer</label>
                                                    <p class="form-control"><?= $account['fullname'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="table">
                                                    <thead>
                                                        <th>School ID</th>
                                                        <th>Fullname</th>
                                                        <th>Course</th>
                                                        <th>Year & Section</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($students as $row): ?>
                                                        <tr>
                                                            <td><?= $row->school_id ?></td>
                                                            <td><?= $row->lastname ?>,&nbsp;<?= $row->firstname ?>&nbsp;<?= $row->middlename ?>
                                                            </td>
                                                            <td><?= $row->course ?></td>
                                                            <td><?= $row->year ?> - <?= $row->section ?></td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-files-8">
                                    <br />
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="files">
                                            <thead>
                                                <th>Files</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($files as $row): ?>
                                                <tr>
                                                    <td><?= $row['filename'] ?></td>
                                                    <td><a href="<?= base_url('assets/attachment/') ?><?= $row['filename'] ?>"
                                                            target="_blank" class="btn btn-primary btn-sm">Download</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BODY -->
        </div>
    </div>

    <div class="modal modal-blur fade" id="uploadModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Upload Files</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="form" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="schedule" value="<?= $schedule['schedule_id'] ?>">
                        <div class="col-lg-12">
                            <label class="form-label">Attach File</label>
                            <input type="file" name="file" class="form-control"
                                accept=".pdf,.zip,.doc,.docx,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="btnUpload">
                                <i class="ti ti-upload"></i>&nbsp;Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
    $('#files').DataTable();
    $(document).on('click', '.upload', function() {
        $('#uploadModal').modal('show');
    });
    $('#form').on('submit', function(e) {
        e.preventDefault();
        $('#btnUpload').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Uploading...'
        );
        let data = $(this).serialize();
        $.ajax({
            url: "<?=site_url('grades/file/upload')?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#btnUpload').attr('disabled', false).html(
                    '<span class="ti ti-upload"></span>&nbsp;Upload'
                );
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully uploaded and saved",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            $('#uploadModal').modal('hide');
                            location.reload();
                        }
                    });
                } else {
                    var errors = response.errors;
                    console.log(response.errors);
                    Swal.fire({
                        title: "Error!",
                        text: errors.file,
                        icon: "warning"
                    });
                }
            }
        });
    });
    </script>
</body>

</html>