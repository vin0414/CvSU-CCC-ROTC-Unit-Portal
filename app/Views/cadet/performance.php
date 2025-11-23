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
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-award">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                            <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                                            <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                                        </svg>
                                        My Grades
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <div class="row g-3 mb-3">
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3>TOTAL ATTENDANCE</h3>
                                                    <h1><?= $grades['present'] ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3>RAW SCORE</h3>
                                                    <h1><?= !empty($grades['status']) ? $grades['finalScore'] : 'TBD' ?>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3>FINAL GRADE</h3>
                                                    <h1><?= !empty($grades['status']) ? $grades['finalGrade'] : 'TBD' ?>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3>REMARKS</h3>
                                                    <h1><?= !empty($grades['status']) ? $grades['remarks'] : 'TBD' ?>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mb-3">
                                        <h4>Grade Summary</h4>
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
                                                <?php endif;?>
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
</body>

</html>