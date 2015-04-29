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
  		<!-- Customized Main Code Mirror CSS -->
	  	<link rel="stylesheet" href="styles/codemirror-cust.css">
			<link rel="stylesheet" href="/jquery_plugins/CodeMirror/theme/monokai.css">
			<!-- Code Mirror Sub Styles -->
				<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
	<!-- Styles END-->
</head>
<!-- App BEG -->
<body ng-app="coderApp">


<div class="sbControlPanel col-md-3">
				<!-- <h2>Control</h2> -->
				<div class="panel panel-default">
					<div class="panel-heading">
				    <h3 class="panel-title">Control Panel</h3>
				  </div>
  				<div class="panel-body">
						<div class="sbHistoryTab">
							<div class="sbHistoryTabHeader">
								<!-- Search History -->
								<form role="search" class="ng-pristine ng-valid">
								  <div class="form-group">
								    <input type="text" class="form-control ng-pristine ng-valid" placeholder="Search A Code" ng-model="searchCode">
								  </div>
								</form>
							</div>
							<div class="sbHistoryContentTab ac-container">
								<!-- ngRepeat: thehcode in codeHitory --><div ng-repeat="thehcode in codeHitory" class="ng-scope">
									<input id="ac-386" name="accordion-386" type="checkbox">
									<label for="ac-386">
										<div class="text-left col-md-2">
											<button type="button" class="btn btn-default" title="Open this Snippet" ng-click="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
											  <span class="glyphicon glyphicon-folder-open">
											</span></button>
										</div>

										<div class="text-right col-md-2">
											<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click="appendThisCodeToEditor(thehcode.myCodeBody)">
											  <span class="glyphicon glyphicon-plus">
											</span></button>
										</div>

										<div class="text-center col-md-8">
											<h4 class="text-left"><small class="ng-binding">
												<b class="ng-binding">No Name </b>


											 2014-06-27 14:11:19  ID is <b class="ng-binding">386 </b></small></h4>
											<!-- <h5 class="text-right"><small></small></h5> -->
										</div>
										<!-- Add to editor button -->
									</label>

									<!-- <article class="ac-medium"> -->
									<article class="ac-auto col-md-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
										<pre class="ng-binding"></pre>
									</article>
								</div><!-- end ngRepeat: thehcode in codeHitory --><div ng-repeat="thehcode in codeHitory" class="ng-scope">
									<input id="ac-376" name="accordion-376" type="checkbox">
									<label for="ac-376">
										<div class="text-left col-md-2">
											<button type="button" class="btn btn-default" title="Open this Snippet" ng-click="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
											  <span class="glyphicon glyphicon-folder-open">
											</span></button>
										</div>

										<div class="text-right col-md-2">
											<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click="appendThisCodeToEditor(thehcode.myCodeBody)">
											  <span class="glyphicon glyphicon-plus">
											</span></button>
										</div>

										<div class="text-center col-md-8">
											<h4 class="text-left"><small class="ng-binding">
												<b class="ng-binding">No Name </b>


											 2014-06-27 14:11:11  ID is <b class="ng-binding">376 </b></small></h4>
											<!-- <h5 class="text-right"><small></small></h5> -->
										</div>
										<!-- Add to editor button -->
									</label>

									<!-- <article class="ac-medium"> -->
									<article class="ac-auto col-md-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
										<pre class="ng-binding"></pre>
									</article>
								</div><!-- end ngRepeat: thehcode in codeHitory --><div ng-repeat="thehcode in codeHitory" class="ng-scope">
									<input id="ac-366" name="accordion-366" type="checkbox">
									<label for="ac-366">
										<div class="text-left col-md-2">
											<button type="button" class="btn btn-default" title="Open this Snippet" ng-click="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
											  <span class="glyphicon glyphicon-folder-open">
											</span></button>
										</div>

										<div class="text-right col-md-2">
											<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click="appendThisCodeToEditor(thehcode.myCodeBody)">
											  <span class="glyphicon glyphicon-plus">
											</span></button>
										</div>

										<div class="text-center col-md-8">
											<h4 class="text-left"><small class="ng-binding">
												<b class="ng-binding">Testing Codey </b>


											 2014-06-27 14:09:44  ID is <b class="ng-binding">366 </b></small></h4>
											<!-- <h5 class="text-right"><small></small></h5> -->
										</div>
										<!-- Add to editor button -->
									</label>

									<!-- <article class="ac-medium"> -->
									<article class="ac-auto col-md-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
										<pre class="ng-binding"></pre>
									</article>
								</div><!-- end ngRepeat: thehcode in codeHitory --><div ng-repeat="thehcode in codeHitory" class="ng-scope">
									<input id="ac-356" name="accordion-356" type="checkbox">
									<label for="ac-356">
										<div class="text-left col-md-2">
											<button type="button" class="btn btn-default" title="Open this Snippet" ng-click="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
											  <span class="glyphicon glyphicon-folder-open">
											</span></button>
										</div>

										<div class="text-right col-md-2">
											<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click="appendThisCodeToEditor(thehcode.myCodeBody)">
											  <span class="glyphicon glyphicon-plus">
											</span></button>
										</div>

										<div class="text-center col-md-8">
											<h4 class="text-left"><small class="ng-binding">
												<b class="ng-binding">No Name </b>


											 2014-06-27 14:04:45  ID is <b class="ng-binding">356 </b></small></h4>
											<!-- <h5 class="text-right"><small></small></h5> -->
										</div>
										<!-- Add to editor button -->
									</label>

									<!-- <article class="ac-medium"> -->
									<article class="ac-auto col-md-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
										<pre class="ng-binding"></pre>
									</article>
								</div><!-- end ngRepeat: thehcode in codeHitory --><div ng-repeat="thehcode in codeHitory" class="ng-scope">
									<input id="ac-326" name="accordion-326" type="checkbox">
									<label for="ac-326">
										<div class="text-left col-md-2">
											<button type="button" class="btn btn-default" title="Open this Snippet" ng-click="runThisCodeLoadToEditor(thehcode.myCodeId,thehcode.myCodeBody,thehcode.myCodeName,thehcode.myCodeOwner,thehcode.myCodeLastEditDate)">
											  <span class="glyphicon glyphicon-folder-open">
											</span></button>
										</div>

										<div class="text-right col-md-2">
											<button type="button" class="btn btn-default" title="Append this code into coding window" ng-click="appendThisCodeToEditor(thehcode.myCodeBody)">
											  <span class="glyphicon glyphicon-plus">
											</span></button>
										</div>

										<div class="text-center col-md-8">
											<h4 class="text-left"><small class="ng-binding">
												<b class="ng-binding">test222 </b>


											 2014-06-27 14:03:58  ID is <b class="ng-binding">326 </b></small></h4>
											<!-- <h5 class="text-right"><small></small></h5> -->
										</div>
										<!-- Add to editor button -->
									</label>

									<!-- <article class="ac-medium"> -->
									<article class="ac-auto col-md-12"><!-- ac-medium will have smooth open effect while height:auto countered it! -->
										<pre class="ng-binding"></pre>
									</article>
								</div><!-- end ngRepeat: thehcode in codeHitory -->

							</div><!-- sbHistoryContentTab END  -->
						</div>
					</div>
				</div>

			</div>
</body>
<!-- App END -->
</html>