<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-01-22 01:42:26 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: UPDATE `user` SET `login_success_detail` = '{\"time\":\"2025-01-22 01:42:26 UTC\",\"interface\":\"web\",\"ip_address\":\"160.187.82.65\",\"user_agent\":\"Chrome 132.0.0.0\"}', `online` = 1, `online_time` = '2025-01-22 01:42:26'
WHERE `ids` IS NULL
ERROR - 2025-01-22 01:42:26 --> Query error: Column 'user_ids' cannot be null - Invalid query: INSERT INTO `activity` (`user_ids`, `level`, `event`, `detail`, `debug_detail`, `created_time`) VALUES (NULL, 'Information', 'signin-success', '{\"ip\":\"160.187.82.65\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"132.0.0.0\",\"platform\":\"Windows 10\"}', '', '2025-01-22 01:42:26')
ERROR - 2025-01-22 01:42:32 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: UPDATE `user` SET `login_success_detail` = '{\"time\":\"2025-01-22 01:42:32 UTC\",\"interface\":\"web\",\"ip_address\":\"160.187.82.65\",\"user_agent\":\"Chrome 132.0.0.0\"}', `online` = 1, `online_time` = '2025-01-22 01:42:32'
WHERE `ids` IS NULL
ERROR - 2025-01-22 01:42:32 --> Query error: Column 'user_ids' cannot be null - Invalid query: INSERT INTO `activity` (`user_ids`, `level`, `event`, `detail`, `debug_detail`, `created_time`) VALUES (NULL, 'Information', 'signin-success', '{\"ip\":\"160.187.82.65\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"132.0.0.0\",\"platform\":\"Windows 10\"}', '', '2025-01-22 01:42:32')
ERROR - 2025-01-22 01:52:32 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: UPDATE `user` SET `online` = 1, `online_time` = '2025-01-22 01:52:32'
WHERE `ids` = 'undefined'
ERROR - 2025-01-22 02:02:32 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: UPDATE `user` SET `online` = 1, `online_time` = '2025-01-22 02:02:32'
WHERE `ids` = 'undefined'
ERROR - 2025-01-22 02:12:32 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: UPDATE `user` SET `online` = 1, `online_time` = '2025-01-22 02:12:32'
WHERE `ids` = 'undefined'
