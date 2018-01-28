<?php
if(!isset($_SESSION['user'])) :
	registerUser(); // все функции описаны в core/lib/functions.php
?>
<form action="" method="post" id="register">
	<!-- login, passwd, email -->
	<p>
		<label>Логин:</label>
		<input type="text" name="login">
	</p>
	<P>
		<label>Пароль:</label>
		<INPUT TYPE="password" NAME="passwd">
	</P>
	<p>
		<label>Электропочта:</label>
		<input type="text" name="email">
	</p>
	<p>
		<label>Инвайт:</label>
		<input type="text" name="invite">
	</p>
	<p>
		<BUTTon name="do_register">YARRR!</BUTTon>
	</p>
</form>
<?php endif; ?>