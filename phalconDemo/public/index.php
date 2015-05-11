<?php
/**
 * @Author: Lock.Esc
 * @Date:   2015-03-27 21:03:11
 * @Last Modified by:   Lock.Esc
 * @Last Modified time: 2015-05-12 00:22:52
 */

use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

function p($data){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}
define('APP_PATH', realpath('..') . '/');

try {
	$loader=new \Phalcon\Loader();
	$loader->registerDirs(
        array(
            '../app/frontend/controllers',
            '../app/frontend/models'
    ));

    //注册命名空间
    $loader->registerNamespaces(array(
       'multiple\frontend\Controllers' => '../app/frontend/controllers/',
       'multiple\frontend\model' => '../app/frontend/models'
    ));

    $loader->register();

	//注入容器 Create a DI injection
	$di=new Phalcon\DI\FactoryDefault();
    // $di->set('dispatcher', function() {
    //     $dispatcher = new \Phalcon\Mvc\Dispatcher();
    //     $dispatcher->setDefaultNamespace('multiple\frontend\Controllers');
    //     return $dispatcher;
    // });


    // $router->add('/',array(
    //     'namespace' => 'multiple\frontend\Controllers',
    //     //'module' => 'frontend',
    //     'controller'=>'Index',
    //     'action'    =>'index'
    // ));
    $di->set('router',function(){
        $router=new \Phalcon\Mvc\Router(false);
        //$router->setDefaultNamespace('multiple\frontend\Controllers');
        $router->add("/",array(
            'namespace'=>'multiple\frontend\Controllers',
            'controller'=>'Index',
            'action'=>'index'
        ));
        $router->add("/Index/index",array(
            'namespace'=>'multiple\frontend\Controllers',
            'controller'=>'Index',
            'action'=>'index'
        ));
        $router->add("/[G|g]uest/list",array(
            'namespace'=>'multiple\frontend\Controllers',
            'controller'=>'Guest',
            'action'=>'list'
        ));
        //正则路由
        $router->add("/(\w+)/(\w+)",array(
            'namespace'=>'multiple\frontend\Controllers',
            'controller'=>1,
            'action'=>2
        ));
        // $router->handle();
        return $router;
    });

    $di->set('view', function() {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/frontend/views');
        // $view->registerEngines(array(
        //     ".volt" => 'Phalcon\Mvc\View\Engine\Volt'
        // ));
        //设置模板文件扩展名
        $view->registerEngines(array(
            ".phtml" => 'Phalcon\Mvc\View\Engine\Volt'
        ));
        return $view;
    });
    //设置编译后生成的php文件路径
    // $di->set('volt', function($view, $di) {
    //     $volt = new VoltEngine($view, $di);
    //     $volt->setOptions(array(
    //         "compiledPath" => APP_PATH . "cache/phtml/"
    //     ));
    //     $compiler = $volt->getCompiler();
    //     $compiler->addFunction('is_a', 'is_a');
    //     return $volt;
    // }, true);

	//设置基准URL
    $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/phalconDemo/');
        return $url;
    });

    // 设置数据库连接
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "root",
            "password" => "",
            "dbname" => "phalcon",
            "charset" => "utf8"
        ));
    });

    // Create the router 创建路由
    // $router = new \Phalcon\Mvc\Router();
    // //Define a route
    // $router->add(
    //     "/PhalconDemo/:controller/:action/:params",
    //     array(
    //         "controller" => 1,
    //         "action"     => 2,
    //         "params"     => 3,
    //     )
    // );
    //避免浏览器缓存数据
    $response=new Phalcon\Http\Response();
    $response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');

    //Handle the request
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);

    echo $application->handle()->getContent();

} catch (\Phalcon\Exception $e) {
	echo "PhalconException: ", $e->getMessage();
}
