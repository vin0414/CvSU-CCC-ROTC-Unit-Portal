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
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-borrow-8" class="nav-link active" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-package-export">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                            <path d="M12 12l8 -4.5" />
                                            <path d="M12 12v9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M15 18h7" />
                                            <path d="M19 15l3 3l-3 3" />
                                        </svg>
                                        &nbsp;Borrowed items
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-purchase-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                                            <path d="M19 21v1m0 -8v1" />
                                            <path
                                                d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                                            <path
                                                d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                                            <path d="M8 14v.01" />
                                            <path d="M8 17v.01" />
                                            <path d="M12 13.99v.01" />
                                            <path d="M12 17v.01" />
                                        </svg>
                                        &nbsp;Request
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs-borrow-8">
                                    <table class="table table-bordered table-striped" id="tblborrowed">
                                        <thead>
                                            <th>Date</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Borrower</th>
                                            <th>Details</th>
                                            <th>Expected Date</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($borrow as $row): ?>
                                            <tr>
                                                <td><?= date('M d,Y h:i:s a',strtotime($row->created_at)) ?></td>
                                                <td><?= $row->item ?></td>
                                                <td><?= $row->qty ?></td>
                                                <td><?= $row->borrower ?></td>
                                                <td><?= $row->details ?></td>
                                                <td><?= date('M d, Y',strtotime($row->date_expected)) ?></td>
                                                <td>
                                                    <?php if($row->status==0): ?>
                                                    <button type="button" class="btn btn-primary return"
                                                        value="<?= $row->inventory_id ?>">
                                                        <i class="ti ti-package-import"></i>&nbsp;Return
                                                    </button>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tabs-purchase-8">
                                    <table class="table table-bordered table-striped" id="tblpurchase">
                                        <thead>
                                            <th>Date</th>
                                            <th>Item(s)</th>
                                            <th>Qty</th>
                                            <th>Borrower's Name</th>
                                            <th>Date Return</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($request as $row): ?>
                                            <tr>
                                                <td><?= date('M d,Y h:i:s a',strtotime($row->created_at)) ?></td>
                                                <td><?= $row->item ?></td>
                                                <td><?= $row->qty ?></td>
                                                <td><?= $row->lastname ?>, <?= $row->firstname ?>
                                                    <?= $row->middlename ?></td>
                                                <td><?= date('M d, Y', strtotime($row->date_return)) ?></td>
                                                <td>
                                                    <?php if($row->status==0):?>
                                                    <span class="badge bg-warning text-white">PENDING</span>
                                                    <?php elseif($row->status==1):?>
                                                    <span class="badge bg-success text-white">APPROVED</span>
                                                    <?php else:?>
                                                    <span class="badge bg-danger text-white">DECLINED</span>
                                                    <?php endif;?>
                                                </td>
                                                <td>
                                                    <?php if($row->status==0):?>
                                                    <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                        role="button">
                                                        <span>More</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item accept"
                                                            value="<?= $row->request_id ?>">
                                                            <i class="ti ti-check"></i>&nbsp;Accept
                                                        </button>
                                                        <button type="button" class="dropdown-item decline"
                                                            value="<?= $row->request_id ?>">
                                                            <i class="ti ti-x"></i>&nbsp;Decline
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
            <!-- END PAGE BODY -->
        </div>
    </div>

    <div class="modal modal-blur fade" id="borrowModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Borrow Item</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="frmBorrow">
                        <?= csrf_field() ?>
                        <input type="hidden" id="borrowID" name="borrowID" />
                        <div class="col-lg-12">
                            <label class="form-label">No of Items</label>
                            <input type="number" class="form-control" name="qty" min="1">
                            <div id="qty-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Name of Borrower</label>
                            <input type="text" class="form-control" name="borrower">
                            <div id="borrower-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Date Return</label>
                            <input type="date" class="form-control" name="date_return">
                            <div id="date_return-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="form-control btn btn-primary" id="btnSend">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="returnModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Return Item</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="frmReturn">
                        <?= csrf_field() ?>
                        <div class="col-lg-12">
                            <label class="form-label">Name of the Borrower</label>
                            <input type="text" class="form-control" name="return_by">
                            <div id="return_by-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">No of Items</label>
                            <input type="number" class="form-control" name="return_qty" min="1">
                            <div id="return_qty-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Remarks</label>
                            <select class="form-select" name="status" id="remarks">
                                <option value="">Choose</option>
                                <option>Good Condition</option>
                                <option>Damaged</option>
                                <option>Partially Damaged</option>
                                <option>Lost Items</option>
                            </select>
                            <div id="status-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12" id="lost_option" style="display:none;">
                            <label class="form-label">Total Number of Lost Item</label>
                            <input type="number" class="form-control" name="lost_qty" min="1">
                            <div id="lost_qty-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="form-control btn btn-primary" id="btnReturn">
                                Submit
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
    $('#tblborrowed').DataTable();
    $('#tblpurchase').DataTable();

    $('#remarks').change(function() {
        let val = $(this).val();
        if (val === "Lost Items") {
            $('#lost_option').slideDown();
        } else {
            $('#lost_option').slideUp();
        }
    });

    $(document).on('click', '.borrow', function() {
        $('#borrowModal').modal('show');
        $('#borrowID').attr("value", $(this).val());
    });

    $(document).on('click', '.return', function() {
        $('#returnModal').modal('show');
        $('#returnID').attr("value", $(this).val());
    });

    $('#frmBorrow').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSend').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Sending...'
        );
        $.ajax({
            url: "<?=site_url('inventory/item/borrow')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSend').attr('disabled', false).html('Submit');
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully submitted",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            $('#frmDamage').modal('hide');
                            location.reload();
                        }
                    });
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

    $('#frmReturn').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnReturn').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Sending...'
        );
        $.ajax({
            url: "<?=site_url('inventory/item/return')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnReturn').attr('disabled', false).html('Submit');
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully submitted",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            $('#frmReturn').modal('hide');
                            location.reload();
                        }
                    });
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

    $(document).on('click', '.accept', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to accept this request?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, accept it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=site_url('inventory/item/accept')?>",
                    method: "POST",
                    data: {
                        value: $(this).val()
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response,
                                icon: "warning"
                            });
                        }
                    }
                });
            }
        });
    });

    $(document).on('click', '.decline', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to decline this request?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, decline it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=site_url('inventory/item/decline')?>",
                    method: "POST",
                    data: {
                        value: $(this).val()
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response,
                                icon: "warning"
                            });
                        }
                    }
                });
            }
        });
    });
    </script>
</body>

</html>