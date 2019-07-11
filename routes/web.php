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

Route::post('/api/login', 'LoginController@ajax_post_login')->name('ajax_post_login');
Route::post('/api/login/do', 'LoginController@ajax_login_outside')->name('ajax_login_outside');
Route::post('/api/test/verify', 'LoginController@ajax_verify_app')->name('ajax_verify_app');

Route::get('/api/dialling/noselector', 'DialController@dialling_noselector')->name('dialling_noselector');

/* CLIENT CONTROLLER */
Route::get('/registers/clients/info/{id}.html', 'ClientController@client_info')->name('client_info');
Route::get('/api/clients/list', 'ClientController@ajax_list_clients')->name('ajax_list_clients');
Route::get('/api/clients/get', 'ClientController@ajax_get_client')->name('ajax_get_client');
Route::post('/api/clients/save', 'ClientController@ajax_create_clients')->name('ajax_create_clients');
Route::get('/api/clients/getbyhash', 'ClientController@ajax_get_client_by_hash')->name('ajax_get_client_by_hash');
Route::post('/api/clients/lockbyhash', 'ClientController@ajax_lock_client_by_hash')->name('ajax_lock_client_by_hash');
Route::post('/api/clients/unlockbyhash', 'ClientController@ajax_unlock_client_by_hash')->name('ajax_unlock_client_by_hash');
Route::post('/api/clients/nextclient', 'ClientController@ajax_next_client')->name('ajax_next_client');
Route::get('/api/clients/unlockone', 'ClientController@ajax_client_unlock')->name('ajax_client_unlock');
Route::get('/api/clients/logs', 'ClientController@ajax_get_client_log')->name('ajax_get_client_log');
Route::post('/api/clients/logs/save', 'ClientController@ajax_create_client_logs')->name('ajax_create_client_logs');
Route::get('/api/clients/notes/list', 'ClientController@ajax_get_notes_clients')->name('ajax_get_notes_clients');
Route::post('/api/clients/notes/save', 'ClientController@ajax_put_notes_clients')->name('ajax_put_notes_clients');
Route::get('/api/clients/delete', 'ClientController@ajax_delete_client')->name('ajax_delete_client');

Route::get('/api/nextcalls', 'ApiController@nextcalls')->name('nextcalls');
Route::get('/api/appointments', 'ApiController@appointments')->name('appointments');
Route::get('/api/appointment/users', 'ApiController@users_on_appointment')->name('users_on_appointment');

Route::get('/api/purchases/listtop', 'PurchaseController@ajax_purchases_list_top')->name('ajax_purchases_list_top');
Route::get('/purchases/list/user', 'PurchaseController@ajax_purchases_list_client')->name('ajax_purchases_list_client');
Route::get('/purchases/index.html', 'PurchaseController@purchase_index')->name('purchase_index');
Route::get('/mailling/sms.html', 'SmsController@sms_index')->name('sms_index');

Route::get('/dash/appointments.html', 'AppointmentController@appointments_index')->name('appointments_index');
Route::get('/api/appointments/list', 'AppointmentController@ajax_appointments_list')->name('ajax_appointments_list');
Route::post('/api/appointment/send', 'AppointmentController@ajax_appointments_send')->name('ajax_appointments_send');

Route::get('/api/feedback/list', 'ClientController@ajax_list_feedback')->name('ajax_list_feedback');
Route::post('/api/feedback/send', 'ClientController@ajax_send_feedback')->name('ajax_send_feedback');

Route::get('/api/mailling/templates/list', 'MaillingController@ajax_templates_list')->name('ajax_templates_list');
Route::get('/mailling/templates/edit/{id}.html', 'MaillingController@templates_editor')->name('templates_editor');

Route::get('/api/clients/list/export', 'ClientController@ajax_list_export')->name('ajax_list_export');
Route::get('/api/clients/last_statuses', 'DialController@ajax_client_last_statuses')->name('ajax_client_last_statuses');
Route::post('/api/mailling/send', 'MaillingController@ajax_mailling_send')->name('ajax_mailling_send');
Route::get('/api/mailling/template/get', 'MaillingController@ajax_templates_get_one')->name('ajax_templates_get_one');
Route::post('/api/mailling/template/save', 'MaillingController@ajax_templates_save')->name('ajax_templates_save');
Route::get('/api/clients/mail/list', 'ClientController@ajax_mails_list')->name('ajax_mails_list');
Route::get('/api/mailling/template/delete', 'MaillingController@ajax_templates_delete')->name('ajax_templates_delete');
Route::get('/mailling/templates/create.html', 'MaillingController@templates_create')->name('templates_create');

Route::get('/mailling/templates.html', 'MaillingController@templates_index')->name('templates_index');
Route::get('/mailling/compose.html', 'MaillingController@compose_index')->name('compose_index');

/* CONTROL SMS MESSAGES */
Route::get('/api/clients/sms/list', 'ClientController@ajax_get_sms_client')->name('ajax_get_sms_client');
Route::post('/api/clients/sms/save', 'ClientController@ajax_save_sms_client')->name('ajax_save_sms_client');

Route::get('/backoffice/recordings.html', 'RecordingController@rec_index')->name('rec_index');
Route::get('/api/recordings/list', 'RecordingController@api_recordings_list')->name('api_recordings_list');

/* USERS CONTROLLER */
Route::get('/api/users/list', 'UserController@ajax_list_users')->name('ajax_list_users');
Route::post('/api/users/save',  'UserController@ajax_create_users')->name('ajax_create_users');
Route::get('/api/users/get', 'UserController@ajax_get_user')->name('ajax_get_user');
Route::get('/api/users/delete', 'UserController@ajax_delete_user')->name('ajax_delete_user');

