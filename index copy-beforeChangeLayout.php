<?php
require_once('common.php');
//Shopkeeper PHP sandbox! Try not to use this to do writes.
$my_report_id = -1;
require_once('incl-auth.php');

require("header.php");
echo (" <br \>");
if ( !isset( $auth_who ) ) {
	echo '<h2>You need to be logged in to use this tool</h2>';
	exit;
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<!-- JavaScript Library BEG -->
  	<!-- AngularJS -->
  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.3/angular.js"></script>
  	<!-- Code Mirrior -->
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/lib/codemirror.js"></script>
  <!-- JavaScript Library END -->
	<!-- Styles BEG-->
		<!-- Defalut Styles -->
		<link href="style.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap -->
			<!-- <script type="text/javascript" src="/library/bootstrap/3.1.1/js/bootstrap.js"></script> -->
			<link rel="stylesheet" href="/library/bootstrap/3.1.1/css/bootstrap.min.css">
			<link rel="stylesheet" href="/library/bootstrap/3.1.1/css/bootstrap-theme.css">
  	<!-- Code Mirrior-->
	  	<link rel="stylesheet" href="/jquery_plugins/CodeMirror/lib/codemirror.css">
			<link rel="stylesheet" href="/jquery_plugins/CodeMirror/theme/monokai.css">
			<!-- Code Mirror Sub Styles -->
				<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
	<!-- Styles END-->
</head>
<!-- App BEG -->
<body ng-app="coderApp">
	<div class="container" ng-controller="codeHandler">
		<!-- <div class="row"> --><!-- Whole Page -->

		<!-- Navigation -->
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Brand</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="#">Link</a></li>
		        <li><a href="#">Link</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		            <li class="divider"></li>
		            <li><a href="#">One more separated link</a></li>
		          </ul>
		        </li>
		      </ul>
		      <form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Submit</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Link</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav><!-- Navigation END -->


		<!-- Console -->
		<div class="sbConsole col-md-9">
			<!-- <h2>Coder</h2> -->
			<div class="sbCoder">

				<div class="row"><p></p></div>
				<div class ="sbRun row">
					<button type="button" id="runCode" title="Run the code" class="btn btn-default btn-default" onclick ="loadCode()">
					  <span class="glyphicon glyphicon-play"></span>
					</button>
					<button type="button" id="clearCode" class="btn btn-default btn-default" title="Refresh Coding Area" onclick ="clearCode()">
					  <span class="glyphicon glyphicon-refresh"></span>
					</button>
					<button type="button" id="editCode" title="Edit the code" class="btn btn-default btn-default" ng-click ="editThisCode()">
					  <span class="glyphicon glyphicon-pencil"></span>
					</button>
				</div>
				<div class="">  <p></p> </div>

				<!-- Save Button With Title Input BEG -->
				<div class="row">
					<div class="input-group">
			      <span class="input-group-btn">
			        <button type="button" id="clearCode" class="btn btn-default" ng-click ="saveThisCode()">
						  <span class="glyphicon glyphicon-plus">
						</span></button></span>
			      <input type="text" class="form-control" placeholder="input your code's title" ng-model="codeInfo.myCodeName">
			      <!-- {{codeInfo.myCodeName}} -->
			    </div><!-- /input-group -->
				</div><!-- Save Button With Title Input END -->
				<div class="">  <p></p> </div>

				<div id="coderWindow" class="sbCodeContainer row">
					<form><textarea id="code" name="code">
<!-- Your Code Here -->

					</textarea></form>
				</div>
			</div>

			<div class="sbResult row">
				<p></p>
 				<Iframe id="resultContainer" class= "" src="result.php" width="100%" height="100%"></Iframe>
			</div>

			<div class="sbExecutionStatBox">
				<!-- <div class="time">Executed in <?php $time?> seconds</div> -->
			</div>
		</div>

		<!-- Control -->
		<div class="sbControlPanel col-md-3">
			<!-- <h2>Control</h2> -->

			<div class="sbHistoryTab">
				<div class="sbHistoryTabHeader">
					<h3>User History</h3>
					<select class="sbHistoryUser form-control">
						<option ng-repeat="user in coderUsers" ng-selected='{{codeInfo.myCodeOwner == user.coderUserInitial}}'>{{ user.coderUserName }}</option>
						<!-- <option>All Users</option> -->
					</select>
				</div>
				<div class="sbHistoryContentTab ac-container">
					<div ng-repeat="code in codeHitory">
						<input id="ac-{{ code.myCodeId}}" name="accordion-{{ code.myCodeId}}" type="checkbox" />
						<label for="ac-{{ code.myCodeId}}">

							<div>
								<button type="button" id="clearCode" class="btn btn-default" title="Save code as new record" ng-click ="appendThisCodeToEditor(code.myCodeBody)">
								  <span class="glyphicon glyphicon-plus">
								</span></button>

								<small>{{ code.myCodeLastEditDate }} {{ code.myCodeName }}</small>
							</div>
							<!-- Add to editor button -->
							
						</label>

						<!-- <article class="ac-medium"> -->
						<article class="ac-auto"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
							<pre>{{ code.myCodeBody }}</pre>
						</article>
					</div>

				</div><!-- sbHistoryContentTab END  -->

			</div>

		</div>
		</div>
	</div>

  <!-- JavaScript Plugins BEG -->
  	<!-- Default JS -->
  	<script src="script.js"></script>
  	
  	<!-- AngularJS -->
  	<script src="app.js"></script>
	  <!-- Codmirror -->
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/addon/edit/matchbrackets.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/keymap/sublime.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/php/php.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/xml/xml.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/javascript/javascript.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/css/css.js"></script>
		<script type="text/javascript" src="/jquery_plugins/CodeMirror/mode/clike/clike.js"></script>
	<!-- JavaScript Plugins END -->

	<!-- Script BEG -->
	<script type="text/javascript">
		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true,
			mode: "application/x-httpd-php",
			matchBrackets: true,
			theme: "monokai",
			indentUnit: 2,
			indentWithTabs: true
		});
	</script>
	<!-- Script END -->
</body>
<!-- App END -->
</html>




