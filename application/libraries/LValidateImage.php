<?php

class LValidateImage{
	public $ci;

	public function __construct(){
		$this->ci = & get_instance();		
	}

	public function isValid($image,$config = []){
		if($image['error'] != 0 && !empty($image['name'])){
			return [
				"title" => "Terjadi Kesalahan",
				"text" => "Gambar tidak dapat diupload"
			];
		}

		if($config['required']){
			if(empty($image['name'] && $image['error'] == 0)){
				return [
					"title" => "Terjadi Kesalahan",
					"text" => "Gambar harus diisi"
				];
			}
		}		

		if(!empty($image['name']) && $image['error'] == 0){
			if(isset($config["image_max_upload"])){
				if($image['size'] > $config['image_max_upload']){
					return [
						"title" => "Terjadi Kesalahan",
						"text" => "Ukuran gambar terlalu besar"
					];
				}
			}else{			
				if($image['size'] > $this->ci->config->item('app.image_max_upload')){
					return [
						"title" => "Terjadi Kesalahan",
						"text" => "Ukuran gambar terlalu besar"
					];
				}
			}


			if(isset($config['image_allow_upload'])){
				if(!in_array($image['type'],$config['image_allow_upload'])){
					return [
						"title" => "Terjadi Kesalahan",
						"text" => "Gambar tidak valid"
					];
				}
			}else{
				if(!in_array($image['type'],$this->ci->config->item('app.image_allow_upload'))){
					return [
						"title" => "Terjadi Kesalahan",
						"text" => "Gambar tidak valid"
					];
				}
			}
		}

		return Null;
	}
}