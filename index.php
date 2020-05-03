<?php 
//for me , without this setting its not showing error // so will comment if not needed ,dont remove
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On'); */


// include all controllers here
// require('./controller/Test.php');
require('./controller/Artist.php');
require('./controller/Album.php');
require('./controller/Song.php');
require('./controller/Login.php');

// call the controllers using 
// domain(localhost)/app_name/index.php/Controller_name/function/args..../


function getArgumentStart($uri){
	foreach ($uri as $key => $value){
		if($value == 'index.php'){
			if($key == count($uri) - 1 ) return -1;
			return $key+1;
		}
	}
}


function main(){

	$uri = parse_url($_SERVER['REQUEST_URI']);
	$parameters = explode('/', $uri['path']);
	$start = getArgumentStart($parameters);

	if($start != -1){
		$controller_name = $parameters[$start];

		if (array_key_exists($start+1, $parameters) && $parameters[$start+1])
			$function_name = $parameters[$start+1] . "_" . strtolower($_SERVER['REQUEST_METHOD']); 
		else 
			$function_name = 'index';

		$start+=2;
		$args = array();
		for(;$start < count($parameters); $start++){
			array_push($args, $parameters[$start]);
		}
		
		call_user_func_array(array(new $controller_name, $function_name), $args);
	}else{
		echo "404 not found";
	}

	
}

main();
