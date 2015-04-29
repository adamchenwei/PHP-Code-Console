<?php
/**
 * @todo:
 * @version
 * 1.0
 */

require_once('common.php');
$my_report_id = -1;
require_once('incl-auth.php');

//$request_body = file_get_contents('php://input');
//receive initial
//receive request_body text (not from javascript directly maybe? Since its not working with $_POST)
//

/*Logging Process*/
/*Console Logic BEG*/
if(Server::IsProduction()) print 'This script is disabled on production, for now.';
$time = '';
if($request_body){
  $log = new PHPConsoleLogBeta;
  $log->initials = $auth_employee->initials;
  $log->ipnum = ip2long($_SERVER['REMOTE_ADDR']);
  $log->hostname = $_SERVER['HTTP_HOST'];
  $log->time_run = date('Y-m-d H:i:s');
  $log->command = $request_body;
  $log->save();

  $time = "N/A";/*temperary*/

/*$time_start = microtime(true);
ob_start();
  db::reset();//reset the db
  try {
  	$code = $request_body;
  	$code .= "\n".' $test_console_completed = true;';
  	print eval($code);
  	$log->completed = @$test_console_completed;
  } catch (Exception $e){
  	print 'Caught exception type '.get_class($e). ' : '.$e->getMessage();
  }
  db::reset(); //reset it again

  $log->production = Server::IsProduction();
  $log->save();
  $time_end = microtime(true);
  $time = $time_end - $time_start;
  $output  = ob_get_clean();
*/
}

if(!isset($log) && @$_REQUEST['log_id']) $log = DataMap::findById('PHPConsoleLogBeta', $_REQUEST['log_id']);
if(!isset($log)) $log = DataMap::findOne('PHPConsoleLogBeta', Criteria::create()->equals('initials', $auth_employee->initials)->order('time_run DESC'));
//$code = isset($log) ? $log->command : '';
/*Console Logic END*/
?>