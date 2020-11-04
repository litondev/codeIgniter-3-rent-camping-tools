<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserCheckoutController extends CI_Controller{
    function __construct(){
        parent::__construct();

        if(!$this->LSession->user()){
            redirect("/signin");
        }
    }

	public function checkout(){
		$this->db->trans_start();
             
        // VALIDASI INVOICE
      	if($this->MInvoice->get_is_invoice_active()){
      		$this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
            	"text" => "Anda masih memiliki invoice yang aktif"
    		]);   		
      	}

        $dateRent = explode(" - ",$this->input->post('date_rent'));

        // VALIDASI TGL RENTAL
        if(!is_array($dateRent)){               
            $this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
            	"text" => "Maaf sepertinya tanggal tidak valid"
    		]);  
        }

        $startRent = $dateRent[0];
        $endRent = $dateRent[1];

        $guaranteing = $this->input->post('guaranteing');
   
        // VALIDASI TGL VALID 
        if($this->LCarbon->parse($startRent)->isBefore(
        	$this->LCarbon->now()->setTime(0,0,0)->addDays(intval($this->config->item('app.expired_invoice')))
        )){
        	 $this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
            	"text" => "Maaf sepertinya tanggal tidak valid"
    		]);  
        }

        // VALIDASI TGL VALID
        if($this->LCarbon->parse($endRent)->isBefore($this->LCarbon->parse($startRent))){
 			$this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
            	"text" => "Maaf sepertinya tanggal tidak valid"
    		]);  
        }      

        // VALIDASI MAX TGL RENTAL
        if($this->LCarbon->parse($endRent)->isAfter($this->LCarbon->parse($startRent)->addDays($this->config->item('app.max_rent_product')))){
        	$this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
                "text" => "Max Sewa Adalah ".$this->config->item('app.max_rent_product')." Hari"
    		]);  
        }       

        // VALIDASI MIN TGL RENTAL
        if($this->LCarbon->parse($startRent)->addDays($this->config->item('app.min_rent_product'))->isAfter($this->LCarbon->parse($endRent))){
        	$this->LRedirect->backWith("error",[
    			"title" => "Terjadi Kesalahan",
                "text" => "Min Sewa Adalah ".$this->config->item('app.min_rent_product')." Hari"
    		]);  
        }          

        $total = 0;

      	$order_item = $this->MOrderItem->get_user_cart();	

        foreach ($order_item as $item) {
            // JIKA PRODUCT YANG DI CART TELAH TERSEWA OLEH ORANG LAIN
            if(intval($item['status_rent']) == 1){
            	$this->LRedirect->backWith("error",[
    				"title" => "Terjadi Kesalahan",
                	"text" => "Product ".$item['name']." telah tersewa"
    			]);  
            }

            $this->MProduct->update_id($item['id'],['status_rent' => 1]);             

            $total += $item['rent_price'];
        }   

        $date_expired_payment =  $this->LCarbon->now()
        ->addDays((intval($this->config->item('app.expired_invoice'))-1))
        ->toDateTimeString();

        $invoice = $this->MInvoice->create([
        	"user_id" => $this->LSession->user()['id'],
            "start_rent" => $startRent,
            "end_rent" => $endRent,
            "expired_payment" => $date_expired_payment,
            "total" => $total,
            "guaranteing" => $guaranteing   
       	])['data'];    

        $this->MOrderItem->update_where([
        	"user_id" => $this->LSession->user()['id'],
        	'status' => 'cart'
        ],[
        	"invoice_id" => $invoice['id'],
        	"status" => "invoice"
        ]);    

        $this->MNotifAdmin->create([
        	"content" => "User ".$this->LSession->user()['first_name']." telah melakukan checkout invoice id #".$invoice['id']
        ]);

		$this->db->trans_complete();

        $this->LRedirect->redirectWith("success",[
    		"title" => "Berhasil",
    		"text" => "Invoice berhasil dibuat"
    	],"/invoice");   
	}
}