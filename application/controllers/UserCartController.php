<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserCartController extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	public function index(){		
		$cart = $this->MOrderItem->get_user_cart();	
		
		$jsDateRangeMobileView = $this->load->view("user/cart/js-date-range-dekstop",[],TRUE);
		$jsDateRangeDekstopView = $this->load->view("user/cart/js-date-range-mobile",[],TRUE);
		$jsCheckoutView = $this->load->view("user/cart/js-checkout.php",[],TRUE);
		$jsFormSubsCartView = $this->load->view("user/cart/js-form-subs-cart.php",[],TRUE);
		$jsFormCheckoutView = $this->load->view("user/cart/js-form-checkout.php",[],TRUE);

		$productView = $this->load->view("user/cart/product",[
			"cart" => $cart
		],TRUE);

		$sidebarDekstopView = $this->load->view("user/cart/sidebar-dekstop",[
			"cart" => $cart
		],TRUE);

		$sidebarMobileView = $this->load->view("user/cart/sidebar-mobile",[
			"cart" => $cart
		],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Keranjang"
		]);

		$this->load->view("user/cart",[
			"jsDateRangeMobile" => $jsDateRangeMobileView,
			"jsDateRangeDekstop" => $jsDateRangeDekstopView,
			"jsCheckout" => $jsCheckoutView,
			"jsFormCheckout" => $jsFormCheckoutView,
			"jsFormSubsCart" => $jsFormSubsCartView,
			"product" => $productView,
			"sidebarDekstop" => $sidebarDekstopView,
			"sidebarMobile" => $sidebarMobileView
		]);
		
		$this->LTemplate->footerUser();
	}

	public function addCart($id){
		// CEK PRODUCT
		if(!$this->MProduct->first_where([
			"id" => $id,
			"status" => "aktif",
		])){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	        	"text" => "Product tidak ditemukan atau tidak aktif"
	    	]);  
		}

        //  CEK PRODUCT JIKA DI KERANJANG
		if($this->MOrderItem->first_where([
			"product_id" => $id,
			"status" => "cart",
			"user_id" => $this->LSession->user()['id']
		])){
			$this->LRedirect->backWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menambah Product"
	    	]);  
		}

        if(count($this->MOrderItem->get_where([
        	"user_id" => $this->LSession->user()['id'],
        	'status' => 'cart',        	
        ])) >= intval($this->config->item('app.max_order'))){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
                "text" => "Anda telah mencapai limit order"
	    	]);          	
        }

        // CEK PRODUCT JIKA TERSEWA
		if(!$this->MProduct->first_where([
			"id" => $id,
			"status_rent" => 0
		])){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	        	"text" => "Product telah tersewa"
	    	]);  
		}

		// CREATE DATA
		if($this->MOrderItem->create([
			"product_id" => $id,
			"user_id" => $this->LSession->user()['id'],
			'status' => 'cart'
		])['success']){
			$this->LRedirect->redirectWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menambah Product"
	    	],"/cart");  
		}

		$this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
	        "text" => "Gagal Menambah Product"
	    ]);  
	}

	public function subCart($id){	
		if($this->MOrderItem->delete_where([
				'id' => $id,
				'user_id' => $this->LSession->user()['id'],
				'status' => 'cart'
			])['success']){

			$this->LRedirect->redirectWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Menghapus Data"
	    	],"/cart");  
		}

		$this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
	        "text" => "Gagal Menghapus Data"
	    ]);  		
	}

	public function subsCart(){
		if($this->input->get("id")){
            if(is_array($this->input->get('id'))){
                foreach ($this->input->get('id') as $item) {             
                    $this->MOrderItem->delete_where([
                    	'id' => $item,
                    	'user_id' => $this->LSession->user()['id'],
                    	'status' => 'cart'
                    ]);
                }

				$this->LRedirect->redirectWith("success",[
	    			"title" => "Berhasil",
		            "text" => "Berhasil Menghapus Data"
	    		],"/cart"); 
            }
        }  

        $this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
	        "text" => "Gagal Menghapus Data"
	    ]);  		
	}
}