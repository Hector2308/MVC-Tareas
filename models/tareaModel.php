<?php  
	/**
	 * Clase modelo de la tarea
	 */
	class TareaModel extends AppModel
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
		 * Obtiene todas las tareas registradas en la base de datos
		 * @return type
		 */
		public function getTareas()
		{
			$tareas = $this->_db->query("SELECT T.*,C.nombre as Categoria FROM tareas T INNER JOIN categorias C ON C.id=T.categoria_ID");
			
			foreach (range(0, $tareas->columnCount()-1) as $column_index) {
				$meta[] = $tareas->getColumnMeta($column_index);
			}
			
			$resultados = $tareas->fetchAll(PDO::FETCH_NUM);

			for ($i=0; $i < count($resultados); $i++) { 
				$j = 0;
				foreach ($meta as $value) {
					$rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
					$j++;
				}
			}
			return $rows;
			//return $tareas->fetchall();			
		}

		/**
		 * Agrega un nuevo registro en la tabla de tareas
		 * @param type|array $datos 
		 * @return type
		 */
		public function agregar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"INSERT INTO tareas
				(categoria_id,nombre,descripcion,fecha,prioridad,status)
				VALUES
				(:categoria_id,:nombre,:descripcion,:fecha,:prioridad,0)"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":descripcion",$datos["descripcion"]);
			$consulta->bindParam(":fecha",$datos["fecha"]);
			$consulta->bindParam(":prioridad",$datos["prioridad"]);			

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Actualiza los datos de una tarea mediante el Id
		 * @param type|array $datos 
		 * @return type
		 */
		public function actualizar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"UPDATE tareas SET
				categoria_id=:categoria_id,
				nombre=:nombre,
				descripcion=:descripcion,
				fecha=:fecha,
				prioridad=:prioridad				
				WHERE id=:id"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":descripcion",$datos["descripcion"]);
			$consulta->bindParam(":fecha",$datos["fecha"]);
			$consulta->bindParam(":prioridad",$datos["prioridad"]);	
			$consulta->bindParam(":id",$datos["id"]);		

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Obtiene los datos de una tarea mediante el Id
		 * @param type $id 
		 * @return type
		 */
		public function buscarPorId($id)
		{
			$tarea = $this->_db->prepare("SELECT * FROM tareas WHERE id=:id");
			$tarea->bindParam(":id",$id);
			$tarea->execute();
			$registro = $tarea->fetch();

			if ($registro) 
			{
				return $registro;
			}
			else
			{
				return false;
			}
		}

		/**
		 * Elimina los datos de una tarea mediante el Id
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id)
		{
			$query = $this->_db->prepare("DELETE FROM tareas WHERE id=:id");
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

		/**
		 * Actualiza el estatus de la tarea mediante el Id
		 * @param type $id 
		 * @param type $status 
		 * @return type
		 */
		public function actualizarEstatus($id,$status)
		{
			
			$query = $this->_db->prepare("UPDATE tareas SET status=:status WHERE id=:id");		

			$query->bindParam(":id",$id);
			$query->bindParam(":status",$status);
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