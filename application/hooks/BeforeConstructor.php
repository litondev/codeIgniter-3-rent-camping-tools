<?php

class BeforeConstructor{
	public $ci;

 	public $settings = [
        "image_max_upload" => 1000024,
        "image_allow_upload" => ["image/jpeg","image/jpg","image/gif","image/png","jpeg","jpg","gif","png"],
	];

	public function __construct(){
		$this->ci = & get_instance();	
	}

	function setConfig(){	
		setLocale(LC_ALL,"id_ID.utf8");
		
        date_default_timezone_set('Asia/Jakarta');

        $this->ci->LCarbon->setLocale("id_ID.utf8");

		$setting = $this->ci->MSetting->all();

		foreach ($setting as $item) {
			$this->ci->config->set_item("app.".$item["name"],$item["value"]);
		}

		foreach($this->settings as $key => $item){
            $this->ci->config->set_item("app.".$key,$item);
        }        

        if($this->ci->LSession->user()){
        	$this->ci->config->set_item('app.user_cart',
        		$this->ci->MOrderItem->get_cart_count($this->ci->LSession->user()['id'])
        	);

        	if($this->ci->LSession->user()['role'] == "admin"){
        		$this->ci->config->set_item('app.notif_admin',
        			$this->ci->MNotifAdmin->get_last_notif($this->ci->LSession->user()['id'])
        		);
        	}
        }
	}	
}