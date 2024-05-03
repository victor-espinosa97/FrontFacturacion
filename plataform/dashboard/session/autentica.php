<?php

require_once 'admin/model/login.php';
class Autentica{

	private $login;
	
	private $data = array();

	
	public function __CONSTRUCT(){
		$this->login = new class_login();
	}
	
	public function valida_user(){  
		
		try{
		    
		    $email=(isset($_POST['email']))?$_POST['email']:'';
            $password=(isset($_POST['password']))?$_POST['password']:'';
            $pendiente=false;
            $data['email'] = $email;
            $data['password'] = $password;
            
            $consultado = $this->login->obtener_cliente_login($data);
			
		    if (!empty($consultado))
        	{
				$id = $consultado['id'];
				
        		$cliente=array(
        			'ID' => openssl_encrypt($id, COD, KEY),
        			'NOMBRE' => $consultado['nombre'],
        			'EMAIL' => $consultado['email']
        		);
				
        		$_SESSION['SESION'] = $cliente; 

				if(!empty($cliente['EMAIL'])){
					header('Location: admin/');
        		} else {
					header('Location: ../../');
        		} 
        	}else{
				echo "<script>
						alert('Credenciales invalidas');
						window.location.href = '../../';
					</script>";
        	}  
		}catch(Exception $e){
		  echo $e;
		}
	}
	
	
}
?>