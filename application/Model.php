<?php  
	/**
	 * Clase AppModel
	 */
	class AppModel
	{
		/**
		 * @var type Database.php
		 */
		protected $_db;

		/**
		 * Constructor de la clase
		 * @return type
		 */
		public function __construct()
		{
			$this->_db = new Database();
		}
	}
?>