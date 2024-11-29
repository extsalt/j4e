<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-26 06:23:23 --> Query error: Unknown column 'avg' in 'order clause' - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank 
FROM
 (SELECT userid, sum(point) as sumtotal
  FROM reward_user_point where userid=1
  GROUP BY userid ORDER BY sum(point) DESC) agg
CROSS JOIN (SELECT @rn := 0) CONST
ORDER BY avg DESC
ERROR - 2021-08-26 06:23:23 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7120
ERROR - 2021-08-26 06:23:55 --> Query error: Unknown column 'avg' in 'order clause' - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank 
FROM
 (SELECT userid, sum(point) as sumtotal
  FROM reward_user_point where userid=1
  GROUP BY userid ORDER BY sum(point) DESC) agg
CROSS JOIN (SELECT @rn := 0) CONST
ORDER BY avg DESC
ERROR - 2021-08-26 06:24:56 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF) /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7126
ERROR - 2021-08-26 06:26:12 --> Severity: Notice --> Undefined variable: userids /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7111
ERROR - 2021-08-26 06:26:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP BY userid ORDER BY sum(point) DESC) agg
CROSS JOIN (SELECT @rn := 0) CONS' at line 5 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank 
FROM
 (SELECT userid, sum(point) as sumtotal
  FROM reward_user_point where userid=
  GROUP BY userid ORDER BY sum(point) DESC) agg
CROSS JOIN (SELECT @rn := 0) CONST
ORDER BY sumtotal DESC
ERROR - 2021-08-26 06:29:03 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 7010
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2904
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2909
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2915
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2920
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2927
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2950
ERROR - 2021-08-26 06:29:14 --> Severity: Notice --> Undefined index: rank /home/view360/public_html/j4edemo/application/models/User_model.php 3129
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2904
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2909
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2915
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2920
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2927
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2950
ERROR - 2021-08-26 06:29:19 --> Severity: Notice --> Undefined index: rank /home/view360/public_html/j4edemo/application/models/User_model.php 3129
ERROR - 2021-08-26 06:30:42 --> Severity: Notice --> Undefined variable: gallery_data /home/view360/public_html/j4edemo/application/models/User_model.php 5686
ERROR - 2021-08-26 06:36:09 --> Severity: Notice --> Trying to get property 'functional_area' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 1236
ERROR - 2021-08-26 09:44:04 --> Query error: Unknown column 'user.buddy_id' in 'on clause' - Invalid query: select * from buddies LEFT JOIN user ON buddies.user_id=user.buddy_id where user.id='99'  AND ( user.packages_id = '9')
ERROR - 2021-08-26 09:44:04 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 2984
ERROR - 2021-08-26 10:12:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 10:12:46 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 10:12:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 10:12:56 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 10:18:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 10:18:58 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 10:52:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 10:52:02 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 10:52:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 10:52:39 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:25:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:25:21 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:25:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:25:26 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:26:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:26:11 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:26:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:26:44 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:30:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:30:20 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:30:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:30:46 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:31:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:31:00 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 11:41:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 11:41:23 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 12:30:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 12:30:14 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
ERROR - 2021-08-26 13:26:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND membership_type !='0'' at line 1 - Invalid query: select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`= AND membership_type !='0'
ERROR - 2021-08-26 13:26:13 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 3494
