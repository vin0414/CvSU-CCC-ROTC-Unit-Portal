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
                            <h2 class="page-title"><?=$title?> | All Subjects</h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?= site_url('gradebook/batch/create') ?>" class="btn btn-default">
                                    <i class="ti ti-plus"></i>&nbsp;Add
                                </a>
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
                            <div class="card-title">All Batches</div>
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Batch Name</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach($batch as $row): ?>
                                    <tr>
                                        <td><?= $row['school_year'] ?></td>
                                        <td><?= $row['semester'] ?></td>
                                        <td><?= $row['batchName'] ?></td>
                                        <td><?= $row['section'] ?></td>
                                        <td class="text-center">
                                            <?= ($row['status']) ? '<span class="badge bg-success text-white">OPEN</span>' : '<span class="badge bg-danger text-white">CLOSE</span>' ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                data-bs-auto-close="outside" role="button">
                                                <span>More</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="<?= site_url('gradebook/batch/edit/') ?><?= $row['batch_id'] ?>"
                                                    class="dropdown-item">
                                                    <i class="ti ti-edit"></i>&nbsp;Edit Batch
                                                </a>
                                                <a href="<?= site_url('gradebook/batch/upload/') ?><?= $row['batch_id'] ?>"
                                                    class="dropdown-item">
                                                    <i class="ti ti-upload"></i>&nbsp;Upload Grades
                                                </a>
                                                <a href="<?= site_url('gradebook/batch/view/') ?><?= $row['batch_id'] ?>"
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

    <div class="modal modal-blur fade" id="addModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Add Class</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="form">
                        <?= csrf_field() ?>
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
                        <input type="hidden" name="subject" id="subject" />
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <label class="form-label">School Year</label>
                                    <select name="year" class="form-select" id="year">
                                        <option value="">Choose</option>
                                        <?php foreach ($semesters as $semester): ?>
                                        <option value="<?= $semester ?>"><?= $semester ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="year-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Semester</label>
                                    <select name="semester" class="form-select" id="semester">
                                        <option value="">Choose</option>
                                        <option>1st</option>
                                        <option>2nd</option>
                                    </select>
                                    <div id="semester-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-8">
                                    <label class="form-label">Class Name</label>
                                    <input type="text" class="form-control" name="className" />
                                    <div id="className-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Section</label>
                                    <input type="text" class="form-control" name="section" />
                                    <div id="section-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="btnSave">
                                <i class="ti ti-device-floppy"></i>&nbsp;Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="viewModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">View Classes</div>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Name of Class</th>
                                <th>Section</th>
                            </thead>
                            <tbody id="output"></tbody>
                        </table>
                    </div>
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
    </script>
</body>

</html>