<?php  
	/**
	 * Clase modelo de categoria
	 */
	class CategoriaModel extends AppModel
	{
		/**
		 * Constructor
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * Obtener todas las categorias registradas en la base de datos
		 * @return type
		 */
		public function getCategorias()
		{
			$tareas = $this->_db->query("SELECT * FROM categorias");
			return $tareas->fetchall();			
		}

		/**
		 * Busca una categoria mediante el Id
		 * @param type $id 
		 * @return type
		 */
		public function find($id)
		{
			$query = $this->_db->prepare("SELECT * FROM categorias WHERE id=:id");
			$query->bindParam(":id",$id);
			$query->execute();
			$category = $query->fetch();

			if($category)
			{
				return $category;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Agrega una categoria
		 * @param type|array $data 
		 * @return type
		 */
		public function add($data = array())
		{
			$query = $this->_db->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");

			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Actualiza los datos de una categoria
		 * @param type|array $data 
		 * @return type
		 */
		public function update($data = array())
		{
			$query = $this->_db->prepare(
				"UPDATE categorias SET nombre=:nombre WHERE id=:id"				
			);

			$query->bindParam(":id",$data["id"]);
			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Elimina una categoria mediante el Id
		 * @param type $id 
		 * @return type
		 */
		public function delete($id)
		{
			$query = $this->_db->prepare("DELETE FROM categorias WHERE id=:id");
			echo $id;
			$query->bindParam(":id",$id);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>