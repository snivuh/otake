<?php
	function OTAKE_parser($OTAKE_parser_text) {
		$parsedown = new Parsedown();
		// $OTAKE_parser_text = htmlspecialchars($OTAKE_parser_text);
		$OTAKE_parser_text = $parsedown->parse($OTAKE_parser_text);
		$jevix = new Jevix();
	
		//Конфигурация
		
		// Устанавливаем разрешённые теги. (Все не разрешенные теги считаются запрещенными.)
		$jevix->cfgAllowTags(array('span', 'div', 'p', 'abbr', 'marquee'));

		$base_allowed_attr = array('style', 'class');		
		
		// Устанавливаем разрешённые параметры тегов.
		$jevix->cfgAllowTagParams('span', $base_allowed_attr);
		$jevix->cfgAllowTagParams('div', $base_allowed_attr);
		$jevix->cfgAllowTagParams('p', $base_allowed_attr);
		$jevix->cfgAllowTagParams('abbr', array('style', 'class', 'title'));
		$jevix->cfgAllowTagParams('marquee', array('style', 'class', 'title', 'behavior', 'direction', 'loop', 'scrollamount', 'scrolldelay', 'truespeed'));
		
		//Парсинг
		$OTAKE_parser_text = $jevix->parse($OTAKE_parser_text);

		return $OTAKE_parser_text;
	}
?>
