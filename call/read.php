<?php
/**
 * @todo:
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');

/*Receive Data*/
$data = file_get_contents("php://input");
$objData = json_decode($data);
/*var_dump($objData->myCodeName);
var_dump($objData->myCodeOwner);
var_dump($objData->myCodeBody);
var_dump($objData->myCodeCreateDate);*/


/*Output*/
/*$createDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $objData->myCodeCreateDate);
$editDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $objData->myCodeLastEditDate);
echo ($objData->myCodeCreateDate);*/

/*$objData->myCodeCreateDate="2014-06-24T22:37:13.151Z";*/
/*$date = DateTime::createFromFormat('j-M-Y', $objData->myCodeCreateDate);
echo $date->format('Y-m-d H:i:s');*/
/*echo ("<br><br><br>Raw......     ");
var_dump ( $objData->myCodeCreateDate );
$createDateConverted = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $objData->myCodeCreateDate);
echo ("<br><br><br>Converted......     ");
echo $createDateConverted;
$createDateFormatted = $createDateConverted->format('Y-m-d H:i:s');
echo ("<br><br><br>Formatted......     ");
echo $createDateFormatted;*/

/*echo ("<br><br><br>");
echo ($createDateConverted);
echo ($objData->myCodeCreateDate);
echo ("<br><br><br>");*/

/*Write Data Into DB*/
$db = db::logs();
$sql = "
		INSERT INTO php_console_history_beta_mycode (
			myCodeName,
			myCodeOwner,
			myCodeBody,
			myCodeCreateDate
			)
		VALUES (
			'$objData->myCodeName',
			'$objData->myCodeOwner',
			'$objData->myCodeBody',
			'$objData->myCodeCreateDate'
			);
		";
$res = $db->query( $sql );
f(!$res){
	echo ("res not found!");
}else{
	/*$result = $res->fetch_object();
	$objData = json_encode($result);
	echo $objData;*/
}








?>