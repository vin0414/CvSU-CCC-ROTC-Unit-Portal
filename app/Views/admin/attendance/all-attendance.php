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

    .present {
        background-color: #0baf11ff !important;
        color: #ffffff !important;
        text-align: center;
        /* light green */
    }

    .late {
        background-color: #d4c117ff !important;
        color: #ffffff !important;
        text-align: center;
        /* light yellow */
    }

    .absent {
        background-color: #ef1026ff !important;
        color: #ffffff !important;
        text-align: center;
        /* light red */
    }
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
                                                <div class="col-lg-2">
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
                                                <div class="col-lg-2">
                                                    <label class="form-label">Name of Batch</label>
                                                    <select name="batchName" class="form-select" id="batchName">
                                                        <option value="">Choose</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">From</label>
                                                    <input type="date" name="from" class="form-control">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">To</label>
                                                    <input type="date" name="to" class="form-control">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="form-label">&nbsp;</label>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="ti ti-settings"></i>&nbsp;Search
                                                    </button>
                                                    <button type="button" class="btn btn-default" id="btnExport">
                                                        <i class="ti ti-download"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="table-responsive" style="height: 400px;overflow-y:auto;">
                                                <table class="table table-bordered table-striped" id="tblattendance">
                                                    <thead>
                                                        <th>Fullname</th>
                                                        <th>1st</th>
                                                        <th>2nd</th>
                                                        <th>3rd</th>
                                                        <th>4th</th>
                                                        <th>5th</th>
                                                        <th>6th</th>
                                                        <th>7th</th>
                                                        <th>8th</th>
                                                        <th>9th</th>
                                                        <th>10th</th>
                                                        <th>11th</th>
                                                        <th>12th</th>
                                                        <th>13th</th>
                                                        <th>14th</th>
                                                        <th>15th</th>
                                                    </thead>
                                                    <tbody id="result">
                                                        <tr>
                                                            <td colspan="16" class="text-center">No Record(s)</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
            url: "<?= site_url('gradebook/batch/list') ?>",
            method: "GET",
            data: {
                year: year,
                semester: semester
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                const dropdown = $('#batchName');
                response.batch.forEach(function(item) {
                    dropdown.append(
                        `<option value="${item.batch_id}">${item.batchName} - ${item.section}</option>`
                    );
                });
            }
        });
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('#result').html('<tr><td colspan="16" class="text-center">Loading...</td></tr>');
        $.ajax({
            url: "<?= site_url('attendance/generate') ?>",
            method: "GET",
            data: data,
            success: function(response) {
                if (response === "") {
                    $('#result').html(
                        '<tr><td colspan="16" class="text-center">No Record(s) found</td></tr>');
                } else {
                    $('#result').html(response);
                }
            }
        });
    });

    document.getElementById('btnExport').addEventListener('click', function() {
        const table = document.getElementById('tblattendance');
        let html = table.outerHTML;
        let blob = new Blob([html], {
            type: 'application/vnd.ms-excel'
        });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'attendance-sheet.xls';
        link.click();
    });
    </script>
</body>

</html>