<?php

/*******************************************************
	Page Security Check BEG
 *******************************************************/
$test =0;
// require_once('common.php');
// //Shopkeeper PHP sandbox! Try not to use this to do writes.
// $my_report_id = -1;
// require_once('incl-auth.php');

// require("header-coder.php");
// echo (" <br \>");
$auth_who="awh";
$auth_initials="awh";
if ( !$auth_who || $auth_who=="Anonymous" ) {
	echo '<h2>You need to be logged in to use this tool</h2>';
	exit;
};
/*else{*/
if($test){Benchm::v($_COOKIE, "_COOKIE");};
if($test){Benchm::v($auth_who, "auth_who");};
if($test){Benchm::v($auth_initials, "auth_initials");};
$file="result-awh.php";
$files=array(
	"result-awh.php",
	"result-aiy.php",
	"result-dvg.php",
);
if($test){Benchm::v($_SESSION, "SESSION");};
//$user=strtolower($_SESSION['auth']->initials);
$user=strtolower($auth_initials);
/*******************************************************
	Page Security Check END
 *******************************************************/


/*******************************************************
	Check File Permission
 *******************************************************/
$permissionLevel=755;
$currentUsername='';
$currentUserGitRepoLocal='';
$owner="_www";
switch ($user) {
	case 'awh':
		$file=$files[0];
		break;
	case 'aiy':
		$file=$files[1];
		break;
	case 'dvg':
		$file=$files[2];
		break;
	default:
		echo ("Not a authorized user!");
		break;
}


$perms = fileperms($file);

if (($perms & 0xC000) == 0xC000) {
    // Socket
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Symbolic Link
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Regular
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Block special
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Directory
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Character special
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // FIFO pipe
    $info = 'p';
} else {
    // Unknown
    $info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));
/*******************************************************
	Check File Owner
 *******************************************************/
//$owner =posix_getpwuid(fileowner($file));
$owner=array(
	'name'=>"_www",

);
$changeInfo='';
$changeOwner='';
if($info!="-rwxr-xr-x"||$owner['name']!=="_www"){
	// echo ("Please change your file permssion. Its has been altered and Coder does not like it!".
	// 	"<br>Current permission: ".$info.
	// 	"<br>Current owner: ".$owner['name'].
	// 	"<br>"
	// );
	if($info!="-rwxr-xr-x"){
		$changeInfo="<br>Correct permission: <b>-rwxr-xr-x</b>";
	};
	if($owner['name']!=="_www"){
		$changeOwner="<br>Correct owner: <b>_www</b>";
	};
	echo ('
		<div class="alert alert-danger" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>
	  Please change your file permssion. Its has been altered and Coder does not like it!
	  <br>Current permission: '.$info.''.$changeInfo.
		'<br>Current owner: '.$owner['name'].''.$changeOwner.
		'<br>
	</div>
	');
}else{
	if($test){
		echo ("File permission is good!");
	}
};

/**
 * @filename: Display Git Branch Currently On
 * @usage: Include this file after the '<body>' tag in your project
 * @author Kevin Ridgway 
 */
		//Validate user name to read .git file accordingly-awh
		//

		switch ($user) {
			case 'awh':
				$currentUsername="adam";
				$currentUserGitRepoLocal="adam";
				break;
			case 'dvg':
				$currentUsername="dgiglio";
				$currentUserGitRepoLocal="dgiglio";
				break;
			case 'aiy':
				$currentUsername="aziz";
				$currentUserGitRepoLocal="aziz";
				break;
			default:
				echo ("Can't find a valid user!");
				exit;
				break;
		}
		$dirLink='/Library/WebServer/Webs/'.$currentUsername.'/.git/HEAD';
		//Benchm::v($dirLink,"dirlink");
    //$stringfromfile = file($dirLink, FILE_USE_INCLUDE_PATH);
    $stringfromfile = "abc";
    $firstLine = $stringfromfile[0]; //get the string from the array
    $explodedstring = explode("/", $firstLine, 3); //seperate out by the "/" in the string
    //$branchname = $explodedstring[2]; //get the one that is always the branch name

    if($test){Benchm::v($dirLink,"dirLink");};
    if($test){$theFiles = scandir($dirLink);};
    if($test){Benchm::v($theFiles,"theFiles");};
    if($test){Benchm::v($stringfromfile,"GIT");};
    if($test){Benchm::v($firstLine,"firstLine");};
    if($test){Benchm::v($explodedstring,"explodedstring");};

    if($test){
    	echo ("<br><h1> ANOTHER TEST</h1><br>");
	    // $dir    = '../../../../../../../Users/aziz/';
	    // $dir    = '../../../../../../../Users/aziz/Library';
	    echo ("_DIR_ IS ".__DIR__);
	    $dir = dirname('../../../../../../..'.__DIR__);
	    Benchm::v($dir, "DIR");
	    $files1 = scandir($dir);
	     Benchm::v($files1, "files1");

     	$contentFiles1 = file_get_contents($dir);
  		Benchm::v($contentFiles1, "contentFiles1");

  		echo ("_DIR_ IS ".__DIR__."/result-awh.php");
  		$dirNew=__DIR__."/result-awh.php";
  		$contentDIR = file_get_contents($dirNew);
  		Benchm::v($contentDIR, "contentDIR");


	    // $content2 = file_get_contents($dir);
	    // Benchm::v($content2, "content2");

	    //echo (implode('/', array_slice(explode('/', file_get_contents('.git/HEAD')), 2)));
	    //$content = file_get_contents('../../../../aziz.shopkeeper.tekserve.com/.git/HEAD');
	    $content = file_get_contents('../../../../.git/HEAD');
	    Benchm::v($content, "content");


	    $contentAdam = file_get_contents('/Library/WebServer/Webs/adam/.git/HEAD');
	    Benchm::v($content, "contentAdam");

  	};