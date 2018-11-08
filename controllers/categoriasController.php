<?php  
	
	/**
	 * Clase Controlador de las cateogorias
	 */
	class categoriasController extends AppController
	{
		/**
		 * Constructor de la clase
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * Imprime los registros de las categorias
		 * @return type
		 */
		public function index()
		{
			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		/**
		 * Agrega una nueva categoria
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$categoria = $this->loadModel("categoria");
				$categoria->add($_POST);
				$this->redirect(array("controller"=>"categorias"));
			}
			$this->_view->titulo="Nueva Tarea";
			$this->_view->renderizar("agregar");
		}

		/**
		 * Actualiza los datos de una nueva categoria
		 * @param type|null $id 
		 * @return type
		 */
		public function editar($id=null)
		{
			if($_POST)
			{
				$categoria = $this->loadModel("categoria");
				$categoria->update($_POST);
				$this->redirect(array("controller"=>"categorias"));
			}
			$categoria = $this->loadModel("categoria");
			$this->_view->categoria=$categoria->find($id);
			$this->_view->titulo="Editar Tarea";
			$this->_view->renderizar("editar");
		}

		/**
		 * Elimina una categoria mediante el Id
		 * @param type|null $id 
		 * @return type
		 */
		public function eliminar($id = null)
		{
			$categoria = $this->loadModel("categoria");
			$item = $categoria->find($id);
			print_r($item);
			if($item)
			{
				$categoria->delete($id);
				$this->redirect(array("controller"=>"categorias"));
			}
		}
	}
?>