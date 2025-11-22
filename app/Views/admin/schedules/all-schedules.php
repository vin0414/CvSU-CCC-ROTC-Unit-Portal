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
                                <a href="<?=site_url('schedules/manage')?>" class="btn btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M4 13h3l3 3h4l3 -3h3" />
                                    </svg>
                                    Manage
                                </a>
                                <a href="<?=site_url('schedules/create')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-plus"></i>&nbsp;Add
                                </a>
                                <a href="<?=site_url('schedules/create')?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <i class="ti ti-plus"></i>
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
                    <div id='calendar'></div>
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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
    <?php $eventData = array();?>
    <?php 
    $scheduleModel = new \App\Models\scheduleModel();
    $schedules = $scheduleModel->where('day', 'Saturday')->where('status',1)->findAll();
    // Determine dynamic date range from the records
    $minDate = $scheduleModel->selectMin('from_date')->first()['from_date'];
    $maxDate = $scheduleModel->selectMax('to_date')->first()['to_date'];

    $startDate = new DateTime($minDate);
    $endDate = new DateTime($maxDate);
    $eventData = [];

    while ($startDate <= $endDate) {
        if ($startDate->format('l') === 'Saturday') {
            $dateStr = $startDate->format('Y-m-d');

            foreach ($schedules as $row) {
                $tempArray = [
                    'title'       => $row['name'],
                    'description' => $row['details'],
                    'start'       => $dateStr . 'T' . $row['from_time'],
                    'end'         => $dateStr . 'T' . $row['to_time'],
                ];

                array_push($eventData, $tempArray); // 👈 Your requested line
            }
        }
        $startDate->modify('+1 day');
    }
    ?>

    const jsonData = <?php echo json_encode($eventData); ?>;
    var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
        initialView: "dayGridMonth",
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'today dayGridMonth listWeek prev,next'
        },
        buttonText: {
            today: 'Today',
            month: 'Month',
            listWeek: 'Week',
        },
        selectable: true,
        editable: true,
        events: jsonData,
        views: {
            // Customize the timeGridWeek and timeGridDay views
            timeGridWeek: {
                buttonText: 'Week'
            },
            timeGridDay: {
                buttonText: 'Day'
            },
        }
    });
    calendar.render();
    </script>
</body>

</html>