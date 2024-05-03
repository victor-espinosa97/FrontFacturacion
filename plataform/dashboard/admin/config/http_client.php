<?php
class HttpClient {

    public function __construct(){}

    public function sendPostRequest($endpoint, $data = []) {
        return $this->sendRequest($endpoint, $data, "POST");
    }

    public function sendPutRequest($endpoint, $data = []) {
        return $this->sendRequest($endpoint, $data, "PUT");
    }

    public function sendDeleteRequest($endpoint, $data = []) {
        return $this->sendRequest($endpoint, $data, "DELETE");
    }

    public function sendGetRequest($endpoint){
        try {
            $curl = curl_init();
    
            curl_setopt($curl, CURLOPT_URL, REST_API . $endpoint);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $response = curl_exec($curl);
    
            if ($response === false) {
                $error = curl_error($curl);
                throw new Exception("Error en la solicitud get: $error");
            }
    
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpStatus !== 200) {
                throw new Exception("El servidor respondió en el get con un estado HTTP: $httpStatus");
            }
    
            curl_close($curl);
    
            return json_decode($response, true);
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function sendRequest($endpoint, $data = [], $method) {
        try {
            $curl = curl_init();
    
            curl_setopt($curl, CURLOPT_URL, REST_API . $endpoint);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); // Usar CURLOPT_CUSTOMREQUEST
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
    
            $response = curl_exec($curl);
    
            if ($response === false) {
                $error = curl_error($curl);
                throw new Exception("Error en la solicitud $method: $error");
            }
    
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpStatus !== 200 && $httpStatus !== 201) {
                throw new Exception("El servidor respondió en el $method con un estado HTTP: $httpStatus");
            }
    
            curl_close($curl);
    
            return json_decode($response, true);
        } catch (\Throwable $th) {
            return null;
        }
    }

}
?>
