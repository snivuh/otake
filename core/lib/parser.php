<?php
	function OTAKE_parser($OTAKE_parser_text) {
		$parsedown = new Parsedown();
		$OTAKE_parser_text = htmlspecialchars($OTAKE_parser_text);
		$OTAKE_parser_text = $parsedown->parse($OTAKE_parser_text);
		return $OTAKE_parser_text;
	}
?>
