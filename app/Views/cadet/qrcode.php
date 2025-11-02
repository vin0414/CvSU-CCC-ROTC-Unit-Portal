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
                            <div class="card">
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
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-lg-8">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x200&data=<?=$qrcode['token'] ?? 'N/A' ?>"
                                                alt="QRCode" class="form-control" />
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row g-1">
                                                        <div class="col-lg-12">
                                                            <img src="<?=site_url('assets/images/profile/')?><?=$student['photo']?>"
                                                                alt="photo" class="form-control"
                                                                style="height:150px;" />
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label class="form-label">Control #</label>
                                                            <p class="form-control">
                                                                <?=$qrcode['control_number'] ?? 'N/A' ?></p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label class="form-label">School ID</label>
                                                            <p class="form-control">
                                                                <?=$student['school_id'] ?? 'N/A' ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(empty($qrcode)): ?>
                                        <div class="col-lg-12">
                                            <form method="POST" class="row g-2" id="frmQRCode">
                                                <?=csrf_field()?>
                                                <div class="col-lg-12">
                                                    <button type="submit" class="form-control btn btn-primary">
                                                        Generate
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endif;?>
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