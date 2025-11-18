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
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($students as $row): ?>
                                                <tr>
                                                    <td><?= $row->school_id ?></td>
                                                    <td><?= $row->lastname ?>,&nbsp;<?= $row->firstname ?>&nbsp;<?= $row->middlename ?>
                                                    </td>
                                                    <td><?= $row->course ?></td>
                                                    <td><?= $row->year ?> - <?= $row->section ?></td>
                                                    <td>
                                                        <button type="button" class="btn dropdown-toggle"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                            role="button">
                                                            <span>More</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= site_url('gradebook/grades/') ?><?= $row->school_id ?>"
                                                                class="dropdown-item">
                                                                <i class="ti ti-search"></i>&nbsp;View Grades
                                                            </a>
                                                        </div>
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
    </script>
</body>

</html>