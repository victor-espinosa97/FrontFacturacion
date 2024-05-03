<?php
$path = (isset($path))?$path:'';

class AdminController{
	
	private $data = array();
	private $errores = 0;
    
    public function __CONSTRUCT(){}
	
    public function Index(){
		
      require_once '../session/verifica_session.php';
      
      if(isset($_SESSION['SESION'])){
        
        if( is_numeric(openssl_decrypt($_SESSION['SESION']['ID'], COD,KEY))){
          require_once 'view/admin/templates/header.php'; 

          require_once 'view/admin/principal/principal.php';

          require_once 'view/admin/facturas/facturas.php';
          require_once 'view/admin/facturas/modal_form_facturar.php';
          
          require_once 'view/admin/producto/productos.php';
          require_once 'view/admin/producto/modal_form_producto.php';
          
          require_once 'view/admin/clientes/clientes.php';
          require_once 'view/admin/clientes/modal_form_cliente.php';
          require_once 'view/admin/clientes/modal_form_facturas_cliente.php';

          require_once 'view/admin/templates/footer.php'; 
          
          
        }else{
          header('Location: ../../../');
        }

      }else{
        header('location: ../../../');
      }	
		
    }

}