<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLogoutController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/");
		}
	}

	public function index(){
		$this->session->sess_destroy();
		
		redirect("/");
	}
}