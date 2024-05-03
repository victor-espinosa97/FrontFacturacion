<?php
class class_producto 
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

	public function listar_productos($data)
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
			
			
			$response = $this->httpClient->sendGetRequest('/productos/?' . $params);
			
			return $response;
			
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'modelo/productos',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function obtener_producto($data)
	{
		try 
		{
            $response = $this->httpClient->sendGetRequest('/productos/' .$data['productId']);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/producto',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	
	public function registrar_producto($data)
	{
		try 
		{
			$body = [
                'descripcion' => $data['descripcion'],
                'disponible' => ($data['disponible'] == 1)?true: false,
                'existencia' => $data['existencia'],
                'precio' => $data['precio'],
                'categoriaId' => $data['categoriaId']
            ];
			
            $response = $this->httpClient->sendPostRequest('/productos/', $body);

            return;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/producto',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function editar_producto($data)
	{
		try 
		{
			$body = [
                'descripcion' => $data['descripcion'],
                'disponible' => ($data['disponible'] == 1)?true: false,
                'existencia' => $data['existencia'],
                'precio' => $data['precio'],
                'categoriaId' => $data['categoriaId']
            ];
            $response = $this->httpClient->sendPutRequest('/productos/edit/'.$data['producto'], $body);

			return;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/producto',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function buscar_por_dato($dato)
	{
		try 
		{
            $response = $this->httpClient->sendGetRequest('/productos/buscar_por_dato/' .$dato);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/productos',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}

	public function deshabilitar_producto($data)
	{
		try 
		{
            $response = $this->httpClient->sendDeleteRequest('/productos/' .$data['producto']);

            return $response;
		} catch (Exception $e) 
		{
			$this->log->log_eventos($e->getMessage(),'model/productos',__CLASS__,__FUNCTION__,$data);
			die($e->getMessage());
		}
	}
	

}

?>