<?php
$path = (isset($path))?$path:'';

require_once $path.'model/categoria.php'; 

class CategoriaController{

	
	private $categoria;
	
	private $data = array();
	private $errores = 0;
    
    public function __CONSTRUCT(){
		$this->categoria = new class_categoria();
    }
	
	
	public function cargar_categorias(){
		
    $output = array();

    $result = $this->categoria->cargar_categorias();
    $categorias = '<option selected disabled value="">Seleccionar...</option>';  
  
    foreach ($result as $r) {
      $value = openssl_encrypt($r['id'], COD, KEY);
      $categorias .= '<option value="'.$value.'">'.$r['descripcion'].'</option>';
    }

    $output["categorias"] =  $categorias;  

    echo json_encode($output);

  }
    

}