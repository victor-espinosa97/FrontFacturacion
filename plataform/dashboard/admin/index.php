<?php
	session_start();
	require_once 'config/global.php';
    require_once 'config/http_client.php';
	require_once 'config/log.php';
	require_once '../session/verifica_session.php';
	
	date_default_timezone_set("America/Lima");
	ini_set('display_errors', '1');

	if(!isset($_REQUEST['c'])){
		
		require_once "controller/admin.controller.php";
		$controller = ucwords('admin') . 'Controller';
		$controller = new $controller;
		$controller->Index();    
		
	}else{	
		$controller = strtolower($_REQUEST['c']);
		$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
		
		
		require_once "controller/$controller.controller.php";
		$controller = ucwords($controller) . 'Controller';
		$controller = new $controller;
		
		call_user_func( array( $controller, $accion ) );
	}
 
?>