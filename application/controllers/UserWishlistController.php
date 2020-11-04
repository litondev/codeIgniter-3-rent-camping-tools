<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserWishlistController extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	public function index(){
		$wishlist = $this->MWishlist->get_user_wishlist();

		$this->LTemplate->headerUser([
			"title" => "Keinginan"
		]);

		$this->load->view("user/wishlist",$wishlist);
		
		$this->LTemplate->footerUser();
	}

	public function addWishlist($id){
		// CEK APAKAH PRODUCT ADA
		if(!$this->MProduct->first_where([
			"id" => $id,
			"status" => "aktif"
		])){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	            "text" => "Product tidak ditemukan atau tidak aktif"
	    	]);   		
		}

		// CEK APAKAH PRODUCT SUDAH ADA DIWISHLIST
		if($this->MWishlist->first_where([
			"product_id" => $id,
			"user_id" => $this->LSession->user()['id']
		])){
			$this->LRedirect->backWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menambahkan Keinginan"
	    	]);  
		}
		
		// CEK APAKAH PRODUCT SUDAH MENCAPAI LIMIT
		if(count($this->MWishlist->get_where([
			"user_id" => $this->LSession->user()['id']
		])) >= intval($this->config->item('app.max_wishlist'))){
           $this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
                "text" => "Anda telah mencapai limit daftar keinginan"
	       ]); 
        }

        if($this->MWishlist->create([
        	"user_id" => $this->LSession->user()['id'],
        	"product_id" => $id
        ])){
        	$this->LRedirect->backWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menambahkan Keinginan"
	    	]);
        }

    	$this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
            "text" => "Tidak dapat menambah keinginan"
	   	]); 
	}

	public function subWishlist($id){			
		// CEK APAKAH PRODUCT ADA DIWISHLIST
		if(!$this->MWishlist->first_id($id)){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	            "text" => "Wishlist tidak ditemukan"
	    	]);  
		}

		if($this->MWishlist->delete_id($id)["success"]){
        	$this->LRedirect->backWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menghapus Data"
	    	]);
        }

        $this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
	        "text" => "Gagal Menghapus Data"
	    ]);  
	}
}