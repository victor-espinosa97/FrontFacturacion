<?php
$path = (isset($path))?$path:'';

require_once $path.'model/clientes.php'; 

class ClientesController{

	
	private $clientes;
	
	private $data = array();
	private $errores = 0;
    
    public function __CONSTRUCT(){
		$this->clientes = new class_clientes();
    }

	public function listar_clientes(){
		
		$output = array();
		
		$data['search'] = (isset($_POST["search"]))?$_POST["search"]:NULL;
		$data['order'] 	= (isset($_POST["order"]))?$_POST["order"]:NULL;
		$data['length'] = (isset($_POST["length"]))?$_POST["length"]:NULL;
		$data['start'] 	= (isset($_POST['start']))?$_POST["start"]:NULL;
		$data['length'] = (isset($_POST['length']))?$_POST["length"]:NULL; 
		$data['offset'] = 1;
		
		
		$array = array();
		
		$resultado = $this->clientes->listar_clientes($data);

		foreach($resultado['data'] as $r):
			$sub_array = array(); 

			$sub_array[] = $r['id'];
			$sub_array[] = $r['nombreCompleto'];
			$sub_array[] = $r['correoElectronico'];
			$sub_array[] = $r['fechaIngreso'];
			$sub_array[] = $r['telefono'];
			$sub_array[] = $r['capacidadCredito'];
			// $sub_array[] = $r['direccion'];
			$sub_array[] = $r['identificacion'];
			$sub_array[] = $r['tipoIdentificacion'];
			
			$sub_array[] = '<div class="d-flex justify-content-around">
								<a class="btn btn-outline-success obtener_facturas_cliente" id="'.openssl_encrypt($r['id'], COD, KEY).'"> 
									Facturas
								</a>
								<a class="btn btn-outline-info obtener_cliente" id="'.openssl_encrypt($r['id'], COD, KEY).'"> 
									Editar
								</a>
							</div>'; 
			$array[] = $sub_array;
											
		endforeach;
		
		$data['offset'] = 0;
		
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$resultado['total'],
			"recordsFiltered"	=>	$resultado['total'],
			"data"				=>	$array
		);
		
		echo json_encode($output);
			
    }

	public function buscar_por_dato(){
		try {
			
			$output = $this->clientes->buscar_por_dato($_POST['dato']); 

			echo json_encode($output);

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function obtener_cliente(){
		try {
			
			$data['cliente'] = openssl_decrypt($_POST['clienteId'],COD,KEY);
			$output = $this->clientes->obtener_cliente($data); 

			echo json_encode($output);

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function registrar_cliente(){
		try {

			$data['capacidadCredito'] = $_POST['capacidadCredito'];    
			$data['correoElectronico'] = $_POST['correoElectronico'];    
			$data['direccion'] = $_POST['direccion'];    
			$data['identificacion'] = $_POST['identificacion'];  
			$data['nombreCompleto'] = $_POST['nombreCompleto'];  
			$data['telefono'] = $_POST['telefono'];  
			$data['tipoIdentificacion'] = $_POST['tipoIdentificacion'];  
			$error =  $this->clientes->registrar_cliente($data); 

			if($error == ''){
				echo "Registrado..";
			}else{
				echo "¡Ha ocurrido un error al registrar!";
			}

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function editar_cliente(){
		try {
			$data['cliente'] = $_POST['cliente_seleccionado'];    
			$data['capacidadCredito'] = $_POST['capacidadCredito'];    
			$data['correoElectronico'] = $_POST['correoElectronico'];    
			$data['direccion'] = $_POST['direccion'];    
			$data['identificacion'] = $_POST['identificacion'];  
			$data['nombreCompleto'] = $_POST['nombreCompleto'];  
			$data['telefono'] = $_POST['telefono'];  
			$data['tipoIdentificacion'] = $_POST['tipoIdentificacion'];  
			$error =  $this->clientes->editar_cliente($data); 

			if($error == ''){
				echo "Actualizado..";
			}else{
				echo "¡Ha ocurrido un error al actualizar!";
			}

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function deshabilitar_cliente(){
		try {
			
			$data['cliente'] = $_POST['clienteId'];
			$output = $this->clientes->deshabilitar_cliente($data); 
			echo 'Eliminado..';
		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}

}