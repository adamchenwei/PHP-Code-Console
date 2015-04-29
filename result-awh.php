<script type="text/javascript">

  test = {
	
		data : [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
		args : [0, 2],
		strfunc : function(data, a, b){
	 		 return data.splice(a, b);
		},
		result : function(){
			test['strfunc'].apply(test,test.args);
  		}	
  	};
  
  	test.result();
  
  	console.log(result);
	
	alert('test');
  
</script>