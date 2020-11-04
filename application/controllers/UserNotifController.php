<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserNotifController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	public function index(){	
		$notif = $this->MNotif->get_user_notif();

		$this->LTemplate->headerUser([
			"title" => "Notif"
		]);
		
		$this->load->view("user/notif",$notif);

		$this->LTemplate->footerUser();		
	}
}