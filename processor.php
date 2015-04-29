<?php
/**
 * @todo:implimenting common and incl-auth will cause delay in runtime for javascript! NOT PROCEEDABLE! Must find alternative if want to tighten security further.
 * @version
 * 1.0 - Must NOT edit or open "result.php" otherwise, affect permission-CWH
 */
/*require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');*/

require_once('common.php');

$request_body = file_get_contents('php://input');
$objData = json_decode($request_body);
$myCodeOwner=$_GET['myCodeOwner'];
/*var_dump($request_body->params);*/
$myFile = "result-$myCodeOwner.php";
//echo exec('whoami');
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $objData->params);
fclose($fh);


?>