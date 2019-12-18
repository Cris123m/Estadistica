<?php
class Estudiante
{
   
	private $pdo;
    
    public $ci;
    public $Nombre;
    public $Apellido;
    

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

			$stm = $this->pdo->prepare("SELECT * FROM estudiantes");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($ci)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM estudiantes WHERE ci = ?");
			          

			$stm->execute(array($ci));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($ci)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM estudiantes WHERE ci = ?");			          

			$stm->execute(array($ci));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE estudiantes SET 
						Nombre          = ?, 
						Apellido        = ?,
                        
				    WHERE ci = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre, 
                        
                        $data->Apellido,
                        
                        $data->ci
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Estudiante $data)
	{
		try 
		{
		$sql = "INSERT INTO estudiantes (ci,Nombre,Apellido) 
		        VALUES (?,?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->ci,
                    $data->Nombre,                    
                    $data->Apellido
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}