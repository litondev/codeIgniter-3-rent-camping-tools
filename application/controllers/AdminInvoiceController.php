<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminInvoiceController extends CI_Controller{
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
        $searchView = $this->load->view("admin/invoice/search",[],TRUE);
    
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/invoice",[
            "search" => $searchView,
            "invoice" => $this->getPagiData(),
            "invoice_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db->select($this->MInvoice->table.".*,".$this->MUser->table.".first_name");
        $pageQuery = $pageQuery->join($this->MUser->table,$this->MUser->table.".id = ".$this->MInvoice->table.".user_id");
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MInvoice->table,10,$page)->result_array();                   

        return $pageQuery;
    }

    public function getPagiLink(){
       
        $pagiQueryCount = $this->db->select($this->MInvoice->table.".*,".$this->MUser->table.".first_name");
        $pagiQueryCount = $pagiQueryCount->join($this->MUser->table,$this->MUser->table.".id = ".$this->MInvoice->table.".user_id");
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MInvoice->table);       

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
            $pageQuery = $pageQuery->where($this->MInvoice->table.".id >=",$this->input->get('form_id'));
            $pageQuery = $pageQuery->where($this->MInvoice->table.".id <=",$this->input->get('to_id'));
        }

        if(!empty($this->input->get('first_name'))){
            $pageQuery = $pageQuery->where($this->MUser->table.".first_name",$this->input->get('first_name'));
        }
    
        if(!empty($this->input->get('total'))){
            $pageQuery = $pageQuery->where($this->MInvoice->table.".total",$this->input->get('total'));
        }

        if(!empty($this->input->get('status'))){
            $pageQuery = $pageQuery->where($this->MInvoice->table.'.status',$this->input->get('status'));
        }

        if(!empty($this->input->get('status_payment'))){
            $pageQuery = $pageQuery->where($this->MInvoice->table.'.status_payment',$this->input->get('status_payment'));
        }

        if(!empty($this->input->get('search_created_at'))){
            $dateCreated = explode(" - ",$this->input->get('search_created_at'));
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $pageQuery = $pageQuery->where($this->MInvoice->table.".created_at >=",$startDate);
                $pageQuery = $pageQuery->where($this->MInvoice->table.".created_at <=",$endDate);
            }
        }

        $pageQuery = $pageQuery->order_by($this->MInvoice->table.'.id','desc');

        return $pageQuery;
    }

    public function detail($id){
        $invoice = $this->MInvoice->first_id($id);

        if(!$invoice){
            $this->LRedirect->backWith("error",[
                "title" => "Terjadi Kesalahan",
                "text" => "Maaf invoice tidak valid"
            ]);
        }

        $user = $this->MUser->first_id($invoice['user_id']);

        $manualPayment = $this->MManualPayment->get_where([
            "invoice_id" => $invoice['id']
        ]);

        $product = $this->MInvoice->get_product_invoice($invoice['id']);        

        $data = [
            "user" => $user,
            "invoice" => $invoice,
            "manualPayment" => $manualPayment,
            "product" => $product
        ];

        $modalAddFineView = $this->load->view("admin/invoice-detail/modal-add-fine",$data,TRUE);
        $modalEditFineView = $this->load->view("admin/invoice-detail/modal-edit-fine",$data,TRUE);
        $modalReasonRejectView = $this->load->view("admin/invoice-detail/modal-reason-reject",$data,TRUE);
        $detailView = $this->load->view("admin/invoice-detail/detail",$data,TRUE);
        $manualPaymentView = $this->load->view("admin/invoice-detail/manual-payment",$data,TRUE);
        $productView = $this->load->view("admin/invoice-detail/product",$data,TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/invoice-detail",[            
            "modalAddFine" => $modalAddFineView,
            "modalEditFine" => $modalEditFineView,
            "modalReasonReject" => $modalReasonRejectView,
            "product" => $productView,
            "detail" => $detailView,
            "manualPayment" => $manualPaymentView
        ]);
        
        $this->LTemplate->footerAdmin();        
    }
}