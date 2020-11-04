<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProfilController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/");
		}
	}	

	function index(){
		$data = [];
		$data['password'] = $this->load->view("user/profil/password",[],TRUE);
		$data['data'] = $this->load->view("user/profil/data",[],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Profil"
		]);
		
		$this->load->view("user/profil",$data);

		$this->LTemplate->footerUser();	
	}

	function updateData(){
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

		$this->form_validation->set_rules(
			'password','Password','required|min_length[8]',[
				'required' => '%s harus diisi',
				'min_length' => '%s harus lebih dari 8 digit'
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

  		$payload = $this->input->post(["first_name","last_name","phone","address",'email']);
		
        if($this->MUser->get_where_not_in(
        	["email" => $payload['email']],
        	"email",
        	[$this->LSession->user()['email']]
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
        	[$this->LSession->user()['phone']]
        	)
        ){
	    	$this->LRedirect->backWith("error",[        		
	            "title" => "Terjadi Kesalahan",
	            "text" => "No telp telah terpakai"                 
	    	]);                   
	    }

    	$user = $this->MUser->first_id($this->LSession->user()['id']);

  		if($this->Bcrypt->checkPassword($this->input->post('password'),$user['password'])){
  			$payload["password"] = $this->Bcrypt->hashPassword($this->input->post("password"));  
  	
  			$updateData = $this->MUser->update_id($user['id'],$payload);

  			if($updateData["success"]){
  				$this->LSession->setSession($updateData["data"]);

  				$this->LRedirect->backWith("success",[
  					"title" => "Berhasil",
  					"text" => "Berhasil update data"
  				]);
  			}
  		}

		$this->LRedirect->backWith("error",[        		
	        "title" => "Terjadi Kesalahan",
	        "text" => "Password tidak valid"                 
	   	]);   
	}

	function updatePassword(){
		$this->form_validation->set_rules(
			'password','Password','required|min_length[8]',[
				'required' => '%s harus diisi',
				'min_length' => '%s harus lebih dari 8 digit'
			]
		);

		$this->form_validation->set_rules(
			'new_password','Password Baru','required|min_length[8]',[
				'required' => '%s harus diisi',
				'min_length' => '%s harus lebih dari 8 digit'
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

        $user = $this->MUser->first_id($this->LSession->user()['id']);

  		if($this->Bcrypt->checkPassword($this->input->post('password'),$user['password'])){
  			if($this->MUser->update_id($user['id'],[
  				"password" => $this->Bcrypt->hashPassword($this->input->post('new_password'))
  			])["success"]){
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

		$this->LRedirect->backWith("error",[        		
	        "title" => "Terjadi Kesalahan",
	        "text" => "Password tidak valid"                 
	   	]);  
	}
}