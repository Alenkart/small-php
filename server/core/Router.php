<?php 

class Router {

	private $search = [
		'/'	   => '\/',
		'{a}'  => '(.*)',
		'{n}'  => '(\d+)',
		'{w}'  => '([a-zA-Z]+)',
		'{b}' => '(\w+)'
	];

	function __construct() {}

	public function get($path = '/', $response = null) {
		$this->request('GET', $path, $response);
	}

	public function post($path = '/', $response = null) {
		$this->request('POST', $path, $response);
	}

	public function put($path = '/', $response = null) {
		$this->request('PUT', $path, $response);
	}

	public function delete($path = '/', $response = null) {
		$this->request('DELETE', $path, $response);
	}

	private function request($type = 'GET', $path = '/', $response = null) {

		$params = $this->validatePath($path);

		if($params 
			&& $this->validateMethod($type) 
			&& is_callable($response)) {

			$bound = Closure::bind($response, $this);

			$response = $bound($params);
			
			exit($response);
		}
	}

	public function getParam(...$param) {
	
		$result = [];

		foreach ($param as $key) {

			if(empty($_REQUEST[$key])) {
				
				$this->error();
			} else {

				$result[$key] = $_REQUEST[$key];
			}
		}

		return $result;
	}

	public function error() {
		http_response_code(404);
		die("ERROR 404");
	}

	public function addRegex($regex) {
		array_push($this->search, $regex);
	}

	public function json($data) {
		header('Content-Type: application/json');
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	private function validateMethod($type = 'GET') {
		return $_SERVER['REQUEST_METHOD'] == $type;
	}

	private function validatePath($path = '/') {

		$matches = [];

		$url = rtrim($_SERVER['REQUEST_URI'], "/");

		$url = parse_url($url, PHP_URL_PATH);

		$path = str_replace(
			array_keys($this->search), 
			array_values($this->search), 
			$path
		);

		preg_match('/^'.$path.'+$/', $url, $matches);

		return $matches;
	}
}