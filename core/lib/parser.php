<?php
	function OTAKE_parser($OTAKE_parser_text) { // ЭТО - ЛОХ! ЗОВУТ ЕГО - ПАРСЕР!!11
		$parsedown = new Parsedown(); // парсер markdown
		$OTAKE_parser_text = htmlspecialchars($OTAKE_parser_text); // уничтожаем html
		$OTAKE_parser_text = $parsedown->parse($OTAKE_parser_text); // парсим markdown
		return $OTAKE_parser_text; // возвращаем контент, который пропарсили
	}
?>
