<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LangController;
use \App\Http\Controllers\SalesController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use \Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});


//password reset
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::post('profile-change-status', [RestaurantController::class, 'restaurantChangeStatus'])->name('profile-change-status');
//END PASSWORD RESET

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
Route::match(['get', 'post'], 'login', [AccountController::class, 'login'])->name('login')->middleware('guest');
Route::match(['get', 'post'], 'sign-up', [AccountController::class, 'SignUp'])->name('sign-up')->middleware('guest');
Route::get('log-out', [AccountController::class, 'logout'])->name('log-out')->middleware('auth');

//WIZARD ROUTES
Route::middleware(['auth', 'verified', 'approved', 'isRestaurant'])->group(function () {
    Route::match(['get', 'post'], 'general-information-step', [AccountController::class, 'general_information_step'])->name('general-information-step');
    Route::match(['get', 'post'], 'owner-details-step', [AccountController::class, 'owner_details_step'])->name('owner-details-step');
    Route::match(['get', 'post'], 'bank-address-step', [AccountController::class, 'bank_address_step'])->name('bank-address-step');
    Route::match(['get', 'post'], 'select-package-step', [AccountController::class, 'select_package_step'])->name('select-package-step');
});
Route::get('finished-application', function () {
    return view('layout.profile.finished-application');
})->name('finished-application')->middleware('auth');
//END WIZARD ROUTES


//EMAIL VERIFICATION
Route::get('/email/verify/{token}', [AccountController::class, 'verifyUser'])->name('verify');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/profile/' . auth()->id());
})->middleware('signed')->name('verification.verify');

