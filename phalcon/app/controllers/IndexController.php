<?php

class IndexController extends \Phalcon\Mvc\Controller{
	public function indexAction(){
		$crypt = new Phalcon\Crypt();
		$key = 'le password';
		$text = 'This is a secret text';
		$encrypted = $crypt->encrypt($text, $key);
		echo $crypt->decrypt($encrypted, $key);
		die;
	}


	public function demoAction(){
		echo 'index demo';
	}

	
}