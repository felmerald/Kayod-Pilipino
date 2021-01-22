<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user_controller';
$route['index']	='user_controller/index';
$route['forgot_password'] ='user_controller/get_forget_password';
$route['user/home'] ='user_controller/get_homepage';
$route['user/employee/leave'] = 'user_controller/view_leave';
$route['user/employee/overtime'] = 'user_controller/view_overtime';
$route['user/employee/undertime'] ='user_controller/view_undertime';
$route['user/employee/documents'] ='user_controller/view_documents';
$route['user/employees'] ='user_controller/view_employees';
$route['user/employee/application_request'] = 'user_controller/view_request';

// User Function

$route['user_login'] = 'frontend_controller/check_login_authentication';
$route['user/logout'] = 'frontend_controller/destroy_user_session';
$route['user/update_user_profile'] ='frontend_controller/update_user_picture';
$route['user/user_request_leave'] = 'frontend_controller/request_user_leave';
$route['user/request_overtime'] = 'frontend_controller/request_employee_overtime';
$route['user/request_undertime'] = 'frontend_controller/request_employee_undertime';
$route['user/upload_documents'] = 'frontend_controller/employee_upload_documents';
$route['user/upload_documents_update'] = 'frontend_controller/update_employee_documents';
$route['user/delete_document'] = 'frontend_controller/delete_document';

$route['user/download_leave'] = 'frontend_controller/user_download_leave';
$route['user/download_overtime'] = 'frontend_controller/user_download_overtime';
$route['user/download_undertime'] = 'frontend_controller/user_download_undertime';

// Admin side
$route['admin/login'] ='admin_controller/index';
$route['admin/register/form'] = 'admin_controller/view_register'; 
$route['admin/dashboard'] ='admin_controller/view_dashboard';
$route['admin/employees_resquest/leave'] = 'admin_controller/view_leave';
$route['admin/employees_resquest/overtime'] ='admin_controller/view_overtime';
$route['admin/employees_resquest/undertime'] ='admin_controller/view_undertime';
$route['admin/employees_images/files'] ='admin_controller/view_files';
$route['admin/employee/add_worker'] ='admin_controller/add_employee_record';

// Functions Admin
$route['admin/register/authenticate'] = 'admin_controller/register';
$route['admin/login_authenticate'] ='admin_controller/check_login';
$route['admin/logout'] = 'admin_controller/destroying_session';
$route['admin/update_account'] = 'dashboard_controller/update_admin_account';
$route['admin/update_profile'] ='dashboard_controller/get_upload_update';
$route['admin/download_excel'] = 'dashboard_controller/excel';
$route['admin/download_pdf'] = 'dashboard_controller/profilepdf';
$route['admin/add_employee'] ='admin_controller/add_employed_user';

$route['admin/user_profile_pdf'] = 'dashboard_controller/userprofile_pdf';
$route['admin/employees/search'] = 'admin_controller/view_search_result';
$route['admin/search/result/employee'] = 'admin_controller/get_user_search';
$route['admin/update_employee_info'] = 'dashboard_controller/update_employees_record';
$route['admin/delete_employee'] ='dashboard_controller/delete_employee_record';

$route['admin/activate_leave'] ='dashboard_controller/activate_leave';
$route['admin/deactivate_leave'] = 'dashboard_controller/deactivate_leave';
$route['admin/approve_overtime'] ='dashboard_controller/approve_overtime';
$route['admin/deactivate_approve_overtime'] ='dashboard_controller/deactivate_approve_overtime';

$route['admin/approve_employee_undertime'] ='dashboard_controller/approve_employee_undertime';
$route['admin/deactivate_approve_employee_undertime'] = 'dashboard_controller/deactivate_approve_employee_undertime';

$route['admin/download_overtime'] = 'dashboard_controller/download_overtime';
$route['admin/download_leave'] ='dashboard_controller/download_leave';
$route['admin/download_undertime'] = 'dashboard_controller/download_undertime';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
