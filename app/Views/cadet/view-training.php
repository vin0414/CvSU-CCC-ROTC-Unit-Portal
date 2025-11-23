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
                            <h2 class="page-title">My Trainings</h2>
                            <small><?= $schedule['name'] ?> | <?= $schedule['day'] ?> |
                                <?= date('h:i:s a',strtotime($schedule['from_time'])) ?> -
                                <?= date('h:i:s a',strtotime($schedule['to_time'])) ?></small>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="javascript:history.back();"
                                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="javascript:history.back();" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
                    <div class="row g-3">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title"><?= $schedule['name'] ?></div>
                                    <div class="row g-1">
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-4">
                                                    <label class="form-label">From</label>
                                                    <p class="form-control">
                                                        <?= date('M d, Y',strtotime($schedule['from_date'])) ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">To</label>
                                                    <p class="form-control">
                                                        <?= date('M d, Y',strtotime($schedule['to_date'])) ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Day of the Month</label>
                                                    <p class="form-control">
                                                        <?= $schedule['day'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Details</label>
                                            <textarea class="form-control" style="height: 200px;"><?= $schedule['details'] ?>
                                    </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <i class="ti ti-files"></i> Files
                                    </div>
                                </div>
                                <div class="list-group list-group-flush">
                                    <?php if(empty($files)): ?>
                                    <div class="list-group-item">
                                        <div class="text-center text-muted py-3">
                                            No file(s) uploaded
                                        </div>
                                    </div>
                                    <?php else:?>
                                    <?php 
                                    function formatSize($bytes) 
                                    {
                                        $units = ['B','KB','MB','GB','TB'];
                                        for ($i = 0; $bytes >= 1024 && $i < 4; $i++) {
                                            $bytes /= 1024;
                                        }
                                        return round($bytes, 2) . ' ' . $units[$i];
                                    } 
                                    ?>
                                    <?php foreach($files as $row): ?>
                                    <?php 
                                    $file_path = FCPATH . 'assets/attachment/' . $row['filename'];
                                    $file_size = file_exists($file_path) ? filesize($file_path) : 0;                                              
                                    ?>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <a href="<?=site_url('assets/attachment/')?><?=$row['filename']?>"
                                                    target="_blank">
                                                    <span class="avatar avatar-1"
                                                        style="background-image: url(<?=base_url('assets/images/logo.png')?>)">
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="<?=site_url('assets/attachment/')?><?=$row['filename']?>"
                                                    class="text-reset d-block" target="_blank"><?=$row['filename']?>
                                                </a>
                                                <div class="d-block text-secondary text-truncate mt-n1">
                                                    File Size : <?= formatSize($file_size) ?>
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
            <!-- END PAGE BODY -->
        </div>
    </div>
    <?=view('cadet/templates/footer') ?>
</body>

</html>