Route::get('/registers/script/edit/{id}.html', 'ScriptController@home_edit_script')->name('home_edit_script');
Route::get('/backoffice/scripts/create.html', 'ScriptController@home_create_script')->name('home_create_script');
Route::get('/api/scripts/list', 'ScriptController@ajax_list_scripts')->name('ajax_list_scripts');
Route::post('/api/scripts/save', 'ScriptController@ajax_save_scripts')->name('ajax_save_scripts');
Route::get('/api/scripts/delete', 'ScriptController@delete_script')->name('delete_script');
Route::get('/api/scripts/get/by/status',  'ScriptController@ajax_get_scripts_by_status')->name('ajax_get_scripts_by_status');
Route::get('/api/scripts/get', 'ScriptController@ajax_get_scripts_by_id')->name('ajax_get_scripts_by_id');

Route::get('/backoffice/companies.html', 'CompanyController@company_index')->name('company_index');
Route::get('/api/companies/hashes', 'CompanyController@ajax_get_hashes_company')->name('ajax_get_hashes_company');
Route::get('/api/companies/statuses', 'CompanyController@ajax_load_statuses_hash_company')->name('ajax_load_statuses_hash_company');
Route::get('/api/companies/get', 'CompanyController@ajax_get_company')->name('ajax_get_company');
Route::get('/api/companies/list', 'CompanyController@ajax_list_companies')->name('ajax_list_companies');
Route::get('/api/companies/withclients', 'CompanyController@ajax_list_companies_clients')->name('ajax_list_companies_clients');

Route::get('/dash/dialling/schedule.html', 'SchedulingController@scheduling_index')->name('scheduling_index');
Route::get('/api/sheculing/calls', 'SchedulingController@ajax_get_schedulling')->name('ajax_get_schedulling');

Route::post('/api/companies/save', 'CompanyController@ajax_company_save')->name('ajax_company_save');
Route::get('/api/companies/delete', 'CompanyController@ajax_company_delete')->name('ajax_company_delete');

Route::get('/api/clients/unlockall', 'ClientController@ajax_unloclall_clients')->name('ajax_unloclall_clients');
Route::get('/api/clients/lockall', 'ClientController@ajax_lockall_clients')->name('ajax_lockall_clients');

Route::get('/api/imports/files/import', 'ImportController@ajax_file_import')->name('ajax_file_import');
Route::post('/api/imports/upload', 'ImportController@ajax_upload_file')->name('ajax_upload_file');
Route::get('/api/imports/cancel',  'ImportController@ajax_cancel_upload_file')->name('ajax_cancel_upload_file');
Route::post('/api/imports/save', 'ImportController@ajax_imports_save')->name('ajax_imports_save');
Route::get('/api/imports/delete', 'ImportController@ajax_imports_delete')->name('ajax_imports_delete');
Route::get('/api/imports/files/list', 'ImportController@ajax_imports_list_files')->name('ajax_imports_list_files');
Route::get('/htmls/dropzone.html', 'ImportController@ajax_get_dropzone')->name('ajax_get_dropzone');
Route::get('/api/imports/upload', 'ImportController@ajax_post_upload_file')->name('ajax_post_upload_file');
Route::get('/api/imports/list', 'ImportController@ajax_imports_list')->name('ajax_imports_list');
Route::get('/api/permissions/list', 'PermissionController@ajax_permissions_list')->name('ajax_permissions_list');
Route::post('/api/permissions/save',  'PermissionController@ajax_permissions_save')->name('ajax_permissions_save');

Route::get('/api/statuses/list', 'ClientStatusController@ajax_list_statuses')->name('ajax_list_statuses');

Route::get('/api/clients/one/unlock', 'ClientController@ajax_one_unlock_client')->name('ajax_one_unlock_client');
Route::get('/api/clients/one/lock', 'ClientController@ajax_one_lock_client')->name('ajax_one_lock_client');

Route::get('/api/tasks/list', 'TaskController@ajax_list_tasks')->name('ajax_list_tasks');
Route::post('/api/tasks/save',  'TaskController@ajax_task_save')->name('ajax_task_save');
//Route::get('/api/login/do', 'LoginController@ajax_login_outside')->name('ajax_login_outside_insecure');


Route::get('/home', 'HomeController@home_index')->name('home_index');
Route::get('/login', 'LoginController@signup')->name('login');
Route::get('/logout.html', 'LoginController@auth_get_logout')->name('auth_get_logout');

Route::get('/dash/index.html', 'HomeController@home_index')->name("dash_main");
Route::get('/dash/dialing/select-company.html', 'DialController@dialling_select_company')->name('dialling_select_company');

Route::get('/backoffice/users.html', 'UserController@user_index')->name('user_index');
Route::get('/backoffice/clients.html', 'ClientController@client_index')->name('client_index');
Route::get('/backoffice/scripts.html', 'ScriptController@script_index')->name('script_index');

Route::get('/backoffice/imports.html', 'ImportController@import_index')->name('imports_index');
Route::get('/backoffice/tasks.html', 'TaskController@task_index')->name('tasks_index');

Route::get('/apps/calendar.html', 'CalendarController@calendar_index')->name('calendar_index');
Route::get('/api/calendar/listmonth', 'CalendarController@ajax_events_month')->name('ajax_events_month');

Route::get('/', function () {
    return view('welcome');
});