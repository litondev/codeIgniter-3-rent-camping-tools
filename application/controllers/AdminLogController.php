<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogController extends CI_Controller{
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
        $searchView = $this->load->view("admin/log-admin/search",[],TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/log-admin",[
            "search" => $searchView,
            "logAdmin" => $this->getPagiData(),
            "logAdmin_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db;
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MLogAdmin->table,10,$page)->result_array();                   

        return $pageQuery;
    }

    public function getPagiLink(){
        $pagiQueryCount = $this->db;
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MLogAdmin->table);       

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

        if(!empty($this->input->get('name'))){
            $pageQuery = $pageQuery->like("name",$this->input->get('name'));
        }


        if(!empty($this->input->get('ip'))){
            $pageQuery = $pageQuery->like("ip",$this->input->get('ip'));
        }

        if(!empty($this->input->get('agent'))){
            $pageQuery = $pageQuery->like('user_agent',$this->input->get('agent'));
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
}