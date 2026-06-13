<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default home route
$routes->get('/', 'Home::index');

// Page routes for main website
$routes->get('about', 'About::index');
$routes->get('service', 'Service::index');
$routes->get('product', 'Product::index');
$routes->get('feature', 'Feature::index');
$routes->get('quote', 'Quote::index');
$routes->get('team', 'Team::index');
$routes->get('testimonial', 'Testimonial::index');
$routes->get('safety-tips', 'SafetyTips::index');
$routes->get('safety-tips/more', 'SafetyTips::moreTips');
$routes->get('contact', 'Contact::index');

$routes->post(
    'contact/submit',
    'Contact::submit'
);

// 404 route
$routes->get('404', 'NotFound::index');

// ============================================================
// PUBLIC AUTH ROUTES
// ============================================================

$routes->get('admin', 'Admin\Auth::login');
// $routes->post('login', 'Admin\Auth::login');
$routes->match(['get', 'post'], 'login', 'Admin\Auth::login');
$routes->match(
    ['get', 'post'],
    'forgot-password',
    'Admin\Auth::forgotPassword'
);

$routes->match(
    ['get', 'post'],
    'reset-password/(:any)',
    'Admin\Auth::resetPassword/$1'
);
// $routes->get('forgot-password', 'Admin\Auth::forgotPassword');
// $routes->post('forgot-password', 'Admin\Auth::forgotPassword');

$routes->get(
    'verification-sent',
    'Admin\Auth::verificationSent'
);
$routes->get('reset-password/(:any)', 'Admin\Auth::resetPassword/$1');
$routes->post('reset-password/(:any)', 'Admin\Auth::resetPassword/$1');
$routes->get('logout', 'Admin\Auth::logout');
$routes->get('create-admin', 'Admin\Users::createAdmin');
$routes->post('create-admin', 'Admin\Users::createAdmin');

// ============================================================
// PROTECTED ADMIN ROUTES
// ============================================================

