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