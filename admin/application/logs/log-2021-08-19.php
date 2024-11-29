<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-19 04:33:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '74' ') as count from `recomendation` INNER JOIN user ON user.id = recomendation.' at line 1 - Invalid query: select COUNT('SELECT COUNT(id), recomend_by FROM recomendation where recomendation.userid='74' ') as count from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY count DESC
ERROR - 2021-08-19 04:33:31 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5843
ERROR - 2021-08-19 04:34:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '74' ') as count from `recomendation` INNER JOIN user ON user.id = recomendation.' at line 1 - Invalid query: select COUNT('SELECT COUNT(id), recomend_by FROM recomendation where recomendation.userid='74' ') as count from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY count DESC
ERROR - 2021-08-19 04:41:14 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:41:18 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:41:24 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:41:48 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:42:40 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:45:43 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:47:29 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:47:35 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 04:47:37 --> Severity: Notice --> Undefined index: result /home/view360/public_html/j4edemo/application/controllers/Api_v1.php 121
ERROR - 2021-08-19 05:10:16 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY count DESC
ERROR - 2021-08-19 05:10:16 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5845
ERROR - 2021-08-19 05:10:35 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY count DESC
ERROR - 2021-08-19 05:35:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 05:35:52 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 05:35:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 05:35:54 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 05:35:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 05:35:57 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 05:36:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 05:36:17 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 05:45:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 05:45:19 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:32:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:32:57 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:33:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:33:01 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:33:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:33:03 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:47:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:47:04 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:47:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:47:10 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5851
ERROR - 2021-08-19 06:54:35 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:39 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:39 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:42 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:46 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:46 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:54:59 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:56:49 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:56:56 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:56:57 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:57:01 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:57:01 --> Severity: Compile Error --> Cannot redeclare User_model::get_list_recommendations_to() /home/view360/public_html/j4edemo/application/models/User_model.php 5856
ERROR - 2021-08-19 06:58:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:58:42 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5739
ERROR - 2021-08-19 06:58:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 06:58:55 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 07:09:34 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select recomendation.id as recom_id,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY visits DESC
ERROR - 2021-08-19 07:09:34 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 07:09:54 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select recomendation.id as recom_id,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY visits DESC
ERROR - 2021-08-19 07:10:20 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'view360_j4edemo.recomendation.id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: select recomendation.id as recom_id,COUNT(recomendation.id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY visits DESC
ERROR - 2021-08-19 07:19:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 07:19:17 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5739
ERROR - 2021-08-19 07:24:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM p' at line 1 - Invalid query: select *,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74' SELECT SUM(order_count.number) AS total, image.image_link AS image_link 
FROM product JOIN order_count 
ON product.product_id = order_count.product_id 
JOIN image ON product.image_id = image.image_id
GROUP BY order_count.product_id 
ORDER BY total DESC 
LIMIT 3  ORDER BY count DESC
ERROR - 2021-08-19 07:24:08 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5739
ERROR - 2021-08-19 07:25:08 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select recomendation.id,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'   ORDER BY count DESC
ERROR - 2021-08-19 07:25:08 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5733
ERROR - 2021-08-19 07:29:14 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select recomendation.id,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='74'   ORDER BY count DESC
ERROR - 2021-08-19 07:29:14 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5733
ERROR - 2021-08-19 07:29:47 --> Query error: Column 'id' in field list is ambiguous - Invalid query: select recomendation.id,COUNT(id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='74'   ORDER BY visits DESC
ERROR - 2021-08-19 07:29:47 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5733
ERROR - 2021-08-19 08:18:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '74' GROUP BY recomendation.recomend_by') as visits from `recomendation` INNER JO' at line 1 - Invalid query: select recomendation.id,recomend_by,COUNT('select recomendation.recomend_by from recomendation where recomendation.userid='74' GROUP BY recomendation.recomend_by') as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by where recomendation.userid='74' GROUP BY recomendation.id,recomend_by ORDER BY visits DESC
ERROR - 2021-08-19 08:18:27 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5962
ERROR - 2021-08-19 08:18:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '74' GROUP BY recomendation.recomend_by') as visits from `recomendation` INNER JO' at line 1 - Invalid query: select recomendation.id,recomend_by,COUNT('select recomendation.recomend_by from recomendation where recomendation.userid='74' GROUP BY recomendation.recomend_by') as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by where recomendation.userid='74' GROUP BY recomendation.id,recomend_by ORDER BY visits DESC
ERROR - 2021-08-19 08:21:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '74' GROUP BY `recomendation`.`recomend_by`') as visits from `recomendation` INNE' at line 1 - Invalid query: select recomendation.id,recomend_by,COUNT('select recomendation.recomend_by from recomendation where recomendation.userid='74' GROUP BY `recomendation`.`recomend_by`') as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by where recomendation.userid='74' GROUP BY recomendation.id,recomend_by ORDER BY visits DESC
ERROR - 2021-08-19 08:28:37 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'view360_j4edemo.recomendation.id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: select recomendation.id,COUNT(recomendation.recomend_by) as visits from `recomendation` where recomendation.userid='74' ORDER BY visits DESC
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5992
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6008
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6009
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6010
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6019
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6020
ERROR - 2021-08-19 08:29:13 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6021
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined property: stdClass::$recom_id /home/view360/public_html/j4edemo/application/models/User_model.php 5986
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'requirement_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5989
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'recomend_by' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5996
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Undefined offset: 0 /home/view360/public_html/j4edemo/application/models/User_model.php 5998
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'middle_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 5999
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'email_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6000
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'phone' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6001
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'designation' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6002
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6003
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_contact' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6004
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'company_address' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6005
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'dob' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6006
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6007
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'user_id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6012
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'id' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6013
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'title' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6014
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'description' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6015
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'thumbnil' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6016
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_date' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6017
ERROR - 2021-08-19 08:29:41 --> Severity: Notice --> Trying to get property 'created_time' of non-object /home/view360/public_html/j4edemo/application/models/User_model.php 6018
ERROR - 2021-08-19 08:34:20 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'view360_j4edemo.recomendation.id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: select recomendation.id as recom_id,COUNT(recomendation.id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'
ERROR - 2021-08-19 09:58:26 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'view360_j4edemo.recomendation.id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: select recomendation.id as recom_id,COUNT(recomendation.id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'
ERROR - 2021-08-19 09:58:26 --> Severity: error --> Exception: Call to a member function result() on boolean /home/view360/public_html/j4edemo/application/models/User_model.php 5966
ERROR - 2021-08-19 09:59:08 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'view360_j4edemo.recomendation.id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: select recomendation.id as recom_id,COUNT(recomendation.id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='74'
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:12:38 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:15:21 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:15:33 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:16:31 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:26:07 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2636
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2641
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2647
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2655
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2662
ERROR - 2021-08-19 10:26:17 --> Severity: Notice --> Undefined index: location /home/view360/public_html/j4edemo/application/models/User_model.php 2667
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:26:58 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:27:24 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:27:32 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:28:12 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:29:48 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:32:09 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:32:09 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:32:09 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:32:09 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3098
ERROR - 2021-08-19 10:32:10 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:32:10 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:32:10 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:32:10 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:32:10 --> Severity: Notice --> Undefined property: stdClass::$company_phone /home/view360/public_html/j4edemo/application/models/User_model.php 3027
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:32:24 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:33:55 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: membershiptype /home/view360/public_html/j4edemo/application/models/User_model.php 2757
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: min_employee /home/view360/public_html/j4edemo/application/models/User_model.php 2762
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: turn_over /home/view360/public_html/j4edemo/application/models/User_model.php 2768
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: business_category /home/view360/public_html/j4edemo/application/models/User_model.php 2773
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2780
ERROR - 2021-08-19 10:36:50 --> Severity: Notice --> Undefined index: keyword /home/view360/public_html/j4edemo/application/models/User_model.php 2803
ERROR - 2021-08-19 12:23:13 --> Query error: Column 'by_user_ids' cannot be null - Invalid query: INSERT INTO `notification` (`ids`, `by_user_ids`, `to_user_ids`, `subject`, `body`, `request_for`, `request_id`, `is_read`) VALUES ('iuhPQzHj14cf7ab8d98f5f0c32214a7c4df3ddb1eP0CVtHOQg', NULL, NULL, 'New Followup Request', 'New Followup Request', 'Followup', 1, '0')
