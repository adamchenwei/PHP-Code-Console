

<?php
/**
 * @todo
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');

if ( !isset( $auth_who ) ) {
	echo '<h2>You need to be logged in to use this tool</h2>';
	exit;
}else{
	//echo $auth_who;
	
}

/*Load User Info*/
/*$log = new PHPConsoleLog;
$log->initials = $auth_employee->initials;
$log->ipnum = ip2long($_SERVER['REMOTE_ADDR']);
$log->hostname = $_SERVER['HTTP_HOST'];*/
//var_dump($log->initials);

/*Receive Data*/
$data = file_get_contents("php://input");
$objData = json_decode($data);

/*Get Data From DB*/
$db = db::logs();
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
			myCodeOwner ='$objData->myCodeOwner'
			AND
			myCodeId='$objData->myCodeId'
		ORDER BY
			myCodeLastEditDate DESC
		LIMIT 1
		";
$res = $db->query( $sql );
if(!$res){
	echo ("res not found!");
}


$result = $res->fetch_object();

$objData = json_encode($result);
echo $objData;


?>