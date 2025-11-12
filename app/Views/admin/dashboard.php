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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('visualization', "1", {
        packages: ['corechart']
    });
    </script>
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
                            <h2 class="page-title">My Dashboard</h2>
                        </div>
                        <!-- Page title actions -->
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
                    <div class="mb-4">
                        <div class="card bg-success text-primary-fg">
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-white text-primary">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <label style="font-size: 30px;">Welcome back, Mr/Ms.
                                    <?= session()->get('fullname') ?></label>
                                <p>Have a good day at work</p>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-9">
                            <div class="row g-3 mb-3">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="<?=base_url('assets/images/student.png')?>"
                                                        width="50px" />
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">0</div>
                                                    <div class="text-secondary">Total Cadets</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="<?=base_url('assets/images/student.png')?>"
                                                        width="50px" />
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">0</div>
                                                    <div class="text-secondary">Enrolled Cadets</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="<?=base_url('assets/images/team.png')?>" width="50px" />
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">0</div>
                                                    <div class="text-secondary">Total Officers</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="<?=base_url('assets/images/book.png')?>" width="50px" />
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">0</div>
                                                    <div class="text-secondary">Total Training(s)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-deck">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <i class="ti ti-calendar"></i>&nbsp;My Schedules
                                            </div>
                                            <div class="card-actions">
                                                <a href="" class="btn btn-link">
                                                    <i class="ti ti-search"></i>&nbsp;View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="list-group list-group-flush">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <i class="ti ti-calendar-plus"></i>&nbsp;Attendance
                                            </div>
                                            <div class="card-actions">
                                                <select class="form-select">
                                                    <option>Today</option>
                                                    <option>This Week</option>
                                                    <option>This Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="attendanceChart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-speakerphone">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 8a3 3 0 0 1 0 6" />
                                            <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
                                            <path
                                                d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
                                        </svg>
                                        Announcement
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <div class="list-group list-group-flush">
                                        <?php if(empty($announcement)):?>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                                No Announcement posted
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <?php foreach($announcement as $row): ?>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <a href="javascript:void(0);">
                                                        <span class="avatar avatar-1"
                                                            style="background-image: url(<?=base_url('assets/images/announcement/')?><?=$row['image']?>)">
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="col text-truncate">
                                                    <a href="javascript:void(0);"
                                                        class="text-reset d-block"><?=$row['title']?></a>
                                                    <div class="d-block text-secondary text-truncate mt-n1">
                                                        <?=$row['details']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;?>
                                        <?php endif;?>
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
    <script>
    google.charts.setOnLoadCallback(attendanceCharts);

    function attendanceCharts() {
        const data = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            <?php foreach ($attendance as $row): ?>['<?= $row['status'] ?>', <?= $row['total'] ?>],
            <?php endforeach; ?>
        ]);

        const options = {
            pieHole: 0.4,
            pieSliceText: 'percentage',
            legend: {
                position: 'bottom'
            },
            backgroundColor: {
                fill: 'transparent'
            },
            colors: ['#4CAF50', '#FFC107', '#F44336']
        };

        const chart = new google.visualization.PieChart(document.getElementById('attendanceChart'));
        chart.draw(data, options);

    }
    </script>
</body>

</html>