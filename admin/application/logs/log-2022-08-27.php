<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-27 05:50:54 --> Query error: Incorrect DATE value: '08/27/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`>='08/27/2022' AND `event_status`='1'   
ERROR - 2022-08-27 05:50:54 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8466
ERROR - 2022-08-27 05:50:54 --> Query error: Incorrect DATE value: '08/27/2022' - Invalid query: select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`<'08/27/2022' AND `event_status`='1'   
ERROR - 2022-08-27 05:50:54 --> Severity: error --> Exception: Call to a member function result() on boolean /var/www/html/admin/application/models/User_model.php 8476
