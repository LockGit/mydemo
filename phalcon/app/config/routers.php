<?php
/**
 * @Author: Lock.Esc
 * @Date:   2015-05-11 23:08:35
 * @Last Modified by:   Lock.Esc
 * @Last Modified time: 2015-05-12 00:59:05
 */
$di->set('router',function(){
	$router = new \Phalcon\Mvc\Router();
	//定义访问 http://localhost/phalcon/Index/index123
	//等于访问 http://localhost/phalcon/Index/index
	$router->add("/Index/index123",array(
		'controller' => 'Index',
		'action' => 'index'
	));
	//定义访问 http://localhost/phalcon/Product/list
	//等于访问 http://localhost/phalcon/Index/index
	$router->add('/Product/list',array(
		'controller' => 'Index',
		'action'	=> 'index'
	));
	//定义访问 http://localhost/phalcon/Index/abc/123-
	//等于访问 http://localhost/phalcon/Index/index
	$router->add('/Index/abc/{slug:(\w+|\-|\w+\-+)}', array(
		'controller' => 'Index',
		'action'	=> 'index'
    ))->convert('slug', function($slug) {
        return str_replace('-', '*', $slug);
    });



	$router->add('/login',array(
		'controller' => 'Index',
		'action'	=> 'index',
	));

	return $router;
});


