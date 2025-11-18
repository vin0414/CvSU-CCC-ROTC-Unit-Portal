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
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-users"></i>&nbsp;All Students
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-recent-8" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-clipboard-data"></i>&nbsp;Summary
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-list-8" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-clipboard-check"></i>&nbsp;Master List
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table1">
                                            <thead>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>School ID</th>
                                                <th>Complete Name</th>
                                                <th>Remarks</th>
                                                <th>Token</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($attendance as $row): ?>
                                                <tr>
                                                    <td><?=date('F d, Y',strtotime($row->date))?></td>
                                                    <td><?=date('h:i:s a',strtotime($row->time))?></td>
                                                    <td><?=$row->school_id?></td>
                                                    <td><?=$row->firstname?>&nbsp;<?=$row->middlename?>&nbsp;<?=$row->lastname?>
                                                    </td>
                                                    <td><?=$row->remarks?></td>
                                                    <td><?=$row->token?></td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-recent-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table2">
                                            <thead>
                                                <th>Date</th>
                                                <th>School ID</th>
                                                <th>Fullname</th>
                                                <th>Hours</th>
                                                <th>Token</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($summary as $row): ?>
                                                <tr>
                                                    <td><?=date('F d, Y',strtotime($row->date))?></td>
                                                    <td><?=$row->school_id?></td>
                                                    <td><?=$row->firstname?>&nbsp;<?=$row->middlename?>&nbsp;<?=$row->lastname?>
                                                    </td>
                                                    <td><?=date('h:i',strtotime($row->hours))?></td>
                                                    <td><?=$row->token?></td>
                                                    <td>
                                                        <a href="<?=site_url('attendance/view/')?><?=$row->date?>/<?=$row->token?>"
                                                            class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-search">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                <path d="M20.2 20.2l1.8 1.8" />
                                                            </svg>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-list-8">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <form method="GET" class="row g-3" id="form">
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
                                                <div class="col-lg-3">
                                                    <label class="form-label">School Year</label>
                                                    <select name="year" class="form-select" id="year">
                                                        <option value="">Choose</option>
                                                        <?php foreach ($semesters as $semester): ?>
                                                        <option value="<?= $semester ?>"><?= $semester ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">Semester</label>
                                                    <select name="semester" class="form-select" id="semester">
                                                        <option value="">Choose</option>
                                                        <option>1st</option>
                                                        <option>2nd</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Name of Class</label>
                                                    <select name="className" class="form-select" id="className">
                                                        <option value="">Choose</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="form-label">&nbsp;</label>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="ti ti-settings"></i>&nbsp;Generate
                                                    </button>
                                                    <button type="button" class="btn btn-default">
                                                        <i class="ti ti-download"></i>&nbsp;Download
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
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
    $('#table1').DataTable();
    $('#table2').DataTable();
    $('#semester').change(function() {
        let semester = $(this).val();
        let year = $('#year').val();
        $.ajax({
            url: "<?= site_url('gradebook/class/list') ?>",
            method: "GET",
            data: {
                year: year,
                semester: semester
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                const dropdown = $('#className');
                response.class.forEach(function(item) {
                    dropdown.append(
                        `<option value="${item.class_id}">${item.className} - ${item.section}</option>`
                    );
                });

            }
        });
    });
    </script>
</body>

</html>