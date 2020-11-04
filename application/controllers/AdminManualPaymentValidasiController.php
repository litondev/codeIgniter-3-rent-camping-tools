<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminManualPaymentValidasiController extends CI_Controller{
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
        $searchView = $this->load->view("admin/manual-payment-validasi/search",[],TRUE);
      
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/manual-payment-validasi",[
            "search" => $searchView,            
            "manualPayment" => $this->getPagiData(),
            "manualPayment_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db->select($this->MManualPayment->table.".*,".$this->MUser->table.".first_name");
        $pageQuery = $pageQuery->join($this->MUser->table,$this->MUser->table.".id = ".$this->MManualPayment->table.".user_id");
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MManualPayment->table,10,$page)->result_array();                   
        return $pageQuery;
    }

    public function getPagiLink(){
        $pagiQueryCount = $this->db->select($this->MManualPayment->table.".*,".$this->MUser->table.".first_name");
        $pagiQueryCount = $pagiQueryCount->join($this->MUser->table,$this->MUser->table.".id = ".$this->MManualPayment->table.".user_id");        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MManualPayment->table);       

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
            $pageQuery = $pageQuery->where($this->MManualPayment->table.".id >=",$this->input->get('form_id'));
            $pageQuery = $pageQuery->where($this->MManualPayment->table.".id <=",$this->input->get('to_id'));
        }
    
        if(!empty($this->input->get('first_name'))){
            $pageQuery = $pageQuery->like($this->MUser->table.'.first_name',$this->input->get('first_name'));
        }

        if(!empty($this->input->get('invoice_id'))){
            $pageQuery = $pageQuery->where($this->MManualPayment->table.'.invoice_id',$this->input->get('invoice_id'));
        } 
      
        if(!empty($this->input->get('search_created_at'))){
            $dateCreated = explode(" - ",$this->input->get('search_created_at'));
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $pageQuery = $pageQuery->where($this->MManualPayment->table.".created_at >=",$startDate);
                $pageQuery = $pageQuery->where($this->MManualPayment->table.".created_at <=",$endDate);
            }
        }

        $pageQuery = $pageQuery->where($this->MManualPayment->table.".status","validasi");

        $pageQuery = $pageQuery->order_by($this->input->get('column') ?? 'id',$this->input->get('order_by') ?? 'desc');

        return $pageQuery;
    }
}