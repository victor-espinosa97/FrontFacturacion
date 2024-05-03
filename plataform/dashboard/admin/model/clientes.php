<?php
class class_clientes
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

	public function listar_clientes($data)
	{
		try 
		{
			$params = http_build_query(array(
				'search[value]' => isset($data["search"]["value"]) ? $data["search"]["value"] : '',
				'order[0][column]' => isset($data["order"]["0"]["column"]) ? $data["order"]["0"]["column"] : '',
				'order[0][dir]' => isset($data["order"]["0"]["dir"]) ? $data["order"]["0"]["dir"] : '',
				'start' => isset($data["start"]) ? $data["start"] : 0,
				'length' => isset($data["length"]) ? $data["length"] : 10
			));
			
			
			$response = $this->httpClient->sendGetRequest('/clientes/?' . $params);
			
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function buscar_por_dato($dato)
	{
		try 
		{
            $response = $this->httpClient->sendGetRequest('/clientes/buscar_por_dato/' .$dato);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function obtener_cliente($data)
	{
		try 
		{
            $response = $this->httpClient->sendGetRequest('/clientes/' .$data['cliente']);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function registrar_cliente($data)
	{
		try 
		{
			$body = [
                'capacidadCredito' => $data['capacidadCredito'],
                'correoElectronico' => $data['correoElectronico'],
                'direccion' => $data['direccion'],
                'identificacion' => $data['identificacion'],
                'nombreCompleto' => $data['nombreCompleto'],
                'telefono' => $data['telefono'],
                'tipoIdentificacion' => $data['tipoIdentificacion']
            ];

            $response = $this->httpClient->sendPostRequest('/clientes/', $body);

            return;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function editar_cliente($data)
	{
		try 
		{
			$body = [
                'capacidadCredito' => $data['capacidadCredito'],
                'correoElectronico' => $data['correoElectronico'],
                'direccion' => $data['direccion'],
                'identificacion' => $data['identificacion'],
                'nombreCompleto' => $data['nombreCompleto'],
                'telefono' => $data['telefono'],
                'tipoIdentificacion' => $data['tipoIdentificacion']
            ];
            $response = $this->httpClient->sendPutRequest('/clientes/edit/'.$data['cliente'], $body);

			return;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function deshabilitar_cliente($data)
	{
		try 
		{
            $response = $this->httpClient->sendDeleteRequest('/clientes/' .$data['cliente']);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/clientes',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

}

?>