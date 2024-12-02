<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'home';
$route['login'] = 'home/login';
$route['verify'] = 'home/verify';
$route['register'] = 'home/register';
$route['dashboard'] = 'dashboard/index';
$route['dashboard/events'] = 'dashboardEvent/index';
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
