<?php 


class CJ_Controller{
	
	function __construct() {}


	function load_view($view, $args) {

		foreach ($args as $vname => $vvalue) {
			
			$$vname = $vvalue;
		}
		require_once(__DIR__.'/../view/'.$view.'.php');		
	}
}





?>