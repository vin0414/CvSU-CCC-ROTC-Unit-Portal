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
                                <a href="<?=site_url('schedules/create')?>" class="btn btn-default">
                                    <i class="ti ti-plus"></i>&nbsp;Add
                                </a>
                                <a href="<?=site_url('schedules')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="<?=site_url('schedules')?>" class="btn btn-success btn-6 d-sm-none btn-icon">
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
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M4 13h3l3 3h4l3 -3h3" />
                                        </svg>
                                        Manage
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-user">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 21h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" />
                                        </svg>
                                        Assignment
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table">
                                            <thead>
                                                <th>Semester</th>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>More</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-activity-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tblassign">
                                            <thead>
                                                <th>Date</th>
                                                <th>Title</th>
                                                <th>Details</th>
                                                <th>Officer</th>
                                                <th>More</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
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

    <div class="modal modal-blur" id="modal-loading" data-bs-backdrop="static">
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

    <div class="modal modal-blur fade" id="assignModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Assign Officer</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="assignID" id="assignID" />
                        <div class="col-lg-12">
                            <label class="form-label">Account</label>
                            <select class="form-select" name="account">
                                <option value="">Choose</option>
                                <?php foreach($account as $row):?>
                                <option value="<?= $row['account_id'] ?>"><?= $row['fullname'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary form-control">
                                <i class="ti ti-device-floppy"></i>&nbsp;Save
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
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    let table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "<?= site_url('fetch-schedules') ?>",
        "columns": [{
                "data": "year"
            },
            {
                "data": "name"
            },
            {
                "data": "details"
            },
            {
                "data": "date"
            },
            {
                "data": "time"
            },
            {
                "data": "status"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            }
        ]
    });

    let assign = $('#tblassign').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "<?= site_url('assignment') ?>",
        "columns": [{
                "data": "date"
            },
            {
                "data": "name"
            },
            {
                "data": "details"
            },
            {
                "data": "fullname"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            }
        ]
    });

    $(document).on('click', '.assign', function() {
        $('#assignModal').modal('show');
        let value = $(this).val();
        $('#assignID').attr("value", value);
    });

    $(document).on('click', '.remove', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this selected data?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Continue',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            // Action based on user's choice
            if (result.isConfirmed) {
                let data = $(this).serialize();
                $('#modal-loading').modal('show');
                $.ajax({
                    url: "<?= site_url('assignment/remove') ?>",
                    method: "POST",
                    data: {
                        value: $(this).val()
                    },
                    success: function(response) {
                        $('#modal-loading').modal('hide');
                        if (response.success) {
                            Swal.fire({
                                title: 'Great!',
                                text: "Successfully removed",
                                icon: 'success',
                                confirmButtonText: 'Continue'
                            }).then((result) => {
                                // Action based on user's choice
                                if (result.isConfirmed) {
                                    assign.ajax.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response.errors,
                                icon: "error"
                            });
                        }
                    }
                });
            }
        });
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('#modal-loading').modal('show');
        $('#assignModal').modal('hide');
        $.ajax({
            url: "<?= site_url('assignment/save') ?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#modal-loading').modal('hide');
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: 'Schedule has been assigned successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            assign.ajax.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.errors.account,
                        icon: "error"
                    });
                    $('#assignModal').modal('show');
                }
            }
        });
    });
    </script>
</body>

</html>