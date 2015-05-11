<?php
/**
 * @Author: Lock.Esc
 * @Date:   2015-03-27 21:03:11
 * @Last Modified by:   Lock.Esc
 * @Last Modified time: 2015-05-11 23:38:52
 */
function p($data){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

try {
    //引入配置文件
    $config=require_once('./../app/config/config.php');
    //自动加载
	$loader=new \Phalcon\Loader();
	$loader->registerDirs(
        array(
            $config->application->controllersDir,
            $config->application->modelsDir
            )
    )->register();

	//注入容器 Create a DI injection
	$di=new Phalcon\DI\FactoryDefault();

	//设置视图组件
	$di->set('view', function() use($config){
	    $view = new \Phalcon\Mvc\View();
	    //设置视图模块
	    $view->setViewsDir($config->application->viewsDir);
	    return $view;
	});

	//设置基准URL
    $di->set('url', function() use($config){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri($config->application->baseUrl);
        return $url;
    });

    // 设置数据库连接
    $di->set('db', function() use($config){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->localhost,
            "username" => $config->database->user,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname
        ));
    });
    
    //引入路由模块
    $router=require_once('./../app/config/routers.php');
    

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();


} catch (\Phalcon\Exception $e) {
	echo "PhalconException: ", $e->getMessage();
}

