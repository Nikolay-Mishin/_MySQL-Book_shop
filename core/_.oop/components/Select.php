<?
	class Select {
	
		private $from; 
		private $what = '*';
		private $where; 
		private $order;
		private $limit; 
		private $group;
		private $join; 
		
		public function __construct($from) {
			$this->from = $from; 
			return $this;
		}
		
		public function what($arr = []) {
			$str = ""; 
			foreach ($arr as $key => $value) {
				if (is_numeric($key)) {
					$str .= $value . ', ';
				} else {
					$str .= $value . ' AS ' . $key . ', ';
				}
			}
			$str = rtrim($str, ', ');
			$this->what = $str; 
			return $this; 
		}
		
		public function and($arr = []) {
			$str = ""; 
			foreach ($arr as $key => $value) {
				$str .= ' AND ' . $key . ' ' . $value;
			}
			$this->where = $str; 
			return $this;
		}
		
		public function group($col) {
			$str = " GROUP BY $col ";
			$this->group = $str; 
			return $this; 
		}
		
		public function join($arr = []) {
			$str = ""; 
			foreach ($arr as $key => $val) {
				$str .= " $val[0] JOIN $key ON $val[1] = $val[2]";
			}
			$this->join = $str; 
			return $this; 
		}
		
		public function limit($offset, $count) {
			$this->limit = "LIMIT $offset, $count"; 
			return $this;
		}
		
		public function build() {
			$str = "
				SELECT {$this->what}
				FROM {$this->from}
				{$this->join}
				WHERE 1 {$this->where}
				{$this->group}
				{$this->limit};
			";
			return $str; 
		}
	
	}

?>