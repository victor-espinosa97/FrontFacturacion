<?php
class class_categoria
{
	
	public function __CONSTRUCT()
	{
		try
		{
			$this->httpClient = new HttpClient();  
			$this->log = new log();  
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	

	public function cargar_categorias()
	{
		try 
		{
			$response = $this->httpClient->sendGetRequest('/categorias/');

            return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/categorias',__CLASS__,__FUNCTION__,'N/A');
			die($e->getMessage());
		}
	}


	

}

?>