<?php
/**
 * Coder
 * @version
 * 1.0 - Created middle of 2014-awh
 * 2.0 - Refactored on Dec 3rd 2014-awh
 */
require_once('index-init.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<script>
		//To hack fix error regarding saving code snippets-awh
		var ownerUser='<?=strtolower($auth_initials);?>';
		// alert(ownerUser);
	</script>
	<!-- Styles BEG-->
		<!-- Defalut Styles -->
		<link href="style.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap -->
			<!-- <script type="text/javascript" src="/library/bootstrap/3.1.1/js/bootstrap.js"></script> -->
			<link rel="stylesheet" href="/library/bootstrap/3.3.1/css/bootstrap.css">
			<link rel="stylesheet" href="/library/bootstrap/3.3.1/css/bootstrap-theme.css">
  	<!-- Code Mirrior-->
  		<!-- Default Styles -->
  		<link rel="stylesheet" href="/library/codemirror/4.8.0/codemirror.css">
  		<!-- Customized Main Code Mirror CSS -->
  		<link rel="stylesheet" href="styles/bootstrap-cust.css">
	  	<link rel="stylesheet" href="styles/codemirror-cust.css">
	  	<link rel="stylesheet" href="styles/angular-cust.css">
	  	<link rel="stylesheet" href="styles/off-canvas-sidebar.css">
	  	<!-- Theme Style -->
			<link rel="stylesheet" href="/jquery_plugins/CodeMirror/theme/monokai.css">
			<!-- Code Mirror Sub Styles -->
				<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
	<!-- Styles END-->
</head>
<!-- App BEG -->
<body ng-app="coderApp">
<!-- NG-Controller + Off Canvas Snippet Bar BEG -->
	<div ng-controller="codeHandler" >
		<div id="wrapper" class="{{coderUI.sidebarWrapperToggle}}">
		 <!-- {{coderUI.sidebarWrapperToggle|json}} -->

	    <!-- Sidebar -->
	    <div id="sidebar-wrapper">
	        <ul class="sidebar-nav">
	            <!-- Panel BEG -->
	            <!-- codeList -->
							<div class="panel panel-default">
								<div class="panel-heading">
							    <h3 class="panel-title">Snippets Panel</h3>
							  </div>
			  				<div class="panel-body">
									<div class="sbHistoryTab">
										<div class="sbHistoryTabHeader">
											<!-- Search History -->
											<form role="search">
											  <div class="form-group">
											    <input type="text" class="form-control" placeholder="Search A Code" ng-model="searchCode">
											  </div>
											</form>
											<!-- Search History END-->
										</div>
										<div class="sbHistoryContentTab ac-container" when-scrolled="loadMore()">
											<div ng-repeat="thehcode in codeHitory">
												<input id="ac-{{ thehcode.myCodeId}}" name="accordion-{{ thehcode.myCodeId}}" type="checkbox" />
												<label for="ac-{{ thehcode.myCodeId}}">
													<div class="container-fluid">
														<div class="row">
															<div class="text-left col-md-1 col-lg-1">
																<button type="button" class="btn btn-default" title="Open this Snippet" ng-click ="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate,ownerUser)">
																  <span class="glyphicon glyphicon-folder-open"></span>
																</button>

																<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click ="appendThisCodeToEditor(thehcode.myCodeBody)">
																  <span class="glyphicon glyphicon-plus"></span>
																</button>

															</div>


															<div class="text-center col-md-11 col-lg-11">
																<h4 class="text-left"><small>
																	<b>{{thehcode.myCodeName=='' && 'No Name' || thehcode.myCodeName}} </b>
																 {{ thehcode.myCodeLastEditDate }}  ID is <b>{{ thehcode.myCodeId }} </b> Owner: <b>{{ thehcode.myCodeOwner }} </b></small></h4>
															</div>
															<!-- Add to editor button -->
														</div>
													</div>
												</label>

												<!-- <article class="ac-medium"> -->
												<article class="ac-auto col-md-12 col-lg-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
													<pre>{{ thehcode.myCodeBody }}</pre>
												</article>
											</div>

										</div><!-- sbHistoryContentTab END  -->
									</div>
								</div>
							</div>

	            <!-- Panel END -->
	        </ul>
	    </div>
	    <!-- /#sidebar-wrapper -->

		  <!-- Page Content -->
		  <div id="page-content-wrapper">

				<div class="container-fluid" >
				<!-- Branch Info Bar BEG-->
					<?php
						$branchname="master";
						echo "<div class='row' style='clear: both; width: 100%; font-size: 14px; font-family: Helvetica; color: #D6D38B; background: #bcbf77; padding: 20px; text-align: center;'>
				    Current branch: 
				    <span style='color:#000; font-weight: bold; text-transform: uppercase;'>".$branchname."</span>
				    </div>"; //show it on the page
					?>

				<!-- Branch Info Bar END -->

					<!-- Navigation BEG-->
					<div class="row">
						<nav class="navbar navbar-default" role="navigation">
						  <div class="container-fluid">
						    <!-- Brand and toggle get grouped for better mobile display -->
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">CODER</a>
						      <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" ng-click="toggleSidebar()">Toggle Menu</a> -->
						    </div>

						    <!-- Collect the nav links, forms, and other content for toggling -->
						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						      <ul class="nav navbar-nav">
						        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->

						        <li class="dropdown">
						          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">File <span class="caret"></span></a>
						          <ul class="dropdown-menu" role="menu">
						            <li><a id="editCode" href="#" ng-click="editThisCode()"> <span class="glyphicon glyphicon-floppy-disk"></span> Save</a></li>
						            <li><a href="#" id="editCode" ng-click ="addNewCode()"> <span class="glyphicon glyphicon-plus" ></span> New</a></li>
						          </ul>
						        </li>
						      </ul>

						    </div><!-- /.navbar-collapse -->
						  </div><!-- /.container-fluid -->
						</nav>
					</div>
					<!-- Navigation END -->

					<!-- Operational Tabs BEG -->
					<div class="row">
						<div role="tabpanel">

						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						  	<li role="presentation" >
						    	
						    	<a href="#menu-toggle" role="tab" data-toggle="tab" ng-click="toggleSidebar()" id="menu-toggle" >
						    		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ng-hide="!coderUI.toggled"></span>
										<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" ng-hide="coderUI.toggled"></span>
						    		Snippets
						    	</a>
						    </li>
						    <li role="presentation" class="active"><a href="#codingUI" aria-controls="codingUI" role="tab" data-toggle="tab" ng-click="coderUI.showProgress=false">Coding</a></li>
						    <li role="presentation"><a href="#resultUI" aria-controls="resultUI" role="tab" data-toggle="tab" ng-click ="runCode();coderUI.showProgress=true" id="runCode">Result</a></li>
						    
						    <!-- original-awh -->
						    <!-- <li role="presentation"><a href="#codeListUI" aria-controls="codeListUI" role="tab" data-toggle="tab" ng-click="coderUI.showProgress=false">Snippets</a></li> -->
						  </ul>

								<div class="progress" ng-hide="coderUI.showProgress">
								  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								    <!-- <span class="sr-only">40% Complete (success)</span> -->
								  </div>
								</div>
								<div class="progress" ng-show="coderUI.showProgress">
								  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{coderUI.loadingProgressBar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{coderUI.loadingProgressBar}}%">
								    <!-- <span class="sr-only">40% Complete (success)</span> -->
								  </div>
								</div>
							

						  <!-- Tab Content -->
						  <div class="tab-content">

						  	<!-- ****************************************************************************************************************
						  	codingUI BEG 
						  	***************************************************************************************************************** -->
							  <div role="tabpanel" class="tab-pane fade in active" id="codingUI">



							  	<!-- <h2>Coder</h2> -->
									<div class="sbCoder">
										<!-- Save Button With Title Input BEG -->
										<div>
											<div class="input-group">
									    </div><!-- /input-group -->
										</div><!-- Save Button With Title Input END -->

										<!-- Coding Window -->
										<div class="panel panel-default">
											<div class="panel-heading">

										    <h3 class="panel-title">
										    	<div>File Name:  <b> {{codeInfo.myNewCodeName=='' && 'New Entry' || codeInfo.myNewCodeName}} </b> </div>
										    	</h3><small>wrote by <b>{{codeInfo.myCodeOwner}}</b> on {{codeInfo.myCodeLastEditDate}}   ID is {{codeInfo.myCodeId}}</small>
										    	<div>
											    	<form class="form-inline" role="form" >
														  <div class="form-group has-{{coderUI.savingStatus}} has-feedback">
														    <input type="text" class="form-control" placeholder="New File Name Here" ng-model='codeInfo.myNewCodeName' ng-readonly='coderUI.editTitle' ng-mouseover ="changeUIeditTitle(0)" ng-mouseleave ="changeUIeditTitle(1)">
														    <span class="glyphicon glyphicon-{{coderUI.savingIcon}} form-control-feedback"></span>
														  </div>
														</form>
													</div>
										  </div>
						  				<div class="panel-body">
												<div class="panel panel-default">
													<div id="coderWindow" class="sbCodeContainer" ng-mode="codeItself" >
														<form><textarea id="code" name="code">
														</textarea></form>
													</div>
												</div>
											</div>
										</div>
									</div><!-- sbCoder END -->
							  </div><!-- codingUI END -->


							  <!-- ****************************************************************************************************************
							  	resultUI BEG 
							  	***************************************************************************************************************** -->
							  <div role="tabpanel" class="tab-pane fade" id="resultUI">
							  	<!-- Result Window -->
									<div class="panel panel-default">
										<div class="panel-heading">
									    <h3 class="panel-title">Result From {{codeInfo.myNewCodeName}}  {{coderUI.loadingResult}}</h3>
									  </div>
					  				<div class="panel-body">
											<div class="sbResult">
												<p></p>
								 				<Iframe id="resultContainer" class= "" ng-src={{codeInfo.iframeSrc}} width="100%" height="100%" ng-init="checkIframeLoaded()"></Iframe>
											</div>
										</div>
									</div><!-- Result Window END-->
								</div><!-- resultUI END -->

								<!-- ****************************************************************************************************************
						  	codeListUI BEG 
						  	***************************************************************************************************************** -->
						  	<div role="tabpanel" class="tab-pane fade" id="codeListUI">


						  		<!-- codeList -->
									<div class="panel panel-default">
										<div class="panel-heading">
									    <h3 class="panel-title">Snippets Panel</h3>
									  </div>
					  				<div class="panel-body">
											<div class="sbHistoryTab">
												<div class="sbHistoryTabHeader">
													<!-- Search History -->
													<form role="search">
													  <div class="form-group">
													    <input type="text" class="form-control" placeholder="Search A Code" ng-model="searchCode">
													  </div>
													</form>
													<!-- Search History END-->

													<!-- Search ONLY [user name] -->
													<!-- <div class="form-group">
														<select class="sbHistoryUser form-control">
															<option ng-repeat="user in coderUsers" ng-selected='{{codeInfo.myCodeOwner == user.coderUserInitial}}'>{{ user.coderUserName }}</option>
														</select>
													</div> -->

													<!-- <div class="form-group">
														<select class="sbHistoySearchContent form-control">
															<option>Title Only</option>
															<option>Title & Code</option>
														</select>
													</div> -->
													<!-- Search ONLY [user name] END -->
												</div>
												<div class="sbHistoryContentTab ac-container" when-scrolled="loadMore()">
													<div ng-repeat="thehcode in codeHitory">
														<input id="ac-{{ thehcode.myCodeId}}" name="accordion-{{ thehcode.myCodeId}}" type="checkbox" />
														<label for="ac-{{ thehcode.myCodeId}}">
															<div class="container-fluid">
																<div class="row">
															
																	<div class="text-left col-md-1 col-lg-1">
																		<button type="button" class="btn btn-default" title="Open this Snippet" ng-click ="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
																		  <span class="glyphicon glyphicon-folder-open"></span>
																		</button>

																		<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click ="appendThisCodeToEditor(thehcode.myCodeBody)">
																		  <span class="glyphicon glyphicon-plus"></span>
																		</button>

																	</div>


																	<div class="text-center col-md-11 col-lg-11">
																		<h4 class="text-left"><small>
																			<b>{{thehcode.myCodeName=='' && 'No Name' || thehcode.myCodeName}} </b>


																		 {{ thehcode.myCodeLastEditDate }}  ID is <b>{{ thehcode.myCodeId }} </b> Owner: <b>{{ thehcode.myCodeOwner }} </b></small></h4>
																		<!-- <h5 class="text-right"><small></small></h5> -->
																	</div>
																	<!-- Add to editor button -->
																</div>
															</div>
														</label>

														<!-- <article class="ac-medium"> -->
														<article class="ac-auto col-md-12 col-lg-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
															<pre>{{ thehcode.myCodeBody }}</pre>
														</article>
													</div>

												</div><!-- sbHistoryContentTab END  -->
											</div>
										</div>
									</div>
							  	</div><!-- codeListUI END-->
							</div><!-- tab-content END -->
						</div><!-- tabpanel END -->
					</div><!-- Operational Tabs END -->

				</div><!-- Page Content END-->
			</div>
		</div><!-- id =wrapper + coderUI.sidebarWrapperToggle END -->
	</div>

	<!-- JavaScript Library BEG -->
  	<!-- AngularJS -->
  	<script src="/library/angularjs/1.2.9/angular.js"></script>
  	<script src="/library/angularjs/1.2.9/angular-animate.js"></script>
  	<!-- Code Mirrior -->
		<script type="text/javascript" src="/library/codemirror/4.8.0/codemirror.js"></script>
  <!-- JavaScript Library END -->

  <!-- JavaScript Plugins BEG -->
  	<!-- Default JS -->
  	<script src="script.js"></script>
  	<!-- AngularJS -->
  	<script src="app.js"></script>
  	<!-- Infinity Scroll Module -->
  	<!-- already in app.js.... -->

  	<!-- jQuery for Bootstrap Dependency -->
  	<script type="text/javascript" src="/library/jQuery/2.1.1/js/jquery.js"></script>
  	<!-- Bootstrap JS -->
  	<script type="text/javascript" src="/library/bootstrap/3.3.1/js/bootstrap.js"></script>
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



