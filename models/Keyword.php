<?php
	class Keyword extends Model {

		var $table = 'keyword';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
	}
?>