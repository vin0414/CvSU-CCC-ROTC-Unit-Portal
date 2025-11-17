<?=view('cadet/templates/header') ?>
<link href="<?=base_url('assets/css/dropzone.css')?>" rel="stylesheet" />

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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 18.004h-5.343c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.38 0 2.57 .811 3.128 1.986" />
                                    <path d="M19 22v-6" />
                                    <path d="M22 19l-3 -3l-3 3" />
                                </svg>
                                Upload
                            </div>
                            <p>
                                <small>Upload supported documents. Accepted file types: zip, and
                                    pdf(25MB limit).
                                </small>
                            </p>
                            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                                <?= session()->getFlashdata('fail'); ?>
                            </div>
                            <?php endif; ?>
                            <form class="mb-3" id="frmUpload" action="<?=site_url('upload-file')?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="dropzone" id="dropzone">
                                    <p>Drag & Drop files here or click to select files</p>
                                    <input type="file" id="fileInput" name="file"
                                        accept=".zip,application/zip,application/pdf" onchange="this.form.submit();" />
                                </div>
                            </form>
                            <?php if(!empty($attachment)): ?>
                            <div class="list-group list-group-hoverable mb-3">
                                <div class="list-group-item">
                                    <?=$attachment['file']?>
                                    <button type="button" class="btn btn-danger btn-sm delete"
                                        value="<?=$attachment['attachment_id']?>" style="padding:5px;float:right;">
                                        Remove&nbsp;<i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <?php endif;?>
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
                                    Copyright &copy; <?=date('Y')?>
                                    <a href="." class="link-secondary">CvSU-CCC ROTC Unit Portal</a>. All rights
                                    reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!--  END FOOTER  -->
        </div>
    </div>
    <?=view('cadet/templates/footer') ?>
    <script src="<?=base_url('assets/js/dropzone.js')?>" defer></script>
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow", function() {
                // Optional: Remove the element from the DOM after fade out
                $(this).remove();
            });
        }, 5000);
    });
    $(document).on('click', '.delete', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to remove this file?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, remove it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=site_url('remove-file')?>",
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
    </script>
</body>

</html>