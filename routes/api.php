<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Order;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CustomerAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//RESTAURANT REGISTER

Route::get('marketing/companies/{id}', [\App\Http\Controllers\RestaurantController::class, 'account_by_code']);
Route::post('restaurant_reg', [AccountController::class, 'api_restaurant_registration'])->name('restaurant-reg');
Route::post('restaurant_login', [AccountController::class, 'api_restaurant_login'])->name('restaurant-login');
Route::post('check_email', [AccountController::class, 'check_email'])->name('check-email');
Route::post('check_phone_number', [AccountController::class, 'check_phone_number'])->name('check-phone-number');
Route::post('login', [CustomerAuthController::class, 'login'])->name('login');
Route::post('sign-up', [CustomerAuthController::class, 'register'])->name('sign-up');
Route::post('add-address', [CustomerAuthController::class, 'add_address'])->name('create-address');

Route::post('get-account-types', 'General@get_account_types')->name('get-account-types');
Route::post('get-menu-types', 'General@get_menu_types')->name('get-menu-types');
Route::post('get-offers', 'General@get_offers')->name('get-offers');
Route::post('get-offer-details', 'General@get_offer_details')->name('get-offer-details');


Route::post('get-restaurant', 'General@get_restaurant')->name('get-restaurant');
Route::post('get-last-items', 'item@get_last_items')->name('get-last-items');
Route::post('get-same-restaurants', 'General@get_same_restaurants')->name('get-same-restaurants');
Route::post('get-trend', 'item@get_trend')->name('get-trend');
Route::post('get-filters', 'General@get_filters')->name('get-filters');
//Route::post('get-account-filters', 'General@get_accounts_filters')->name('get-account-filters');

Route::post('get-account-filters', 'General@get_account_filters')->name('get-account-filters');
Route::post('get-accounts-by-filters', 'AccountController@get_accounts_by_filters')->name('get-accounts-by-filters');


Route::post('verify-order', [Order::class, 'verify_order'])->name('verify-order');
Route::post('get-accounts-by-sub-menu', 'General@get_accounts_by_sub_menu')->name('get-accounts-by-sub-menu');

/*start cart item*/

Route::post('add-to-cart', 'Cart@add_to_cart')->name('add-to-cart');
Route::post('remove-from-cart', 'Cart@remove_from_cart')->name('remove-from-cart');
Route::post('update-cart', 'Cart@update_cart')->name('update-cart');
Route::post('show-cart', 'Cart@show_cart')->name('show-cart');
Route::post('show-cart-item', 'Cart@show_cart_item')->name('show-cart-item');


/*end cart item*/

/* start country */

Route::post('get-countries', 'General@get_countries')->name('get-countries');

/*end country*/

/* start city */

Route::post('get-cities', 'General@get_cities')->name('get-cities');

/*end city*/

/* start area */

Route::post('get-areas', 'General@get_areas')->name('get-areas');

/*end area*/

/*start eval*/

Route::post('add-eval', 'Evaluation@add_eval')->name('add-eval');
Route::post('get-eval', 'Evaluation@get_eval')->name('get-eval');
Route::post('get-all-eval', 'Evaluation@get_all_eval')->name('get-all-eval');


/*end eval*/

/* start restaurant by area */

Route::post('get-restaurants-by-area', 'General@get_restaurants_by_area')->name('get-restaurants-by-area');
Route::post('get-restaurants-count-by-area', 'General@get_restaurants_count_by_area')->name('get-restaurants-count-by-area');

Route::post('get-restaurants-by-location', 'General@get_restaurants_by_location')->name('get-restaurants-by-location');
Route::post('get-restaurants-count-by-location', 'General@get_restaurants_count_by_location')->name('get-restaurants-count-by-location');

/*end restaurant by area*/

/* start list of restaurant*/

Route::post('get-accounts-by-category', 'General@get_accounts_by_category')->name('get-accounts-by-category');

/* end list of restaurant*/
/*start restaurant*/

