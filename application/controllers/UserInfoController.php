<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserInfoController extends CI_Controller{
	/* INFO */
	public function info(){
		$info = $this->MInfo->all();

		$this->LTemplate->headerUser([
			"title" => "Info"
		]);

		$this->load->view("user/info",["info" => $info]);

		$this->LTemplate->footerUser();
	}

	public function infoDetail($slug){
		$info = $this->MInfo->first_where([
			"slug" => $slug
		]);

		if(!$info){
			$this->LRedirect->back();
		}

		$this->LTemplate->headerUser([
			"title" => "Info"
		]);

		$this->load->view("user/info-detail",["info" => $info]);		
		
		$this->LTemplate->footerUser();
	}
	/* INFO */
}