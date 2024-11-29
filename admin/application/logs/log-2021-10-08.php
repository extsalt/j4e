<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-10-08 10:21:31 --> Query error: Unknown column 'invite_id' in 'order clause' - Invalid query: SELECT `event_title`
FROM `events`
WHERE `event_id` = '1'
AND `event_status` = '1'
ORDER BY `invite_id` DESC
ERROR - 2021-10-08 10:21:31 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4e_new/application/models/User_model.php 7719
ERROR - 2021-10-08 10:22:34 --> Query error: Unknown column 'event_invite_id' in 'order clause' - Invalid query: SELECT `event_title`
FROM `events`
WHERE `event_id` = '1'
AND `event_status` = '1'
ORDER BY `event_invite_id` DESC
ERROR - 2021-10-08 10:22:34 --> Severity: error --> Exception: Call to a member function row() on boolean /home/view360/public_html/j4e_new/application/models/User_model.php 7719
ERROR - 2021-10-08 10:35:00 --> Severity: Warning --> Division by zero /home/view360/public_html/j4e_new/application/models/User_model.php 6478
