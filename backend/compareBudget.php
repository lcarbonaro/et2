<?php
require_once '../../includes/db.inc.php';

// read in POSTed parameters
$inparms = file_get_contents("php://input");
$objParms  = json_decode($inparms);
$month     = $objParms->month;
$year      = $objParms->year;

$sql = "SELECT c.code AS `category`, IFNULL(b.amount,0 ) AS `budgeted`, IFNULL( SUM( e.amount ) , 0 ) AS `actual`, 
               CASE WHEN IFNULL( sum( e.amount ) , 0 ) > IFNULL(b.amount,0) THEN 'over' ELSE 'ok' END AS `status` 
          FROM `category` c 
          LEFT OUTER JOIN `expense` e ON c.code = e.category AND YEAR( e.date ) = :year AND MONTH( e.date ) = :month
          LEFT OUTER JOIN `budget` b  ON c.code = b.category AND YEAR( b.date ) = :year AND MONTH( b.date ) = :month
         WHERE c.isactive = 'y' 
         GROUP BY c.code";

$parms =  array( ':month' => $month, ':year' => $year );    

$compareList  = R::getAll( $sql, $parms );

echo json_encode($compareList);
exit();