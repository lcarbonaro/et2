<?php
require_once '../../includes/db.inc.php';

// read in POSTed parameters
$parms = file_get_contents("php://input");
$objParms  = json_decode($parms);
$month     = $objParms->month;
$year      = $objParms->year;
$category  = $objParms->category;

if ( $category==='ALL' ) {    
    $sql = "SELECT `id`,`date`,`category`,`amount`,`paidby`, `comment` FROM `expense` WHERE MONTH(`date`) = :month AND YEAR(`date`) = :year";
    $parms =  array( ':month' => $month, ':year' => $year );    
} else {
    $sql = "SELECT `id`,`date`,`category`,`amount`,`paidby`, `comment` FROM `expense` WHERE MONTH(`date`) = :month AND YEAR(`date`) = :year AND `category` = :category";
    $parms =  array( ':month' => $month, ':year' => $year, ':category' => $category );    
}

$expenseList  = R::getAll( $sql, $parms );

echo json_encode($expenseList);
exit();