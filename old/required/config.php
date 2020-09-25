<?php
	$base = str_replace('required', '', __DIR__);
	define('MURL','http://localhost/dohung/');
	define('AURL',MURL.'admin/');
	define('DEFAULT_PAGE','home');
	define('WEB_NAME','Dohung');
	define('IMAGE_PHOTO',MURL.'uploads/photo/');
	define('NO_PHOTO',MURL.'uploads/no_photo.jpg');
	// Config DB
	define('DB', 'mysqli');
	define('PREFIX', 'dh_');
	define('DB_HOST','localhost');
	define('DB_USER','fsoftpro_votedb');
	define('DB_PASS','jkfWnls5t');
	define('DB_DB','fsoftpro_votedb');
	// System config 
	define('DEFAULT_LANGUAGE','2');
	define('DEFAULT_LIMIT_PAGE','10');

	define('CONFIG_START_DATE',date('Y-m-').date('d').date(' 00:00:00'));
	define('CONFIG_END_DATE',date('Y-m-').date('d').date(' 23:59:59'))
	
?>