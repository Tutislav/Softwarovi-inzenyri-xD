<?php
	if (strcmp($_POST["approve_submit"],"Schválit změnu")==0) {
		$kladny=1;
		echo "kladny";
	} elseif (strcmp($_POST["disapprove_submit"],"Zamítnout změnu")==0) {
		$zaporny=1;	
		echo "zaporny";
	}
?>
