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
$route['default_controller'] = 'index';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = TRUE;


/*
| -------------------------------------------------------------------------
| BACKEND MODULES ROUTES
| -------------------------------------------------------------------------
*/
// Default URL
$route['(\w{2})/backend'] = 'backend/admin/auth';
$route['backend'] = 'backend/admin/auth';

$route['(\w{2})/backend/(\w+)/(\w+)'] = 'backend/$2/$3';
$route['(\w{2})/backend/(\w+)/(\w+)/(.+)'] = 'backend/$2/$3/$4';
$route['backend/(\w+)/(\w+)'] = 'backend/$1/$2';
$route['backend/(\w+)/(\w+)/(.+)'] = 'backend/$1/$2/$3';

/*
| -------------------------------------------------------------------------
| FRONTEND MODULES ROUTES
| -------------------------------------------------------------------------
*/
// Default URL
$route['(\w{2})'] = 'index';
$route['(\w{2})/home'] = 'index';

// Static URL for About Us
$route['(\w{2})/about-us'] = 'frontend/information/about_us';
$route['(\w{2})/about-us/(\w+)'] = 'frontend/information/about_us/$2';
$route['about-us'] = 'frontend/information/about_us';
$route['about-us/(\w+)'] = 'frontend/information/about_us/$1';

// Static URL for Contact Us
$route['(\w{2})/contact-us'] = 'frontend/information/contact_us';
$route['(\w{2})/contact-us/(\w+)'] = 'frontend/information/contact_us/$2';
$route['contact-us'] = 'frontend/information/contact_us';
$route['contact-us/(\w+)'] = 'frontend/information/contact_us/$1';

// Static URL for Sitemap
$route['(\w{2})/sitemap'] = 'frontend/information/sitemap';
$route['(\w{2})/sitemap/(\w+)'] = 'frontend/information/sitemap/$2';
$route['sitemap'] = 'frontend/information/sitemap';
$route['sitemap/(\w+)'] = 'frontend/information/sitemap/$1';

// Dynamic URL
$route['(\w{2})/(\w+)/(\w+)'] = 'frontend/$2/$3';
$route['(\w{2})/(\w+)/(\w+)/(.+)'] = 'frontend/$2/$3/$4';
$route['(\w+)/(\w+)'] = 'frontend/$1/$2';
$route['(\w+)/(\w+)/(.+)'] = 'frontend/$1/$2/$3';