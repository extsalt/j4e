<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| HTTP protocol
|--------------------------------------------------------------------------
|
| Set to force the use of HTTPS for REST API calls
|
*/
$config['force_https'] = false;

/*
|--------------------------------------------------------------------------
| REST Output Format
|--------------------------------------------------------------------------
|
| The default format of the response
|
| 'array':      Array data structure
| 'csv':        Comma separated file
| 'json':       Uses json_encode(). Note: If a GET query string
|               called 'callback' is passed, then jsonp will be returned
| 'html'        HTML using the table library in CodeIgniter
| 'php':        Uses var_export()
| 'serialized':  Uses serialize()
| 'xml':        Uses simplexml_load_string()
|
*/
$config['rest_default_format'] = 'json';

/*
|--------------------------------------------------------------------------
| REST Supported Output Formats
|--------------------------------------------------------------------------
|
| The following setting contains a list of the supported/allowed formats.
| You may remove those formats that you don't want to use.
| If the default format $config['rest_default_format'] is missing within
| $config['rest_supported_formats'], it will be added silently during
| REST_Controller initialization.
|
*/
$config['rest_supported_formats'] = [
    'json',
    'array',
    'csv',
    'html',
    'jsonp',
    'php',
    'serialized',
    'xml',
];

/*
|--------------------------------------------------------------------------
| REST Status Field Name
|--------------------------------------------------------------------------
|
| The field name for the status inside the response
|
*/
$config['rest_status_field_name'] = 'status';

/*
|--------------------------------------------------------------------------
| REST Message Field Name
|--------------------------------------------------------------------------
|
| The field name for the message inside the response
|
*/
$config['rest_message_field_name'] = 'error';

/*
|--------------------------------------------------------------------------
| Enable Emulate Request
|--------------------------------------------------------------------------
|
| Should we enable emulation of the request (e.g. used in Mootools request)
|
*/
$config['enable_emulate_request'] = true;

/*
|--------------------------------------------------------------------------
| REST Realm
|--------------------------------------------------------------------------
|
| Name of the password protected REST API displayed on login dialogs
|
| e.g: My Secret REST API
|
*/
$config['rest_realm'] = 'REST API';

/*
|--------------------------------------------------------------------------
| REST Login
|--------------------------------------------------------------------------
|
| Set to specify the REST API requires to be logged in
|
| FALSE     No login required
| 'basic'   Unsecured login
| 'digest'  More secured login
| 'session' Check for a PHP session variable. See 'auth_source' to set the
|           authorization key
|
*/
$config['rest_auth'] = false;

/*
|--------------------------------------------------------------------------
| REST Login Source
|--------------------------------------------------------------------------
|
| Is login required and if so, the user store to use
|
| ''        Use config based users or wildcard testing
| 'ldap'    Use LDAP authentication
| 'library' Use a authentication library
|
| Note: If 'rest_auth' is set to 'session' then change 'auth_source' to the name of the session variable
|
*/
$config['auth_source'] = 'ldap';

/*
|--------------------------------------------------------------------------
| Allow Authentication and API Keys
|--------------------------------------------------------------------------
|
| Where you wish to have Basic, Digest or Session login, but also want to use API Keys (for limiting
| requests etc), set to TRUE;
|
*/
$config['allow_auth_and_keys'] = true;
$config['strict_api_and_auth'] = true; // force the use of both api and auth before a valid api request is made

/*
|--------------------------------------------------------------------------
| REST Login Class and Function
|--------------------------------------------------------------------------
|
| If library authentication is used define the class and function name
|
| The function should accept two parameters: class->function($username, $password)
| In other cases override the function _perform_library_auth in your controller
|
| For digest authentication the library function should return already a stored
| md5(username:restrealm:password) for that username
|
| e.g: md5('admin:REST API:1234') = '1e957ebc35631ab22d5bd6526bd14ea2'
|
*/
$config['auth_library_class'] = '';
$config['auth_library_function'] = '';

