<?php
	class Configuration extends Model {

		var $table = 'config';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}

	}
?>