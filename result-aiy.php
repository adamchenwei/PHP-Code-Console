<?php

	require("common.php");
	$part = TekPartNumber::getbyidserial(84281);

	if( $part )
		//$ih = $part->qty_discrepancy() + $part->qty_inhouse();
		echo $part->qty_inhouse_fifo();