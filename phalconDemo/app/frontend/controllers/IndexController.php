<?php
namespace multiple\frontend\Controllers;
class IndexController extends \Phalcon\Mvc\Controller{
	public function indexAction(){
		echo 'Frontend index';
	}
	
	// 实现一个计算器程序
	public function calcAction(){
		if($this->request->isPost()){
			$one=$this->request->getPost('one','int');
			$two=$this->request->getPost('two','int');
			$type=$this->request->getPost('type','string');
			if(empty($one)||empty($two)||empty($type)){
				echo '文本框必须填写数字,操作类型必须选择!';
				exit();
			}
			switch ($type) {
				case '+':
					echo $result=$one+$two;
					break;
				case '-':
					echo $result=$one-$two;
					break;
				case 'x':
					echo $result=$one*$two;
					break;
				case '/':
					echo $result=$one/$two;
					break;
				default:
					echo '非法操作！';
					break;
			}

		}else{
			echo '非法访问!';
		}
	}

}