<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-16 08:59:18 --> Query error: Expression #2 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'view360_j4e_new.recomendation.doe' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT COUNT(id) AS total_sale, DATE_FORMAT(doe, "%b") AS month_name
FROM `recomendation`
GROUP BY year(CURDATE()), MONTH(doe)
ORDER BY year(CURDATE()), MONTH(doe)
ERROR - 2022-02-16 08:59:18 --> Severity: error --> Exception: Call to a member function result_array() on boolean /home/view360/public_html/j4e_new/application/controllers/Dashboard.php 88
