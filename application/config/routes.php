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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'home';
$route['login'] = 'home/login';
$route['verify'] = 'home/verify';
$route['register'] = 'home/register';
$route['dashboard'] = 'home/dashboard';
$route['point_history'] = 'home/point_history';
$route['edit_profile'] = 'home/edit_profile';
$route['payments'] = 'home/payments';
$route['logout'] = 'home/logout';
$route['about'] = 'home/about';

$route['faq'] = 'home/faq';

$route['business_category'] = 'home/business_category';
$route['business_subcategory/(:any)'] = 'home/business_subcategory/$1';
$route['profile_listing'] = 'home/profile_listing';
$route['profile_listing/(:any)'] = 'home/profile_listing/$1';
$route['member_profile/(:any)'] = 'home/member_profile/$1';
$route['event'] = 'home/events';
$route['post'] = 'home/posts';
$route['event_detail/(:any)'] = 'home/event_detail/$1';
$route['blog'] = 'home/blog';
$route['blog_detail/(:any)'] = 'home/blog_detail/$1';
$route['testimonial'] = 'home/testimonial';
$route['testimonial_detail/(:any)'] = 'home/testimonial_detail/$1';
$route['contact'] = 'home/contact';
$route['profile/(:any)'] = 'home/profile/$1';
$route['contact1/(:any)'] = 'home/contact1/$1';
$route['gallery/(:any)'] = 'home/gallery/$1';
$route['reviews/(:any)'] = 'home/reviews/$1';

$route['terms_conditions'] = 'home/terms_conditions';
$route['privacy_policy'] = 'home/privacy_policy';
