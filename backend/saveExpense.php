<?php
require_once '../../includes/db.inc.php';

// read in POSTed data (the angularjs way)
$data = file_get_contents("php://input");
$objData = json_decode($data);
$date     = $objData->DateStr;
$category = $objData->Category;
$amount   = $objData->Amount;
$comment  = $objData->Comment;
$paidby   = $objData->PaidBy;

// insert record
$sql = 'INSERT INTO `expense` SET `date` = :date, `category` = :category , `amount` = :amount , `paidby` = :paidby , `comment` = :comment ';
$parms = array (':date' => $date , ':category' => $category , ':amount' => $amount , ':comment' => $comment , ':paidby' => $paidby   );
$res = R::exec( $sql, $parms );
 
echo($res);
exit();
