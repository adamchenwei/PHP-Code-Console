
var test=1;
var coderUserInitialStatic='';
var coderA = angular.module('coderApp',['ngAnimate',]);


/*************************************************************************
 * Animated Loadingbar Module
 *************************************************************************/
coderA
.animation('.progress-bar', function() {
  return {
    enter: function(element, done) {
      element.css('display', 'none');
      element.fadeIn(1000, done);
      return function() {
        element.stop();
      }
    },
    leave: function(element, done) {
      element.fadeOut(1000, done)
      return function() {
        element.stop();
      }
    }
  }
});

/*************************************************************************
 * Infinity Scroll Module
 *************************************************************************/
coderA
.directive('whenScrolled', function() {
		if(test){};
    return function(scope, elm, attr) {
        var raw = elm[0];

        elm.bind('scroll', function() {
            if (raw.scrollTop + raw.offsetHeight >= raw.scrollHeight) {


                scope.$apply(attr.whenScrolled);
            }
        });
    };
});

/*************************************************************************
 * CodeHandler Controller
 *************************************************************************/
coderA
.controller('codeHandler', ['$scope', '$timeout', '$http',function($scope, $timeout, $http){
	/**
	 * Inits
	 */
	$scope.codeInfo={};
	$scope.codeInfo.myCodeId ="";
	$scope.codeInfo.myCodeName ="";
	$scope.codeInfo.myCodeOwner ="";
	$scope.codeInfo.myCodeOwnerUser ="";
	$scope.codeInfo.myCodeBody ="";
	$scope.codeInfo.myCodeLastEditDate ="";
	$scope.searchInfo={};
	$scope.searchInfo.recordPerPage = 8;
	$scope.searchInfo.currentPage =1;
	$scope.searchInfo.startRecord =0;
	$scope.searchInfo.codeTerm ='';
	$scope.coderUI={};
	$scope.coderUI.editTitle=true;
	$scope.coderUI.saved=true;
	$scope.coderUI.savingStatus="success";
	$scope.coderUI.savingIcon="ok";
	$scope.codeItself="";
	$scope.coderUI.loadingResult="Loading";
	$scope.coderUI.loadingProgressBar=0;
	$scope.coderUI.showProgress=false;
	$scope.coderUI.sidebarWrapperToggle='toggled';
	$scope.coderUI.toggled=false;
	var timeout;
	var typeCount=0;


	/*************************************************************************
	 * UI Manipulations
	 *************************************************************************/
		$scope.initializationManifest = function(){
			$scope.initUser();
		}
		$scope.toggleSidebar= function(){

			$scope.coderUI.toggled=!$scope.coderUI.toggled;
			if($scope.coderUI.sidebarWrapperToggle==''){
				$scope.coderUI.sidebarWrapperToggle='toggled';
			}else{
				$scope.coderUI.sidebarWrapperToggle ='';
			}
		}
		$scope.loadDateTimeNow = function(){
			var dateNow = new Date();
			var d = dateNow.getDate();
		  var m = dateNow.getMonth() + 1; //Months are zero based
		  var Y = dateNow.getFullYear();
		  var H = dateNow.getHours();
		  var i = dateNow.getMinutes();
		  var s = dateNow.getSeconds();
		  var newDateTime=Y + "-" + m + "-" + d + " " + H + ":"+ i + ":"+ s;
		  /*alert(newDateTime);*/
			return newDateTime;
		}

		$scope.appendThisCodeToEditor = function($myCode) {
	  	editor.newValue=editor.getValue()+$myCode;
	  	editor.setValue(editor.newValue);
	  }

	  $scope.runThisCodeLoadToEditor = function($myCodeId,$myCode,$myCodeName,$myCodeOwner,$myCodeLastEditDate,ownerUser) {
	  	$scope.codeInfo.myCodeId=$myCodeId;
	  	$scope.codeInfo.myNewCodeName=$myCodeName;
	  	$scope.codeInfo.myCodeName=$myCodeName;
	  	//The myCodeOwner loaded here is really from snippet, should NOT touch!
	  	$scope.codeInfo.myCodeOwner=$myCodeOwner;/*cause not runnable code!!!-awh*/
	  	$scope.codeInfo.myCodeOwnerUser=ownerUser;

	  	$scope.codeInfo.myCodeLastEditDate=$myCodeLastEditDate;
	  	$scope.codeInfo.myCodeBody=$myCode;
	  	editor.newValue=$scope.codeInfo.myCodeBody;
	  	editor.setValue(editor.newValue);
	  	$scope.runCode();
	  }

	  /*Watch Hover on CodeName (Real Time)*/
		$scope.changeUIeditTitle = function(val){
			$scope.coderUI.editTitle=val;
		}

		/**************************************************************************************************
		Check Loaded Iframe
		**************************************************************************************************/
		$scope.checkIframeLoaded=function () {
			$scope.coderUI.loadingResult="--- Loading.......";
		    // Get a handle to the iframe element
		    var iframeHolder = document.getElementById('resultContainer');
		    if(test){


		 		};
		    var iframeDoc = iframeHolder.contentDocument || iframeHolder.contentWindow.document;
		    // Check if loading is complete
		    if (  iframeDoc.readyState  == 'complete' ) {
		        // The loading is complete, call the function we want executed once the iframe is loaded
		        $scope.afterLoading();
		    };
		}

		$scope.afterLoading=function (){
			$scope.coderUI.loadingProgressBar=100;
			//$scope.coderUI.hideloadingProgressBar=100;
		   	$scope.coderUI.loadingResult=">>> Loaded";
		}


	/*************************************************************************
	 * UI Manipulations END
	 *************************************************************************/

	/*************************************************************************
	 * Data Manipulations BEG
	 *************************************************************************/
		/*Load Previous Code*/
		$scope.loadPreviousCode = function(){
			//alert("load previous");
			$http.post('codeLoader.php', {
				'myCodeOwner': $scope.codeInfo.myCodeOwner
			})
			.success(function(data, status, headers, config){
				$scope.codeInfo.myCodeOwner=data.myCodeOwner;
	      if ($scope.codeInfo.myCodeOwner!=''){
	      	//$scope.codeInfo.push(data.codeInfo);
	      	$scope.codeInfo=data;
	      	/*Define name to be changed or compared for title editing*/
	      	$scope.codeInfo.myNewCodeName=$scope.codeInfo.myCodeName;
	      	loadedCodeId =$scope.codeInfo.myCodeId;
	      }else{}
	      if($scope.codeInfo.myCodeBody==null || $scope.codeInfo.myCodeBody==undefined ){
	      	/**/
	      	$scope.codeInfo.myCodeBody="empty";
	      }else{
	      	editor.setValue($scope.codeInfo.myCodeBody);
	      }
		  }).error(function(data, status) {


	  	});
		}

		/*Load New Code*/
		$scope.loadNewCode = function(){
			//alert("load previous");
			$http.post('codeLoader.php', {
				'myCodeOwner': $scope.codeInfo.myCodeOwner
			})
			.success(function(data, status, headers, config){
				$scope.codeInfo.myCodeOwner=data.myCodeOwner;
	      if ($scope.codeInfo.myCodeOwner!=''){
	      	alert("myCodeOwner value found! its "+$scope.codeInfo.myCodeOwner);
	      	$scope.codeInfo=data;
	      	$scope.codeInfo.myNewCodeName="";
	      	$scope.codeInfo.myNewCodeBody="";
	      	$scope.codeInfo.myNewCodeId=$scope.codeInfo.myCodeId;

	      	loadedCodeId =$scope.codeInfo.myCodeId;
	      }else{

	      }
	      editor.setValue("");

		  }).error(function(data, status) {


	  	});

		}

		/*Load New Code*/
		$scope.loadCodeWithId = function(codeId){
			//alert("load previous");
			$http.post('newCodeLoader.php', {
				'myCodeOwner': $scope.codeInfo.myCodeOwner,
				'myCodeId': $scope.codeInfo.myCodeId
			})
				.success(function(data, status, headers, config){
					$scope.codeInfo.myCodeOwner=data.myCodeOwner;

		      if ($scope.codeInfo.myCodeOwner!=''){
		      	$scope.codeInfo=data;
		      	$scope.codeInfo.myNewCodeName="";
		      	$scope.codeInfo.myNewCodeBody="";
		      	$scope.codeInfo.myNewCodeId=$scope.codeInfo.myCodeId;
		      	loadedCodeId =$scope.codeInfo.myCodeId;
		      }else{
		      }
		      editor.setValue("");

		  	}).error(function(data, status) {


		  	});

		}

	  /*Run code*/
		$scope.runThisCode = function(){
	    $scope.codeInfo = null;
			$scope.loadingd = true;

			$http({
			  method: 'GET',
			  url: 'codeExtractor.php'
			}).success(function(data,status,headers,config){ // This is called when the response is
			// ready
				$scope.codeInfo = data;
				$scope.loadingd = false;
				//alert("success!");
				alert($scope.codeInfo.myCodeName);
			}).error(function(data,status,headers,config){ // This is called when the response


			});
	  }



	  /*Create whole new fresh view and an new entry*/
		$scope.addNewCode = function() {
			/*alert("add New Code Ran");*/
			$http.post('codeCreator.php', {

				/*'myCodeId': $scope.codeInfo.myCodeId,*//*No need for id as its new record creation*/
				'myCodeName': "",
				'myNewCodeName': "",
				'myCodeOwner': $scope.codeInfo.myCodeOwner,
				'myCodeBody': "",
				'myCodeCreateDate': $scope.loadDateTimeNow(),
				'myCodeLastEditDate': $scope.loadDateTimeNow()
			})
			.success(function(data, status, headers, config){
				//$scope.codeInfo=data;//Should not set since loadPreviousCode will do it
				$scope.codeInfo=data;
				$scope.loadCodeWithId();//*To adjust CodeId to new one
				$scope.getMyCodeHistory();

			}).error(function(data, status) {


	  	});
		}

		$scope.editThisCode = function() {
			$scope.coderUI.showProgress=true;
			$scope.coderUI.loadingProgressBar=0;
			/*alert(myEscapedJSONString);*/
			$http.put('codeEditor.php', {
				'myCodeId': $scope.codeInfo.myCodeId,/*Critical to dermine and ensure the one edit is the new one!*/
				'myCodeName': $scope.codeInfo.myCodeName,
				'myNewCodeName': $scope.codeInfo.myNewCodeName,
				'myCodeOwner': $scope.codeInfo.myCodeOwner,
				'myCodeBody': editor.getValue(),
				'myCodeLastEditDate': $scope.loadDateTimeNow(),
			})
			.success(function(data, status, headers, config){
				$scope.coderUI.loadingProgressBar=35;
	      if (data.codeInfo != ''){

	      	$scope.codeInfo.myCodeName=$scope.codeInfo.myNewCodeName;
	      	$scope.getMyCodeHistory();
	      	$scope.coderUI.loadingProgressBar=100;
	      }else{
	      	alert("no data to push!");
	      	$scope.coderUI.loadingProgressBar=0;
	      };
	      $scope.getMyCodeHistory();
		  })
			.error(function(data, status) {


	  	});
		};

		$scope.getMyCodeHistory = function() {
	    $scope.codeHitory = [];
	    /*Calculate Start Record Here*/
	    $scope.searchInfo.startRecord=($scope.searchInfo.currentPage - 1) * $scope.searchInfo.recordPerPage;

			$http({
			  method: 'GET',
			  url: 'codeHistoryLoader.php?myCodeOwner='+$scope.codeInfo.myCodeOwner+'&startRecord='+$scope.searchInfo.startRecord+'&recordPerPage='+$scope.searchInfo.recordPerPage+'&codeTerm='+$scope.searchInfo.codeTerm+'&currentPage='+$scope.searchInfo.currentPage
			}).success(function(data,status,headers,config){ // This is called when the response is
				$scope.codeHitory = data;
			}).error(function(data,status,headers,config){ // This is called when the response


			});
	  }


	  /*Search (Real Time)*/
	  $scope.$watch('searchCode', function(newVal) {
	    if (newVal) {
	      if (timeout) $timeout.cancel(timeout);
	      timeout = $timeout(function() {
	      	$scope.searchInfo.currentPage=1;

	      	$http({
					  method: 'GET',
					  url: 'codeSearcher.php?codeTerm='+newVal+'&recordPerPage='+$scope.searchInfo.recordPerPage
					}).success(function(data,status,headers,config){ // This is called when the response is
						// ready
							$scope.searchInfo.codeTerm=newVal;
							$scope.codeInfo.totalRecords=data.totalRecords;
							$scope.codeInfo.totalPages=data.totalPages;

							$scope.getMyCodeHistory();
						}).error(function(data,status,headers,config){ // This is called when the response


						});
	      }, 500);
	    }
	  });
		/*Search (Real Time) END*/

		/*ChangeCodeName (Real Time)*/
		$scope.$watch('codeInfo.myNewCodeName', function(newVal) {
			/*alert("newVal is "+newVal);*/
			if (newVal) {
				$scope.coderUI.savingStatus="";
				$scope.coderUI.savingIcon="";
				if (timeout) $timeout.cancel(timeout);
				timeout = $timeout(function() {
					if(newVal!=$scope.codeInfo.myCodeName){

						$http.put('codeEditor.php', {
							'myCodeId': $scope.codeInfo.myCodeId,
							'myCodeName': $scope.codeInfo.myCodeName,
							'myNewCodeName': newVal,
							'myCodeOwner': $scope.codeInfo.myCodeOwner,
							'myCodeBody': editor.getValue(),
							'myCodeLastEditDate': $scope.loadDateTimeNow()
						})
						.success(function(data, status, headers, config){
							$scope.getMyCodeHistory();
						/*	alert("a new code title saved!success!");*/
							$scope.coderUI.editTitle=false;
							/*$scope.coderUI.saved=true;*/
							$scope.coderUI.savingStatus="success";
							$scope.coderUI.savingIcon="ok";
					  }).error(function(data, status) {


				  	});
					}
				}, 1000);
			}/*if (newVal) {... END*/
		});
		/*ChangeCodeName (Real Time) END*/
		/*Infinity Scroll for Code History Tab END*/

		CodeMirror.on(editor, 'changes', function() {
			if($scope.codeInfo.myCodeOwner!='' && $scope.codeInfo.myCodeOwner!=null && $scope.codeInfo.myCodeOwner!=undefined){

				var codeValue= editor.getValue();
				typeCount=typeCount+1;

				if(typeCount>=20){
					typeCount=0;

					$http.post('codeRealTimeSaver.php', {
						'myCodeId': $scope.codeInfo.myCodeId,
						'myCodeBody': codeValue
					})
					.success(function(data, status, headers, config){
						//runCode();

				  }).error(function(data, status) {


			  	});
				}else{
					/*alert("YES");*/
					if (timeout) $timeout.cancel(timeout);
					timeout = $timeout(function() {
						$http.post('codeRealTimeSaver.php', {
							'myCodeId': $scope.codeInfo.myCodeId,
							'myCodeBody': codeValue
						})
						.success(function(data, status, headers, config){
							//[Todo] Here I can update the related history if the record is inside the history control panel
					  }).error(function(data, status) {


				  	});


				  	typeCount=0;
					}, 60000);
				}
			}
		});

		$scope.runCode = function(){
			if(test){



			}
			$scope.coderUI.loadingProgressBar=0;
			$scope.coderUI.loadingProgressBar=5;
			if(test){};

			$scope.coderUI.loadingResult="Loading...";
			$scope.coderUI.loadingProgressBar=50;

			//A HA!!! HERE IT IS!
			//
			$http.post('processor.php?myCodeOwner='+coderUserInitialStatic, {
				'params': editor.getValue()
			})
			.success(function(data, status, headers, config){
				//runCode();
				if(test){};
				document.getElementById('resultContainer').contentWindow.location.reload(true);
				;
				$scope.checkIframeLoaded();
		  	}).error(function(data, status) {


	  		});
		}

		$scope.emptyResult = function(){
			$http.post('processor.php?myCodeOwner='+coderUserInitialStatic, {
				'params': ''
			})
			.success(function(data, status, headers, config){
				//runCode();
				document.getElementById('resultContainer').contentWindow.location.reload(true);
		  }).error(function(data, status) {


	  	});
		}

		/*Extract Data From User Storage*/
		function PostsCtrlAjax($scope, $http){
			$http({method: 'POST', url: 'codeExtractor.php'}).success(function(data){
				$scope.posts = data; // response data
			});
		}

		$scope.initUser = function(){
			$http({
			  method: 'GET',
			  url: 'coderUserInitialsLoader.php'
			}).success(function(data,status,headers,config){ // This is called when the response is
				/*alert(data.hasData);*/
				$scope.codeInfo.myCodeOwner=data.myCodeOwner;

				/*To clone object*/
				coderUserInitialStatic=JSON.parse(JSON.stringify(data.myCodeOwner));



				if($scope.codeInfo.myCodeOwner!='' && $scope.codeInfo.myCodeOwner!=null && $scope.codeInfo.myCodeOwner!=undefined){
					$scope.codeInfo.iframeSrc="result-"+coderUserInitialStatic+".php";
					$scope.codeInfo.hasData=data.hasData;
					/*Must have an if*/
					if($scope.codeInfo.hasData==true){
						$scope.loadPreviousCode();
						$scope.getMyCodeHistory();
					}else{
						$scope.addNewCode();
					}
				}else{
					alert("Did you log in shopkeeper?");
				}

			}).error(function(data,status,headers,config){ // This is called when the response


			});
		}

		$scope.loadMore = function() {
				//count how many records available to load
				$scope.searchInfo.currentPage= $scope.searchInfo.currentPage+1;
				$scope.searchInfo.startRecord=($scope.searchInfo.currentPage - 1) * $scope.searchInfo.recordPerPage;
				if(test){


				}
				$http({
				  method: 'GET',
			  	url: 'codeHistoryLoader.php?myCodeOwner='+$scope.codeInfo.myCodeOwner+'&startRecord='+$scope.searchInfo.startRecord+'&recordPerPage='+$scope.searchInfo.recordPerPage+'&codeTerm='+$scope.searchInfo.codeTerm+'&currentPage='+$scope.searchInfo.currentPage
				}).success(function(data,status,headers,config){ // This is called when the response is


					var dataLength = data.length;

					if(dataLength>0){
						for (var i=0; i<dataLength; i++){
							$scope.codeHitory.push(data[i]);
						}


					}else{
						$scope.searchInfo.currentPage= $scope.searchInfo.currentPage-1;

					}
				}).error(function(data,status,headers,config){ // This is called when the response


				});
		};
	/*************************************************************************
	 * Data Manipulations END
	 *************************************************************************/

	/*************************************************************************
	 * RUNNING FUNCTION
	 *************************************************************************/
	$scope.initializationManifest();
}]);/*codeHandler Controller END*/

