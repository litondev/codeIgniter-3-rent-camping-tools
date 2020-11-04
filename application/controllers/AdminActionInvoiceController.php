<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminActionInvoiceController extends CI_Controller{
	public function __construct(){
		parent::__construct();

    	if(!$this->LSession->user()){
      		redirect("/");
    	}

    	if($this->LSession->user()['role'] != "admin"){
    		redirect("/");
    	}
	}

    // MERUBAH STATUS INVOCE MENJADI DITOLAK
    function actionRejected($id){
        $this->db->trans_start();    

    	if($this->MInvoice->update_where([
    		"status_payment" => "unpaid",
    		"status" => "pending",
    		"id" => $id
    	],[
    		"status" => "rejected"
    	])["success"]){

    		$invoice = $this->MInvoice->first_id($id);

    		$this->MNotif->create([
    			"user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
               	"description" => "Invoice #".$invoice['id']."  telah di tolak oleh admin dengan alasan : ".$this->input->get('reason')
    		]);

    		$product = $this->MInvoice->get_product_invoice($id);        

    		foreach ($product as $item) {
    			$this->MProduct->update_id($item['id'],[
    				"status_rent" => 0
    			]);
    		}

    		$this->db->trans_complete();

    		$this->LRedirect->backWith("success",[
    			"text" => "Berhasil merubah status",
    			"title" => "Berhasil"
    		]);
    	}                         

    	$this->LRedirect->backWith("error",[
    		"text" => "Gagal merubah status",
    		"title" => "Terjadi Kesalahan"
    	]);
    }

    // MERUBAH STATUS INVOICE MENJADI PEMBAYARAN
    function actionPayment($id){
        $this->db->trans_start();    

    	if($this->MInvoice->update_where([
    		"status_payment" => "unpaid",
    		"status" => "pending",
    		"id" => $id
    	],[
    		"status" => "payment"
    	])["success"]){
    		$invoice = $this->MInvoice->first_id($id);

    		$this->MNotif->create([
    			"user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
               "description" => "Invoice #".$invoice['id']." status telah berubah menjadi pembayaran"
            ]);

    		$this->db->trans_complete();

    		$this->LRedirect->backWith("success",[
    			"text" => "Berhasil merubah status",
    			"title" => "Berhasil"
    		]);
    	}                         

    	$this->LRedirect->backWith("error",[
    		"text" => "Gagal merubah status",
    		"title" => "Terjadi Kesalahan"
    	]);
    }

    // MERUBAH STATUS INVOICE MENJADI PENGAMBILAN BARANG
    function actionWithdrawingStuff($id){
        $this->db->trans_start();  

        if($this->MInvoice->update_where([
            "status_payment" => "paid",
            "status" => "prepare",
            "id" => $id
        ],[
            "status" => "withdrawing stuff"
        ])["success"]){
            $invoice = $this->MInvoice->first_id($id);

            $this->MNotif->create([
                "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
                "description" => "Invoice #".$invoice['id']." status telah berubah menjadi pengambilan barang"
            ]);

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil merubah status",
                "title" => "Berhasil"
            ]);
        }              

        $this->LRedirect->backWith("error",[
            "text" => "Gagal merubah status",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    // MERUBAH STATUS INVOICE MENJADI DALAM PENYEWAAN
    function actionInRent($id){
        $this->db->trans_start();    

        if($this->MInvoice->update_where([
            "status_payment" => "paid",
            "status" => "withdrawing stuff",
            "id" => $id
        ],[
            "status" => "in rent"
        ])["success"]){
            $invoice = $this->MInvoice->first_id($id);

            $this->MNotif->create([
               "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
                "description" => "Invoice #".$invoice['id']." status telah berubah menjadi dalam penyewaan"
            ]);

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil merubah status",
                "title" => "Berhasil"
            ]);
        } 

        $this->LRedirect->backWith("error",[
            "text" => "Gagal merubah status",
            "title" => "Terjadi Kesalahan"
        ]);   
    }

    // MERUBAH STATUS INVOICE MENJADI PENGEMBALIAN BARANG
    function actionBackingStuff($id){
        $this->db->trans_start();    

        if($this->MInvoice->update_where([
            "status_payment" => "paid",
            "status" => "in rent",
            "id" => $id
        ],[
            "status" => "backing stuff"
        ])["success"]){    
            $invoice = $this->MInvoice->first_id($id);

            $this->MNotif->create([
                "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
                "description" => "Invoice #".$invoice['id']." status telah berubah menjadi pengembalian barang"
            ]);

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil merubah status",
                "title" => "Berhasil"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal merubah status",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    // MERUBAH STATUS INVOICE MENJADI SELESAI
    function actionCompleted($id){
        $this->db->trans_start();    

        if($this->MInvoice->update_where([
            "status_payment" => "paid",
            "status" => "backing stuff",
            "id" => $id
        ],[
            "status" => "completed"
        ])["success"]){

            $invoice = $this->MInvoice->first_id($id);

            $this->MNotif->create([
                "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
                "description" => "Invoice #".$invoice['id']." status telah berubah menjadi selesai"            
            ]);

            $product = $this->MInvoice->get_product_invoice($id);        

            foreach ($product as $item) {
                $this->MProduct->update_id($item['id'],[
                    "status_rent" => 0
                ]);
            }

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil merubah status",
                "title" => "Berhasil"
            ]);
        }                         

        $this->LRedirect->backWith("error",[
            "text" => "Gagal merubah status",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    function addFine(){
        $this->db->trans_start();    

        $payload = [];

        $payload["fine_description"] = $this->input->post("fine_description");        
        $payload["fine_total"] = intval(str_replace(".","",$this->input->post('fine_total')));
        $payload["is_fine"] = 1;

        if($this->MInvoice->update_id($this->input->post('id'),$payload)['success']){
            $invoice = $this->MInvoice->first_id($this->input->post('id'));

            $this->MNotif->create([
                "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Denda keterlambatan",
                "description" => "Invoice #".$invoice['id']." telah terkena denda keterlambatan pengembalian barang sebesar : Rp ".number_format($payload["fine_total"],"2")
            ]);

            $product = $this->MInvoice->get_product_invoice($this->input->post('id'));        

            foreach ($product as $item) {
                $this->MProduct->update_id($item['id'],[
                    "status_rent" => 0
                ]);
            }

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil memberikan denda",
                "title" => "Berhasil"
            ]);   
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal memberikan denda",
            "title" => "Terjadi Kesalahan"
        ]);
    }

    function editFine($id){
        $this->db->trans_start();    
        
        $payload = [];
        $payload["fine_description"] = $this->input->post("fine_description");        
        $payload["fine_total"] = intval(str_replace(".","",$this->input->post('fine_total')));

        if($this->MInvoice->update_id($id,$payload)['success']){

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "text" => "Berhasil memberikan denda",
                "title" => "Berhasil"
            ]);   
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal memberikan denda",
            "title" => "Terjadi Kesalahan"
        ]);
    }
}