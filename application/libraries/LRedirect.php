<?php

class LRedirect {
	public $ci;

	public function __construct(){
		$this->ci = & get_instance();	
	}

	public function back(){
		redirect($this->ci->agent->referrer());
	}

	public function backWith($type,$data){
		$this->ci->session->set_flashdata($type,$data);
		$this->ci->session->set_flashdata("old_get",$this->ci->input->get());	
		$this->ci->session->set_flashdata("old_post",$this->ci->input->post());
		redirect($this->ci->agent->referrer());
	}

	public function redirectWith($type,$data,$url){
		$this->ci->session->set_flashdata($type,$data);
		$this->ci->session->set_flashdata("old_get",$this->ci->input->get());	
		$this->ci->session->set_flashdata("old_post",$this->ci->input->post());
		redirect($url);
	}
}