<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSettingController extends CI_Controller{
	public function __construct(){
		parent::__construct();

    	if(!$this->LSession->user()){
      		redirect("/");
    	}

    	if($this->LSession->user()['role'] != "admin"){
    		redirect("/");
    	}
	}

    public function website(){
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/setting/website",[]);
        
        $this->LTemplate->footerAdmin();   
    }

    public function editWebsite(){
        foreach ($this->input->post() as $key => $item) {            
            $this->MSetting->update_where([
                "name" => $key
            ],[
                "value" => $item
            ]);    
        }

        $this->LRedirect->backWith("success",[
            "title" => "Berhasil",
            "text" => "Berhasil update data"
        ]);
    }

    public function invoice(){
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/setting/invoice",[]);
        
        $this->LTemplate->footerAdmin();   
    }

    public function editInvoice(){
        foreach ($this->input->post() as $key => $item) {            
            $this->MSetting->update_where([
                "name" => $key
            ],[
                "value" => $item
            ]);    
        }

        $this->LRedirect->backWith("success",[
            "title" => "Berhasil",
            "text" => "Berhasil update data"
        ]);     
    }

    public function order(){
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/setting/order",[]);
        
        $this->LTemplate->footerAdmin();  
    }

    public function editOrder(){
        foreach ($this->input->post() as $key => $item) {            
            $this->MSetting->update_where([
                "name" => $key
            ],[
                "value" => $item
            ]);    
        }

        $this->LRedirect->backWith("success",[
            "title" => "Berhasil",
            "text" => "Berhasil update data"
        ]);
    }
}