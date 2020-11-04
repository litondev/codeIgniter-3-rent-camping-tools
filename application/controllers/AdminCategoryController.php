<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCategoryController extends CI_Controller{
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
        $searchView = $this->load->view("admin/category/search",[],TRUE);
        $modalAddView = $this->load->view("admin/category/modal-add",[],TRUE);
        $modalEditView = $this->load->view("admin/category/modal-edit",[],TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/category",[
            "search" => $searchView,
            "modalAdd" => $modalAddView,
            "modalEdit" => $modalEditView,
            "category" => $this->getPagiData(),
            "category_link" => $this->getPagiLink()
        ]);
        
        $this->LTemplate->footerAdmin();        
    }

    public function getPagiData(){       
        $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
            ? ((intval($this->input->get('page'))*10)-10) 
            : 0;

        $pageQuery = $this->db;
        $pageQuery = $this->searchPagi($pageQuery);
        $pageQuery = $pageQuery->get($this->MCategory->table,10,$page)->result_array();                   

        return $pageQuery;
    }

    public function getPagiLink(){
        $pagiQueryCount = $this->db;
        $pagiQueryCount = $this->searchPagi($pagiQueryCount);    
        $pagiQueryCount = $pagiQueryCount->count_all_results($this->MCategory->table);       

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
            $pageQuery = $pageQuery->like('name',$this->input->get('name'));
        }

        if(!empty($this->input->get('status'))){
            $pageQuery = $pageQuery->where('status',$this->input->get('status'));
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

    function addCategory(){        
        $this->form_validation->set_rules(
            'name','Nama','required',[
                'required' => '%s harus diisi',    
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

        $isValidImage = $this->LValidateImage->isValid($_FILES['image'],[
            "required" => true, 
        ]);

        if($isValidImage){
            $this->LRedirect->backWith("error",$isValidImage);
        }

        $nameFile = random_string('alpha',20);
        $extension = substr($_FILES['image']['name'], -3);
        $theNameFile = $nameFile.".".$extension;

        $payload = [];
        $payload["name"] = $this->input->post('name');  
        $payload["image"] = $theNameFile;

        $this->db->trans_start();

        if($this->MCategory->create($payload)["success"]){
            // UPLOAD IMAGE
            $path = "./assets/images/categories/".$theNameFile;        
            move_uploaded_file($_FILES["image"]["tmp_name"], $path);

            $config['image_library'] = 'gd2';
            $config['source_image'] = FCPATH . $path;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = NULL;
            $config['height']       = 82;
            
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil Tambah Data",
                "title" => "Berhasil"
            ]);            
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal Tambah Data",
            "title" => "Terjadi Kesalahan"
        ]); 
    }

    function editCategory($id){        
        $this->form_validation->set_rules(
            'name','Nama','required',[
                'required' => '%s harus diisi',    
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

        $isValidImage = $this->LValidateImage->isValid($_FILES['image'],[
            'required' => false
        ]);

        if($isValidImage){
            $this->LRedirect->backWith("error",$isValidImage);
        }

        $category = $this->MCategory->first_id($id);

        if(!$category){
            $this->LRedirect->backWith("error",[
                "text" => "Maaf Id Tidak Valid",
                "title" => "Terjadi Kesalahan"
            ]);
        }

        if(!empty($_FILES['image']['name'])){
            $nameFile = random_string('alpha',20);
            $extension = substr($_FILES['image']['name'], -3);
            $theNameFile = $nameFile.".".$extension;
        }

        $payload = [];
        $payload["name"] = $this->input->post('name');     

        if(!empty($_FILES['image']['name'])){
            $payload["image"] = $theNameFile;
        }

        $this->db->trans_start();

        if($this->MCategory->update_where(["id" => $id],$payload)["success"]){
            if(!empty($_FILES['image']['name'])){
                // UPLOAD IMAGE
                $path = "./assets/images/categories/".$theNameFile;    
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);

                // RESIZE IMAGE
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH . $path;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = NULL;
                $config['height']       = 82;            

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                // DELETE IMAGE
                if(!empty($category['image'])){            
                    $path = FCPATH."assets/images/categories/".$category["image"];

                    if(file_exists($path)){            
                        unlink($path);
                    }
                }
            }

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil Edit Data",
                "title" => "Berhasil"
            ]);            
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal Edit Data",
            "title" => "Terjadi Kesalahan"
        ]); 
    }

    function changeStatus($id,$status){ 
        if($status != "aktif" && $status != "nonaktif"){
            $this->LRedirect->backWith("error",[
                "text" => "Gagal Ubah Status",
                "title" => "Terjadi Kesalahan"
            ]); 
        }

        $category = $this->MCategory->first_id($id);

        if(!$category){       
            $this->LRedirect->backWith("error",[
                "text" => "Gagal Ubah Status",
                "title" => "Terjadi Kesalahan"
            ]); 
        }

        if($this->MCategory->update_where([
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