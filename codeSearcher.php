

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


$objData= new stdClass();
$objData->codeTerm = $_GET['codeTerm'];
$objData->recordPerPage = $_GET['recordPerPage'];
$objData->totalRecords = 0;
//$objData = "fsa";
/*Get Data From DB*/

echo (" fd f d fd fd<br>");
echo ($objData->recordPerPage);
echo ("<br>");
echo ($objData->codeTerm);
echo ("<br>");


$db = db::logs();
$sql = "
		SELECT
			myCodeId
		FROM
			php_console_history_beta_mycode
		WHERE
			myCodeName LIKE '%$objData->codeTerm%'
		ORDER BY
			myCodeLastEditDate DESC
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
$objData->totalRecords=count($result);
$objData->totalPages=ceil($objData->totalRecords/$objData->recordPerPage);
$objData->currentPage=1;
$objData = json_encode($objData);
echo $objData ;


?>