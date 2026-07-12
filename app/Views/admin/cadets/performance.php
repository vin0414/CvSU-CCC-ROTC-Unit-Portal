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
                            <h2 class="page-title">Student No : <?=$cadet['school_id']?></h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?=site_url('cadets')?>"
                                    class="btn btn-default text-success btn-5 d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                    Back
                                </a>
                                <a href="<?=site_url('cadets')?>"
                                    class="btn btn-default text-success btn-6 d-sm-none btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Cadet Performance</div>
                            <div class="row g-1 mb-2">
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <b>Semester : </b>&nbsp;<?= $cadet['school_year'] ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <b>School No : </b>&nbsp;<?= $cadet['school_id'] ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <b>Serial No : </b>&nbsp;<?= $cadet['serial_number'] ?? 'N/A' ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <b>Complete Name :
                                            </b>&nbsp;<?= strtoupper($cadet['lastname']) ?>,&nbsp;<?= strtoupper($cadet['firstname']) ?>&nbsp;<?= strtoupper($cadet['middlename']) ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <b>Email Address : </b>&nbsp;<?= $cadet['email'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mb-3">
                                <h4>Student Grades</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Attendance</th>
                                            <th colspan="2" class="text-center">Physical</th>
                                            <th colspan="2" class="text-center">Proper<br />Appearance</th>
                                            <th colspan="2" class="text-center">Discipline</th>
                                            <th colspan="2" class="text-center">Cadet<br /> Qualities</th>
                                            <th colspan="2" class="text-center">Leadership</th>
                                            <th colspan="2" class="text-center">Work/<br />Designation</th>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                            <th>Total</th>
                                            <th>Trans</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($grades):?>
                                        <tr>
                                            <td><?=$grades['attendanceScore'] ?></td>
                                            <td><?=$grades['attendanceValue'] ?></td>
                                            <td><?=$grades['physicalScore'] ?></td>
                                            <td><?=$grades['physicalValue'] ?></td>
                                            <td><?=$grades['appearanceScore'] ?></td>
                                            <td><?=$grades['appearanceValue'] ?></td>
                                            <td><?=$grades['disciplineScore'] ?></td>
                                            <td><?=$grades['disciplineValue'] ?></td>
                                            <td><?=$grades['qualitiesScore'] ?></td>
                                            <td><?=$grades['qualitiesValue'] ?></td>
                                            <td><?=$grades['leadershipScore'] ?></td>
                                            <td><?=$grades['leadershipValue'] ?></td>
                                            <td><?=$grades['workScore'] ?></td>
                                            <td><?=$grades['workValue'] ?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="14">
                                                <center>No Records</center>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <h4>Cadet Qualities</h4>
                                <table class="table table-bordered table-striped" id="qualities">
                                    <thead>
                                        <th>Knowledge</th>
                                        <th>Dependability</th>
                                        <th>Unselfishness</th>
                                        <th>Decisive</th>
                                        <th>Raw Score</th>
                                    </thead>
                                    <tbody>
                                        <?php if($grades):?>
                                        <tr>
                                            <td><?= $grades['knowledge'] ?></td>
                                            <td><?= $grades['dependability'] ?></td>
                                            <td><?= $grades['unselfishness'] ?></td>
                                            <td><?= $grades['decisive'] ?></td>
                                            <td><?= $grades['qualitiesRawScore'] ?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="5">
                                                <center>No Records</center>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    </tbody>
                                </table>
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
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
</body>

</html>