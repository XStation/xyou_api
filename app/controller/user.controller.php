<?php
//------------------------------------------------------
//控制器类名必须以controller_开头,同时需要继承controller
//方法名必须以action_开头
//每个控制器都会有一个核心对象codeant,
//可以通过$this->codeant来调用该变量,以及codeant所包含的方法
//----------------------------------------------------------------

class controller_user extends controller
{
	public function action_index()
	{
		$this->codeant->display();
		//or
		//$this->codeAnt->tpl("frame/index.htm");
		//$this->codeAnt->debug();
	}


	public function action_login()
	{
		help_session::start();
		$mobile = $this->codeAnt->input->post('mobile');
		$token = $this->codeAnt->input->post('token');

		if($this->isMobileExist($mobile)===true){
			if($this->loginTokenCheck($mobile, $token) === true){
				help_session::set_token($mobile.$token);
				$userinfo =  module_user::getUserInfo(array('mobile'=>$mobile));
				if(!empty($userinfo[0])){
					help_session::set('userinfo',$userinfo[0]);
					$this->codeAnt->response('2000', 'ok', 'true');
				}else{
					$this->codeAnt->response('4000', 'error', 'user is not exist');
				}
			}else{
				$this->codeAnt->response('4000', 'token error', 'fasle');
			}
		}else{
			$this->codeAnt->response('4000', 'mobile is not exist', 'fasle');
		}

	}

	public function action_self()
	{
		$this->sessionCheck();
		$userinfo = help_session::get('userinfo');
		
		$this->codeAnt->response('2000', 'ok', $userinfo);
		
	}

	public function action_self_modify()
	{
		$this->sessionCheck();
		$modify_info = array();
  		$modify_info['email'] = $this->codeant->input->post("email");
  		$modify_info['id_number'] = $this->codeAnt->input->post("id_number");
  		$modify_info['avatar'] = $this->codeAnt->input->post("avatar");
  		$modify_info['nickname'] = $this->codeAnt->input->post("nickname");
  		$modify_info['mood'] = $this->codeAnt->input->post("mood");
  		$modify_info['gender'] = $this->codeAnt->input->post("gender");

		$userinfo = help_session::get('userinfo');
		$where['mobile'] = $userinfo['mobile'];
		module_user::modifyUser($modify_info, $where);
		$this->updateSessionInfo();
		$this->codeAnt->response('2000', 'ok', true);
		
	}

	private function isMobileExist($mobile)
	{
		$user_info = dao_user::getBy(array('mobile'=>$mobile));
		if(!empty($user_info)){
			return true;
		}else{
			return false;
		}
	}

	private function loginTokenCheck($mobile, $token)
	{
		$random = random_int(1, 10);
		if($random < 3){
			return false;
		}else{
			return true;
		}
	}

	private function sessionCheck()
	{
		help_session::start();
		$userinfo = help_session::get('userinfo');
		var_dump($userinfo);
		if(!empty($userinfo['mobile'])){
			return true;
		}else{
			$this->codeAnt->response('4003', 'login first', 'fasle');
			die();
		}
	}

	private function updateSessionInfo()
	{
		$old_info = help_session::get('userinfo');
		$new_info = module_user::getUserInfo(array('mobile'=>$old_info['mobile']));
		if(!empty($new_info[0])){
			help_session::set('userinfo', $new_info[0]);
		}else{
			$this->codeAnt->log->warning("update session error!!!");
		}
	}

}
?>
