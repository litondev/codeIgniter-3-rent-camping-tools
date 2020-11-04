<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUserEditController extends CI_Controller{
	public function __construct(){
		parent::__construct();

    	if(!$this->LSession->user()){
      		redirect("/");
    	}

    	if($this->LSession->user()['role'] != "admin"){
    		redirect("/");
    	}
	}

	public function index($id){
		$user = $this->MUser->first_id($id);

		if($user["role"] == "admin"){
			redirect("admin/user");
		}

		$this->LTemplate->headerAdmin();

		$this->load->view("admin/user-edit",["user" => $user]);

		$this->LTemplate->footerAdmin();
	}

	public function editUser($id){
		$user = $this->MUser->first_id($id);

		if(!$user){
			$this->LRedirect->backWith("error",[
				"title" => "Terjadi Kesalahan",
				"text" => "User tidak valid"
			]);
		}

		$this->form_validation->set_rules(
			'first_name','Nama depan','required',[
				'required' => '%s harus diisi'
			]
		);

		$this->form_validation->set_rules(
			'last_name','Nama belakang','required',[
				'required' => '%s harus diisi'
			]
		);

		$this->form_validation->set_rules(
			'phone','No telp','required',[
				'required' => '%s harus diisi'
			]
		);

		$this->form_validation->set_rules(
			'address','Alamat','required',[
				'required' => '%s harus diisi'
			]
		);

        $this->form_validation->set_rules(
			'email','Email','required|valid_email',[
				'required' => '%s harus diisi',
				'valid_email' => '%s tidak valid',
		]);

		if(!empty($this->input->post('password'))){
			$this->form_validation->set_rules(
				'password','Password','min_length[8]',[
					'min_length' => '%s harus lebih dari 8 digit'
				]
			);
		}

        if ($this->form_validation->run() == FALSE){
        	$theError = $this->form_validation->error_array();
        	$keyArray = array_keys($theError);
        	$this->LRedirect->backWith("error",[
        		"text" => $theError[$keyArray[0]],
        		"title" => "Terjadi Kesalahan"
        	]);
        }

  		$payload = $this->input->post(["first_name","last_name","phone","address",'email','role']);
		
        if($this->MUser->get_where_not_in(
        	["email" => $payload['email']],
        	"email",
        	$user['email']
        	)
        ){
        	$this->LRedirect->backWith("error",[
        		"text" => "Email telah terpakai",
        		"title" => "Terjadi Kesalahan"
        	]);
        }

    	// VALIDASI PHONE
	    $mobile_phone = preg_replace('/[^0-9\+]/','',strval($payload['phone']));
	    if(substr($mobile_phone, 0,2) != '08'){
	    	$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	            "text" => "No telp harus 08"
	    	]);          
	    }
	    $validPhone = substr($mobile_phone, 0,2);
	    $noBelakang = explode($validPhone,$mobile_phone)[1];
	    $payload['phone'] = $validPhone . preg_replace('/[^0-9]/','',strval($noBelakang));                                        

    	//  CEK MOBILE UNIQUE
    	if($this->MUser->get_where_not_in(
        	["phone" => $payload['phone']],
        	"phone",
        	$user['phone']
        	)
        ){
	    	$this->LRedirect->backWith("error",[        		
	            "title" => "Terjadi Kesalahan",
	            "text" => "No telp telah terpakai"                 
	    	]);                   
	    }

	    if(!empty($this->input->post('password'))){
	    	$payload['password'] = $this->Bcrypt->hashPassword($this->input->post('password'));
	    }

		if($this->MUser->update_id($id,$payload)["success"]){    		
			$this->LRedirect->backWith("success",[
				"title" => "Berhasil",
				"text" => "Berhasil update data"
			]);  			
  		}

		$this->LRedirect->backWith("error",[        		
	        "title" => "Terjadi Kesalahan",
	        "text" => "Gagal update data"                 
	   	]);   
	}
}