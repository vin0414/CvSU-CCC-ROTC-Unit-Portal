<?=view('cadet/templates/header') ?>
<style>
img {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

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
                                <?php if(empty($qrcode)): ?>
                                <form method="POST" class="row g-2" id="frmQRCode">
                                    <?=csrf_field()?>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-default">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-automation">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M13 20.693c-.905 .628 -2.36 .292 -2.675 -1.01a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.492 .362 1.716 2.219 .674 3.03" />
                                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                <path d="M17 22l5 -3l-5 -3z" />
                                            </svg>
                                            Generate
                                        </button>
                                    </div>
                                </form>
                                <?php endif;?>
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
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M7 17l0 .01" />
                                            <path
                                                d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M7 7l0 .01" />
                                            <path
                                                d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M17 7l0 .01" />
                                            <path d="M14 14l3 0" />
                                            <path d="M20 14l0 .01" />
                                            <path d="M14 14l0 3" />
                                            <path d="M14 20l3 0" />
                                            <path d="M17 17l3 0" />
                                            <path d="M20 17l0 3" />
                                        </svg>
                                        QR Code
                                    </div>
                                    <div class="card-actions">
                                        <button type="button" class="btn btn-primary">
                                            <i class="ti ti-download"></i>&nbsp;Download
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-lg-4 text-center">
                                            <div style="margin: 10px;">
                                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?=$qrcode['token'] ?? 'N/A' ?>"
                                                    alt="QRCode" class="mb-2"
                                                    style="border: 10px solid green;border-radius:10px 10px;" />
                                                <p class="bg-success text-white"
                                                    style="border-radius:10px 10px;font-size:20px;">SCAN ME</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row g-2">
                                                        <div class="col-lg-6">
                                                            <label class="form-label">CONTROL NO</label>
                                                            <p class="form-control">
                                                                <?= !empty($qrcode['control_number']) ? $qrcode['control_number'] : 'N/A' ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-label">STUDENTS NO</label>
                                                            <p class="form-control"><?= $student['school_id'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label class="form-label">STUDENT NAME</label>
                                                    <p class="form-control"><?= $student['fullname'] ?></p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label class="form-label">COURSE/YEAR/SECTION</label>
                                                    <p class="form-control">
                                                        <?= !empty($cadet['course']) ? $cadet['course'] : 'N/A' ?>
                                                        /<?= !empty($cadet['year']) ? $cadet['year'] : 'N/A' ?>
                                                        /<?= !empty($cadet['section']) ? $cadet['section'] : 'N/A' ?>
                                                    </p>
                                                </div>
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
    <div class="modal" id="modal-loading" data-backdrop="static">
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
    <?=view('cadet/templates/footer') ?>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <script>
    $('#frmQRCode').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $('#modal-loading').modal('show');
        $.ajax({
            url: "<?=site_url('generate-qr-code')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#modal-loading').modal('hide');
                if (response.success) {
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully generated",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            location.reload();
                        }
                    });
                } else {
                    alert(response.errors);
                }
            }
        });
    });
    </script>
</body>

</html>