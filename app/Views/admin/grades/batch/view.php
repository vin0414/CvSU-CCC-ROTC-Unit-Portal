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
                            <h2 class="page-title"><?= $batch['batchName'] ?> | Grades</h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?=site_url('gradebook/batch')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="<?=site_url('gradebook/batch')?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
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
                            <div class="card-title">Student Grades</div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Student No</th>
                                            <th rowspan="2">Fullname</th>
                                            <th colspan="3" class="text-center">Attendance</th>
                                            <th colspan="3" class="text-center">Physical</th>
                                            <th colspan="3" class="text-center">Proper<br />Appearance</th>
                                            <th colspan="3" class="text-center">Discipline</th>
                                            <th colspan="3" class="text-center">Cadet<br /> Qualities</th>
                                            <th colspan="3" class="text-center">Leadership</th>
                                            <th colspan="3" class="text-center">Work/<br />Designation</th>
                                            <th rowspan="2">Raw<br />Score</th>
                                            <th rowspan="2">Final<br />Score</th>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($grades as $row):?>
                                        <tr>
                                            <td><?=$row->school_id ?></td>
                                            <td><?=$row->lastname ?>,&nbsp;<?=$row->firstname ?>&nbsp;<?=$row->middlename ?>
                                            </td>
                                            <td><?=$row->attendanceScore ?></td>
                                            <td><?=$row->attendanceValue ?></td>
                                            <td><?=$row->attendancePercentage ?></td>
                                            <td><?=$row->physicalScore ?></td>
                                            <td><?=$row->physicalValue ?></td>
                                            <td><?=$row->physicalPercentage ?></td>
                                            <td><?=$row->appearanceScore ?></td>
                                            <td><?=$row->appearanceValue ?></td>
                                            <td><?=$row->appearancePercentage ?></td>
                                            <td><?=$row->disciplineScore ?></td>
                                            <td><?=$row->disciplineValue ?></td>
                                            <td><?=$row->disciplinePercentage ?></td>
                                            <td><?=$row->qualitiesScore ?></td>
                                            <td><?=$row->qualitiesValue ?></td>
                                            <td><?=$row->qualitiesPercentage ?></td>
                                            <td><?=$row->leadershipScore ?></td>
                                            <td><?=$row->leadershipValue ?></td>
                                            <td><?=$row->leadershipPercentage ?></td>
                                            <td><?=$row->workScore ?></td>
                                            <td><?=$row->workValue ?></td>
                                            <td><?=$row->workPercentage ?></td>
                                            <td><?= $row->finalScore ?></td>
                                            <td><?= $row->finalGrade ?></td>
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