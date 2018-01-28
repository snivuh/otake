<?php
	if(isset($_SESSION['user'])) {

	} else {
		header('Location: ' . $config['site_url'] . '/login/');
	}
?>