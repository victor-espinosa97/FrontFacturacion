<?php
$path = (isset($path))?$path:'';

require_once $path.'model/producto.php';   

class ProductoController{

	
	private $producto;
	
	private $data = array();
	private $errores = 0;
    
    public function __CONSTRUCT(){
		$this->producto = new class_producto();
    }

	public function listar_productos(){
		
		$output = array();
		
		$data['search'] = (isset($_POST["search"]))?$_POST["search"]:NULL;
		$data['order'] 	= (isset($_POST["order"]))?$_POST["order"]:NULL;
		$data['length'] = (isset($_POST["length"]))?$_POST["length"]:NULL;
		$data['start'] 	= (isset($_POST['start']))?$_POST["start"]:NULL;
		$data['length'] = (isset($_POST['length']))?$_POST["length"]:NULL; 
		$data['offset'] = 1;
		
		
		$array = array();
		
		$resultado = $this->producto->listar_productos($data);
		
		foreach($resultado['data'] as $r):
			$sub_array = array(); 
			
			$sub_array[] = '<button class="btn btn-outline-dark btn-sm">'.$r['id'].'</button>'; 
			$sub_array[] = $r['descripcion'];
			$sub_array[] = $r['disponible']?'Si':'No';
			$sub_array[] = $r['existencia'];
			$sub_array[] = number_format($r['precio']) ;
			$sub_array[] = $r['categoria']['descripcion'];
			$sub_array[] = '<div class="d-flex justify-content-around">
								<button class="btn btn-outline-success btn-sm obtener_producto" id="'.openssl_encrypt($r['id'], COD, KEY).'"> 
									modificar
								</button>
								<button class="eliminar_producto btn btn-outline-danger btn-sm" id="'.$r['id'].'"> 
									eliminar
								</button>
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

	public function obtener_producto(){
		try {
			
			$data['productId'] = openssl_decrypt($_POST['productId'],COD,KEY);
			$output = $this->producto->obtener_producto($data);
			$categoriaId = $output['categoria']['id'];
			
			$output['categoria']['id'] = openssl_encrypt($categoriaId,COD,KEY); 
			echo json_encode($output);

		} catch (\Throwable $th) {
			print_r($th);
			echo 'Ocurrio un error..'; 
		}
	}
	public function buscar_por_dato(){
		try {
			
			$output = $this->producto->buscar_por_dato($_POST['dato']); 

			echo json_encode($output);

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function registrar_producto(){
		try {
			
			$data['descripcion'] = $_POST['descripcion'];    
			$data['disponible'] = $_POST['disponible'];    
			$data['existencia'] = $_POST['existencia'];     
			$data['precio'] = $_POST['precio'];    
			$data['categoriaId'] = openssl_decrypt($_POST['categoriaId'],COD,KEY);   
			
			$error =  $this->producto->registrar_producto($data); 

			if($error == ''){
				echo "Registrado..";
			}else{
				echo "¡Ha ocurrido un error al registrar!";
			}

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}
	
	public function editar_producto(){
		try {
			$data['producto'] = $_POST['product_seleccionado'];
			$data['descripcion'] = $_POST['descripcion'];    
			$data['disponible'] = $_POST['disponible'];    
			$data['existencia'] = $_POST['existencia'];     
			$data['precio'] = $_POST['precio'];    
			$data['categoriaId'] = openssl_decrypt($_POST['categoriaId'],COD,KEY);     
			$error =  $this->producto->editar_producto($data); 

			if($error == ''){
				echo "Actualizado..";
			}else{
				echo "¡Ha ocurrido un error al actualizar!";
			}

		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}

    public function deshabilitar_producto(){
		try {
			$data['producto'] = $_POST['productId'];
			$output = $this->producto->deshabilitar_producto($data); 
			echo 'Eliminado..';
		} catch (\Throwable $th) {
			echo 'Ocurrio un error..'; 
		}
	}


}