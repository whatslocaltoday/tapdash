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
$route['default_controller'] = 'Welcome/index';
$route['404_override'] = 'Welcome/page_not_found';
$route['translate_uri_dashes'] = FALSE;


$route['login']='admin/User_authentication';

$route['webmaster/login_process']='admin/User_authentication/user_login_process';

//new user regestration for client account admin

$route['registration']='admin/User_authentication/registration_user_clientview';
$route['reset-password']='admin/User_authentication/resetPassword';


$route['dashboard']='admin/Dashboard/dashboard';
$route['dashboardmain']='admin/Dashboard/dashboardmain';
$route['logout']='admin/User_authentication/logout';


$route['dashboard/profile']='admin/Dashboard/user_profile';

$route['dashboard/change-password']='admin/Dashboard/change_pass_user';
$route['dashboard/view-user']='admin/Dashboard/list_admin_user';
$route['dashboard/view-user/(:num)']='admin/Dashboard/list_admin_user/$1';
$route['dashboard/edit-admin-user/(:num)']='admin/Dashboard/edit_admin_user/$1';

$route['dashboard/add-user']='admin/Dashboard/user_registration_show';

$route['dashboard/add-webiste']='admin/Dashboard/web_registration_show';
$route['dashboard/change-project/(:num)']='admin/Dashboard/change_project/$1';
$route['dashboard/view-webiste']='admin/Dashboard/list_website';



$route['process/add-plan-process']='admin/Process/add_plan_process';
$route['process/view-plan-process']='admin/Process/list_plan_process';
//$route['process/edit-plan-process']='admin/Process/list_plan_process';
$route['process/upload-plan-process']='admin/Process/list_website';

$route['process/fb-add-plan-process']='admin/Process/fb_add_plan_process';

$route['setting/add-permission']='admin/Setting/permission_add_show';
$route['setting/edit-permission']='admin/Setting/list_permission';

$route['setting/add-country']='admin/Setting/country_add_show';
$route['setting/edit-country']='admin/Setting/list_country';

// $route['setting/add-currency']='admin/Setting/currency_add_show';
$route['setting/edit-currency']='admin/Setting/list_currency';


$route['seo_dashboard']='admin/Dashboard/seoDashboard';


$route['seo/rankings']='admin/Seo/ranking';
$route['seo/alexa-graph']='admin/Seo/alexa_graph_seostats';
$route['seo/alexa-ranking']='admin/Seo/alexa_rank_seostats';

$route['seo/website-traffic']='admin/Seo/web_traffic_analytics';
$route['seo/search-page-title']='admin/Seo/search_page_title';
$route['seo/source-medium']='admin/Seo/source_medium';
$route['seo/searched-keyword']='admin/Seo/searched_keyword';
$route['google-analytics']='admin/Seo';


$route['seo/main-graph']='admin/Seo/web_traffic_analytics_home';


$route['accounts']='admin/Account/accounts';


$route['forgot_auth/(:any)'] = 'admin/User_authentication/forgot_Pass_word/$1';




//analytics

$route['analytics_login']='admin/LoginWithGooglePlus/login';

$route['analytics_overview']='admin/LoginWithGooglePlus/mainAnalyticsDashboard';
$route['disconnect-analytics']='admin/LoginWithGooglePlus/discoonect_analytics';




