<?php
/**
 * [Calendar Picker Script]
 * @author previous user + awh
 * @return
 * These script will help generate date picker in a report with a UI part example like below:
	<p><b>Select a date range.</b></p>
	<p>
	<b>From:</b> <input class="date" type="text" id="from" name="from" value="<?=@$_GET['from']?>"/>
	<b>To:</b> <input class="date" type="text" id="to" name="to" value="<?=@$_GET['to']?>"/>&nbsp;&nbsp;
 */
$extraHeaders = '<link href="/jquery_plugins/facebox/facebox.css" rel="stylesheet" type="text/css" />';
$jQuery = '/jquery_plugins/facebox/facebox.js';
$extraHeaders .= "\t".'<!-- EXTRA --><link href="/jquery_plugins/tabs/ui.tabs.css" rel="stylesheet" type="text/css"/>'."\n";
$extraHeaders .= "\t".'<link href="/jquery_plugins/smoothness/jquery-ui-1.8.custom.css" rel="stylesheet" type="text/css"/>'."\n";
$extraHeaders .= "\t".'<link href="/jquery_plugins/Mottie-tablesorter-0c2c9a7/css/blue/style.css" rel="stylesheet" type="text/css"/>'."\n";
$jQueryPlugin[] = "jquery.ui.core.js";
$jQueryPlugin[] = "jquery.ui.datepicker.js";
$jQueryPlugin[] = "Mottie-tablesorter-0c2c9a7/js/jquery.tablesorter.js";
$newjQuery = true;
$extraHeaders .=
'<script type="text/javascript">  
	function populateDates(){ 
		var dates = $("#week").val().split("&");
		$("#from").val(dates[0]); 
		$("#to").val(dates[1]);
	};
	$(document).ready(function() { 
		$("a[rel*=facebox]").facebox();
		//$("#ratiograph").attr("src") = "benchReportGraphRatio.php?dateOne=2009-03-22&dateTwo=2009-03-28";
		//$("#ratiograph").attr("src=benchReportGraphRatio.php?dateOne=2009-03-22&dateTwo=2009-03-28");
		console.log("Load Datepickers...");
		$(".date").datepicker();
		$("table.tablesorter").tablesorter(); 
    })
</script>';