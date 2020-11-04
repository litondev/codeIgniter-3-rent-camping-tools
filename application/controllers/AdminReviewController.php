<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminReviewController extends CI_Controller{
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
        $searchView = $this->load->view("admin/review/search",[],TRUE);
        $modalAddView = $this->load->view("admin/review/modal-add",[],TRUE);
        $modalEditView = $this->load->view("admin/review/modal-edit",[],TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/review",[
            "search" => $searchView,
            "modalAdd" => $modalAddView,
            "modalEdit" => $modalEditView,
            "review" => $this->getPagiData(),
            "review_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db->select($this->MReview->table.".*,".$this->MUser->table.".first_name,".$this->MProduct->table.".name");
        $pageQuery = $pageQuery->join($this->MUser->table,$this->MUser->table.".id = ".$this->MReview->table.".user_id");
        $pageQuery = $pageQuery->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->MReview->table.".product_id");
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MReview->table,10,$page)->result_array();                   

        return $pageQuery;
    }

    public function getPagiLink(){
        $pagiQueryCount = $this->db->select($this->MReview->table.".*,".$this->MUser->table.".first_name,".$this->MProduct->table.".name");
        $pagiQueryCount = $pagiQueryCount->join($this->MUser->table,$this->MUser->table.".id = ".$this->MReview->table.".user_id");
        $pagiQueryCount = $pagiQueryCount->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->MReview->table.".product_id");
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MReview->table);       

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
            $pageQuery = $pageQuery->where($this->MReview->table.".id >=",$this->input->get('form_id'));
            $pageQuery = $pageQuery->where($this->MReview->table.".id <=",$this->input->get('to_id'));
        }

        if(!empty($this->input->get('product_name'))){
            $pageQuery = $pageQuery->like($this->MProduct->table.".name",$this->input->get('product_name'));
        }

        if(!empty($this->input->get('first_name'))){
            $pageQuery = $pageQuery->like($this->MUser->table.'.first_name',$this->input->get('first_name'));
        }

        if(!empty($this->input->get('komentar'))){
            $pageQuery = $pageQuery->like($this->MReview->table.'.komentar',$this->input->get('komentar'));
        }

        if(!empty($this->input->get('star'))){
            $pageQuery = $pageQuery->where($this->MReview->table.'.star',intval($this->input->get('star')));
        }

        if(!empty($this->input->get('search_created_at'))){
            $dateCreated = explode(" - ",$this->input->get('search_created_at'));
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $pageQuery = $pageQuery->where($this->MReview->table.".created_at >=",$startDate);
                $pageQuery = $pageQuery->where($this->MReview->table.".created_at <=",$endDate);
            }
        }

        $pageQuery = $pageQuery->order_by($this->MReview->table.'.id','desc');

        return $pageQuery;
    }

    function deleteReview($id){
        $review = $this->MReview->first_id($id);
        
        if(!$review){       
            $this->LRedirect->backWith("error",[
                "text" => "Gagal Hapus Data",
                "title" => "Terjadi Kesalahan"
            ]); 
        }         

        if($this->MReview->delete_id($id)){       
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil Hapus Data",
                "title" => "Berhasil"
            ]); 
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal Hapus Data",
            "title" => "Terjadi Kesalahan"
        ]); 
    }   

    function addReplay(){
        $this->form_validation->set_rules(
            'replay','Balasan','required',[
                'required' => '%s harus diisi',
            ]
        );

        $this->form_validation->set_rules(
            'id','Id','required|integer',[
                'required' => '%s harus diisi',
                'integer' => '%s tidak valid'
            ]
        );

        if ($this->form_validation->run() == FALSE){
            $theError = $this->form_validation->error_array();
            $keyArray = array_keys($theError);
            $this->LRedirect->backWith("error",[
                "text" => $theError[$keyArray[0]],
                "title" => "Terjadi Kesalahan"
            ]);
        }

        if($this->MReview->update_id($this->input->post('id'),
            [
                "replay" => $this->input->post('replay')
            ]
        )["success"]){
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil memberikan balasan",
                "title" => "Berhasil"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "text" => "Tidak dapat memberikan balasan",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    function editReplay(){
        $this->form_validation->set_rules(
            'replay','Balasan','required',[
                'required' => '%s harus diisi',
            ]
        );

        $this->form_validation->set_rules(
            'id','Id','required|integer',[
                'required' => '%s harus diisi',
                'integer' => '%s tidak valid'
            ]
        );

        if ($this->form_validation->run() == FALSE){
            $theError = $this->form_validation->error_array();
            $keyArray = array_keys($theError);
            $this->LRedirect->backWith("error",[
                "text" => $theError[$keyArray[0]],
                "title" => "Terjadi Kesalahan"
            ]);
        }

        if($this->MReview->update_id($this->input->post('id'),
            [
                "replay" => $this->input->post('replay')
            ]
        )["success"]){
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil memberikan balasan",
                "title" => "Berhasil"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "text" => "Tidak dapat memberikan balasan",
            "title" => "Terjadi Kesalahan"
        ]);
    }
}