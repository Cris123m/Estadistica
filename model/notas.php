<?php
class Notas
{
   
	private $pdo;
    
    public $id;
    public $ci;
    public $id_materia;
    public $nota;

	public function __CONSTRUCT()
	{
		try
		{
            include_once 'database.php';
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM notas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarxEstudiante($ci)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM notas WHERE ci_estudiante = ?");
			$stm->execute(array($ci));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarxMateria($id)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM notas WHERE id_materia = ?");
			$stm->execute(array($id));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM notas WHERE id_nota = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM notas WHERE id_nota = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE notas SET 
						nota = $data->nota,
                        ci_estudiante = '$data->ci',
						id_materia = '$data->id_materia'
				    WHERE id_nota = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarxEstudiante(Notas $data)
	{
		try 
		{
			$sql = "UPDATE notas SET 
						nota = ?
				    WHERE ci_estudiante = ? and id_materia = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->nota,
						$data->ci,
						$data->id_materia
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Notas $data)
	{
		try 
		{
		$sql = "INSERT INTO notas (nota,ci_estudiante,id_materia) 
		        VALUES (?,?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nota,
					$data->ci,
					$data->id_materia         
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>