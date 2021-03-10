<?php
class ClientesModel
{
	private $cn;

	public function __CONSTRUCT()
	{
		try
		{
			$this->cn = new PDO('mysql:host=localhost;dbname=examenmanuel', 'root', 'toor');
			$this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
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

			$stm = $this->cn->prepare("SELECT * FROM clientes");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Cliente();

				$alm->__SET('DNI', $r->DNI);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Direccion', $r->Direccion);
				$alm->__SET('Telefono', $r->Telefono);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($DNI)
	{
		try 
		{
			$stm = $this->cn->prepare("SELECT * FROM clientes WHERE DNI = ?");
			          

			$stm->execute(array($DNI));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Cliente();

				$alm->__SET('DNI', $r->DNI);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Direccion', $r->Direccion);
				$alm->__SET('Telefono', $r->Telefono);

			return $alm;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($DNI)
	{
		try 
		{
			$stm = $this->cn->prepare("DELETE FROM clientes WHERE DNI = ?");			          

			$stm->execute(array($DNI));
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Cliente $data)
	{
		try 
		{
			$sql = "UPDATE clientes SET 
						 
						Nombre      = ?,
						Direccion 	= ?,
						Telefono 	= ?
				    WHERE DNI 		= ?";

			$this->cn->prepare($sql)->execute(
				array(
					$data->__GET('Nombre'), 
					$data->__GET('Direccion'),
					$data->__GET('Telefono'),
					
					$data->__GET('DNI')
					)
				);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
		try 
		{
			$sql = "INSERT INTO clientes (DNI,Nombre,Direccion,Telefono) VALUES (?, ?, ?, ?)";

			$this->cn->prepare($sql)->execute(
				array(
					$data->__GET('DNI'),
					$data->__GET('Nombre'),  
					$data->__GET('Direccion'),
					$data->__GET('Telefono'),
				)
			);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}