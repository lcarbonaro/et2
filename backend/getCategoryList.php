<?php
require_once '../../includes/db.inc.php';
$categoryList  = R::getAll( 'SELECT `code`,`code` AS `desc` FROM `category` WHERE `isactive` = :isactive', [':isactive' => 'y'] );
echo json_encode($categoryList);
exit();