<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-06 02:39:20 --> Severity: Warning --> array_map(): Argument #2 should be an array /var/www/html/admin/application/models/User_model.php 5063
ERROR - 2022-09-06 02:39:20 --> Severity: Warning --> array_multisort(): Argument #1 is expected to be an array or a sort flag /var/www/html/admin/application/models/User_model.php 5063
ERROR - 2022-09-06 04:36:36 --> Query error: Incorrect DATE value: '09/06/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`>='09/06/2022' AND `event_status`='1'   
ERROR - 2022-09-06 04:36:36 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8466
ERROR - 2022-09-06 04:36:36 --> Query error: Incorrect DATE value: '09/06/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`<'09/06/2022' AND `event_status`='1'   
ERROR - 2022-09-06 04:36:36 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8476
ERROR - 2022-09-06 04:55:22 --> Query error: Incorrect DATE value: '09/06/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`>='09/06/2022' AND `event_status`='1'   
ERROR - 2022-09-06 04:55:22 --> Query error: Incorrect DATE value: '09/06/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`<'09/06/2022' AND `event_status`='1'   
ERROR - 2022-09-06 04:55:22 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8466
ERROR - 2022-09-06 04:55:22 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8476
