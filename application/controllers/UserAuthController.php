<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuthController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if($this->LSession->user()){
			redirect("/");
		}
	}

	public function signin(){		
		$this->LTemplate->headerUser([
			"title" => "Masuk"
		]);

		$this->load->view("user/signin");

		$this->LTemplate->footerUser();
	}

	public function signup(){
		$this->LTemplate->headerUser([
			"title" => "Daftar"
		]);

		$this->load->view("user/signup");

		$this->LTemplate->footerUser();
	}	

	public function forgetPassword(){
		$this->LTemplate->headerUser([
			"title" => "Lupa Password"
		]);

		$this->load->view("user/forget-password");

		$this->LTemplate->footerUser();		
	}

	public function resetPassword(){
		if(empty($this->input->get('email')) && empty($this->input->get('key'))){
			redirect("/forget-password");
		}

		if(!$this->MUser->first_where([
			'email' => $this->input->get('email'),
			'remember_token' => $this->input->get('key')
		])){
			redirect("/forget-password");
		}

		$this->LTemplate->headerUser([
			"title" => "Reset Password"
		]);

		$this->load->view("user/reset-password",[
			"email" => $this->input->get('email'),
			"key" => $this->input->get('key')
		]);

		$this->LTemplate->footerUser();			
	}
}