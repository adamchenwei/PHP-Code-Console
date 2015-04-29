

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
$log = new PHPConsoleLog;
$log->initials = $auth_employee->initials;
$log->ipnum = ip2long($_SERVER['REMOTE_ADDR']);
$log->hostname = $_SERVER['HTTP_HOST'];
//var_dump($log->initials);
//
//
//
$objData= new stdClass();
$objData->codeTerm = $_GET['codeTerm'];
$objData->startRecord = $_GET['startRecord'];
$objData->recordPerPage = $_GET['recordPerPage'];
/*echo (" fd f d fd fd<br>");
echo ($objData->recordPerPage);
echo ("<br>");
echo ($objData->codeTerm);
echo ("<br>");
echo ($objData->startRecord);
echo ("<br>");*/
/*$objData->myCodeOwner = $_GET['myCodeOwner'];*/
/*The New Start Record*/
/*$objData->startRecord =($objData->currentPage-1)*$objData->recordPerPage;*/
/*Receive Data*/
$data = file_get_contents("php://input");
/*$objData = json_decode($data);*/

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
				myCodeName LIKE '%{$objData->codeTerm}%'
		ORDER BY
			myCodeLastEditDate DESC
		LIMIT {$objData->startRecord} , {$objData->recordPerPage}
		";
$res = $db->query( $sql );
if(!$res){
	echo ("res not found!");
	/*echo ($db->mysql_error());*/
}

$result = $res->fetch_object();
/*Conversion*/

$res = $db->query( $sql );
if(!$res){echo ("res not found!");}
$result=array();
while($entry = $res->fetch_assoc()){$result[]=$entry;}

$newAgentArray=array();
//foreach( $result AS $agentInfoArray => $attributesArray ){
foreach( $result AS $innerAgentArray ){
	$newAgentArray[] = $innerAgentArray;
}

$historyData = json_encode($newAgentArray);
if(!$historyData){echo ("historyData not found!");}
echo $historyData ;

?>