$routes->group('admin', ['filter' => 'admin_auth'], function ($routes) {
    $routes->get('/', function () {
        return redirect()->to('admin/home');
    });
    $routes->get('home', 'Admin\Home::index');
    $routes->get('profile', 'Admin\Home::profile');
    $routes->post('profile', 'Admin\Home::profile');
    $routes->get('settings', 'Admin\Home::settings');
    $routes->post('settings', 'Admin\Home::settings');
    // $routes->get('users', 'Admin\Users::index');
    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */
    $routes->get('users', 'Admin\Users::index', ['filter' => 'permission:users.view']);

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    $routes->match(['GET', 'POST'], 'users/create', 'Admin\Users::create', ['filter' => 'permission:users.create']);


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    $routes->match(
        ['GET', 'POST'],
        'users/edit/(:num)',
        'Admin\Users::edit/$1',
        [
            'filter' =>
            'permission:users.edit'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    $routes->post(
        'users/delete/(:num)',
        'Admin\Users::delete/$1',
        [
            'filter' =>
            'permission:users.delete'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | STATUS TOGGLE
    |--------------------------------------------------------------------------
    */

    $routes->post(
        'users/status/(:num)',
        'Admin\Users::status/$1',
        [
            'filter' =>
            'permission:users.edit'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'users/search',
        'Admin\Users::search',
        [
            'filter' =>
            'permission:users.view'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | SEND TEMP PASSWORD
    |--------------------------------------------------------------------------
    */
    $routes->post(
        'users/send-temp-password/(:num)',
        'Admin\Users::sendTempPassword/$1',
        [
            'filter' =>
            'permission:users.edit'
        ]
    );

    /* 
    | -----------------------------------------------------------------
    | CHANGE TEMP PASSWORD
    | -----------------------------------------------------------------
    */
    $routes->match(
        ['GET', 'POST'],
        'change-temp-password',
        'Admin\Auth::changeTempPassword'
    );

    // ============================================================ 
    // ROLES ROUTES
    // ============================================================
    $routes->get(
        'roles',
        'Admin\Roles::index',
        [
            'filter' =>
            'permission:roles.view'
        ]
    );

    $routes->post(
        'roles/create',
        'Admin\Roles::create',
        [
            'filter' =>
            'permission:roles.create'
        ]
    );

    $routes->match(
        ['GET', 'POST'],
        'roles/edit/(:num)',
        'Admin\Roles::edit/$1',
        [
            'filter' =>
            'permission:roles.edit'
        ]
    );

    $routes->post(
        'roles/delete/(:num)',
        'Admin\\Roles::delete/$1',
        [
            'filter' =>
            'permission:roles.delete'
        ]
    );

    $routes->match(
        ['GET', 'POST'],
        'roles/permissions/(:num)',
        'Admin\Roles::permissions/$1',
        [
            'filter' =>
            'permission:roles.permissions'
        ]
    );


    // ============================================================ 
    // PERMISSIONS ROUTES
    // ============================================================ 

    $routes->get(
        'permissions',
        'Admin\Permissions::index',
        [
            'filter' =>
            'permission:permissions.view'
        ]
    );

    $routes->post(
        'permissions/create',
        'Admin\Permissions::create',
        [
            'filter' =>
            'permission:permissions.create'
        ]
    );


    $routes->match(
        ['GET', 'POST'],
        'permissions/edit/(:num)',
        'Admin\Permissions::edit/$1',
        [
            'filter' =>
            'permission:permissions.edit'
        ]
    );

    $routes->post(
        'permissions/delete/(:num)',
        'Admin\Permissions::delete/$1',
        [
            'filter' =>
            'permission:permissions.delete'
        ]
    );

    // ============================================================ 
    // ACCOUNT SETTINGS ROUTES
    // ============================================================
    $routes->match(
        ['get', 'post'],
        'account-settings',
        'Admin\\Profile::accountSettings'
    );

    $routes->get(
        'homepage/homepage',
        'Admin\\Homepage::homepage'
    );

    $routes->get(
        'homepage/sliders',
        'Admin\\Homepage::sliders'
    );

    $routes->get(
        'homepage/createslider',
        'Admin\\Homepage::createSlider'
    );

    $routes->post(
        'homepage/store-slider',
        'Admin\\Homepage::storeSlider'
    );

    $routes->get(
        'homepage/edit/(:num)',
        'Admin\Homepage::editSlider/$1'
    );
    $routes->post(
        'homepage/delete/(:num)',
        'Admin\Homepage::deleteSlider/$1'
    );

    $routes->get(
        'homepage/statistics',
        'Admin\Homepage::statistics'
    );

    $routes->get(
        'homepage/statistics_create',
        'Admin\Homepage::createStatistic'
    );

    $routes->post(
        'homepage/statistics_store',
        'Admin\Homepage::storeStatistic'
    );

    $routes->get(
        'homepage/statistics_edit/(:num)',
        'Admin\Homepage::editStatistic/$1'
    );

    $routes->post(
        'homepage/statistics_update/(:num)',
        'Admin\Homepage::updateStatistic/$1'
    );

    $routes->get(
        'homepage/sliders_edit/(:num)',
        'Admin\Homepage::editSlider/$1'
    );

    $routes->post(
        'homepage/sliders-update/(:num)',
        'Admin\Homepage::updateSlider/$1'
    );

    $routes->post(
        'homepage/sliders-delete/(:num)',
        'Admin\Homepage::deleteSlider/$1'
    );

    $routes->get(
        'homepage/about',
        'Admin\Homepage::about'
    );

    $routes->post(
        'homepage/about-update',
        'Admin\Homepage::aboutUpdate'
    );

    $routes->get(
        'homepage/services-header',
        'Admin\Homepage::servicesHeader'
    );

    $routes->post(
        'homepage/services-header-update',
        'Admin\Homepage::servicesHeaderUpdate'
    );

    $routes->get(
        'homepage/services',
        'Admin\Homepage::services'
    );

    $routes->get(
        'homepage/services-create',
        'Admin\Homepage::createService'
    );

    $routes->post(
        'homepage/services-store',
        'Admin\Homepage::storeService'
    );

    $routes->get(
        'homepage/services-edit/(:num)',
        'Admin\Homepage::editService/$1'
    );

    $routes->post(
        'homepage/services-update/(:num)',
        'Admin\Homepage::updateService/$1'
    );

    $routes->post(
        'homepage/services-delete/(:num)',
        'Admin\Homepage::deleteService/$1'
    );

    $routes->get(
        'homepage/choose-us',
        'Admin\Homepage::chooseUs'
    );

    $routes->post(
        'homepage/choose-us-update',
        'Admin\Homepage::chooseUsUpdate'
    );

    $routes->get(
        'aboutpage',
        'Admin\Aboutpage::index'
    );

    $routes->post(
        'aboutpage/update',
        'Admin\Aboutpage::update'
    );

    $routes->get(
        'aboutpage/company-intro',
        'Admin\Aboutpage::companyIntro'
    );

    $routes->post(
        'aboutpage/company-intro-update',
        'Admin\Aboutpage::updateCompanyIntro'
    );

    $routes->get(
        'aboutpage/vision',
        'Admin\Aboutpage::vision'
    );

    $routes->post(
        'aboutpage/vision-update',
        'Admin\Aboutpage::updateVision'
    );

    $routes->get(
        'aboutpage/about-fine-gas',
        'Admin\Aboutpage::aboutFineGas'
    );

    $routes->post(
        'aboutpage/about-fine-gas-update',
        'Admin\Aboutpage::updateAboutFineGas'
    );

    $routes->get(
        'aboutpage/page-header',
        'Admin\Aboutpage::pageHeader'
    );

    $routes->post(
        'aboutpage/page-header-update',
        'Admin\Aboutpage::updatePageHeader'
    );

    $routes->get(
        'servicepage/index',
        'Admin\Servicepage::index'
    );

    $routes->get(
        'servicepage/page-header',
        'Admin\Servicepage::pageHeader'
    );

    $routes->post(
        'servicepage/page-header-update',
        'Admin\Servicepage::updatePageHeader'
    );

    $routes->get(
        'servicepage/service-header',
        'Admin\Servicepage::serviceHeader'
    );

    $routes->post(
        'servicepage/service-header-update',
        'Admin\Servicepage::updateServiceHeader'
    );

    $routes->get(
        'servicepage/services',
        'Admin\Servicepage::services'
    );

    $routes->get(
        'servicepage/create-service',
        'Admin\Servicepage::createService'
    );

    $routes->post(
        'servicepage/store-service',
        'Admin\Servicepage::storeService'
    );

    $routes->get(
        'servicepage/edit-service/(:num)',
        'Admin\Servicepage::editService/$1'
    );

    $routes->post(
        'servicepage/update-service/(:num)',
        'Admin\Servicepage::updateService/$1'
    );

    $routes->post(
        'servicepage/delete-service/(:num)',
        'Admin\Servicepage::deleteService/$1'
    );

    $routes->get(
        'contactpage',
        'Admin\Contactpage::index'
    );

    // $routes->get('contactpage', 'Admin\Contactpage::index');

    $routes->get('contactpage/page-header', 'Admin\Contactpage::pageHeader');
    $routes->post('contactpage/page-header-update', 'Admin\Contactpage::updatePageHeader');

    $routes->get('contactpage/contact-intro', 'Admin\Contactpage::contactIntro');
    $routes->post('contactpage/contact-intro-update', 'Admin\Contactpage::updateContactIntro');

    $routes->get('contactpage/contact-info', 'Admin\Contactpage::contactInfo');

    $routes->get('contactpage/create-contact-info', 'Admin\Contactpage::createContactInfo');
    $routes->post('contactpage/store-contact-info', 'Admin\Contactpage::storeContactInfo');

    $routes->get('contactpage/edit-contact-info/(:num)', 'Admin\Contactpage::editContactInfo/$1');
    $routes->post('contactpage/update-contact-info/(:num)', 'Admin\Contactpage::updateContactInfo/$1');

    $routes->post('contactpage/delete-contact-info/(:num)', 'Admin\Contactpage::deleteContactInfo/$1');

    // $routes->get(
    //     'testimonialpage',
    //     'Admin\Testimonialpage::index'
    // );

    // $routes->get(
    //     'testimonialpage/page-header',
    //     'Admin\Testimonialpage::pageHeader'
    // );

    // $routes->post(
    //     'testimonialpage/page-header-update',
    //     'Admin\Testimonialpage::updatePageHeader'
    // );

    // $routes->get(
    //     'testimonialpage/testimonial-header',
    //     'Admin\Testimonialpage::testimonialHeader'
    // );

    // $routes->post(
    //     'testimonialpage/testimonial-header-update',
    //     'Admin\Testimonialpage::updateTestimonialHeader'
    // );


    // $routes->get(
    //     'testimonialpage/testimonial',
    //     'Admin\Testimonialpage::testimonials'
    // );

    // $routes->get(
    //     'testimonialpage/create-testimonial',
    //     'Admin\Testimonialpage::createTestimonial'
    // );

    // $routes->post(
    //     'testimonialpage/store-testimonial',
    //     'Admin\Testimonialpage::storeTestimonial'
    // );

    // $routes->get(
    //     'testimonialpage/edit-testimonial/(:num)',
    //     'Admin\Testimonialpage::editTestimonial/$1'
    // );

    // $routes->post(
    //     'testimonialpage/update-testimonial/(:num)',
    //     'Admin\Testimonialpage::updateTestimonial/$1'
    // );

    // $routes->post(
    //     'testimonialpage/delete-testimonial/(:num)',
    //     'Admin\Testimonialpage::deleteTestimonial/$1'
    // );

    // Testimonial Page Routes
    $routes->group('testimonialpage', function ($routes) {

        $routes->get('/', 'Admin\Testimonialpage::index');

        $routes->get('page-header', 'Admin\Testimonialpage::pageHeader');
        $routes->post('page-header-update', 'Admin\Testimonialpage::updatePageHeader');

        $routes->get('testimonial-header', 'Admin\Testimonialpage::testimonialHeader');
        $routes->post('testimonial-header-update', 'Admin\Testimonialpage::updateTestimonialHeader');

        $routes->get('testimonials', 'Admin\Testimonialpage::testimonials');

        $routes->get('create-testimonial', 'Admin\Testimonialpage::createTestimonial');
        $routes->post('store-testimonial', 'Admin\Testimonialpage::storeTestimonial');

        $routes->get('edit-testimonial/(:num)', 'Admin\Testimonialpage::editTestimonial/$1');
        $routes->post('update-testimonial/(:num)', 'Admin\Testimonialpage::updateTestimonial/$1');

        $routes->post('delete-testimonial/(:num)', 'Admin\Testimonialpage::deleteTestimonial/$1');
    });

    // Team Page Routes
    $routes->get(
        'teampage',
        'Admin\Teampage::index'
    );

    $routes->get('teampage', 'Admin\Teampage::index');

    $routes->get('teampage/page-header', 'Admin\Teampage::pageHeader');
    $routes->post('teampage/page-header-update', 'Admin\Teampage::updatePageHeader');

    $routes->get('teampage/team-header', 'Admin\Teampage::teamHeader');
    $routes->post('teampage/team-header-update', 'Admin\Teampage::updateTeamHeader');

    $routes->get('teampage/team-members', 'Admin\Teampage::teamMembers');

    $routes->get('teampage/create-team-member', 'Admin\Teampage::createTeamMember');
    $routes->post('teampage/store-team-member', 'Admin\Teampage::storeTeamMember');

    $routes->get('teampage/edit-team-member/(:num)', 'Admin\Teampage::editTeamMember/$1');
    $routes->post('teampage/update-team-member/(:num)', 'Admin\Teampage::updateTeamMember/$1');

    $routes->post('teampage/delete-team-member/(:num)', 'Admin\Teampage::deleteTeamMember/$1');

    // Product Page Routes
    $routes->get(
        'productpage',
        'Admin\Productpage::index'
    );

    $routes->get('productpage', 'Admin\Productpage::index');

    $routes->get('productpage/page-header', 'Admin\Productpage::pageHeader');
    $routes->post('productpage/page-header-update', 'Admin\Productpage::updatePageHeader');

    $routes->get('productpage/product-header', 'Admin\Productpage::productHeader');
    $routes->post('productpage/product-header-update', 'Admin\Productpage::updateProductHeader');

    $routes->get('productpage/products', 'Admin\Productpage::products');

    $routes->get('productpage/create-product', 'Admin\Productpage::createProduct');
    $routes->post('productpage/store-product', 'Admin\Productpage::storeProduct');

    $routes->get('productpage/edit-product/(:num)', 'Admin\Productpage::editProduct/$1');
    $routes->post('productpage/update-product/(:num)', 'Admin\Productpage::updateProduct/$1');

    $routes->post('productpage/delete-product/(:num)', 'Admin\Productpage::deleteProduct/$1');


    /*
    |--------------------------------------------------------------------------
    | CONTACT MESSAGES ROUTES
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'contact-messages',
        'Admin\ContactMessages::index'
    );

    $routes->get(
        'contact-messages/view/(:num)',
        'Admin\ContactMessages::view/$1'
    );

    $routes->get(
        'contact-messages/mark-read/(:num)',
        'Admin\ContactMessages::markRead/$1'
    );

    $routes->get(
        'contact-messages/mark-unread/(:num)',
        'Admin\ContactMessages::markUnread/$1'
    );

    $routes->get(
        'contact-messages/delete/(:num)',
        'Admin\ContactMessages::delete/$1'
    );

    // ============================================================
    // SAFETY TIPS ROUTES
    // ============================================================
    // Safety Tips Page CMS Routes
    $routes->group('safetypage', function ($routes) {

        $routes->get('/', 'Admin\Safetypage::index');

        $routes->get('page-header', 'Admin\Safetypage::pageHeader');
        $routes->post('page-header-update', 'Admin\Safetypage::updatePageHeader');

        $routes->get('safety-header', 'Admin\Safetypage::safetyHeader');
        $routes->post('safety-header-update', 'Admin\Safetypage::updateSafetyHeader');

        $routes->get('safety-tips', 'Admin\Safetypage::safetyTips');

        $routes->get('create-safety-tip', 'Admin\Safetypage::createSafetyTip');
        $routes->post('store-safety-tip', 'Admin\Safetypage::storeSafetyTip');

        $routes->get('edit-safety-tip/(:num)', 'Admin\Safetypage::editSafetyTip/$1');
        $routes->post('update-safety-tip/(:num)', 'Admin\Safetypage::updateSafetyTip/$1');

        $routes->post('delete-safety-tip/(:num)', 'Admin\Safetypage::deleteSafetyTip/$1');

        $routes->get('emergency-header', 'Admin\Safetypage::emergencyHeader');
        $routes->post('emergency-header-update', 'Admin\Safetypage::updateEmergencyHeader');

        $routes->get('emergency-contact', 'Admin\Safetypage::emergencyContact');
        $routes->post('emergency-contact-update', 'Admin\Safetypage::updateEmergencyContact');
    });
});




// ============================================================
// USER CREATION AND VERIFICATION ROUTES
// ============================================================
$routes->get(
    'verify-email/(:any)',
    'Admin\Auth::verifyEmail/$1'
);


// ============================================================ 
// VERIFICATION ROUTES
// ============================================================
$routes->get('verification', 'Admin\Auth::verify');

$routes->post('verification/verify', 'Admin\Auth::verifyCode');

$routes->post('verification/resend', 'Admin\Auth::resendCode');

// Test route for email
// $routes->get('test-email', 'Admin\Auth::testEmail');

// Set 404 override
$routes->set404Override(function () {
    echo view('pages/404', ['title' => '404 Page Not Found - Fine Gas']);
});
