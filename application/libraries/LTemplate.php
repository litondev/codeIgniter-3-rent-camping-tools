<?php

class LTemplate{
	public $ci;

	public function __construct(){
		$this->ci = & get_instance();		
	}

	public function headerUser($data = []){
		if(empty($data["title"])){
			$data["title"] = "";
		}
		
		$this->ci->load->view("layout-user/header",$data);
	}

	public function footerUser($data = []){
		$this->ci->load->view("layout-user/footer",$data);
	}

	public function headerAdmin($data = []){
		$this->ci->load->view("layout-admin/header",$data);
	}

	public function footerAdmin($data = []){
		$this->ci->load->view("layout-admin/footer",$data);
	}
}