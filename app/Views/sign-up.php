<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <title>Sign Up | CvSU CC ROTC Unit</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="<?=base_url('assets/css/demo.min.css')?>" rel="stylesheet" />
    <!-- END DEMO STYLES -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- BEGIN CUSTOM FONT -->
    <style>
    @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN DEMO THEME SCRIPT -->
    <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="text-center mb-0">CvSU CC ROTC UNIT</h2>
                                <h3 class="text-center mb-4">Register here</h3>
                                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('fail'); ?>
                                </div>
                                <?php endif; ?>
                                <form action="<?=base_url('register')?>" method="POST" autocomplete="off" novalidate>
                                    <?=csrf_field()?>
                                    <div class="mb-3">
                                        <label class="form-label">Student No</label>
                                        <input type="text" name="school_id" class="form-control"
                                            placeholder="e.g. ABC-00001" value="<?=set_value('school_id')?>"
                                            autocomplete="off" required />
                                        <div class="text-danger">
                                            <small><?=$validation->getError('school_id') ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row g-2">
                                            <div class="col-lg-5">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" name="lastname" class="form-control"
                                                    placeholder="e.g. Dela Cruz" value="<?=set_value('lastname')?>"
                                                    autocomplete="off" required />
                                                <div class="text-danger">
                                                    <small><?=$validation->getError('lastname') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="form-label">M.I.</label>
                                                <input type="text" name="middlename" class="form-control"
                                                    placeholder="C" value="<?=set_value('middlename')?>"
                                                    autocomplete="off" required />
                                                <div class="text-danger">
                                                    <small><?=$validation->getError('middlename') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <label class="form-label">First Name</label>
                                                <input type="text" name="firstname" class="form-control"
                                                    placeholder="e.g. Juan" value="<?=set_value('firstname')?>"
                                                    autocomplete="off" required />
                                                <div class="text-danger">
                                                    <small><?=$validation->getError('firstname') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="your@email.com" value="<?=set_value('email')?>"
                                            autocomplete="off" required />
                                        <div class="text-danger">
                                            <small><?=$validation->getError('email') ?></small>
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
                                                    <i id="icons" class="ti ti-eye-closed"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="text-danger">
                                            <small><?=$validation->getError('password') ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">
                                            Re-enter Password
                                        </label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" name="confirm_password" id="cpassword"
                                                class="form-control" placeholder="Your password" autocomplete="off"
                                                required />
                                            <span class="input-group-text">
                                                <a href="javascript:void(0);" onclick="toggles()" class="link-secondary"
                                                    title="Show password" data-bs-toggle="tooltip">
                                                    <i id="icons" class="ti ti-eye-closed"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="text-danger">
                                            <small><?=$validation->getError('confirm_password') ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" name="agreement" required />
                                            <span class="form-check-label">I agree with the terms and conditions</span>
                                        </label>
                                        <div class="text-danger">
                                            <small><?=$validation->getError('agreement') ?></small>
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">Create new account</button>
                                    </div>
                                </form>
                                <div class="text-center text-secondary mt-3">Already have account?
                                    <a href="<?=site_url('/')?>" tabindex="-1">Sign in</a>
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

    function toggles() {
        var x = document.getElementById("cpassword");
        if (x.type === "password") {
            x.type = "text";
            let elem = document.getElementById('icons');
            elem.classList.remove("ti-eye-closed");
            elem.classList.add("ti-eye");
        } else {
            x.type = "password";
            let elem = document.getElementById('icons');
            elem.classList.remove("ti-eye");
            elem.classList.add("ti-eye-closed");
        }
    }
    </script>
</body>

</html>