/*
|--------------------------------------------------------------------------
| Override auth types for specific class/method
|--------------------------------------------------------------------------
|
| Set specific authentication types for methods within a class (controller)
|
| Set as many config entries as needed.  Any methods not set will use the default 'rest_auth' config value.
|
| e.g:
|
|           $config['auth_override_class_method']['deals']['view'] = 'none';
|           $config['auth_override_class_method']['deals']['insert'] = 'digest';
|           $config['auth_override_class_method']['accounts']['user'] = 'basic';
|           $config['auth_override_class_method']['dashboard']['*'] = 'none|digest|basic';
|
| Here 'deals', 'accounts' and 'dashboard' are controller names, 'view', 'insert' and 'user' are methods within. An asterisk may also be used to specify an authentication method for an entire classes methods. Ex: $config['auth_override_class_method']['dashboard']['*'] = 'basic'; (NOTE: leave off the '_get' or '_post' from the end of the method name)
| Acceptable values are; 'none', 'digest' and 'basic'.
|
*/
// $config['auth_override_class_method']['deals']['view'] = 'none';
// $config['auth_override_class_method']['deals']['insert'] = 'digest';
// $config['auth_override_class_method']['accounts']['user'] = 'basic';
// $config['auth_override_class_method']['dashboard']['*'] = 'basic';

