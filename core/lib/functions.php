<?php
	session_start();
	function registerUser()
	{
		if(isset($_POST['do_register'])) {
			//wolfram00: вот нахуй приравнивать к хуй знает какой переменной массивы _GET и _POST?
			$formData = $_POST; //todo потом выпилить
			if($formData['login'] == '') {
				echo "<p class=\"error\">Введи логине, сука!</p>";
			}
			elseif(!preg_match("/^[a-z0-9A-Zа-яА-Я_-]+$/i", $_POST['login'])) {
			    echo "<p>Никнейм содержит некорректные символы</p>";
			}
			elseif($formData['passwd'] == '') {
				echo '<p class="error">Введи пароле, сука!</p>';
			} elseif($formData['email'] == '' || !preg_match('/@/', $formData['email'])) {
				echo '<p class="error">Введи ъмло, сука!</p>';
			} elseif($formData['invite'] == '') {
				echo '<p class="error">Введи инвайте, сука!</p>';
			} else {
				// Проверка инвайта на свежесть и запись юзверя в БД
				$invites = R::getAssoc("SELECT * FROM `otake_invites` WHERE `code` = ? AND `is_used` = 0 ORDER BY `create_time` DESC", array($formData['invite']));
				if($invites == array()) {
					echo '<p class="error">Такого инвайта нет</p>';
				} else {
					R::exec("INSERT INTO `otake_users`(`login`, `passwd`, `joindate`, `join_ip`, `ugroup`, `email`) VALUES (?, ?, ?, ?, ?, ?)", array($_POST['login'], md5($_POST['passwd']), time(), $_SERVER['REMOTE_ADDR'], 'user', $_POST['email']));
					R::exec("UPDATE `otake_invites` SET `is_used`='1' WHERE `code` = ?", array($_POST['invite']));
				}
			}
		}
	}
	function loginUser()
	{
		if(isset($_POST['doLogin'])) {
			$passwd = md5($_POST['passwd']);
			$user = R::getAssoc("SELECT * FROM `otake_users` WHERE `login` = ? AND `passwd` = ?", array($_POST['login'], $passwd));
			if($user == array()) {
				echo "<p>Неправильно введены логин или пароль</p>";
			} else {
				$_SESSION['user'] = $_POST['login'];
				echo '<a href="'.$config['site_url'].'/"">На главную</a>';
			}
		}
	}
	function logout()
	{
		unset($_SESSION['user']);
		echo '<a href="'.$config['site_url'].'/"">На главную</a>';
	}
	function createSubPage()
	{
		if(isset($_POST['doCreateSubPage'])) {
			$page=R::getAssoc("SELECT * FROM `otake_subpages` WHERE `address` = ?", array($_POST['address']));
			if($_POST['address'] == '') {
				echo "<p>Адрес не введен</p>";
			}
			elseif(!preg_match("/^[a-z0-9A-Zа-яА-Я_-]+$/i", $_POST['address'])) {
			    echo "<p>Адрес раздела содержит некорректные символы</p>";
			}
			elseif($_POST['name'] == '') {
				echo "<p>Имя раздела не введено</p>";
			}
			elseif($_POST['description'] == '') {
				echo "<p>Описание не введено</p>";
			}
			elseif($page != array()) {
				echo "<p>Такой раздел уже существует</p>";
			}
			else {
				R::exec("INSERT INTO `otake_subpages`(`address`, `name`, `description`, `admin`, `mods`, `hidden`, `users_allowed`, `create_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", array($_POST['address'], $_POST['name'], $_POST['description'], $_SESSION['user'], '', 0, '', time()));
				header('Location: ' . $config['site_url'] , '/');
			}
		}
	}
?>
