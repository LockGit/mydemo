<?php

class SignupController extends \Phalcon\Mvc\Controller{
    public function indexAction(){

    }


	// 注册表单
	public function registerAction(){
		$user=new Users();
		$success=$user->save($this->request->getPost(),array('username','useremail'));
        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();


	}



}