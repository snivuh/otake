<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" href="<?php echo $config['site_url']; ?>/assets/css/main.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<header>
		<table border=0 width="100%">
			<tr>
				<td id="h-imgs" >
					<a href="<?php echo $config['site_url'] ?>"><img src="<?php echo $config['site_url'] ?>/assets/img/up4kman.png" id="h-img"></a>
				</td>
				<td id="h-info">
					<nav>
						<ul>
							<?php if(!isset($_SESSION['user'])) : ?>
							<li><a href="<?php echo $config['site_url'] ?>/register/">Регистрация</a></li>
							<li><a href="<?php echo $config['site_url'] ?>/login/">Вход</a></li>
							<?php else : ?>
							<li><a href="<?php echo $config['site_url'] ?>/createSubPage/">Создать раздел</a></li>
							<li><a href="<?php echo $config['site_url'] ?>/logout/">Выход</a></li>
							<?php endif; ?>
						</ul>
					</nav>
				</td>
			</tr>
		</table>
	</header>