<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserActionAuthController extends CI_Controller{
  function __construct(){
    parent::__construct();

    if($this->LSession->user()){
      redirect("/");
    }
  }

  // MASUK ACTION
	public function signin(){
		$this->form_validation->set_rules(
			'email','Email','required|valid_email',[
				'required' => '%s harus diisi',
				'valid_email' => '%s tidak valid'
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

		$user = $this->MUser->first_where(["email" => $this->input->post('email')]);

    if(!$user){
    	$this->LRedirect->backWith("error",[
    		"title" => "Terjadi Kesalahan",
    		"text" => "Email tidak ditemukan"
    	]);
    }

   	if($this->Bcrypt->checkPassword($this->input->post('password'),$user['password'])){
   		if($user['status'] == "blokir" && !empty($user['description_blokir'])){
   			$this->LRedirect->backWith("error",[
                "title" => "Maaf sepertinya anda telah diblokir",
                "text" => $user['description_blokir']
    		]);  
   		}

 			$this->MUser->update_id($user['id'],[
 				"last_login" => $this->LCarbon->now()->toDateTimeString()
 			]);       			

			$this->LSession->setSession($user);

 			if($user['role'] == "user"){
 				$this->LRedirect->redirectWith("success",[
        		"title" => "Berhasil",
  				"text" => "Berhasil masuk"
  			],"/");
 			}else{
        $this->MLogAdmin->create([
          "name" => $this->LSession->user()['first_name'],
          "ip" => $_SERVER['REMOTE_ADDR'],
          "user_agent" => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null
        ]);
     
 				$this->LRedirect->redirectWith("success",[
 					"title" => "Berhasil",
 					"text" => "Berhasil masuk"
 				],'/admin');
 			}       	
   	}

   	$this->LRedirect->backWith("error",[
    	"title" => "Terjadi Kesalahan",
    	"text" => "Password tidak valid"
    ]);       
	}

  // DAFTAR ACTION
	public function signup(){	
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
			'gender','Jenis kelamin','required',[
				'required' => '%s harus diisi'
			]
		);

		$this->form_validation->set_rules(
			'address','Alamat','required',[
				'required' => '%s harus diisi'
			]
		);

    $this->form_validation->set_rules(
			'email','Email','required|valid_email|is_unique[users.email]',[
				'required' => '%s harus diisi',
				'valid_email' => '%s tidak valid',
				'is_unique' => '%s sudah digunakan'
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

		$payload = $this->input->post(["first_name","last_name","phone","gender","address",'email']);
		$payload["password"] = $this->Bcrypt->hashPassword($this->input->post("password"));
		
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
    if($this->MUser->first_where(['phone' => $payload['phone']])){
    	$this->LRedirect->backWith("error",[        		
            "title" => "Terjadi Kesalahan",
            "text" => "No telp telah terpakai"                 
    	]);                   
    }
  
    if($this->MUser->create($payload)["success"]){
    	$this->LRedirect->redirectWith("success",[
    		"title" => "Berhasil",
    		"text" => "Berhasil mendaftar"
    	],"/signin");
    }

    $this->LRedirect->backWith("error",[
    	"tite" => "Terjadi Kesalahan",
    	"text" => "Gagal mendaftar"
    ]);
	}  

  // FORGET PASSWORD ACTION
  public function forgetPassword(){
    $this->form_validation->set_rules(
      'email','Email','required|valid_email',[
        'required' => '%s harus diisi',
        'valid_email' => '%s tidak valid'
    ]);

    if ($this->form_validation->run() == FALSE){
      $theError = $this->form_validation->error_array();

      $keyArray = array_keys($theError);

      $this->LRedirect->backWith("error",[
        "text" => $theError[$keyArray[0]],
        "title" => "Terjadi Kesalahan"
      ]);
    }

    $user = $this->MUser->first_where(["email" => $this->input->post('email')]);

    if(!$user){
      $this->LRedirect->backWith("error",[
        "title" => "Terjadi Kesalahan",
        "text" => "Email tidak ditemukan"
      ]);
    }

    $key = random_string('alpha',20);

    // EMAIL SEND
    $subject = "lupa password ".$user['first_name'];

    $content = "<div>";
    $content .= "<span class='title-email-camp'>Hello ".$user['first_name']."</span>";
     $content .= "<br>";
     $content .= "<br>";
    $content .= "<span class='text-email-camp'>Klik link dibawah ini untuk reset password</span>";
     $content .= "<br>";
    $content .= "<a href='".site_url().'/reset-password?email='.$user['email'].'&key='.$key."' class='text-email-camp'>Klik</a>";
    $content .= "</div>";

    $view = $this->load->view("email/layout",["content" => $content],TRUE);

    if($this->LMail->send($user['email'],$view,$subject)){
      if($this->MUser->update_id($user['id'],[
        "remember_token" => $key
      ])['success']){
        $this->LRedirect->backWith("success",[
            "title" => "Berhasil",
            "text" => "Email verifikasi password baru telah terkirim,Silahkan cek email"
        ]);
      }
    }

    $this->LRedirect->backWith("error",[
          "title" => "Terjadi Kesalahan",
          "text" => "Tidak dapat mengirim email"
    ]);
  }

  // RESET PASSWORD ACTION
  public function resetPassword(){   
    $this->form_validation->set_rules(
      'email','Email','required|valid_email',[
        'required' => '%s harus diisi',
        'valid_email' => '%s tidak valid'
    ]);

    $this->form_validation->set_rules(
      'password','Password','required|min_length[8]',[
        'required' => '%s harus diisi',
        'min_length' => '%s harus lebih dari 8 digit'
      ]
    );

    $this->form_validation->set_rules(
      'password_confirmation','Password Konfirmasi','required|min_length[8]',[
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
    
    $payload = $this->input->post(["key","email","password","password_confirmation"]);

    // VALIDASI PASSWORD
    if($payload["password"] !== $payload["password_confirmation"]){
      $this->LRedirect->backWith("error",[
        "text" => "Password tidak sama",
        "title" => "Terjadi Kesalahan"
      ]);
    }

    $user = $this->MUser->first_where([
        "email" => $payload['email'],
        "remember_token" => $payload['key']
    ]);

    // VALIDASI EMAIL DAN REMEMBER TOKEN
    if(!$user){
      $this->LRedirect->backWith("error",[
        "text" => "Data tidak ditemukan",
        "title" => "Terjadi Kesalahan"
      ]);
    }

    $newPassword = $this->Bcrypt->hashPassword($payload['password']);

    if($this->MUser->update_id($user['id'],[
      "password" => $newPassword,
      "remember_token" => Null
    ])){
      $this->LRedirect->redirectWith("success",[
        "text" => "Berhasil update password",
        "title" => "Berhasil"
      ],"/signin");
    }

    $this->LRedirect->backWith("error",[
      "text" => "Terjadi kesalahan",
      "title" => "Terjadi Kesalahan"
    ]);
  }
}