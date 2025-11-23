<?=view('cadet/templates/header') ?>

<body>
    <div class="page">
        <!-- BEGIN GLOBAL THEME SCRIPT -->
        <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
        <!-- END GLOBAL THEME SCRIPT -->
        <!-- BEGIN NAVBAR  -->
        <?=view('cadet/templates/navbar') ?>
        <!-- END NAVBAR  -->
        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title"><?=$title?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="row g-3 mb-3">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-status-bottom bg-primary"></div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 3v18h18" />
                                                    <path d="M20 18v3" />
                                                    <path d="M16 16v5" />
                                                    <path d="M12 13v8" />
                                                    <path d="M8 16v5" />
                                                    <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                                                </svg>
                                                Attendance Rate
                                            </div>
                                            <h1 class="text-center"><?=number_format($attendanceRate,2)?>%</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-status-bottom bg-primary"></div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                                    <path d="M15 19l2 2l4 -4" />
                                                </svg>
                                                Total Attendance
                                            </div>
                                            <h1 class="text-center"><?=$totalAttendance?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-status-bottom bg-primary"></div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-clock">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h10" />
                                                    <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                    <path d="M18 16.5v1.5l.5 .5" />
                                                </svg>
                                                Late Attendance
                                            </div>
                                            <h1 class="text-center"><?=$late?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-status-bottom bg-primary"></div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-cancel">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                                    <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                    <path d="M17 21l4 -4" />
                                                </svg>
                                                Total Absent
                                            </div>
                                            <h1 class="text-center"><?=$absent?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 12l.01 0" />
                                            <path d="M13 12l2 0" />
                                            <path d="M9 16l.01 0" />
                                            <path d="M13 16l2 0" />
                                        </svg>
                                        Attendance Summary
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table">
                                            <thead>
                                                <th>School ID</th>
                                                <th>Date</th>
                                                <th>In</th>
                                                <th>Out</th>
                                                <th>Hours</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($summary as $row): ?>
                                                <tr>
                                                    <td><?=$row->school_id?></td>
                                                    <td><?=date('F d, Y',strtotime($row->date))?></td>
                                                    <td><?=date('h:i:s a',strtotime($row->timeIn))?></td>
                                                    <td><?=date('h:i:s a',strtotime($row->timeOut))?></td>
                                                    <td><?=date('h:i',strtotime($row->hours))?></td>
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
    <?=view('cadet/templates/footer') ?>
    <script>
    $('#table').DataTable();
    </script>
</body>

</html>