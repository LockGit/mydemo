<?php
namespace Multiple\backend\Controllers;
class indexController extends \Phalcon\Mvc\Controller{
	public function indexAction(){
		$this->view->pick('index/index');
	}

}
