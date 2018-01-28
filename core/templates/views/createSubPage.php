<?php
	if(isset($_SESSION['user'])) {
		createSubPage();
		?>
		<h2>Создать раздел</h2>
		<form action="" method="post">
			<p>Адрес: <input type="text" name="address"></p>
			<p>Имя: <input type="text" name="name"></p>
			<p>
				<p>Описание:</p>
				<p>
					<textarea name="description" id="description" cols="30" rows="10"></textarea>
				</p>
			</p>
			<p><button type="submit" name="doCreateSubPage">Создать</button></p>
		</form>
		<?php
	} else {
		include 'login.php';
	}