Route::post('get-restaurants', 'General@get_restaurants')->name('get-restaurants');
Route::get('get-restaurant-menu', 'Api\Portal\RestaurantController@get_restaurant_menu')->name('get-restaurant-menu');
Route::get('get-restaurant-menu-v2', 'Api\Portal\RestaurantController@get_restaurant_menu_v2')->name('get-restaurant-menu-v2');
Route::get('get-articles', 'Api\Portal\RestaurantController@get_articles')->name('get.articles');
Route::get('get-restaurant-details', 'Api\Portal\RestaurantController@get_restaurant_details')->name('get.restaurant.details');
Route::get('get-restaurant-menu-details', 'Api\Portal\RestaurantController@get_restaurant_menu_details')->name('get-restaurant-details');
//Route::get('best-seller', 'Api\Portal\RestaurantController@best_seller')->name('best-seller');
Route::get('show-restaurants', 'Api\Portal\RestaurantController@show_restaurants')->name('show-restaurants');
Route::get('all-reviews', 'Api\Portal\RestaurantController@all_reviews')->name('all-reviews');
Route::get('restaurant-by-coordinates', 'Api\Portal\RestaurantController@restaurants_by_coordinates')->name('restaurant-by-coordinates');
Route::get('all-items', 'Api\Portal\RestaurantController@all_items')->name('all-items');
Route::get('all-subCategory-items', 'Api\Portal\RestaurantController@all_sub_category_items')->name('all-subCategory-items');
Route::get('can-deliver', 'Api\Portal\RestaurantController@can_deliver')->name('can-deliver');
Route::get('item-components', 'Api\Portal\RestaurantController@item_components')->name('item-components');

/*end restaurant */

/*start item*/

Route::post('get-items-restaurant-by-menu', 'item@get_items_restaurant_by_menu_id')->name('get-items-restaurant-by-menu');

Route::post('get-item-details', 'item@get_item_details')->name('get-item-details');

Route::post('get-items-by-filters', 'item@get_items_by_filters')->name('get-items-by-filters');

/*end item*/

/* start coupon */
Route::post('validate-coupon', 'Coupon@validate_coupon')->name('validate-coupon');

/*end coupon*/

/* start favorite*/

Route::post('add-to-favorite', 'favorite@add_to_favorite')->name('add-to-favorite');
Route::post('get-favorites', 'favorite@get_favorites')->name('get-favorites');
Route::post('delete-from-favorits', 'favorite@delete_from_favorits')->name('delete-from-favorits');


/* end favorite*/


/* start coupon */
Route::post('validate-coupon', 'Coupon@validate_coupon')->name('validate-coupon');
/*end coupon*/


/*start order*/

Route::post('create-order', 'Order@create_order')->name('create-order');
Route::post('get-orders', 'Order@get_orders')->name('get-orders');
Route::post('get-order-by-id', 'Order@get_order_by_id')->name('get-order-by-id');

Route::post('get-orders-count', 'Order@get_orders_count')->name('get-orders-count');

Route::post('get-all-orders', 'Order@get_all_orders')->name('get-all-orders');
Route::post('get-all-orders-count', 'Order@get_all_orders_count')->name('get-all-orders-count');

Route::post('check-out', 'Order@check_out')->name('check-out');
Route::post('get-tax-by-currency', 'General@get_tax_by_currency')->name('get-tax-by-currency');
Route::post('validate-coupon-website', 'Coupon@validate_coupon_website')->name('validate-coupon-website');


/*start comment*/

Route::post('add-comment', 'Comment@add_comment')->name('add-comment');

/*end comment*/


/*start search*/
Route::post('search', 'General@search_request')->name('search');
/*end search*/


/*end order*/

Route::group(['middleware' => 'auth:sanctum'], function () {





});

Route::middleware('portal')->group(function () {
    Route::get('/portal-check-login', [App\Http\Controllers\Api\Portal\PortalController::class, 'login']);
    Route::post('/portal-check-admin', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'check_email']);
    Route::post('/portal-check-admin-phone', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'check_email_phone']);
    //for admin
    Route::post('/portal-insert-admin', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'insert_admin']);
    //for vendor
    Route::post('/portal-insert-vendor', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'insert_vendor']);
    //change password
    Route::put('/p-change-password', [App\Http\Controllers\Api\Portal\PortalController::class, 'change_password']);
    //update user info
    Route::put('/update-user-info', [App\Http\Controllers\Api\Portal\PortalController::class, 'update_user_info']);
    //add support
    Route::post('/portal-add-support', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'add_support']);
    //insert user
    Route::post('/portal-insert-customer', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'insert_user']);
    //temp order
    Route::post('/insert-temp-order', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'insert_temp_order']);
    //delete temp order
    Route::post('/delete-temp-order', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'delete_temp_order']);
    //get temp order
    Route::post('/get-temp-order', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'get_temp_order']);
    //insert order payments
    Route::post('/insert-order-payments', [App\Http\Controllers\Api\Portal\RestaurantController::class, 'insert_order_payments']);
});




