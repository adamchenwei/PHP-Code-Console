<!-- Code Snippet Widget (Pending Dev) -->
<div class="sbCodeSnippetTab">
	<div class="sbCodeSnippetTabHeader"><h3>Code Snippet</h3></div>
	<div class="sbCodeSnippetContentTab">
		<select class="sbCodeSnippetUser form-control">
			<option>{{ codeSnippetTitle }}</option>
			<option>Run A Class</option>
		</select>
	</div>
</div>





<script type="text/javascript">

/*Infinity Scroll for Code History Tab*/
	$scope.infnityScrollLoader= function(){
		/*$scope.items = [];*/
		
    /*var counter = 0;*/
    $scope.loadMore = function() {
       /* for (var i = 0; i < 5; i++) {
            $scope.items.push({id: counter});*/
            /*counter += 10;*/
        /*}*/

        /*$scope.codeHitory = [];*/

				$http({
				  method: 'GET',
				  url: 'codeHistoryLoader.php?myCodeOwner='+$scope.codeInfo.myCodeOwner
				}).success(function(data,status,headers,config){ // This is called when the response is
					$scope.codeHitory.push(data);
					
				}).error(function(data,status,headers,config){ // This is called when the response
					alert(status+" "+config);
				});

        /*$scope.getMyCodeHistory();
        $scope.codeHitory.push(  );*/
    };

    $scope.loadMore();
	}

$scope.codeInfo.totalHistoryCount=data.length;
						$scope.codeInfo.loadedHistoryCount =5;


SELECT * FROM `your_table` LIMIT 5, 5 

0,5 5,5 10,5
1    2    3

recordPerPage = 5;
totalRecords=20
totalPages = ceil( total / recordPerPage)
currentPage


startRecord = (currentPage-1) * recordPerPage;



	</script>