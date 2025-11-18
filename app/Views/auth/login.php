<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/cvsu-logo.png')?>">
    <title>Login | CvSU CC ROTC Unit</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN DEMO STYLES -->
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
        <div class="container container-tight py-4">
            <center><img src="<?=base_url('assets/images/logo.png')?>" alt="logo" width="100px" class="mb-4" /></center>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center">CvSU CC ROTC Unit</h2>
                    <p class="text-center"><small>Login to your account</small></p>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <form action="<?=base_url('checkAuth')?>" method="POST" autocomplete="off" novalidate>
                        <?=csrf_field();?>
                        <div class="mb-3">
                            <label class="form-label">Account ID</label>
                            <input type="text" class="form-control" name="employee_id" placeholder="EMP-000001"
                                value="<?=set_value('employee_id')?>" autocomplete="off" />
                            <div class="text-danger">
                                <small><?= $validation->getError('employee_id'); ?></small>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="password" id="password" minlength="8"
                                    maxlength="16" placeholder="Your password"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    autocomplete="off" />
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
                            <button type="submit" class="btn btn-success w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">Forgot password? <a href="<?=base_url('reset-password')?>"
                    tabindex="-1">Click here</a></div>
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
</body>

</html>