<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <!-- BEGIN NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <div class="nav-item">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-1">
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-1">
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </a>
                </div>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-1">
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="badge bg-red text-white">
                            <?php 
                            $model = new \App\Models\notificationModel();
                            $total = $model->where('account_id',session()->get('loggedAdmin'))
                                    ->where('status',0)
                                    ->countAllResults();
                            echo $total;
                            ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title">Notifications</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <?php 
                                $db = \Config\Database::connect();
                                $query = $db->table('notifications a')
                                        ->select('a.announcement_id,b.title,b.details')
                                        ->join('announcement b','b.announcement_id=a.announcement_id','LEFT')
                                        ->where('a.account_id',session()->get('loggedAdmin'))->where('a.status',0)
                                        ->get()->getResult();
                                foreach($query as $row)
                                { ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="<?= site_url('announcement/view/') ?><?= $row->announcement_id ?>"
                                                class="text-body d-block"><?= $row->title ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                <?= $row->details ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="<?=site_url('dashboard')?>" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url(<?=base_url('assets/images/user.png')?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?=session()->get('fullname')?></div>
                        <?php
                        $roleModel = new \App\Models\roleModel();
                        $role = $roleModel->where('role_id', session()->get('role'))->first();
                        if ($role) {
                            echo '<div class="mt-1 small text-secondary">' . $role['role_name'] . '</div>';
                        } else {
                            echo '<div class="mt-1 small text-secondary">No Role</div>';
                        }
                        ?>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?=site_url('my-account')?>" class="dropdown-item">My Account</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=site_url('sign-out')?>" class="dropdown-item">Sign-out</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <!-- BEGIN NAVBAR MENU -->
                <ul class="navbar-nav">
                    <li class="nav-item <?= ($title == 'Overview') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('dashboard')?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-1">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title"> Overview </span>
                        </a>
                    </li>
                    <?php if($role['cadet']==1): ?>
                    <li class="nav-item <?= ($title == 'Cadets') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('cadets')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Cadets</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($role['schedule']==1): ?>
                    <li class="nav-item <?= ($title == 'Plans') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('schedules')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M7 14h.013" />
                                <path d="M10.01 14h.005" />
                                <path d="M13.01 14h.005" />
                                <path d="M16.015 14h.005" />
                                <path d="M13.015 17h.005" />
                                <path d="M7.01 17h.005" />
                                <path d="M10.01 17h.005" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Plans </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($role['attendance']==1): ?>
                    <li class="nav-item <?= ($title == 'Attendance') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('attendance')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-clock">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h10" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M18 16.5v1.5l.5 .5" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Attendance </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($role['grading_system']==1): ?>
                    <li class="nav-item <?= ($title == 'Gradebook') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('gradebook')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-vocabulary">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                                <path d="M12 5v16" />
                                <path d="M7 7h1" />
                                <path d="M7 11h1" />
                                <path d="M16 7h1" />
                                <path d="M16 11h1" />
                                <path d="M16 15h1" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Grades </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($role['report']==1): ?>
                    <li class="nav-item <?= ($title == 'Reports') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('reports')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                <path d="M18 14v4h4" />
                                <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M8 11h4" />
                                <path d="M8 15h3" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Reports </span>
                        </a>
                    </li>
                    <?php endif;?>
                    <?php if($role['announcement']==1): ?>
                    <li class="nav-item <?= ($title == 'Announcement') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=site_url('announcement')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-speakerphone">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M18 8a3 3 0 0 1 0 6" />
                                <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
                                <path
                                    d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
                            </svg>
                            <span class="nav-link-title">&nbsp;Announcement </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($role['maintenance']==1): ?>
                    <li
                        class="nav-item dropdown <?= ($title == 'Back-up and Recovery'||$title == 'Settings') ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/lifebuoy -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">&nbsp;Maintenance </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?=site_url('maintenance/recovery')?>">
                                Back-Up and Restore
                            </a>
                            <a class="dropdown-item" href="<?=site_url('maintenance/accounts')?>">
                                Accounts
                            </a>
                            <a class="dropdown-item" href="<?=site_url('maintenance/settings')?>">
                                Settings
                            </a>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- END NAVBAR MENU -->
            </div>
        </div>
    </div>
</header>