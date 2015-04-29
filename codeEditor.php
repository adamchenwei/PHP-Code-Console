<?php
/**
 * @todo:
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
/*require_once('incl-auth.php');*/

/*Init*/
/*$objData = array(
	'myNewCodeName'=>"",
	'myCodeName'=>""
	);*/
/*$_GET['newCodeName'] ='';
$_GET['oldCodeName'] ='';
*/

/*Receive Data*/
$data = file_get_contents("php://input");
$objData = json_decode($data);

/*echo ("BEFORE ENOCDE");
var_dump($data);



echo ("AFTER ENOCDE");
var_dump($objData);*/
/*var_dump($objData->myCodeName);
var_dump($objData->myCodeOwner);
var_dump($objData->myCodeBody);
var_dump($objData->myCodeCreateDate);*/

$db = db::logs();
$body=$db->real_escape_string($objData->myCodeBody);
if($objData->myNewCodeName!=$objData->myCodeName){
	echo("changed Name<br>");
	echo("$objData->myNewCodeName");
	echo("$objData->myCodeId");
	echo("$objData->myCodeName");
	
	$sql = "
			UPDATE php_console_history_beta_mycode
			SET
				myCodeName = '$objData->myNewCodeName',
				myCodeLastEditDate = '$objData->myCodeLastEditDate'
			WHERE
				myCodeId='$objData->myCodeId';
			";
}else{
	/*Write Data Into DB*/
	/*echo("update the whole code<br>");*/
	$sql = "
			UPDATE php_console_history_beta_mycode
			SET
				myCodeName = '$objData->myNewCodeName',
				myCodeBody = '$body'
			WHERE
				myCodeId='$objData->myCodeId';
			";
}

$db = db::logs();
$res = $db->query( $sql );
if(!$res){echo ("res for update is not found!");}


$sql = "
		SELECT
			myCodeId,
			myCodeName,
			myCodeOwner,
			myCodeBody,
			myCodeTimesUsedCount,
			myCodeValueAsMins,
			myCodeCreateDate,
			myCodeLastEditDate,
			isSnippet,
			isDeleted,
			isMyFavorite
		FROM
			php_console_history_beta_mycode
		WHERE
			myCodeOwner = '$objData->myCodeOwner'
		ORDER BY
			myCodeLastEditDate DESC
		LIMIT 1
		";
$res = $db->query( $sql );
if(!$res){echo ("res for select is not found!");}
$result = $res->fetch_object();
$objData = json_encode($result);
echo $objData;
?>