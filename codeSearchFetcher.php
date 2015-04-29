

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

/*Receive Data*/
/*$data = file_get_contents("php://input");
$objData = json_decode($data);*/
$objData = $_GET['codeTerm'];
//$objData = "fsa";
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
			myCodeName LIKE '%$objData%'
		ORDER BY
			myCodeLastEditDate DESC
		LIMIT 5
		";
$res = $db->query( $sql );
if(!$res){
	echo ("res not found!");
}


$result = $res->fetch_object();
/*Conversion*/

$res = $db->query( $sql );
$result=array();
while($entry = $res->fetch_assoc()){$result[]=$entry;}
//Benchm::v($result, "result   ");
//$agentsInfoArray=array();

$newAgentArray=array();
//foreach( $result AS $agentInfoArray => $attributesArray ){
foreach( $result AS $innerAgentArray ){
	$newAgentArray[] = $innerAgentArray;
}

/*
header("Content-type: text/plain");
echo ("<pre>");
var_dump($newAgentArray);
echo ("</pre>");*/
$objData = json_encode($newAgentArray);
echo $objData ;


?>