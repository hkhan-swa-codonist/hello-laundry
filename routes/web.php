<?php

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

Route::get('/', 'WebController@index');
Route::get('/home', 'WebController@index')->name('home');
Route::get('/services', 'WebController@services');
Route::get('/faq', 'WebController@faq');
Route::get('/pricing', 'WebController@pricing');
Route::get('/pricing_mobile', 'WebController@pricing_mobile');
Route::get('/products/{id}', 'WebController@products');
Route::get('/cart', 'WebController@cart');
Route::get('/login', 'WebController@showLogin');
Route::get('/profile/{id}', 'WebController@profile');
Route::post('/login', 'WebController@doLogin');
Route::post('/register', 'WebController@doRegister');
Route::get('/register', 'WebController@showRegister');
Route::get('/logout', 'WebController@doLogout');
Route::post('/add_to_cart', 'WebController@add_to_cart');
Route::post('/add_to_cart_category', 'WebController@add_to_cart_category');
Route::post('/remove_from_cart_category', 'WebController@remove_from_cart_category');
Route::post('/apply_promo', 'WebController@apply_promo');
Route::post('/remove_promo', 'WebController@remove_promo');
Route::post('/checkout', 'WebController@checkout');
Route::post('/profile_update', 'WebController@profile_update');
Route::post('/profile_image', 'WebController@profile_image');
Route::post('/save_address', 'WebController@save_address');
Route::post('/edit_address', 'WebController@edit_address');
Route::post('/address_delete', 'WebController@address_delete');
Route::get('/forgot_password', 'WebController@forgot_password');
Route::post('/forgot_password', 'WebController@generate_otp');
Route::post('/reset', 'WebController@reset_password');
Route::post('/reset_password', 'WebController@update_password');
Route::post('/get_delivery_time_slot', 'WebController@get_delivery_time_slot');
Route::post('/get_pickup_time_slot', 'WebController@get_pickup_time_slot');
Route::post('check_order_count', 'WebController@check_order_count');
Route::get('/privacy_policy', 'WebController@privacy_policy');
Route::get('/my_cards', 'WebController@my_cards');
Route::get('/delete_card/{id}', 'WebController@delete_card');
Route::get('/category/{id}', 'WebController@category');
Route::post('/add_card', 'WebController@add_card');

Route::post('/check_category', 'WebController@check_category');
Route::post('/check_card_availability', 'WebController@check_card_availability');
Route::get('/check_service_availability', function () {
    return view('check_service_availability');
});
Route::post('/check_pincode', 'WebController@check_pincode');

Route::get('/thankyou', function () {
    return view('thankyou');
});
Route::get('/payment_success', function () {
    return view('payment_success');
});
Route::get('/payment_fail', function () {
    return view('payment_fail');
});
Route::get('/order_success', function () {
    return view('order_success');
});
Route::post('/payment_checkout', 'WebController@payment_checkout');
Route::get('/payment', 'WebController@stripe');
Route::post('/payment', 'WebController@stripePost')->name('payment.post');

Route::get('/order_detail/{id}', 'WebController@show_order_detail');
Route::get('/pending_order_detail/{id}', 'WebController@show_pending_order_detail');
Route::get('/sage_payment/{customer_id}/{amount}/{address_id}', 'WebController@sage_payment');

Route::get('/payment', 'WebController@payment');
Route::post('/payment_card_added', 'WebController@payment_card_added');
