<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProductController extends CI_Controller{
	public function __construct(){
		parent::__construct();

    	if(!$this->LSession->user()){
      		redirect("/");
    	}

    	if($this->LSession->user()['role'] != "admin"){
    		redirect("/");
    	}
	}

	public function index(){
        $searchView = $this->load->view("admin/product/search",[],TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/product",[
            "search" => $searchView,            
            "product" => $this->getPagiData(),
            "product_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db;
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MProduct->table,10,$page)->result_array();                   

        return $pageQuery;
    }

    public function getPagiLink(){
        $pagiQueryCount = $this->db;
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MProduct->table);       

        if($pagiQueryCount > 10){
            $this->pagination->initialize([
                "total_rows" => $pagiQueryCount,
                "per_page" => 10,                
            ]);             

            return $this->pagination->create_links();       
        }else{
            return "";
        }
    }

    public function searchPagi($pageQuery){  
        if(!empty($this->input->get('form_id')) && !empty($this->input->get('to_id'))){
            $pageQuery = $pageQuery->where("id >=",$this->input->get('form_id'));
            $pageQuery = $pageQuery->where("id <=",$this->input->get('to_id'));
        }

        if(!empty($this->input->get('rent_price'))){
            $pageQuery = $pageQuery->where('rent_price',$this->input->get('rent_price'));
        }

        if(!empty($this->input->get('status'))){
            $pageQuery = $pageQuery->where('status',$this->input->get('status'));
        }

        if(!empty($this->input->get('status_rent'))){
            $pageQuery = $pageQuery->where('status_rent',$this->input->get('status_rent'));
        }

        if(!empty($this->input->get('star'))){
            $pageQuery = $pageQuery->where('star',$this->input->get('star'));
        }

        if(!empty($this->input->get('search_created_at'))){
            $dateCreated = explode(" - ",$this->input->get('search_created_at'));
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $pageQuery = $pageQuery->where("created_at >=",$startDate);
                $pageQuery = $pageQuery->where("created_at <=",$endDate);
            }
        }

        $pageQuery = $pageQuery->order_by('id','desc');

        return $pageQuery;
    }
    
     function changeStatus($id,$status){ 
        if($status != "aktif" && $status != "nonaktif"){
            $this->LRedirect->backWith("error",[
                "text" => "Gagal Ubah Status",
                "title" => "Terjadi Kesalahan"
            ]); 
        }

        $product = $this->MProduct->first_id($id);

        if(!$product){       
            $this->LRedirect->backWith("error",[
                "text" => "Gagal Ubah Status",
                "title" => "Terjadi Kesalahan"
            ]); 
        }

        if($this->MProduct->update_where([
            "id" => $id,
        ],[
            "status" => $status
        ])["success"]){
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil Ubah Status",
                "title" => "Berhasil"
            ]); 
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal Ubah Status",
            "title" => "Terjadi Kesalahan"
        ]); 
    }    
}