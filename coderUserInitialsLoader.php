<?php
/**
 * @todo:
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');
$objData= new stdClass();
$objData->hasData = true;
$objData->myCodeOwner = '';
/*echo ($auth_initials);*/
$res=strtolower($auth_initials);
$objData->myCodeOwner = $res;
/*echo ($res);*/
if(!$res || $res==''){
	/*means there is no initials or no one is logged in!*/
	/*echo ("initlas not found!");*/
	$objData->hasData = false;
}else{
	$db = db::logs();
	$sql = "
			SELECT
				myCodeId
			FROM
				php_console_history_beta_mycode
			WHERE
				myCodeOwner = '$res'
			LIMIT 1
			";
	$res2 = $db->query( $sql );
}
/*var_dump($res2);*/
if($res2->num_rows==0){
	/*echo("res empty! no data found!");*/
	$objData->hasData = false;
}else{
	/*echo ("has data!!");*/
}

$objData = json_encode($objData);
echo $objData;





?>