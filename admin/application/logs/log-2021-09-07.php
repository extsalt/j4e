<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-09-07 05:02:47 --> Severity: error --> Exception: Too few arguments to function Events::managesdetail(), 0 passed in /home/view360/public_html/j4edemo/system/core/CodeIgniter.php on line 532 and exactly 1 expected /home/view360/public_html/j4edemo/application/controllers/Events.php 28
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:06:51 --> Severity: Warning --> A non-numeric value encountered /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_list.php 56
ERROR - 2021-09-07 05:11:28 --> Severity: error --> Exception: Call to undefined method Events::getpostliketotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 25
ERROR - 2021-09-07 05:14:36 --> Severity: error --> Exception: Call to undefined method Events::getpostliketotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 25
ERROR - 2021-09-07 05:24:13 --> Severity: error --> Exception: Call to undefined method Events::getpostliketotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 25
ERROR - 2021-09-07 05:24:30 --> Severity: error --> Exception: Call to undefined method Events::getpostcommenttotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 27
ERROR - 2021-09-07 05:26:28 --> Query error: Unknown column 'V' in 'field list' - Invalid query: select count(V) as totalcomment from event_ratings_reviews where `event_id`=2 
ERROR - 2021-09-07 05:26:28 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 60
ERROR - 2021-09-07 05:26:54 --> Severity: error --> Exception: Call to undefined method Events::getpostcommenttotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 30
ERROR - 2021-09-07 05:29:21 --> Severity: error --> Exception: Call to undefined method Events::getpostcommenttotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 36
ERROR - 2021-09-07 05:29:37 --> Severity: error --> Exception: Call to undefined method Events::getpostcommenttotal() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 36
ERROR - 2021-09-07 05:31:39 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 05:35:49 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `events`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:35:49 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 05:37:50 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `events`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:37:50 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 05:38:05 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `events`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:38:05 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 05:38:39 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `events`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:38:39 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 05:39:01 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `events`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:39:08 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:39:08 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:39:08 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:08 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:11 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:39:11 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:39:11 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:11 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:25 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `event_booking`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:39:25 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 05:39:35 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `events`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `event_booking`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:39:51 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:39:51 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:39:51 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:51 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:54 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:39:54 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:39:54 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:54 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:39:56 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `event_booking`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `event_booking`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 05:40:28 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:40:28 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:40:28 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:28 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:29 --> Severity: Notice --> Undefined variable: sql /home/view360/public_html/j4edemo/application/models/User_model.php 7309
ERROR - 2021-09-07 05:40:30 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:40:30 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:40:30 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:30 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:31 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:40:31 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:40:31 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:31 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:32 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:40:32 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:40:32 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:32 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:33 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5094
ERROR - 2021-09-07 05:40:33 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5097
ERROR - 2021-09-07 05:40:33 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 05:40:33 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5141
ERROR - 2021-09-07 06:01:35 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `event_booking`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `event_booking`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 06:01:35 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 35
ERROR - 2021-09-07 06:01:49 --> Query error: Not unique table/alias: 'event_booking' - Invalid query: SELECT `event_booking`.*, CONCAT_WS(' ', `first_name`, `middle_name`, last_name) as full_name
FROM `event_booking`
LEFT JOIN `event_booking` ON `event_booking`.`booking_userid` = `user`.`id`
WHERE `booking_eventid` = '2'
ORDER BY `booking_id` DESC
ERROR - 2021-09-07 06:02:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_bookingdetail.php 78
ERROR - 2021-09-07 06:05:45 --> Severity: error --> Exception: Call to undefined method Events::getusername() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_bookingdetail.php 88
ERROR - 2021-09-07 06:11:29 --> Severity: Compile Error --> Cannot redeclare Events::managesdetail() /home/view360/public_html/j4edemo/application/controllers/Events.php 50
ERROR - 2021-09-07 06:12:51 --> Severity: Compile Error --> Cannot redeclare Events::managesdetail() /home/view360/public_html/j4edemo/application/controllers/Events.php 50
ERROR - 2021-09-07 06:13:05 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_rate_review.php 83
ERROR - 2021-09-07 06:14:44 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_rate_review.php 80
ERROR - 2021-09-07 06:14:49 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_rate_review.php 80
ERROR - 2021-09-07 06:14:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_rate_review.php 80
ERROR - 2021-09-07 06:15:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_rate_review.php 80
ERROR - 2021-09-07 06:16:42 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 06:16:49 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 06:31:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:31:57 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:32:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:32:00 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:33:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:33:36 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:35:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:35:42 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:37:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:37:24 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:37:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`= 
ERROR - 2021-09-07 06:37:34 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 06:40:22 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 06:50:59 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 07:07:24 --> Severity: error --> Exception: Call to a member function getusername() on null /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_attedance.php 68
ERROR - 2021-09-07 07:09:39 --> Severity: error --> Exception: Too few arguments to function Events::managesdetail(), 0 passed in /home/view360/public_html/j4edemo/system/core/CodeIgniter.php on line 532 and exactly 1 expected /home/view360/public_html/j4edemo/application/controllers/Events.php 53
ERROR - 2021-09-07 07:09:42 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 07:13:38 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 07:13:45 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 07:13:58 --> Severity: error --> Exception: Call to a member function getusername() on null /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_attedance.php 68
ERROR - 2021-09-07 07:14:47 --> Severity: error --> Exception: Call to a member function getusername() on null /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_attedance.php 68
ERROR - 2021-09-07 07:55:35 --> Severity: error --> Exception: Too few arguments to function Events::managesbooking(), 0 passed in /home/view360/public_html/j4edemo/system/core/CodeIgniter.php on line 532 and exactly 1 expected /home/view360/public_html/j4edemo/application/controllers/Events.php 28
ERROR - 2021-09-07 08:52:05 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 08:56:12 --> Severity: Compile Error --> Cannot redeclare Events::managesbooking() /home/view360/public_html/j4edemo/application/controllers/Events.php 50
ERROR - 2021-09-07 08:56:39 --> Severity: Compile Error --> Cannot redeclare Events::managesbooking() /home/view360/public_html/j4edemo/application/controllers/Events.php 50
ERROR - 2021-09-07 09:38:21 --> Severity: error --> Exception: Call to a member function add_reward_point() on null /home/view360/public_html/j4edemo/application/controllers/Events.php 75
ERROR - 2021-09-07 09:40:05 --> Severity: Notice --> Undefined property: Events::$user_model /home/view360/public_html/j4edemo/application/controllers/Events.php 75
ERROR - 2021-09-07 09:40:05 --> Severity: error --> Exception: Call to a member function add_reward_point() on null /home/view360/public_html/j4edemo/application/controllers/Events.php 75
ERROR - 2021-09-07 09:40:35 --> Query error: Column 'event_cat_id' in field list is ambiguous - Invalid query: SELECT `event_cat_id`, `event_j4e_meet`
FROM `events`
INNER JOIN `event_category` ON `event_category`.`event_cat_id` = `events`.`event_id`
WHERE `event_id` = '21'
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5107
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5107
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5060
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5063
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'buddy_meet_withuserid' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5070
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5073
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'buddy_meet_withuserid' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5070
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5073
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'request_from' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5060
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'profile_pic' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5063
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5107
ERROR - 2021-09-07 09:42:38 --> Severity: Notice --> Trying to get property 'event_thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5107
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3448
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3448
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3448
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:42:39 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3377
ERROR - 2021-09-07 09:44:02 --> Severity: Notice --> Trying to get property 'event_j4e_meet' of non-object /home/view360/public_html/j4edemo/application/controllers/Events.php 85
ERROR - 2021-09-07 09:44:03 --> Severity: Notice --> Undefined variable: btnnms /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_attedance.php 47
ERROR - 2021-09-07 09:46:50 --> Severity: Notice --> Trying to get property 'event_j4e_meet' of non-object /home/view360/public_html/j4edemo/application/controllers/Events.php 57
ERROR - 2021-09-07 09:47:16 --> Severity: Notice --> Trying to get property 'event_j4e_meet' of non-object /home/view360/public_html/j4edemo/application/controllers/Events.php 57
ERROR - 2021-09-07 09:48:10 --> Severity: Notice --> Trying to get property 'event_j4e_meet' of non-object /home/view360/public_html/j4edemo/application/controllers/Events.php 57
ERROR - 2021-09-07 09:49:58 --> Severity: Notice --> Undefined property: stdClass::$event_j4e_meet /home/view360/public_html/j4edemo/application/controllers/Events.php 58
ERROR - 2021-09-07 10:01:45 --> Query error: Unknown column 'id' in 'field list' - Invalid query: select id FROM event_booking where booking_userid='83' AND bookin_attedance !='3' 
ERROR - 2021-09-07 10:01:45 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7350
ERROR - 2021-09-07 10:01:55 --> Query error: Unknown column 'id' in 'field list' - Invalid query: select id FROM event_booking where booking_userid='83' AND bookin_attedance !='3' 
ERROR - 2021-09-07 10:01:55 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7350
ERROR - 2021-09-07 10:40:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 11:18:51 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
ERROR - 2021-09-07 12:28:29 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Admin/list_user.php 57
ERROR - 2021-09-07 12:28:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Admin/list_user.php 57
ERROR - 2021-09-07 13:02:58 --> Severity: Warning --> Invalid argument supplied for foreach() /home/view360/public_html/j4edemo/application/views/themes/default/Backend/event/event_detail.php 78