Route::get('/email/verify', function () {
    return view('layout.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function () {
    Auth::user()->sendEmailVerificationNotification();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//END EMAIL VERIFICATION


Route::get('show-notifications', [NotificationController::class, 'show_notifications'])->name('show-notifications')->middleware(['auth']);
Route::Post('save-token', [NotificationController::class, 'saveToken'])->name('save-token');
Route::post('/handlePayment', [AccountController::class, 'handlePayment'])->name('handlePayment');
Route::post('/handlePaymentRenew', [RestaurantController::class, 'handlePayment_renew'])->name('handlePaymentRenew');
Route::post('check-code', [SalesController::class, 'check_code'])->name('check-code');


//MUTUAL OFFER ROUTES
Route::middleware('auth')->group(function () {
    Route::get('show-offers', 'Offer@show_offers')->name('show-offers');
    Route::get('show-approved-offers', 'Offer@show_approved_offers')->name('show-approved-offers');
    Route::get('show-rejected-offers', 'Offer@show_rejected_offers')->name('show-rejected-offers');
    Route::delete('delete-offer/{offer_model}', 'Offer@delete')->name('delete-offer');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('home', [AccountController::class, 'dashboard'])->name('home');
    Route::match(array('POST', 'GET'), 'grant-privileges/{account}', [AccountController::class, 'grantPrivileges'])->name('grant-privileges')->middleware('can:grant-privileges');

//    START RESTAURANTS MANAGEMENT
    Route::middleware(['can:manage-restaurants'])->group(function () {
        Route::match(['get', 'post'], 'change-Status', [RestaurantController::class, 'changeStatus'])->name('change-Status');
        Route::get('approve-application/{id}', [RestaurantController::class, 'approve_application'])->name('approve-application');
        Route::match(['get', 'post'], 'send-notes/{id}', [RestaurantController::class, 'send_notes'])->name('send-notes');
    });
    Route::get('all-restaurants', [RestaurantController::class, 'all_restaurants'])->name('all-restaurants')->middleware('can:show-restaurants');
    Route::get('non-approved-restaurant', [RestaurantController::class, 'non_approved_restaurant'])->name('non-approved-restaurant')->middleware('can:show-non-approved-restaurants');
//    END RESTAURANTS MANAGEMENT


//    START PAYMENTS
    Route::middleware(['can:show-payments'])->group(function () {
        Route::get('check-payments', [RestaurantController::class, 'check_payments'])->name('check-payments');
        Route::get('accept-payment/{id}', [RestaurantController::class, 'accept_payment'])->name('accept-payment');
    });
//    END PAYMENTS


    /*start offer*/
    Route::middleware(['can:manage-offers'])->group(function () {
        Route::get('show-offer-details-admin/{offer_id}', 'Offer@show_offer_details_admin')->name('show-offer-details-admin');
        Route::post('approve_offer', 'Offer@approve_offer')->name('approve_offer');
        Route::post('reject_offer', 'Offer@reject_offer')->name('reject_offer');
    });
    /*end offer*/


//  START REVIEW PDF
    Route::get('review-pdf/{id}', function (\Illuminate\Http\Request $request) {
        return view('layout.restaurant.review-license', ['id' => $request->id]);
    })->name('review-pdf');
    Route::get('make-pdf/{id}', [RestaurantController::class, 'view_license'])->name('make-pdf');
// END REVIEW PDF


//    START ADMINS
    Route::delete('delete-admin/{account}', [AccountController::class, 'delete_admin'])->name('delete-admin');
    Route::match(['get', 'post'], 'update-admin/{account}', [AccountController::class, 'update_admin'])->name('update-admin');
    Route::match(['get', 'post'], 'create-admin', [AccountController::class, 'create_admin'])->name('create-admin')->middleware('can:create-admin');
    Route::get('show-admins', [AccountController::class, 'show_admin'])->name('show-admins')->middleware('can:show-admins');
//END ADMINS


// START PACKAGES
    Route::middleware(['can:manage-packages'])->group(function () {
        Route::match(['GET', 'POST'], 'update-package/{id}', [PackageController::class, 'update_package'])->name('update-package');
        Route::delete('delete-package/{id}', [PackageController::class, 'delete_package'])->name('delete-package');
    });
    Route::match(['get', 'post'], 'add-package', [PackageController::class, 'add_package'])->name('add-package')->middleware('can:create-package');
    Route::get('all-packages', [PackageController::class, 'show_packages'])->name('all-packages')->middleware('can:show-packages');
//END PACKAGES


    /* start tax*/
    Route::middleware(['can:manage-tax'])->group(function () {
        Route::get('add-tax', 'Tax_Controller@add_tax')->name('add-tax');
        Route::post('add-tax', 'Tax_Controller@add_tax')->name('add-tax');
        Route::get('show-tax', 'Tax_Controller@show_tax')->name('show-tax');
    });
    /* end tax*/


    /* start restaurant  category Controller*/
    Route::match(['POST', 'GET'], 'add-category', 'category_controller@add_restaurant_category')->name('add-category')->middleware('can:create-category');
    Route::get('show-category', 'category_controller@show_restaurant_category')->name('show-category')->middleware('can:show-categories');
    Route::match(['POST', "GET"], 'edit-category/{category_id}', 'category_controller@edit_category')->name('edit-category')->middleware('can:manage-categories');
    /* end  restaurant  category Controller*/


    /* start restaurant sub category Controller*/
    Route::match(['POST', 'GET'], 'add-sub-category', 'sub_category@add_sub_category')->name('add-sub-category')->middleware('can:create-sub-categories');
    Route::get('show-sub-category', 'sub_category@show_sub_category')->name('show-sub-category')->middleware('can:show-sub-categories');
    Route::match(['POST', 'GET'], 'edit-sub-category/{category_id}', 'sub_category@edit_sub_category')->name('edit-sub-category')->middleware('can:manage-sub-categories');
    /* end restaurant sub category Controller*/


//START CUSTOMERS
    Route::get('show-customers', [AccountController::class, 'show_customers'])->name('show-customers')->middleware('can:show-customers');
    Route::post('customer-change-Status', [CustomerAuthController::class, 'customer_change_status'])->name('customer-change-Status')->middleware('can:manage-customers');
//END CUSTOMERS

//    START ARTICLES
    Route::match(['POST', 'GET'], 'store-article', [ArticlesController::class, 'store'])->name('store.article')->middleware('can:create-article');
    Route::GET('show-articles', [ArticlesController::class, 'index'])->name('show.articles')->middleware('can:show-articles');

    Route::middleware(['can:manage-articles'])->group(function () {
        Route::delete('delete-article/{article}', [ArticlesController::class, 'destroy'])->name('delete.article');
        Route::match(['GET', 'PATCH'], 'article-update/{article}', [ArticlesController::class, 'update'])->name('update.article');
    });
//    END ARTICLES


//    START ROLES AND PERMISSIONS
    Route::middleware(['can:manage-privileges'])->group(function () {
        Route::get('show-permissions', [PermissionController::class, 'showPermissions'])->name('show-permissions');
        Route::get('show-roles', [RoleController::class, 'showRoles'])->name('show-roles');
//        Route::match(['POST', 'GET'], 'add-permission', [PermissionController::class, 'addPermission'])->name('add-permission');
//        Route::match(['POST', 'GET'], 'edit-permission/{permission}', [PermissionController::class, 'editPermission'])->name('edit-permission');
        Route::match(['POST', 'GET'], 'add-role', [RoleController::class, 'addRole'])->name('add-role');
        Route::match(['POST', 'GET'], 'edit-role/{role}', [RoleController::class, 'editRole'])->name('edit-role');
//        Route::delete('delete-permission/{permission}', [PermissionController::class, 'destroy'])->name('delete-permission');
        Route::delete('delete-role/{role}', [RoleController::class, 'destroy'])->name('delete-role');
    });
//    END ROLES AND PERMISSIONS


});


Route::middleware(['hasCurrency', 'auth', 'approved', 'isExpired', 'isRestaurant'])->group(function () {

    Route::post('update-min_price', [RestaurantController::class, 'update_min_price_order_currency'])->name('update-min-price');

    Route::match(['get', 'post'], 'set-currency', [RestaurantController::class, 'set_currency'])->name('set-currency');
    Route::match(['get', 'post'], 'update-restaurant-info/{account}', [RestaurantController::class, 'update_restaurant_info'])->name('update-restaurant-info');

    Route::get('profile/{account}', [RestaurantController::class, 'restaurant_profile'])->name('profile');

    Route::post('clock-pick', [RestaurantController::class, 'clock_picker'])->name('clock-pick');

    Route::match(['get', 'post'], 'renew-subscription', [RestaurantController::class, 'renew_subscription'])->name('renew-subscription');
    Route::match(['get', 'post'], 'change-package', [RestaurantController::class, 'change_package'])->name('change-package');

    Route::get('profile/{id}', [RestaurantController::class, 'restaurant_profile'])->name('profile');

    Route::post('clock-pick', [RestaurantController::class, 'clock_picker'])->name('clock-pick');

//    REGISTRATION WIZARD
    Route::match(['get', 'post'], 'signup-wizard', [AccountController::class, 'signup_wizard'])->name('signup_wizard')->middleware('verified');
//    END OF THE REGISTRATION WIZARD

    /* end restaurant sub categoryController*/

    /* start Component*/
    Route::get('add-component', 'component@add_component')->name('add-component');
    Route::post('add-component', 'component@add_component')->name('add-component');

    Route::get('show-components', 'component@show_component')->name('show-components');
    Route::post('show-components', 'component@show_component')->name('show-components');


    Route::get('edit-component/{component_id}', 'component@edit_component')->name('edit-component');
    Route::post('edit-component/{component_id}', 'component@edit_component')->name('edit-component');

    /* end Component*/

    /* start Item*/
    Route::get('add-item', 'item@add_item')->name('add-item');
    Route::post('add-item', 'item@add_item')->name('add-item');

    Route::get('show-items', 'item@show_items')->name('show-items');
    Route::post('show-items', 'item@show_items')->name('show-items');


    Route::get('edit-item/{item_id}', 'item@edit_item')->name('edit-item');
    Route::post('edit-item/{item_id}', 'item@edit_item')->name('edit-item');

    Route::post('get_items_by_cat', 'item@get_items_by_cat')->name('get_items_by_cat');

    Route::post('get_menus_by_par', 'item@get_menus_by_par')->name('get_menus_by_par');


    /* end itemController*/


    /* start belongings*/

    Route::get('add-belongings/{item_id}', 'item_belonging@add_belongings')->name('add-belongings');
    Route::post('add-belonging', 'item_belonging@add_belonging')->name('add-belonging');

    /* end belongings*/

    /* start Orders */


    Route::get('show-orders', 'Order@show_orders')->name('show-orders');
    Route::post('pass_order', 'Order@pass_order')->name('pass_order');
    Route::get('order-details/{order_id}', 'Order@order_details')->name('order-details');


    Route::get('print-order', 'Order@print_order')->name('print-order');

    Route::get('show-rejected-orders', 'Order@show_rejected_orders')->name('show-rejected-orders');
    Route::get('show-not-finished-orders', 'Order@show_not_finished_orders')->name('show-not-finished-orders');


    /* end orders*/

    /* start comments */

    Route::get('show-new-comments', 'Comment@show_new_comments')->name('show-new-comments');
    Route::get('show-comments', 'Comment@show_comments')->name('show-comments');
    Route::post('approve_comment', 'Comment@approve_comment')->name('approve_comment');
    /* end comments*/

    /* start Evaluation*/

    /* End Evaluation*/

    /* start coupon*/
    Route::get('add-coupon', 'Coupon@add_coupon')->name('add-coupon');
    Route::post('add-coupon', 'Coupon@add_coupon')->name('add-coupon');

    Route::get('show-coupon', 'Coupon@show_coupon')->name('show-coupon');

    Route::get('edit-coupon/{coupon_id}', 'Coupon@edit_coupon')->name('edit-coupon');
    Route::post('edit-coupon/{coupon_id}', 'Coupon@edit_coupon')->name('edit-coupon');

    /* end coupon*/

    /*start offer*/
    Route::get('add-offer', 'Offer@add_offer')->name('add-offer');
    Route::post('add-offer', 'Offer@add_offer')->name('add-offer');
    Route::get('show-offer-details/{offer_id}', 'Offer@show_offer_details')->name('show-offer-details');
    Route::get('edit-offer/{offer_id}', 'Offer@edit_offer')->name('edit-offer');
    Route::post('edit-offer/{offer_id}', 'Offer@edit_offer')->name('edit-offer');

    Route::post('sub-category-image', [RestaurantController::class, 'sub_category_image'])->name('sub-category-image');
    /*end offer*/

});

/* Portal */
Route::get('/p-login', [App\Http\Controllers\Api\Portal\PortalController::class, 'set_login']);
Route::get('/p-logout', [App\Http\Controllers\Api\Portal\PortalController::class, 'logout']);












