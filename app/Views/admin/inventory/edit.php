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
                            <h2 class="page-title"><?=$title?> | Edit</h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="<?=site_url('inventory')?>"
                                    class="btn btn-success btn-5 d-none d-sm-inline-block">
                                    <i class="ti ti-arrow-left"></i>&nbsp;Back
                                </a>
                                <a href="<?=site_url('inventory')?>" class="btn btn-success btn-6 d-sm-none btn-icon">
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
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="ti ti-package-import"></i>&nbsp;Add Item</div>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="row g-3" id="form">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $item['inventory_id'] ?>">
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <label class="form-label">Category</label>
                                            <select name="category" class="form-select">
                                                <option value="">Choose</option>
                                                <?php foreach($category as $row): ?>
                                                <option value="<?= $row['category_id'] ?>"
                                                    <?=!empty($row['category_id']==$item['category_id']) ? 'selected': ''?>>
                                                    <?= $row['categoryName'] ?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                            <div id="category-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-8">
                                            <label class="form-label">Item(s)</label>
                                            <input type="text" class="form-control" name="item"
                                                value="<?= $item['item'] ?>" />
                                            <div id="item-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <label class="form-label">Unit(s)</label>
                                            <input type="text" class="form-control" name="units"
                                                value="<?= $item['units'] ?>" />
                                            <div id="units-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="<?= $item['quantity'] ?>" />
                                            <div id="quantity-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price"
                                                value="<?= $item['price'] ?>" />
                                            <div id="price-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Min</label>
                                            <input type="number" class="form-control" name="minimum"
                                                value="<?= $item['min'] ?>" />
                                            <div id="minimum-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="form-label">Max</label>
                                            <input type="number" class="form-control" name="maximum"
                                                value="<?= $item['max'] ?>" />
                                            <div id="maximum-error" class="error-message text-danger text-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="details" class="form-control"
                                        style="height: 150px;"><?= $item['details'] ?></textarea>
                                    <div id="details-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy"></i>&nbsp;Save Changes
                                    </button>
                                </div>
                            </form>
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
    $('#form').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('.error-message').html('');
        $('#btnSave').attr('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Saving...'
        );
        $.ajax({
            url: "<?=site_url('inventory/item/edit')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#btnSave').attr('disabled', false).html(
                    '<span class="ti ti-device-floppy"></span>&nbsp;Save Changes'
                );
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully applied changes",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            location.href = "/inventory";
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
    </script>
</body>

</html>