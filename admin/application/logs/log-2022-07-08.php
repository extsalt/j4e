<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-08 03:14:13 --> Query error: Expression #2 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'j4e_db.recomendation.doe' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT COUNT(id) AS total_sale, DATE_FORMAT(doe, "%b") AS month_name
FROM `recomendation`
GROUP BY year(CURDATE()), MONTH(doe)
ORDER BY year(CURDATE()), MONTH(doe)
ERROR - 2022-07-08 03:14:13 --> Severity: error --> Exception: Call to a member function result_array() on boolean /var/www/html/admin/application/controllers/Dashboard.php 88
ERROR - 2022-07-08 03:17:58 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/admin/application/views/themes/default/footer.php 588
ERROR - 2022-07-08 03:22:22 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:23 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:23 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:24 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:31 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:31 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:22:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '= ''
WHERE `id` = '2'' at line 1 - Invalid query: UPDATE `user_package_features` SET  = ''
WHERE `id` = '2'
ERROR - 2022-07-08 03:22:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:22:49 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:23:35 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:23:35 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:23:36 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:23:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:23:59 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:31:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:31:51 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:32:03 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:32:03 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:32:04 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:32:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:32:44 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:34:21 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:34:22 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:34:22 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:35:40 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:35:40 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:35:41 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:35:41 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:36:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '= ''
WHERE `id` = '2'' at line 1 - Invalid query: UPDATE `user_package_features` SET  = ''
WHERE `id` = '2'
ERROR - 2022-07-08 03:36:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:36:06 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:36:17 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:36:17 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:36:17 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:36:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:36:20 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:36:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:36:39 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:37:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:37:25 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:57:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:57:33 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 03:59:13 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:59:14 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:59:14 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 03:59:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 03:59:16 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 04:01:46 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 04:01:47 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 04:01:47 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 04:04:16 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 04:04:16 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 05:35:45 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/admin/application/views/themes/default/footer.php 588
ERROR - 2022-07-08 05:36:06 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/admin/application/views/themes/default/footer.php 588
ERROR - 2022-07-08 10:21:23 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:21:23 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:21:23 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:21:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 10:21:25 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
ERROR - 2022-07-08 10:22:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:22:08 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:22:08 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 10:25:28 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/admin/application/views/themes/default/footer.php 588
ERROR - 2022-07-08 11:36:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/admin/application/views/themes/default/footer.php 588
ERROR - 2022-07-08 16:56:49 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 16:56:49 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 16:56:49 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable /var/www/html/admin/application/models/User_model.php 6482
ERROR - 2022-07-08 16:56:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP ' at line 1 - Invalid query: SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC
ERROR - 2022-07-08 16:56:54 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 1586