// ---Uncomment list line for the wildard unit test
// $config['auth_override_class_method']['wildcard_test_cases']['*'] = 'basic';
$config['auth_override_class_method']['api_v1']['status'] = 'none';
$config['auth_override_class_method']['api_v1']['signin'] = 'none';
$config['auth_override_class_method']['api_v1']['signup'] = 'none';
$config['auth_override_class_method']['api_v1']['forgot'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_payment_details'] = 'none';
$config['auth_override_class_method']['api_v1']['app_check_version_maintenance'] = 'none';
$config['auth_override_class_method']['api_v1']['app_check_referral_code'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_home_details'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_terms_conditions'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_privacy_policy'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_intro_screen'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_login'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_verify_otp'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_account_details'] = 'none';
$config['auth_override_class_method']['api_v1']['send_otp'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_all_plan'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_membership_details'] = 'none'; //app_user_edit_profile_post
$config['auth_override_class_method']['api_v1']['app_user_view_profile'] = 'none'; //app_user_view_profile_post
$config['auth_override_class_method']['api_v1']['app_user_edit_profile'] = 'none'; //app_user_view_profile_post
$config['auth_override_class_method']['api_v1']['app_get_subscribe'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_get_current_membership'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_get_upgrade_membership'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_get_renew_membership'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_user_basicinfo_view'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_user_edit_profile_pic'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_user_edit_basicinfo_part1'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['app_user_edit_basicinfo_part2'] = 'none'; //app_get_subscribe_post
$config['auth_override_class_method']['api_v1']['mobile_signin'] = 'none'; //app_get_subscribe_post//app_user_edit_profile_about_post
$config['auth_override_class_method']['api_v1']['app_user_edit_profile_about'] = 'none'; //app_user_edit_profile_contact_post
$config['auth_override_class_method']['api_v1']['app_user_delete_company_profile'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_delete_company_ppt'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_delete_vcard_front'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_delete_vcard_back'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_edit_profile_contact'] = 'none'; //app_user_view_profile_contact_post
$config['auth_override_class_method']['api_v1']['app_user_view_profile_contact'] = 'none'; //app_user_view_profile_about_post
$config['auth_override_class_method']['api_v1']['app_user_view_profile_about'] = 'none'; //social_login_post
$config['auth_override_class_method']['api_v1']['social_login'] = 'none'; //
$config['auth_override_class_method']['api_v1']['app_user_add_membership_details'] = 'none';  //app_user_add_membership_details_post
$config['auth_override_class_method']['api_v1']['app_user_edit_membership_details'] = 'none';  //app_user_edit_membership_details_post
$config['auth_override_class_method']['api_v1']['connection_request_sent'] = 'none';   //connection_request_accept_post
$config['auth_override_class_method']['api_v1']['connection_request_accept'] = 'none'; //connection_request_sent_list_post
$config['auth_override_class_method']['api_v1']['connection_request_sent_list'] = 'none'; //connection_request_decline_post
$config['auth_override_class_method']['api_v1']['connection_request_receive_list'] = 'none';  //
$config['auth_override_class_method']['api_v1']['connection_request_decline'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_all_members'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_buddies'] = 'none';
$config['auth_override_class_method']['api_v1']['app_connection_request_sent_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_connection_request_received_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_requirement'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_requirements'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_all_leads'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_requirement_details'] = 'none';
$config['auth_override_class_method']['api_v1']['app_recommend_myself'] = 'none';
$config['auth_override_class_method']['api_v1']['app_recommend_buddies'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_recommendation_list'] = 'none';//user_ratings_reviews_post
$config['auth_override_class_method']['api_v1']['user_ratings_reviews'] = 'none'; //get_user_rating_review_post
$config['auth_override_class_method']['api_v1']['get_user_rating_review'] = 'none'; ///user_gallery_add_post
$config['auth_override_class_method']['api_v1']['user_gallery_add'] = 'none'; //view_user_gallery_post
$config['auth_override_class_method']['api_v1']['view_user_gallery'] = 'none'; //view_user_gallery_post
$config['auth_override_class_method']['api_v1']['user_gallery_delete'] = 'none';
$config['auth_override_class_method']['api_v1']['app_confirm_event_status'] = 'none';
$config['auth_override_class_method']['api_v1']['app_check_event_invite'] = 'none';

$config['auth_override_class_method']['api_v1']['app_create_referral'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_referral'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_pending_referral'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_complete_referral'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_pending_referral_received'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_complete_referral_received'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_referral_received'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_referral_given'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_referral_status'] = 'none'; 

$config['auth_override_class_method']['api_v1']['app_check_validity'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_buddies_with_membership_type'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_award_recognition'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_search_data'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_batches_data'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_employee_data'] = 'none';  //
$config['auth_override_class_method']['api_v1']['app_get_notification_count'] = 'none';
$config['auth_override_class_method']['api_v1']['app_delete_account'] = 'none';

$config['auth_override_class_method']['api_v1']['app_confirm_business_transaction'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_functional_area'] = 'none'; //view_user_gallery_post
$config['auth_override_class_method']['api_v1']['app_get_lead_status'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_user_add_lead_status'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_get_user_lead_status'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_user_notification'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_membership_plan'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_my_report_card'] = 'none';

$config['auth_override_class_method']['api_v1']['app_check_connection'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_total_employee'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_leads'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_pending_leads'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_complete_leads'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_turnover'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_pending_requirements'] = 'none';  
$config['auth_override_class_method']['api_v1']['app_get_complete_requirements'] = 'none';
$config['auth_override_class_method']['api_v1']['app_user_check_lead'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_post_category'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_posts'] = 'none';
$config['auth_override_class_method']['api_v1']['app_edit_posts'] = 'none';
$config['auth_override_class_method']['api_v1']['app_update_posts'] = 'none';
$config['auth_override_class_method']['api_v1']['app_delete_post_image'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_like_unlike_posts'] = 'none';  
$config['auth_override_class_method']['api_v1']['app_user_check_like_status'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_posts'] = 'none';  
$config['auth_override_class_method']['api_v1']['app_get_all_posts'] = 'none';  
$config['auth_override_class_method']['api_v1']['app_create_posts_comment'] = 'none';   
$config['auth_override_class_method']['api_v1']['app_get_all_posts_comment'] = 'none';
$config['auth_override_class_method']['api_v1']['app_delete_posts_comment'] = 'none';
$config['auth_override_class_method']['api_v1']['app_delete_posts'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_offline_business_transaction_id'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_offline_business_transaction'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_offline_business_transaction'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_all_business_transaction_detail'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_all_business_transaction'] = 'none';
$config['auth_override_class_method']['api_v1']['app_update_business_transaction_status'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_groups'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_group_participants'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_event_category'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_event'] = 'none';
$config['auth_override_class_method']['api_v1']['app_update_event'] = 'none';
$config['auth_override_class_method']['api_v1']['app_delete_event'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_get_event_list'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_get_event_detail'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_add_event_ratings_reviews'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_user_book_event'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_event_participation'] = 'none';
$config['auth_override_class_method']['api_v1']['app_event_invite_byuser'] = 'none';
$config['auth_override_class_method']['api_v1']['app_event_register_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_event_attending_status_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_address'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_guest_invite_event'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_guest_invite_event_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_guest_invite_event_detail'] = 'none';
$config['auth_override_class_method']['api_v1']['app_do_guest_invite_payment'] = 'none';
$config['auth_override_class_method']['api_v1']['app_event_attedance'] = 'none';
$config['auth_override_class_method']['api_v1']['app_event_detail_for_boking'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_list_recommendations_by'] = 'none'; 
$config['auth_override_class_method']['api_v1']['app_get_list_recommendations_to'] = 'none'; 

$config['auth_override_class_method']['api_v1']['app_create_buddy_meet'] = 'none';
$config['auth_override_class_method']['api_v1']['app_buddy_meet_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_recognition'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_recognition'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_my_diary'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_fallowup_lead_data'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_fallowup_lead_userdata'] = 'none';
$config['auth_override_class_method']['api_v1']['app_create_fallowup'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_fallowup_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_toprank_list'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_aboutus'] = 'none';
$config['auth_override_class_method']['api_v1']['app_get_aboutus'] = 'none';

$config['auth_override_class_method']['api_v1']['app_get_testimonial'] = 'none';
$config['auth_override_class_method']['api_v1']['app_add_j4e_ratings_reviews'] = 'none'; 


$config['auth_override_class_method']['api_v1']['checkcodefcm'] = 'none';
$config['auth_override_class_method']['api_v1']['send_event_invitation'] = 'none';


/*
|--------------------------------------------------------------------------
| Override auth types for specific 'class/method/HTTP method'
|--------------------------------------------------------------------------
|
| example:
|
|            $config['auth_override_class_method_http']['deals']['view']['get'] = 'none';
|            $config['auth_override_class_method_http']['deals']['insert']['post'] = 'none';
|            $config['auth_override_class_method_http']['deals']['*']['options'] = 'none';
*/

// ---Uncomment list line for the wildard unit test
// $config['auth_override_class_method_http']['wildcard_test_cases']['*']['options'] = 'basic';

/*
|--------------------------------------------------------------------------
| REST Login Usernames
|--------------------------------------------------------------------------
|
| Array of usernames and passwords for login, if ldap is configured this is ignored
|
*/
$config['rest_valid_logins'] = ['admin' => '1234'];

/*
|--------------------------------------------------------------------------
| Global IP White-listing
|--------------------------------------------------------------------------
|
| Limit connections to your REST server to White-listed IP addresses
|
| Usage:
| 1. Set to TRUE and select an auth option for extreme security (client's IP
|    address must be in white-list and they must also log in)
| 2. Set to TRUE with auth set to FALSE to allow White-listed IPs access with no login
| 3. Set to FALSE but set 'auth_override_class_method' to 'white-list' to
|    restrict certain methods to IPs in your white-list
|
*/
$config['rest_ip_whitelist_enabled'] = false;

/*
|--------------------------------------------------------------------------
| REST Handle Exceptions
|--------------------------------------------------------------------------
|
| Handle exceptions caused by the controller
|
*/
$config['rest_handle_exceptions'] = true;

/*
|--------------------------------------------------------------------------
| REST IP White-list
|--------------------------------------------------------------------------
|
| Limit connections to your REST server with a comma separated
| list of IP addresses
|
| e.g: '123.456.789.0, 987.654.32.1'
|
| 127.0.0.1 and 0.0.0.0 are allowed by default
|
*/
$config['rest_ip_whitelist'] = '';

/*
|--------------------------------------------------------------------------
| Global IP Blacklisting
|--------------------------------------------------------------------------
|
| Prevent connections to the REST server from blacklisted IP addresses
|
| Usage:
| 1. Set to TRUE and add any IP address to 'rest_ip_blacklist'
|
*/
$config['rest_ip_blacklist_enabled'] = false;

/*
|--------------------------------------------------------------------------
| REST IP Blacklist
|--------------------------------------------------------------------------
|
| Prevent connections from the following IP addresses
|
| e.g: '123.456.789.0, 987.654.32.1'
|
*/
$config['rest_ip_blacklist'] = '';

/*
|--------------------------------------------------------------------------
| REST Database Group
|--------------------------------------------------------------------------
|
| Connect to a database group for keys, logging, etc. It will only connect
| if you have any of these features enabled
|
*/
$config['rest_database_group'] = 'default';

/*
|--------------------------------------------------------------------------
| REST API Keys Table Name
|--------------------------------------------------------------------------
|
| The table name in your database that stores API keys
|
*/
$config['rest_keys_table'] = 'user';

/*
|--------------------------------------------------------------------------
| REST Enable Keys
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will look for a column name called 'key'.
| If no key is provided, the request will result in an error. To override the
| column name see 'rest_key_column'
|
| Default table schema:
|   CREATE TABLE `keys` (
|       `id` INT(11) NOT NULL AUTO_INCREMENT,
|       `user_id` INT(11) NOT NULL,
|       `key` VARCHAR(40) NOT NULL,
|       `level` INT(2) NOT NULL,
|       `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
|       `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
|       `ip_addresses` TEXT NULL DEFAULT NULL,
|       `date_created` INT(11) NOT NULL,
|       PRIMARY KEY (`id`)
|   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
*/
$config['rest_enable_keys'] = true;

/*
|--------------------------------------------------------------------------
| REST Table Key Column Name
|--------------------------------------------------------------------------
|
| If not using the default table schema in 'rest_enable_keys', specify the
| column name to match e.g. my_key
|
*/
$config['rest_key_column'] = 'api_key';

/*
|--------------------------------------------------------------------------
| REST API Limits method
|--------------------------------------------------------------------------
|
| Specify the method used to limit the API calls
|
| Available methods are :
| $config['rest_limits_method'] = 'IP_ADDRESS'; // Put a limit per ip address
| $config['rest_limits_method'] = 'API_KEY'; // Put a limit per api key
| $config['rest_limits_method'] = 'METHOD_NAME'; // Put a limit on method calls
| $config['rest_limits_method'] = 'ROUTED_URL';  // Put a limit on the routed URL
|
*/
$config['rest_limits_method'] = 'ROUTED_URL';

/*
|--------------------------------------------------------------------------
| REST Key Length
|--------------------------------------------------------------------------
|
| Length of the created keys. Check your default database schema on the
| maximum length allowed
|
| Note: The maximum length is 40
|
*/
$config['rest_key_length'] = 50;

/*
|--------------------------------------------------------------------------
| REST API Key Variable
|--------------------------------------------------------------------------
|
| Custom header to specify the API key

| Note: Custom headers with the X- prefix are deprecated as of
| 2012/06/12. See RFC 6648 specification for more details
|
*/
$config['rest_key_name'] = 'X-API-KEY';

/*
|--------------------------------------------------------------------------
| REST Enable Logging
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will log actions based on the column names 'key', 'date',
| 'time' and 'ip_address'. This is a general rule that can be overridden in the
| $this->method array for each controller
|
| Default table schema:
|   CREATE TABLE `logs` (
|       `id` INT(11) NOT NULL AUTO_INCREMENT,
|       `uri` VARCHAR(255) NOT NULL,
|       `method` VARCHAR(6) NOT NULL,
|       `params` TEXT DEFAULT NULL,
|       `api_key` VARCHAR(40) NOT NULL,
|       `ip_address` VARCHAR(45) NOT NULL,
|       `time` INT(11) NOT NULL,
|       `rtime` FLOAT DEFAULT NULL,
|       `authorized` VARCHAR(1) NOT NULL,
|       `response_code` smallint(3) DEFAULT '0',
|       PRIMARY KEY (`id`)
|   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
*/
$config['rest_enable_logging'] = false;

/*
|--------------------------------------------------------------------------
| REST API Logs Table Name
|--------------------------------------------------------------------------
|
| If not using the default table schema in 'rest_enable_logging', specify the
| table name to match e.g. my_logs
|
*/
$config['rest_logs_table'] = 'logs';

/*
|--------------------------------------------------------------------------
| REST Method Access Control
|--------------------------------------------------------------------------
| When set to TRUE, the REST API will check the access table to see if
| the API key can access that controller. 'rest_enable_keys' must be enabled
| to use this
|
| Default table schema:
|   CREATE TABLE `access` (
|       `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
|       `key` VARCHAR(40) NOT NULL DEFAULT '',
|       `all_access` TINYINT(1) NOT NULL DEFAULT '0',
|       `controller` VARCHAR(50) NOT NULL DEFAULT '',
|       `date_created` DATETIME DEFAULT NULL,
|       `date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
|       PRIMARY KEY (`id`)
|    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
*/
$config['rest_enable_access'] = false;

/*
|--------------------------------------------------------------------------
| REST API Access Table Name
|--------------------------------------------------------------------------
|
| If not using the default table schema in 'rest_enable_access', specify the
| table name to match e.g. my_access
|
*/
$config['rest_access_table'] = 'access';

/*
|--------------------------------------------------------------------------
| REST API Param Log Format
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API log parameters will be stored in the database as JSON
| Set to FALSE to log as serialized PHP
|
*/
$config['rest_logs_json_params'] = false;

/*
|--------------------------------------------------------------------------
| REST Enable Limits
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will count the number of uses of each method
| by an API key each hour. This is a general rule that can be overridden in the
| $this->method array in each controller
|
| Default table schema:
|   CREATE TABLE `limits` (
|       `id` INT(11) NOT NULL AUTO_INCREMENT,
|       `uri` VARCHAR(255) NOT NULL,
|       `count` INT(10) NOT NULL,
|       `hour_started` INT(11) NOT NULL,
|       `api_key` VARCHAR(40) NOT NULL,
|       PRIMARY KEY (`id`)
|   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
| To specify the limits within the controller's __construct() method, add per-method
| limits with:
|
|       $this->methods['METHOD_NAME']['limit'] = [NUM_REQUESTS_PER_HOUR];
|
| See application/controllers/api/example.php for examples
*/
$config['rest_enable_limits'] = false;

/*
|--------------------------------------------------------------------------
| REST API Limits Table Name
|--------------------------------------------------------------------------
|
| If not using the default table schema in 'rest_enable_limits', specify the
| table name to match e.g. my_limits
|
*/
$config['rest_limits_table'] = 'limits';

/*
|--------------------------------------------------------------------------
| REST Ignore HTTP Accept
|--------------------------------------------------------------------------
|
| Set to TRUE to ignore the HTTP Accept and speed up each request a little.
| Only do this if you are using the $this->rest_format or /format/xml in URLs
|
*/
$config['rest_ignore_http_accept'] = false;

/*
|--------------------------------------------------------------------------
| REST AJAX Only
|--------------------------------------------------------------------------
|
| Set to TRUE to allow AJAX requests only. Set to FALSE to accept HTTP requests
|
| Note: If set to TRUE and the request is not AJAX, a 505 response with the
| error message 'Only AJAX requests are accepted.' will be returned.
|
| Hint: This is good for production environments
|
*/
$config['rest_ajax_only'] = false;

/*
|--------------------------------------------------------------------------
| REST Language File
|--------------------------------------------------------------------------
|
| Language file to load from the language directory
|
*/
$config['rest_language'] = 'english';

/*
|--------------------------------------------------------------------------
| CORS Check
|--------------------------------------------------------------------------
|
| Set to TRUE to enable Cross-Origin Resource Sharing (CORS). Useful if you
| are hosting your API on a different domain from the application that
| will access it through a browser
|
*/
$config['check_cors'] = false;

/*
|--------------------------------------------------------------------------
| CORS Allowable Headers
|--------------------------------------------------------------------------
|
| If using CORS checks, set the allowable headers here
|
*/
$config['allowed_cors_headers'] = [
  'Origin',
  'X-Requested-With',
  'Content-Type',
  'Accept',
  'Access-Control-Request-Method',
];

/*
|--------------------------------------------------------------------------
| CORS Allowable Methods
|--------------------------------------------------------------------------
|
| If using CORS checks, you can set the methods you want to be allowed
|
*/
$config['allowed_cors_methods'] = [
  'GET',
  'POST',
  'OPTIONS',
  'PUT',
  'PATCH',
  'DELETE',
];

/*
|--------------------------------------------------------------------------
| CORS Allow Any Domain
|--------------------------------------------------------------------------
|
| Set to TRUE to enable Cross-Origin Resource Sharing (CORS) from any
| source domain
|
*/
$config['allow_any_cors_domain'] = false;

/*
|--------------------------------------------------------------------------
| CORS Allowable Domains
|--------------------------------------------------------------------------
|
| Used if $config['check_cors'] is set to TRUE and $config['allow_any_cors_domain']
| is set to FALSE. Set all the allowable domains within the array
|
| e.g. $config['allowed_origins'] = ['http://www.example.com', 'https://spa.example.com']
|
*/
$config['allowed_cors_origins'] = [];

/*
|--------------------------------------------------------------------------
| CORS Forced Headers
|--------------------------------------------------------------------------
|
| If using CORS checks, always include the headers and values specified here
| in the OPTIONS client preflight.
| Example:
| $config['forced_cors_headers'] = [
|   'Access-Control-Allow-Credentials' => 'true'
| ];
|
| Added because of how Sencha Ext JS framework requires the header
| Access-Control-Allow-Credentials to be set to true to allow the use of
| credentials in the REST Proxy.
| See documentation here:
| http://docs.sencha.com/extjs/6.5.2/classic/Ext.data.proxy.Rest.html#cfg-withCredentials
|
*/
$config['forced_cors_headers'] = [];
