<?
	class Helper {
		
		public static function escape($string) {
			return htmlentities($string); 
		}
	
		public static function hashMD5($string) {
			return md5($string); 
		}
	}

?>