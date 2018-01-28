<?php
	if(isset($_SESSION['user'])) {
		$otake_sub = R::getAssoc("SELECT * FROM `otake_subpages` WHERE `hidden` = 0");
		foreach($otake_sub as $array_sub) {
			echo "<div class=\"sub-block\">";
			echo "<h2>". $array_sub['address'] ." - ". $array_sub['name'] ."</h2>";
			echo "</div>";
		}
	} else {
		include 'login.php';
	}
?>