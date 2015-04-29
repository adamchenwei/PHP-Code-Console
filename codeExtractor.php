aå<?php
/**
 * @todo:
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');

$arr = array(
  'myCodeName' => "My Code 1",
  'myCodeTimesUsedCount' => 0,
  'myCodeValueAsMins' => 5, 
  'myCodeOwner' => "awh",
  //'myCodeBody' => "echo ("LAL1");", //may need serialization
  'myCodeBody' => "abcabc",
  'myCodeLastEditDate' => "2014-06-16 17:00:59",
  'isSnippet' => 0,
  'isMyFavorite' => 0
);
echo json_encode($arr);



?>