<?php
$path = (isset($path))?$path:'';

require_once $path.'model/facturas.php';   

class FacturasController{

	
	private $factura;
	
	private $data = array();
	private $errores = 0;
    
    public function __CONSTRUCT(){
		$this->factura = new class_facturas();
    }
	
	public function listar_facturas(){
		
		$output = array();
		
		$data['search'] = (isset($_POST["search"]))?$_POST["search"]:NULL;
		$data['order'] 	= (isset($_POST["order"]))?$_POST["order"]:NULL;
		$data['length'] = (isset($_POST["length"]))?$_POST["length"]:NULL;
		$data['start'] 	= (isset($_POST['start']))?$_POST["start"]:NULL;
		$data['length'] = (isset($_POST['length']))?$_POST["length"]:NULL; 
		$data['offset'] = 1;
		
		
		$array = array();
		
		$resultado = $this->factura->listar_facturas($data);
		
		foreach($resultado['data'] as $r):
			$sub_array = array(); 
			$sub_array[] = $r['nroFactura']; 
			$sub_array[] = $r['fechaVenta'];
			$sub_array[] = $r['cliente']['nombreCompleto'];
			$sub_array[] = $r['descripcion']; 
			$sub_array[] = number_format($r['subTotal']); 
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
	
	public function listar_facturas_cliente(){
		
		$output = array();
		$data['cliente'] = (isset($_REQUEST['cliente']))?$_REQUEST["cliente"]:NULL; 
		
		$data['search'] = (isset($_POST["search"]))?$_POST["search"]:NULL;
		$data['order'] 	= (isset($_POST["order"]))?$_POST["order"]:NULL;
		$data['length'] = (isset($_POST["length"]))?$_POST["length"]:NULL;
		$data['start'] 	= (isset($_POST['start']))?$_POST["start"]:NULL;
		$data['length'] = (isset($_POST['length']))?$_POST["length"]:NULL; 
		$data['offset'] = 1;
		
		
		$array = array();
		
		$resultado = $this->factura->listar_facturas_cliente($data);
		
		foreach($resultado['data'] as $r):
			$sub_array = array(); 
			$sub_array[] = $r['nroFactura']; 
			$sub_array[] = $r['fechaVenta'];
			$sub_array[] = $r['descripcion']; 
			$sub_array[] = number_format($r['subTotal']); 
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
	
	public function registrar_factura(){
		try {
			$data['productos'] = $_POST['productos'];    
			$data['clienteId'] = $_POST['clienteId'];    
			$data['descripcion'] = $_POST['descripcion'];    
			$data['observacion'] =  $_POST['observacion'];
			
			$error =  $this->factura->registrar_factura($data); 

			if($error == ''){
				echo "Registrado..";
			}else{
				echo "¡Ha ocurrido un error al registrar!";
			}

		} catch (\Throwable $th) {
			print_r($th);
			echo 'Ocurrio un error..'; 
		}
	}
	
}