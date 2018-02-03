<?php
	session_start();
	function registerUser()
	{
		if(isset($_POST['do_register'])) { // этот блок будет выполнен, если есть в суперглобальном массиве _POST ячейка do_register 
			$formData = $_POST; // просто для простаты набора
			if($formData['login'] == '') { // проверка на пустоту логина
				echo "<p class=\"error\">Введи логине, сука!</p>";
			}
			elseif(!preg_match("/^[a-z0-9A-Zа-яА-Я_-]+$/i", $_POST['login'])) { // проверка наличия в логине говносимволов
			    echo "<p>Никнейм содержит некорректные символы</p>";
			} elseif($formData['passwd'] == '') { // проверка на пустоту пароля
				echo '<p class="error">Введи пароле, сука!</p>';
			} elseif($formData['email'] == '' || !preg_match('/@/', $formData['email'])) { // проверка на пустоту и наличие символа @ у email
				echo '<p class="error">Введи ъмло, сука!</p>';
			} elseif($formData['invite'] == '') { // проверка на пустоту поля инвайта
				echo '<p class="error">Введи инвайте, сука!</p>';
			} else {
				// Проверка инвайта на свежесть и запись юзверя в БД
				$invites = R::getAssoc("SELECT * FROM `otake_invites` WHERE `code` = ? AND `is_used` = 0 ORDER BY `create_time` DESC", array($formData['invite']));
				if($invites == array()) { // если инвайт тухлый:
					echo '<p class="error">Такого инвайта нет</p>';
				} else { // если инвайт свежий:
					R::exec("INSERT INTO `otake_users`(`login`, `passwd`, `joindate`, `join_ip`, `ugroup`, `email`) VALUES (?, ?, ?, ?, ?, ?)", array($_POST['login'], md5($_POST['passwd']), time(), $_SERVER['REMOTE_ADDR'], 'user', $_POST['email'])); // регистрация
					R::exec("UPDATE `otake_invites` SET `is_used`='1' WHERE `code` = ?", array($_POST['invite'])); // обнуление инвайта в БД
				}
			}
		}
	}
	function loginUser()
	{
		if(isset($_POST['doLogin'])) {
			$passwd = md5($_POST['passwd']); // шифрование пароля
			$user = R::getAssoc("SELECT * FROM `otake_users` WHERE `login` = ? AND `passwd` = ?", array($_POST['login'], $passwd)); // проверка наличия пользователя в БД
			if($user == array()) { // если пароль и логин тухлые:
				echo "<p>Неправильно введены логин или пароль</p>";
			} else { // если пароль и логин нормальные:
				$_SESSION['user'] = $_POST['login'];
				echo '<a href="'.$config['site_url'].'/"">На главную</a>';
			}
		}
	}
	function logout()
	{
		unset($_SESSION['user']); // уничтожение ячейки user в массиве _SESSION
		echo '<a href="'.$config['site_url'].'/"">На главную</a>';
	}
	function createSubPage()
	{
		if(isset($_POST['doCreateSubPage'])) { // проверка наличия в массиве _POST ячейки doCreateSubPage
			$page=R::getAssoc("SELECT * FROM `otake_subpages` WHERE `address` = ?", array($_POST['address'])); // проверка наличия страницы с вводимым адресом в БД
			if($_POST['address'] == '') {  // проверка адреса раздела на пустоту
				echo "<p>Адрес не введен</p>";
			}
			elseif(!preg_match("/^[a-z0-9A-Zа-яА-Я_-]+$/i", $_POST['address'])) { // проверка наличия в адресе говносимволов
			    echo "<p>Адрес раздела содержит некорректные символы</p>";
			}
			elseif($_POST['name'] == '') { // проверка названия раздела на пустоту
				echo "<p>Имя раздела не введено</p>";
			}
			elseif($_POST['description'] == '') { // проверка описания раздела на пустоту
				echo "<p>Описание не введено</p>";
			}
			elseif($page != array()) { // проверка наличия раздела с таким же адресом в БД [2]
				echo "<p>Такой раздел уже существует</p>";
			}
			else { // добавление раздела в БД
				R::exec("INSERT INTO `otake_subpages`(`address`, `name`, `description`, `admin`, `mods`, `hidden`, `users_allowed`, `create_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", array($_POST['address'], $_POST['name'], $_POST['description'], $_SESSION['user'], '', 0, '', time()));
				header('Location: ' . $config['site_url'] , '/');
			}
		}
	}
?>