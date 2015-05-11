<?php
namespace multiple\frontend\Controllers;
class GuestController extends \Phalcon\Mvc\Controller{
	//新增
	public function addAction(){
		if($this->request->isPost()){
			$username=$this->request->getPost('username','string');
			$content=$this->request->getPost('content','string');
			$time=time()+8*60*60;
			$sql="insert into guest(username,content,addtime)values(:username:,:content:,:addtime:)";
			$result=$this->modelsManager->executeQuery($sql,array('username'=>$username,'content'=>$content,'addtime'=>$time));
			if($result){
				//会自动调用视图
			}else{
				exit('error');
			}

		}else{
			exit('非法操作!');
		}
	}

	//列表
	public function listAction(){
		@$currentPage = (int) $_GET["page"];
		$guest=new \multiple\frontend\model\guest();
		$result=$guest::find(array('order'=>"id desc"));
		// Create a Model paginator, show 10 rows by page starting from $currentPage
		$paginator = new \Phalcon\Paginator\Adapter\Model(
		    array(
		        "data" => $result,
		        "limit"=> 2,
		        "page" => $currentPage
		    )
		);
		// Get the paginated results
		$page = $paginator->getPaginate();
		$this->view->page=$page;
		// $this->view->setVar('result',$result);
		//$this->view->result=$result;

	}

	//编辑
	public function editAction(){
		if($this->request->isPost()){
			$id=$this->request->getPost('id');
			$username=$this->request->getPost('username','string');
			$content=$this->request->getPost('content','string');
			$time=time()+8*60*60;
			$guest=new \multiple\frontend\model\guest();
			$result=$guest::findFirst($id);
			$result->username=$username;
			$result->content=$content;
			$result->addtime=$time;
			if($result->save()){
				//更新成功跳转
				$this->response->redirect('Index/index');
			}
			$this->view->disable();
		}else{
			@$currentPage = (int) $_GET["page"];
			$guest=new \multiple\frontend\model\guest();
			$result=$guest::find(array('order'=>"id desc"));
			// Create a Model paginator, show 10 rows by page starting from $currentPage
			$paginator = new \Phalcon\Paginator\Adapter\Model(
			    array(
			        "data" => $result,
			        "limit"=> 2,
			        "page" => $currentPage
			    )
			);
			// Get the paginated results
			$page = $paginator->getPaginate();
			$this->view->page=$page;
		}
	}

	//删除
	public function delAction(){
		$id=$this->request->get('id');
		if(!empty($id)){
			//删除
			$result=guest::findFirst($id);
			if($result){
				if($result->delete()){
					$this->response->redirect('Index/index');
				}
			}
		}else{
			@$currentPage = (int) $_GET["page"];
			$guest=new \multiple\frontend\model\guest();
			$result=$guest::find(array('order'=>"id desc"));
			// Create a Model paginator, show 10 rows by page starting from $currentPage
			$paginator = new \Phalcon\Paginator\Adapter\Model(
			    array(
			        "data" => $result,
			        "limit"=> 3,
			        "page" => $currentPage
			    )
			);
			// Get the paginated results
			$page = $paginator->getPaginate();
			$this->view->page=$page;
		}
	}

}