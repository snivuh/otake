<?php
if(!isset($_SESSION['user'])) :
	loginUser();// все функции описаны в functions.php
?>
<form action="" method="post">
	<p>Логин: <input type="text" name="login"></p>
	<p>Пароль: <input type="password" name="passwd"></p>
	<p><button type="submit" name="doLogin">Нажимайся, сука!!1</button></p>
</form>
<?php endif; ?>