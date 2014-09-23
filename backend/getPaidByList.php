<?php
require_once '../../includes/db.inc.php';
$paidByList  = R::getAll( 'SELECT `code`,`code` AS `desc` FROM `paidby`');
echo json_encode($paidByList);
exit();