<?php
	class Question extends Model {

		var $table = 'bb_questions';

		function getLast($num = 10) {
			return $this->find(array(
				'limit' => $num,
				'order' => 'id DESC'
			));
		}

	}
?>