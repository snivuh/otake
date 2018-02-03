<?php
	if(isset($_SESSION['user'])) {
		// потом доделаю
	} else {
		header('Location: ' . $config['site_url'] . '/login/');
	}
?>