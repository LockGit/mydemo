<?php
return new \Phalcon\Config(array(
	'application'=>array(
		'controllersDir' => __DIR__.'/../controllers',
		'modelsDir'	=>__DIR__.'/../models',
		'viewsDir'	=>__DIR__.'/../views',
		'baseUrl'	=> '/phalcon/'
	),

	'database'=>array(
		'localhost'=>'localhost',
		'user'	=> 'root',
		'password' => '',
		'dbname'	=>'phalcon'
	)
));