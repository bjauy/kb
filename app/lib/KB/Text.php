<?php 

class KB_Text {

	public static function shorten($text, $length = 50, $suffix = '...') {
	
		return (mb_strlen($text) > $length ? mb_substr($text, 0, $length). $suffix : $text );

	}

	public static function strip($text) {
		return strip_tags($text, '');
	}

	public static function tags($tags){
		$tags_temp = explode(',', $tags);
		foreach ($tags_temp as &$tag) {
			$tag = trim($tag);
			$tag = '<a href="/list/tag/'. self::slug($tag). '">'. $tag. '</a>';
		}
		return implode(' ', $tags_temp);
	}
	
	public static function slug ($text) {
		$text = mb_strtolower($text);
		$text = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $text);
		return $text;
	}

	public static function mark($text, $needle, $chars = 20, $surround_with = '<strong>') {

		$start = mb_stripos($text, $needle);

		if ($start !== false) {

			$surround_after = str_replace('<', '</', $surround_with);
			$left = $chars - mb_strlen($needle);

			if ($left > 0) {
				$before = $after = ceil($left / 2);
				
				if ($start - $before < 0) {
					$after += $before - $start;
					$before = $start;
				}
				if ($start + mb_strlen($needle) + $after > mb_strlen($text)) {
					$after = mb_strlen($text) - mb_strlen($needle) - $start;
				}

				return mb_substr($text, $start - $before >= 0 ? $start - $before : 0, $before). 
					$surround_with. 
					mb_substr($text, $start, mb_strlen($needle)).
					$surround_after. 
					mb_substr($text, $start + mb_strlen($needle), $after);
			} else {
					return $surround_with. 
					mb_substr($text, $start, mb_strlen($needle)).
					$surround_after;

			}

			
		} else {
			return self::shorten(mb_substr($text, 0, $chars), $chars);
		}
	}
}
