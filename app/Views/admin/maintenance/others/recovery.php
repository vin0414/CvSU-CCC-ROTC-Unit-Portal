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
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-server"></i>&nbsp;Back-Up and Restore</div>
                            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                            <?php endif; ?>
                            <form method="POST" class="row g-3" enctype="multipart/form-data"
                                action="<?=base_url('restore')?>">
                                <div class="col-lg-12">
                                    <span class="form-label">SQL File</span>
                                    <input type="file" class="form-control bg-transparent" name="file" required />
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-upload"></i>&nbsp;Upload
                                    </button>
                                    <a href="<?=site_url('download')?>" class="btn btn-outline-secondary">
                                        <i class="ti ti-download"></i>&nbsp;Download
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <i class="ti ti-database-cog"></i>&nbsp;Database Configuration
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Database/Schema</label>
                                            <input type="text" class="form-control"
                                                value="<?=getenv('database.default.database')?>" />
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control"
                                                        value="<?=getenv('database.default.username')?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label">Port</label>
                                                    <input type="text" class="form-control"
                                                        value="<?=getenv('database.default.port')?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <i class="ti ti-world-cog"></i>&nbsp;System Information
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Project Version</label>
                                            <input type="text" class="form-control"
                                                value="<?=\CodeIgniter\CodeIgniter::CI_VERSION; ?>" />
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Current PHP Version</label>
                                            <input type="text" class="form-control" value="<?= phpversion()?>" />
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
</body>

</html>