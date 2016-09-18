<?php

class Router 
{
	private $routes;
	
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	// returns request string (URI)
	private function getURI() {
		if(!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
	
	public function run()
	{
		// get URI
		$uri = $this->getURI();
		
		// find uri in routes.php
		foreach($this->routes as $uriPattern => $path) {
			//echo "<br/>$uriPattern => $path";
			if(preg_match("~$uriPattern~", $uri)) {
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
			
				$segments = explode('/', $internalRoute);
				
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				$actionName = 'action'.ucfirst(array_shift($segments));
				$parameters = $segments;
				
				//print_r($parameters);
				
				// get needed class of the controller
				$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
				if(file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				
				// create object,run action
				$controllerObject = new $controllerName;
				//$result = $controllerObject->$actionName($parameters);
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				if($result != null) {
					break;
				}
			}
		}
	}
	
}