<?php
class class_login
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

	public function obtener_cliente_login($data)
	{
		try 
		{
            $body = [
                'email' => $data['email'],
                'password' => $data['password']
            ];

            $response = $this->httpClient->sendPostRequest('/usuarios/login', $body);

            return $response;
        } catch (Exception $e) {
            $this->log->log_eventos($e->getMessage(),'Error',__CLASS__,__FUNCTION__,$data);
            die($e->getMessage());
        }
	}


}