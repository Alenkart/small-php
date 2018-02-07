<?php  

class View {

	private $path;

	function __construct() {}

	public function setPath($path = "") {
		$this->path = $path;
	}

	public function render($view, $params) {

		$path = $this->path.$view;

		if(!$this->view_is_valid($view, $path)) {
			exit($path);
		}

		$html = file_get_contents($path);

		foreach ($params as $key => $value) {
		 	unset($params[$key]);
		 	$params['{:'.$key.'}'] = $value;
		} 

		$rendered = str_replace(
			array_keys($params), 
			array_values($params), 
			$html
		);

		exit($rendered);
	}

	private function view_is_valid($view, $path) {
		
		if(empty($view) 
			|| !file_exists($path) 
			|| !is_readable($path)) {

			return false;
		}

		return true;
	}
}