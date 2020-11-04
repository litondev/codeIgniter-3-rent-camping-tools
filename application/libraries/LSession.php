<?php

class LSession{
	public $ci;

	function __construct(){
		$this->ci = & get_instance();
	}

	function user(){
		if($this->ci->session->has_userdata("user_camp") || $this->ci->session->has_userdata("admin_camp")){			
			return [
				"id" => $this->ci->encryption->decrypt($this->ci->session->id),
				"first_name" => $this->ci->encryption->decrypt($this->ci->session->first_name),
				"last_name" => $this->ci->encryption->decrypt($this->ci->session->last_name),
				"email" => $this->ci->encryption->decrypt($this->ci->session->email),
				"phone" => $this->ci->encryption->decrypt($this->ci->session->phone),
				"address" => $this->ci->encryption->decrypt($this->ci->session->address),
				"gender" => $this->ci->encryption->decrypt($this->ci->session->gender),
				"created_at" => $this->ci->encryption->decrypt($this->ci->session->created_at),
				"updated_at" => $this->ci->encryption->decrypt($this->ci->session->updated_at),
				"role" => $this->ci->session->role
			];
		}else{
			return Null;
		}
	}

	function setSession($user){
		if($user['role'] == "user"){
			$this->ci->session->set_userdata("user_camp",true);			
		}else{
			$this->ci->session->set_userdata("admin_camp",true);
		}	

		$this->ci->session->set_userdata("id",$this->ci->encryption->encrypt($user['id']));
		$this->ci->session->set_userdata("first_name",$this->ci->encryption->encrypt($user['first_name']));
		$this->ci->session->set_userdata("last_name",$this->ci->encryption->encrypt($user['last_name']));
		$this->ci->session->set_userdata("email",$this->ci->encryption->encrypt($user['email']));
		$this->ci->session->set_userdata("phone",$this->ci->encryption->encrypt($user['phone']));
		$this->ci->session->set_userdata("address",$this->ci->encryption->encrypt($user['address']));
		$this->ci->session->set_userdata("gender",$this->ci->encryption->encrypt($user['gender']));
		$this->ci->session->set_userdata("created_at",$this->ci->encryption->encrypt($user['created_at']));
		$this->ci->session->set_userdata("updated_at",$this->ci->encryption->encrypt($user['updated_at']));	
		$this->ci->session->set_userdata("role",$user['role']);
	}	
}