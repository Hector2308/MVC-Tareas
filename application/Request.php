<?php  
	/**
	 * Clase request
	 */
	class Request
	{
		/**
		* @var type Controller
		*/	
		private $_controlador;
		private $_metodo;
		private $_argumentos;

		/**
		 * Constructor de la clase
		 * @return type
		 */
		public function __construct()
		{			
			if(isset($_GET['url']))
			{
			}
				$url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
				$url = explode("/", $url);
				$url = array_filter($url);

				$this->_controlador=strtolower(array_shift($url));
				$this->_metodo=strtolower(array_shift($url));
				$this->_argumentos = $url;

				if(!$this->_controlador)
				{
					$this->_controlador = DEFAULT_CONTROLLER;
				}

				if(!$this->_metodo)
				{
					$this->_metodo = "index";
				}

				if(!$this->_argumentos)
				{
					$this->_argumentos = array();
				}
			
		}

		/**
		 * Retorna el controlador
		 * @return type
		 */
		public function getController()
		{			
			return $this->_controlador;
		}

		/**
		 * Retorna el metodo
		 * @return type
		 */
		public function getMethod()
		{
			return $this->_metodo;
		}

		/**
		 * Retorna los argumentos
		 * @return type
		 */
		public function getArgs()
		{
			return $this->_argumentos;
		}
	}
?>