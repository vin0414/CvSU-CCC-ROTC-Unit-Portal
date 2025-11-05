<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Scanner
$routes->get('scanner','Home::scanner');
//student
$routes->post('validateUser','Home::validateUser');
$routes->post('register','Home::register');
$routes->post('new-password','Home::newPassword');
$routes->get('logout','Home::logout');
$routes->post('upload-file','Home::uploadFile');
$routes->post('remove-file','Home::removeFile');
//ajax
$routes->post('save-profile','Home::saveProfile');
$routes->post('generate-qr-code','Cadet::qrCode');

$routes->group('',['filter'=>'AlreadyLoggedIn'],function($routes)
{
    $routes->get('/', 'Home::index');
    $routes->get('sign-up','Home::signUp');
    $routes->get('forgot-password', 'Home::forgotPassword');
    $routes->get('success/(:any)','Home::successLink/$1');
    $routes->get('resend/(:any)','Home::resend/$1');
    $routes->get('activate/(:any)','Home::activateAccount/$1');
});

$routes->group('',['filter'=>'AuthCheck'],function($routes)
{
    $routes->get('cadet/dashboard','Home::studentDashboard');
    $routes->get('cadet/profile','Home::studentProfile');
    $routes->get('cadet/qr-code','Home::qrCode');
    $routes->get('cadet/upload','Home::upload');
    $routes->get('cadet/trainings','Home::studentTrainings');
    $routes->get('cadet/attendance','Home::studentAttendance');
    $routes->get('cadet/performance','Home::studentPerformance');
    $routes->get('cadet/account-security','Home::accountSecurity');
});

//admin
$routes->post('checkAuth','Administrator::checkAuth');
$routes->get('sign-out','Administrator::logout');
$routes->get('download','Download::downloadFile');
$routes->post('restore','Restore::restoreFile');
//cadet
$routes->get('registered','Administrator::registeredUser');
$routes->get('enrolled','Administrator::enrolledCadet');
$routes->post('edit-cadet','Administrator::modifyCadet');
$routes->post('enroll-cadet','Administrator::enrollCadet');
//schedules
$routes->get('fetch-schedules','Administrator::fetchSchedule');
$routes->post('schedules/store','Administrator::storeSchedule');
//attendance
$routes->post('save-attendance','Administrator::saveAttendance');
//announcement
$routes->post('save-announcement','Administrator::saveAnnouncement');
$routes->post('edit-announcement','Administrator::modifyAnnouncement');
//maintenance
$routes->get('fetch-account','Administrator::fetchAccount');
$routes->post('save-account','Administrator::saveAccount');
$routes->post('edit-account','Administrator::modifyAccount');
$routes->get('fetch-permission','Administrator::fetchPermission');
$routes->post('save-permission','Administrator::savePermission');
$routes->post('edit-permission','Administrator::modifyPermission');

$routes->group('',['filter'=>'AdminCheck'],function($routes)
{
    $routes->get('dashboard','Administrator::index');
    //cadets
    $routes->get('cadets','Administrator::cadetInformation');
    $routes->get('cadets/edit/(:any)','Administrator::editCadet/$1');
    $routes->get('cadets/info/(:any)','Administrator::cadetInfo/$1');
    //schedules
    $routes->get('schedules','Administrator::trainingSchedule');
    $routes->get('schedules/create','Administrator::createSchedule');
    $routes->get('schedules/edit/(:any)','Administrator::editSchedule/$1');
    $routes->get('schedules/manage','Administrator::manageSchedule');
    //attendance
    $routes->get('attendance','Administrator::attendance');
    $routes->get('attendance/view/(:any)','Administrator::viewAttendance/$1');
    //grades
    $routes->get('evaluation','Administrator::gradingSystem');
    $routes->get('evaluation/upload','Administrator::uploadGradeBook');
    //announcement
    $routes->match(['get','post'],'announcement','Administrator::announcement');
    $routes->get('announcement/create','Administrator::createAnnouncement');
    $routes->get('announcement/edit/(:any)','Administrator::editAnnouncement/$1');
    //reports
    $routes->get('reports','Administrator::report');
    //maintenance
    $routes->get('maintenance/accounts','Administrator::accounts');
    $routes->get('maintenance/accounts/create','Administrator::createAccount');
    $routes->get('maintenance/accounts/edit/(:any)','Administrator::editAccount/$1');
    $routes->get('maintenance/recovery','Administrator::recovery');
    $routes->get('maintenance/settings','Administrator::settings');
    $routes->get('maintenance/permission/create','Administrator::createPermission');
    $routes->get('maintenance/permission/edit/(:any)','Administrator::editPermission/$1');
    //profile
    $routes->get('my-account','Administrator::myAccount');
});
$routes->group('',['filter'=>'AdminAlreadyLoggedIn'],function($routes)
{
    $routes->get('auth','Administrator::auth');
    $routes->get('reset-password', 'Administrator::resetPassword');
});