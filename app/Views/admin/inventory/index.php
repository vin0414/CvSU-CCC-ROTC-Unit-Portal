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
                                <a href="#" class="btn btn-default" id="btnExport">
                                    <i class="ti ti-download"></i>&nbsp;Export
                                </a>
                                <a href="<?=site_url('inventory/stock/add')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-package-import"></i>&nbsp;Add Stock
                                </a>
                                <a href="<?=site_url('inventory/stock/add')?>"
                                    class="btn btn-success btn-6 d-sm-none btn-icon">
                                    <i class="ti ti-package-import"></i>
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
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                            <path d="M12 12l8 -4.5" />
                                            <path d="M12 12l0 9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M16 5.25l-8 4.5" />
                                        </svg>
                                        &nbsp;All Stocks
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-package-off">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M8.812 4.793l3.188 -1.793l8 4.5v8.5m-2.282 1.784l-5.718 3.216l-8 -4.5v-9l2.223 -1.25" />
                                            <path d="M14.543 10.57l5.457 -3.07" />
                                            <path d="M12 12v9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M16 5.25l-4.35 2.447m-2.564 1.442l-1.086 .611" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                        &nbsp;Damaged items
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-setup-8" class="nav-link" data-bs-toggle="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg>
                                        &nbsp;Setup
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tabs-home-8">
                                    <table class="table table-bordered table-striped" id="table">
                                        <thead>
                                            <th>Item(s)</th>
                                            <th>Category</th>
                                            <th>Units</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($inventory as $row): ?>
                                            <tr>
                                                <td><?= $row['item'] ?></td>
                                                <td><?= $row['categoryName'] ?></td>
                                                <td><?= $row['units'] ?></td>
                                                <td><?= $row['quantity'] ?></td>
                                                <td><?= number_format($row['price'],2) ?></td>
                                                <td><?= $row['details'] ?></td>
                                                <td>
                                                    <?= ($row['quantity'] == 0) 
                                                            ? '<span class="badge bg-danger text-white">OUT OF STOCKS</span>' 
                                                            : (($row['quantity'] <= $row['min']) 
                                                                ? '<span class="badge bg-warning text-white">CRITICAL</span>' 
                                                                : '<span class="badge bg-success text-white">IN STOCKS</span>') ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                        role="button">
                                                        <span>More</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="<?= site_url('inventory/stock/edit/') ?><?= $row['inventory_id'] ?>"
                                                            class="dropdown-item">
                                                            <i class="ti ti-edit"></i>&nbsp;Edit Item
                                                        </a>
                                                        <button type="button" class="dropdown-item borrow"
                                                            value="<?= $row['inventory_id'] ?>">
                                                            <i class="ti ti-package-export"></i>Borrow Item
                                                        </button>
                                                        <button type="button" class="dropdown-item damage"
                                                            value="<?= $row['inventory_id'] ?>">
                                                            <i class="ti ti-hammer"></i>Damage Item
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tabs-activity-8">
                                    <table class="table table-bordered table-striped" id="tbldamaged">
                                        <thead>
                                            <th>Date Created</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($damage as $row): ?>
                                            <tr>
                                                <td><?= date('M d,Y h:i:s a',strtotime($row->created_at)) ?></td>
                                                <td><?= $row->item ?></td>
                                                <td><?= $row->qty ?></td>
                                                <td><?= $row->reason ?></td>
                                                <td><?= ($row->status) ? '<span class="badge bg-success text-white">CLOSE</span>' : '<span class="badge bg-warning text-white">PENDING</span>' ?>
                                                </td>
                                                <td>
                                                    <?php if($row->status==0): ?>
                                                    <button type="button" class="btn btn-primary restore"
                                                        value="<?= $row->damaged_id ?>">
                                                        <i class="ti ti-restore"></i>&nbsp;Restore
                                                    </button>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tabs-setup-8">
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Add Category</div>
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" class="row g-3" id="form">
                                                        <?= csrf_field() ?>
                                                        <div class="col-lg-12">
                                                            <label class="form-label">Category</label>
                                                            <input type="text" class="form-control" name="category" />
                                                            <div id="category-error"
                                                                class="error-message text-danger text-sm"></div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-primary" id="btnSave">
                                                                <i class="ti ti-device-floppy"></i>&nbsp;Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="tblcategory">
                                                    <thead>
                                                        <th>Date Created</th>
                                                        <th>Category</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody></tbody>
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

    <div class="modal modal-blur fade" id="damageModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Damage Item</div>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row g-3" id="frmDamage">
                        <?= csrf_field() ?>
                        <input type="hidden" id="damageID" name="damageID" />
                        <div class="col-lg-12">
                            <label class="form-label">No of Items</label>
                            <input type="number" class="form-control" name="quantity" min="1">
                            <div id="quantity-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Reason</label>
                            <textarea class="form-control" name="reason"></textarea>
                            <div id="reason-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="form-control btn btn-primary" id="btnSubmit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
                            <label class="form-label">Details</label>
                            <textarea name="details" class="form-control"></textarea>
                            <div id="details-error" class="error-message text-danger text-sm"></div>
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
                        <input type="hidden" id="returnID" name="returnID" />
                        <div class="col-lg-12">
                            <label class="form-label">No of Items</label>
                            <input type="number" class="form-control" name="return_qty" min="1">
                            <div id="return_qty-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="return_by">
                            <div id="return_by-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Item Status</label>
                            <select class="form-select" name="status">
                                <option value="">Choose</option>
                                <option>Good Condition</option>
                                <option>Damaged</option>
                                <option>Partially Damaged</option>
                            </select>
                            <div id="status-error" class="error-message text-danger text-sm"></div>
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
    $('#table').DataTable();
    $('#tbldamaged').DataTable();
    $('#tblborrowed').DataTable();
    $('#tblreturned').DataTable();
    $('#tblpurchase').DataTable();

    $(document).on('click', '.borrow', function() {
        $('#borrowModal').modal('show');
        $('#borrowID').attr("value", $(this).val());
    });

    $(document).on('click', '.damage', function() {
        $('#damageModal').modal('show');
        $('#damageID').attr("value", $(this).val());
    });


    $(document).on('click', '.return', function() {
        $('#returnModal').modal('show');
        $('#returnID').attr("value", $(this).val());
    });

    $(document).on('click', '.edit', function() {
        const {
            value: name
        } = Swal.fire({
            title: "Rename category",
            input: "text",
            inputLabel: "Enter here",
            showCancelButton: true,
            inputValidator: (name) => {
                if (!name) {
                    return "You need to write something!";
                } else {
                    $.ajax({
                        url: "<?= site_url('inventory/category/edit') ?>",
                        method: "POST",
                        data: {
                            value: $(this).val(),
                            name: name
                        },
                        success: function(response) {
                            if (response.success) {
                                category.ajax.reload();
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: response.error,
                                    icon: "warning"
                                });
                            }
                        }
                    });
                }
            }
        });
    });

    let category = $('#tblcategory').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('inventory/category/fetch')?>",
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
                "data": "date"
            },
            {
                "data": "category"
            },
            {
                "data": "action"
            }
        ]
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        $.ajax({
            url: "<?=site_url('inventory/category/add')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Save'
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
                            $('#form')[0].reset();
                            category.ajax.reload();
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

    $('#frmDamage').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSubmit').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Sending...'
        );
        $.ajax({
            url: "<?=site_url('inventory/item/damage')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSubmit').attr('disabled', false).html('Submit');
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

    $(document).on('click', '.restore', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to restore this records?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, restore it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=site_url('inventory/item/restore')?>",
                    method: "POST",
                    data: {
                        value: $(this).val()
                    },
                    success: function(response) {
                        if (response === "success") {
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

    document.getElementById('btnExport').addEventListener('click', function() {
        const table = document.getElementById('table');
        let html = table.outerHTML;
        let blob = new Blob([html], {
            type: 'application/vnd.ms-excel'
        });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'inventory.xls';
        link.click();
    });
    </script>
</body>

</html>