<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUserController extends CI_Controller{
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
        $searchView = $this->load->view("admin/user/search",[],TRUE);
        $modalBlokirUserView = $this->load->view("admin/user/modal-blokir-user",[],TRUE);
      
        $this->LTemplate->headerAdmin();

        $this->load->view("admin/user",[
            "search" => $searchView,
            "modalBlokirUser" => $modalBlokirUserView,        
            "user" => $this->getPagiData(),
            "user_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $per_page = $this->input->get('per_page') ?? 10;
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*$per_page)-$per_page) 
            : 0;

        $pageQuery = $this->db;
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MUser->table,$per_page,$page)->result_array();                   
        return $pageQuery;
    }

    public function getPagiLink(){
        $per_page = $this->input->get('per_page') ?? 10;

        $pagiQueryCount = $this->db;
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MUser->table);       

        if($pagiQueryCount > $per_page){
            $this->pagination->initialize([
                "total_rows" => $pagiQueryCount,
                "per_page" => $per_page,                
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
    
        if(!empty($this->input->get('first_name'))){
            $pageQuery = $pageQuery->like('first_name',$this->input->get('first_name'));
        }

        if(!empty($this->input->get('last_name'))){
            $pageQuery = $pageQuery->like('last_name',$this->input->get('last_name'));
        }

        if(!empty($this->input->get('email'))){
            $pageQuery = $pageQuery->like('email',$this->input->get('email'));
        }

        if(!empty($this->input->get('phone'))){
            $pageQuery = $pageQuery->like('phone',$this->input->get('phone'));
        }

        if(!empty($this->input->get('status'))){
            $pageQuery = $pageQuery->where('status',$this->input->get('status'));
        }

        if(!empty($this->input->get('role'))){
            $pageQuery = $pageQuery->where('role',$this->input->get('role'));
        }

        if(!empty($this->input->get('gender'))){
            $pageQuery = $pageQuery->where('gender',$this->input->get('gender'));
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

        $pageQuery = $pageQuery->order_by($this->input->get('column') ?? 'id',$this->input->get('order_by') ?? 'desc');

        return $pageQuery;
    }

    public function blokir(){
        $this->form_validation->set_rules(
            'id','Id','required|integer',[
                'required' => '%s harus diisi',
                'integer' => '%s tidak valid'
            ]
        );

        $this->form_validation->set_rules(
            'description_blokir','Description','required',[
                'required' => '%s harus disi'
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

        if($this->MUser->update_where([
            "id" => $this->input->post('id')
        ],[
            "status" => "blokir",
            "description_blokir" => $this->input->post('description_blokir')
        ])["success"]){
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil memblokir user",
                "title" => "Berhasil"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "text" => "Maaf tidak dapat memblokir user",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    public function unblokir($id){
        if($this->MUser->update_where([
            "id" => $id
        ],[
            "status" => "aktif",
            "description_blokir" => NULL
        ])["success"]){
            $this->LRedirect->backWith("success",[
                "text" => "Berhasil unblokir user",
                "title" => "Berhasil"
            ]);
        }  

        $this->LRedirect->backWith("error",[
            "text" => "Maaf tidak dapta unblokir user",
            "title" => "Terjadi Kesalahan"
        ]);
    }
}