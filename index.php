<?php
	// http://127.0.0.1/openserver/phpmyadmin/index.php
	require 'core/lib/globalIncludes.php';
	require 'core/templates/html/header.php';
	if(isset($_GET['url'])) {
		$url = explode("/", $_GET['url']); // Разделение на сегменты URL
		if(file_exists('core/templates/views/' . $url[0] . '.php')) {
			include 'core/templates/views/' . $url[0] . '.php'; // Подключение файла-шаблона из core/templates/views/, если тот существует
		} else {
			header('HTTP/1.1 404 Not Found'); // А тут все понятно, хули
			include 'core/templates/views/404.php';
		}
	} else {
		include 'core/templates/views/main.php'; // Вывод глагне
	}
	require 'core/templates/html/footer.php';
?>