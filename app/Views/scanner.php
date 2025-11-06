<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <title><?=$title?> | CvSU-CCC - ROTC Unit Portal</title>
    <meta name="msapplication-TileColor" content="#066fd1" />
    <meta name="theme-color" content="#066fd1" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/vendors.min.css')?>" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="<?=base_url('assets/css/tabler-themes.min.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/demo.min.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- END DEMO STYLES -->
    <!-- BEGIN CUSTOM FONT -->
    <style>
    @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN DEMO THEME SCRIPT -->
    <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
    <!-- END DEMO THEME SCRIPT -->
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="text-center mb-0">CvSU-CCC ROTC Unit Portal</h2>
                                <h4 class="text-center mb-4"><?=$title?></h4>
                                <form method="POST" class="row g-1" id="form">
                                    <?=csrf_field()?>
                                    <input type="date" name="date" id="date" style="display: none;" />
                                    <input type="time" name="time" id="time" style="display: none;" />
                                    <input type="hidden" name="code" id="codeInput">
                                    <div class="col-lg-12 text-center">
                                        <label id="dates" style="font-size:20px;"></label><br />
                                        <small><span id="times"></span></small>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Attendance</label>
                                        <div class="form-selectgroup-boxes row mb-3">
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="status" value="In"
                                                        class="form-selectgroup-input" checked />
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">In</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="status" value="Out"
                                                        class="form-selectgroup-input" />
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">Out</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="status-error" class="error-message text-danger text-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-control" id="reader"></div>
                                    </div>
                                </form>
                                <div class="text-center text-secondary mt-3">
                                    Forgot password?<a href="<?=site_url('forgot-password')?>" tabindex="-1">
                                        Click here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <center><img src="<?=base_url('assets/images/logo.png')?>" alt="logo" class="w-50" /></center>
                </div>
            </div>
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
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url('assets/js/tabler.min.js')?>" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="<?=base_url('assets/js/demo.min.js')?>" defer></script>
    <!-- END DEMO SCRIPTS -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        updateClock();
        var themeConfig = {
            theme: "light",
            "theme-base": "gray",
            "theme-font": "sans-serif",
            "theme-primary": "blue",
            "theme-radius": "1",
        };
        var url = new URL(window.location);
        var form = document.getElementById("offcanvasSettings");
        var resetButton = document.getElementById("reset-changes");
        var checkItems = function() {
            for (var key in themeConfig) {
                var value = window.localStorage["tabler-" + key] || themeConfig[key];
                if (!!value) {
                    var radios = form.querySelectorAll(`[name="${key}"]`);
                    if (!!radios) {
                        radios.forEach((radio) => {
                            radio.checked = radio.value === value;
                        });
                    }
                }
            }
        };
        form.addEventListener("change", function(event) {
            var target = event.target,
                name = target.name,
                value = target.value;
            for (var key in themeConfig) {
                if (name === key) {
                    document.documentElement.setAttribute("data-bs-" + key, value);
                    window.localStorage.setItem("tabler-" + key, value);
                    url.searchParams.set(key, value);
                }
            }
            window.history.pushState({}, "", url);
        });
        resetButton.addEventListener("click", function() {
            for (var key in themeConfig) {
                var value = themeConfig[key];
                document.documentElement.removeAttribute("data-bs-" + key);
                window.localStorage.removeItem("tabler-" + key);
                url.searchParams.delete(key);
            }
            checkItems();
            window.history.pushState({}, "", url);
        });
        checkItems();
    });

    function updateClock() {
        const now = new Date();
        const date = now.toLocaleDateString();
        const time = now.toLocaleTimeString();
        document.getElementById('dates').textContent = `${date}`;
        document.getElementById('times').textContent = `${time}`;
        //date
        const yyyy = now.getFullYear();
        const mm = String(now.getMonth() + 1).padStart(2, '0');
        const dd = String(now.getDate()).padStart(2, '0');
        const formattedDate = `${yyyy}-${mm}-${dd}`;
        // Set the value of the date input
        document.getElementById('date').value = formattedDate;
        // Format time as HH:MM (24-hour)
        const hh = String(now.getHours()).padStart(2, '0');
        const min = String(now.getMinutes()).padStart(2, '0');
        const formattedTime = `${hh}:${min}`;
        document.getElementById('time').value = formattedTime;
    }
    setInterval(updateClock, 1000);

    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        var code = decodedText;
        // Log the result
        console.log(`Code matched = ${code}`, decodedResult);
        // Set the value in the hidden input
        $('#codeInput').val(code);
        const data = $('#form').serialize();
        $('#modal-loading').modal('show');
        $.ajax({
            url: "<?=base_url('save-attendance')?>",
            method: "POST",
            data: data,
            success: function(response) {
                $('#modal-loading').modal('hide');
                if (response.success) {
                    let timerInterval;
                    Swal.fire({
                        title: "Great!",
                        html: response.success.message,
                        icon: "success",
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                        }
                    });
                } else {
                    let timerInterval;
                    Swal.fire({
                        title: "Invalid QR Code!",
                        html: response.errors,
                        icon: "error",
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                        }
                    });
                }
            }
        });
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>

</html>