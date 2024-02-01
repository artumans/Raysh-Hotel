<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('',['filter' => 'CheckLoggedIn'], function ($routes) {

    //pages RESERVATION
    $routes->post('/', 'ReservationController::index');
    $routes->post('payment/setbook', 'ReservationController::setBooking');
    $routes->post('/rayshotel/public/payment/setbook', 'ReservationController::setBooking');
    $routes->post('payment', 'MidtransCon\PaymentController::index');
    $routes->post('/rayshotel/public/payment', 'MidtransCon\PaymentController::index');



    //pages PROFILE
    $routes->get('profile', 'ProfileController::index');
    $routes->get('/profile/history', 'ProfileController::contentHistory');
    $routes->get('/profile/userprofile', 'ProfileController::contentUserProfile');
    $routes->get('/profile/settings/', 'ProfileController::contentSettings');
    $routes->post('/profile/updateuser/(:num)', 'ProfileController::updateUser/$1');
    
    $routes->get('/rayshotel/public/profile', 'ProfileController::index');
    $routes->get('/rayshotel/public/profile/history', 'ProfileController::contentHistory');
    $routes->get('/rayshotel/public/profile/userprofile', 'ProfileController::contentUserProfile');
    $routes->get('/rayshotel/public/profile/settings', 'ProfileController::contentSettings');
    $routes->post('/rayshotel/public/profile/updateuser/(:num)', 'ProfileController::updateUser/$1');

    

    // Custom Signout
    $routes->get('signout', 'PagesCon::signOut');
    $routes->get('/rayshotel/public/profile/signout', 'PagesCon::signOut');
});

$routes->group('',['filter' => 'CheckAdminLoggedIn'], function ($routes) {
    $routes->get('admin', 'Admin\AdminController::dashboard');
    $routes->get('admin/dashboard', 'Admin\AdminController::dashboardMenu');
    $routes->get('admin/reservation', 'Admin\AdminController::reservationMenu');
    $routes->get('admin/room', 'Admin\AdminController::roomMenu');
    $routes->post('admin/find', 'Admin\AdminController::findByRoomType');



    $routes->get('admin/logout', 'Admin\AdminController::logout');
    $routes->get('/rayshotel/public/admin/logout', 'Admin\AdminController::logout');
});




$routes->get('/', 'ReservationController::index');


//TESTING
$routes->post('/testing', 'TestingController::index');



//pages RESERVATION
$routes->get('/rayshotel/public/home','ReservationController::index');
$routes->post('/rayshotel/public/home', 'ReservationController::index');


// Custom Login

        // USER
$routes->get('signin', 'PagesCon::index');
$routes->get('signin-form', 'PagesCon::signIn');
$routes->post('signin', 'PagesCon::signIn');

$routes->get('/rayshotel/public/signin', 'PagesCon::index');
$routes->get('/rayshotel/public/signin-form', 'PagesCon::signIn');
$routes->post('/rayshotel/public/signin', 'PagesCon::signIn');


        //  ADMIN
$routes->get('admin/signin', 'Admin\AdminController::index');
$routes->post('admin/signin', 'Admin\AdminController::index');

$routes->get('/rayshotel/public/admin/signin', 'Admin\AdminController::index');
$routes->post('/rayshotel/public/admin/signin', 'Admin\AdminController::index');




// Custom Register
$routes->get('signup', 'PagesCon::signUp');
$routes->post('signup', 'PagesCon::signUp');

$routes->get('/rayshotel/public/signup', 'PagesCon::signUp');
$routes->post('/rayshotel/public/signup', 'PagesCon::signUp');



// Payment Notification
$routes->post('payment/notifhandler', 'MidtransCon\PaymentController::notifHandler');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
