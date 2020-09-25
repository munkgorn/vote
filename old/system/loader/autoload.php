<?php 
	require_once('framework.php');
	
	$framework = new framework();
		// $framework->controller('common/header');
		if(empty(get('route'))){
			$framework->controller(DEFAULT_PAGE);
		}else{
			$framework->controller(get('route'));
		}
		// $framework->controller('common/footer');
?>