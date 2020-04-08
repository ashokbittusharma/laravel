<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);
Route::get('/', 'Frontend\HomeController@index');

Route::namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/admin', 'DashboardController@index')->name('admin-dashboard');
    /*users*/
    //Employee users
    Route::get('/admin/employees', 'EmployeeController@index')->name('user-employees');
    Route::post('/admin/employees/employees-detail', 'EmployeeController@getAllEmployees');
    Route::get('/admin/employees/add', 'EmployeeController@add')->name('add-employees');
    Route::post('/admin/employees/add-detail', 'EmployeeController@registerEmployee');
    Route::get('/admin/employees/edit/{eid}', 'EmployeeController@edit')->name('edit-employees');
    Route::post('/admin/employees/edit-detail', 'EmployeeController@editEmployee');
    Route::post('/admin/employees/delete', 'EmployeeController@deleteEmployee');

    //Customer users
    Route::get('/admin/customers', 'CustomerController@index')->name('user-customers');
    Route::post('/admin/customers/customers-detail', 'CustomerController@getAllCustomers');
    Route::get('/admin/customers/add', 'CustomerController@add')->name('add-customers');
    Route::get('/admin/customers/edit/{eid}', 'CustomerController@edit')->name('edit-customers');
    Route::post('/admin/customers/add-customer', 'CustomerController@registerCustomer');
    Route::post('/admin/customers/edit-detail', 'CustomerController@editCustomer');
    Route::post('/admin/customers/delete', 'CustomerController@deleteCustomer');
    /* Booking */               
    //Services categories
    Route::get('/admin/booking/service-categories', 'BookingController@serviceCategoires')->name('service-categories');
    Route::post('/admin/booking/add-service-category', 'BookingController@addServiceCategory');
    Route::post('/admin/booking/update-service-category', 'BookingController@updateServiceCategory');
    Route::post('/admin/booking/delete-service-category', 'BookingController@deleteServiceCategory');
    //services..
    Route::get('/admin/booking/services', 'BookingController@allServices')->name('all-services');
    Route::post('/admin/booking/services/add', 'BookingController@addService');
    Route::post('/admin/booking/services/delete', 'BookingController@deleteService');
    Route::post('/admin/booking/services/get-editing-service', 'BookingController@getEditingService');
    Route::post('/admin/booking/services/edit', 'BookingController@editService');

    
    //calendar
    Route::get('/admin/booking/calendar', 'BookingController@calendar')->name('calendar');
    //Appointment
    Route::get('/admin/booking/appointments', 'BookingController@appointments')->name('appointments');
    Route::post('/admin/booking/services/get', 'BookingController@getService');
    Route::post('/admin/booking/appointments/create', 'BookingController@createAppointment');
    Route::post('/admin/booking/appointments/get', 'BookingController@getAppointments');
    Route::get('/admin/booking/appointments/edit/{id}', 'BookingController@editAppointments')->name('edit-appointment');
    Route::post('/admin/booking/appointments/edit', 'BookingController@editAppointmentsdetail');



    //finance
    Route::get('/admin/finance/coupons', 'FinanceController@coupons')->name('coupons');
    Route::get('/admin/finance/payments', 'FinanceController@payments')->name('payments');
    Route::post('/admin/finance/payments/get', 'FinanceController@getpaymentinfo');

    //Settings
    Route::get('/admin/settings/twillo', 'SettingsController@twillo')->name('twillo');
    Route::get('/admin/settings/payment-gateway', 'SettingsController@paymentGateway')->name('payment-gateway');

});
Route::namespace('Employee')->middleware('auth')->group(function () {
    Route::get('/employee', 'DashboardController@index')->name('home');
});

