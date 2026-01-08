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
                                <a href="<?=site_url('reports/create')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-report-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                        <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 11h4" />
                                        <path d="M8 15h3" />
                                        <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                                        <path d="M18.5 19.5l2.5 2.5" />
                                    </svg>
                                    Create
                                </a>
                                <a href="<?=site_url('reports/create')?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-report-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                        <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 11h4" />
                                        <path d="M8 15h3" />
                                        <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                                        <path d="M18.5 19.5l2.5 2.5" />
                                    </svg>
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
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-others-8" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-award"></i>&nbsp;Merits/Demerits
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-others-8">
                                    <button type="button" class="btn btn-default" id="btnExport">
                                        <i class="ti ti-download"></i>&nbsp;Download
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tables">
                                            <thead>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Details</th>
                                                <th>Cadets</th>
                                                <th>Points</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($others as $row): ?>
                                                <tr>
                                                    <td><?= date('M d, Y',strtotime($row->created_at)) ?></td>
                                                    <td><?= $row->type_report ?></td>
                                                    <td><?= $row->category ?></td>
                                                    <td><?= $row->details ?></td>
                                                    <td>
                                                        <?= $row->lastname ?>,&nbsp;<?= $row->firstname ?>&nbsp;<?= $row->middlename ?>
                                                    </td>
                                                    <td><?= $row->points ?></td>
                                                    <td>
                                                        <?php if($row->status==0): ?>
                                                        <button type="button" class="btn dropdown-toggle"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                            role="button">
                                                            <span>More</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button type="button" class="dropdown-item view"
                                                                value="<?= $row->report_id ?>">
                                                                <i class="ti ti-search"></i>&nbsp;View
                                                            </button>
                                                        </div>
                                                        <?php endif;?>
                                                    </td>
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

    <div class="modal modal-blur fade" id="viewModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">View Details</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="frmReport">
                        <?= csrf_field() ?>
                        <input type="hidden" name="reportID" id="reportID" />
                        <div class="col-lg-12">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Details</label>
                            <textarea name="details" class="form-control" style="height: 150px;"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="form-control btn btn-primary" id="btnSend">
                                <i class="ti ti-send"></i>&nbsp;Approve
                            </button>
                        </div>
                    </form>
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
    <script>
    $('#table').DataTable();
    $('#tables').DataTable();

    $(document).on('click', '.view', function() {
        $.ajax({
            url: "<?= site_url('report/view') ?>",
            method: "GET",
            data: {
                value: $(this).val()
            },
            success: function(response) {
                if (response.report) {
                    const report = response.report;
                    $('#frmReport input[name="reportID"]').val(report.report_id);
                    $('#frmReport input[name="title"]').val(report.violation);
                    $('#frmReport textarea[name="details"]').val(report.details);
                    $('#viewModal').modal('show');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to fetch report details.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while fetching report details.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $('#frmReport').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSend').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Submitting...'
        );
        $.ajax({
            url: "<?= site_url('report/update') ?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSend').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Submit'
                );
                if (response.success) {
                    location.reload();
                } else {
                    var errors = response.errors;
                    // Iterate over each error and display it under the corresponding input field
                    for (var field in errors) {
                        $('#' + field + '-error').html('<p>' + errors[field] +
                            '</p>'); // Show the first error message
                        $('#' + field).addClass(
                            'text-danger'); // Highlight the input field with an error
                    }
                }
            }
        });
    });

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
                dropdown.empty();
                dropdown.append('<option value="">Choose</option>');
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
        $('#result').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
        $.ajax({
            url: "<?= site_url('report/grades') ?>",
            method: "GET",
            data: data,
            success: function(response) {
                if (response === "") {
                    $('#result').html(
                        '<tr><td colspan="7" class="text-center">No Data(s) found</td></tr>');
                    document.getElementById('btn').style = "display:none";
                } else {
                    $('#result').html(response);
                    $('#id').attr("value", $('#className').val());
                    document.getElementById('btn').style = "display:block";
                }
            }
        });
    });

    $('#frmGenerate').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        $.ajax({
            url: "<?=site_url('report/grades/update')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Save Changes'
                );
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully saved",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                        }
                    });
                } else {
                    var errors = response.errors;
                    alert(errors);
                }
            }
        });
    });

    document.getElementById('btnDownload').addEventListener('click', function() {
        const table = document.getElementById('table1');
        let html = table.outerHTML;
        let blob = new Blob([html], {
            type: 'application/vnd.ms-excel'
        });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'grades.xls';
        link.click();
    });

    document.getElementById('btnExport').addEventListener('click', function() {
        const table = document.getElementById('tables');
        let html = table.outerHTML;
        let blob = new Blob([html], {
            type: 'application/vnd.ms-excel'
        });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'merits-demerits.xls';
        link.click();
    });

    document.getElementById('btnExports').addEventListener('click', function() {
        const table = document.getElementById('table');
        let html = table.outerHTML;
        let blob = new Blob([html], {
            type: 'application/vnd.ms-excel'
        });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'violations.xls';
        link.click();
    });
    </script>
</body>

</html>