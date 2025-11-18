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
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        </svg>
                                        &nbsp;Newly Registered
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-enrolled-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                                            <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M19.001 15.5v1.5" />
                                            <path d="M19.001 21v1.5" />
                                            <path d="M22.032 17.25l-1.299 .75" />
                                            <path d="M17.27 20l-1.3 .75" />
                                            <path d="M15.97 17.25l1.3 .75" />
                                            <path d="M20.733 20l1.3 .75" />
                                        </svg>
                                        &nbsp;Enrolled Cadets
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-list-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 14h.01" />
                                            <path d="M9 17h.01" />
                                            <path d="M12 16l1 1l3 -3" />
                                        </svg>
                                        &nbsp;Master List
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <table class="table table-bordered table-striped" id="table1">
                                        <thead>
                                            <th>Image</th>
                                            <th>Student ID</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tabs-enrolled-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table2">
                                            <thead>
                                                <th>Image</th>
                                                <th>Student ID</th>
                                                <th>Fullname</th>
                                                <th>Course & Year</th>
                                                <th>Section</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody></tbody>
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
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="table">
                                                    <thead>
                                                        <th>Student No</th>
                                                        <th>Fullname</th>
                                                        <th>Course</th>
                                                        <th>Year</th>
                                                        <th>Section</th>
                                                    </thead>
                                                    <tbody id="output">
                                                        <tr>
                                                            <td colspan="5" class="text-center">No Data(s) Found</td>
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
    <div class="modal" id="modal-loading" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <dotlottie-wc src="https://lottie.host/ed13f8d5-bc3f-4786-bbb8-36d06a21a6cb/XMPpTra572.lottie"
                            style="width: 100%;height: auto;" autoplay loop></dotlottie-wc>
                    </div>
                    <div>Loading</div>
                </div>
            </div>
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
    <script>
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
    let table1 = $('#table1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('registered')?>",
            "type": "GET",
            "dataSrc": function(json) {
                // Handle the data if needed
                return json.data;
            },
            "error": function(xhr, error, code) {
                console.error("AJAX Error: " + error);
                alert("Error occurred while loading data.");
            }
        },
        "searching": true,
        "columns": [{
                "data": "image"
            },
            {
                "data": "id"
            },
            {
                "data": "fullname"
            },
            {
                "data": "email"
            },
            {
                "data": "status"
            },
            {
                "data": "action"
            }
        ]
    });
    let table2 = $('#table2').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('enrolled')?>",
            "type": "GET",
            "dataSrc": function(json) {
                // Handle the data if needed
                return json.data;
            },
            "error": function(xhr, error, code) {
                console.error("AJAX Error: " + error);
                alert("Error occurred while loading data.");
            }
        },
        "searching": true,
        "columns": [{
                "data": "image"
            },
            {
                "data": "id"
            },
            {
                "data": "fullname"
            },
            {
                "data": "course"
            },
            {
                "data": "section"
            },
            {
                "data": "action"
            }
        ]
    });
    $(document).on('click', '.enroll', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to enroll this cadet?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Continue',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            // Action based on user's choice
            if (result.isConfirmed) {
                $('#modal-loading').modal('show');
                const value = $(this).val();
                $.ajax({
                    url: "<?=site_url('enroll-cadet')?>",
                    method: "POST",
                    data: {
                        value: value,
                    },
                    success: function(response) {
                        $('#modal-loading').modal('hide');
                        if (response.success) {
                            table1.ajax.reload();
                            table2.ajax.reload();
                        } else {
                            alert(response.errors);
                        }
                    }
                });
            }
        });
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('#output').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');
        $.ajax({
            url: "<?= site_url('gradebook/attendance/list') ?>",
            method: "GET",
            data: data,
            success: function(response) {
                if (response === "") {
                    $('#output').html(
                        '<tr><td colspan="5" class="text-center">No Data(s) found</td></tr>');
                } else {
                    $('#output').html(response);
                }
            }
        });
    });
    </script>
</body>

</html>