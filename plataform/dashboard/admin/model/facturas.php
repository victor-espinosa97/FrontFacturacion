<?php
class class_facturas 
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
	
	public function listar_facturas($data)
	{
		try 
		{
			$params = http_build_query(array(
				'search[value]' => isset($data["search"]["value"]) ? $data["search"]["value"] : '',
				'order[0][column]' => isset($data["order"]["0"]["column"]) ? $data["order"]["0"]["column"] : '',
				'order[0][dir]' => isset($data["order"]["0"]["dir"]) ? $data["order"]["0"]["dir"] : '',
				'start' => isset($data["start"]) ? $data["start"] : 0,
				'length' => isset($data["length"]) ? $data["length"] : 10,
			));
			
			
			$response = $this->httpClient->sendGetRequest('/facturas/?' . $params);
			
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/facturas',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function listar_facturas_cliente($data)
	{
		try 
		{
			$params = http_build_query(array(
				'search[value]' => isset($data["search"]["value"]) ? $data["search"]["value"] : '',
				'order[0][column]' => isset($data["order"]["0"]["column"]) ? $data["order"]["0"]["column"] : '',
				'order[0][dir]' => isset($data["order"]["0"]["dir"]) ? $data["order"]["0"]["dir"] : '',
				'start' => isset($data["start"]) ? $data["start"] : 0,
				'length' => isset($data["length"]) ? $data["length"] : 10,
				'cliente' => isset($data["cliente"]) ? $data["cliente"] : '',
			));
			
			
			$response = $this->httpClient->sendGetRequest('/facturas/cliente/?' . $params);
			
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/facturas',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function reporte_general()
	{
		try 
		{
			$response = $this->httpClient->sendGetRequest('/facturas/reporte_general/');
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/facturas',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function reporte_facturas_cliente($clienteId)
	{
		try 
		{
			$response = $this->httpClient->sendGetRequest('/facturas/reporte_cliente/'.$clienteId);
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/facturas',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function registrar_factura($data)
	{
		try 
		{
			$body = [
                'productos' => $data['productos'],
                'clienteId' => $data['clienteId'],
                'descripcion' => $data['descripcion'],
                'observacion' => $data['observacion']
            ];
			
            $response = $this->httpClient->sendPostRequest('/facturas/', $body);

            return;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/facturas',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

}

?>