<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <title>Login | CvSU CC ROTC Unit</title>
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
                                <h2 class="text-center mb-0">CvSU-CCC</h2>
                                <h3 class="text-center mb-4">ROTC Unit Portal Login</h3>
                                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                                    <?= session()->getFlashdata('fail'); ?>
                                </div>
                                <?php endif; ?>
                                <form action="<?=base_url('validateUser')?>" method="POST" autocomplete="off"
                                    novalidate>
                                    <?=csrf_field()?>
                                    <div class="mb-3">
                                        <label class="form-label">Student No</label>
                                        <input type="text" name="student_number" class="form-control"
                                            placeholder="ABC-0001" autocomplete="off" required />
                                        <div class="text-danger">
                                            <small><?= $validation->getError('student_number'); ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">
                                            Password
                                        </label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Your password" autocomplete="off" required />
                                            <span class="input-group-text">
                                                <a href="javascript:void(0);" onclick="toggle()" class="link-secondary"
                                                    title="Show password" data-bs-toggle="tooltip">
                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                                    <i id="icon" class="ti ti-eye-closed"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="text-danger">
                                            <small><?= $validation->getError('password'); ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" />
                                            <span class="form-check-label">Remember me on this device</span>
                                        </label>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">Login</button>
                                    </div>
                                </form>
                                <div class="text-center text-secondary mt-3">Don't have an account?
                                    <a href="<?=site_url('sign-up')?>" tabindex="-1">Sign up here</a>
                                </div>
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
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url('assets/js/tabler.min.js')?>" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="<?=base_url('assets/js/demo.min.js')?>" defer></script>
    <!-- END DEMO SCRIPTS -->
    <script>
    function toggle() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            let elem = document.getElementById('icon');
            elem.classList.remove("ti-eye-closed");
            elem.classList.add("ti-eye");
        } else {
            x.type = "password";
            let elem = document.getElementById('icon');
            elem.classList.remove("ti-eye");
            elem.classList.add("ti-eye-closed");
        }
    }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
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
    </script>
</body>

</html>