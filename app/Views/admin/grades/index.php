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
                                <a href="<?= site_url('gradebook/subject') ?>" class="btn btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M4 13h3l3 3h4l3 -3h3" />
                                    </svg>
                                    All Subjects
                                </a>
                                <a href="<?= site_url('gradebook/subject/create') ?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-plus"></i>&nbsp;Add
                                </a>
                                <a href="<?= site_url('gradebook/subject/create') ?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <i class="ti ti-plus"></i>
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
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3">
                            <div class="card bg-success text-white">
                                <div class="card-status-bottom bg-success"></div>
                                <div class="card-body">
                                    <h5>ACTIVE STUDENTS</h5>
                                    <h1 class="text-center"><?= $students ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card bg-success text-white">
                                <div class="card-status-bottom bg-success"></div>
                                <div class="card-body">
                                    <h5>ACTIVE SUBJECTS</h5>
                                    <h1 class="text-center"><?= $activeSubject ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card bg-success text-white">
                                <div class="card-status-bottom bg-success"></div>
                                <div class="card-body">
                                    <h5>ACTIVE OFFICERS</h5>
                                    <h1 class="text-center"><?= $account ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card bg-success text-white">
                                <div class="card-status-bottom bg-success"></div>
                                <div class="card-body">
                                    <h5>CLOSED SUBJECTS</h5>
                                    <h1 class="text-center"><?= $inactiveSubject ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M18.5 18.5l2.5 2.5" />
                                    <path d="M4 6h16" />
                                    <path d="M4 12h4" />
                                    <path d="M4 18h4" />
                                </svg>
                                Task List
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <th>School Year</th>
                                        <th>Subject</th>
                                        <th>Task</th>
                                        <th>Total Cadets</th>
                                        <th>Assigned Officers</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($schedules as $row): ?>
                                        <tr>
                                            <td><?= $row->school_year ?></td>
                                            <td><?= $row->subjectName ?></td>
                                            <td><?= $row->name ?></td>
                                            <td class="text-center"><?= $row->total ?? 0 ?></td>
                                            <td><?= $row->fullname ?></td>
                                            <td class="text-center">
                                                <?= ($row->status) ? '<span class="badge bg-success text-white">OPEN</span>' : '<span class="badge bg-danger text-white">CLOSE</span>' ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                    role="button">
                                                    <span>More</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="<?= site_url('gradebook/view/') ?><?= $row->schedule_id ?>"
                                                        class="dropdown-item">
                                                        <i class="ti ti-search"></i>&nbsp;View Students
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