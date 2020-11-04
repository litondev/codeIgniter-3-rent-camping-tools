<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminManualPaymentDetailController extends CI_Controller{
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
        // DETAIL
        $manualPayment = $this->MManualPayment->first_id($id);

        if(!$manualPayment){
            $this->LRedirect->backWith("error",[
                "title" => "Terjadi Kesalahan",
                "text" => "Data pembayaran manual tidak valid"
            ]);
        }

        // DETAIL INVOICE
        $invoice = $this->MInvoice->first_id($manualPayment["invoice_id"]);

        // HISTORY MANUAL PAYMENT
        $historyManualPayment = $this->MManualPayment->get_where([
            "invoice_id" => $manualPayment['invoice_id']
        ]);

        // IS THEREE VALIDASI
        $isThreeValidasi = count($this->MManualPayment->get_where([
            "invoice_id" => $manualPayment["invoice_id"],
            "status" => "validasi"
        ]));

        $theData = [
            "manualPayment" => $manualPayment,
            "invoice" => $invoice,
            "isThreeValidasi" => $isThreeValidasi,
            "historyManualPayment" => $historyManualPayment
        ];

        $detailView = $this->load->view("admin/manual-payment-detail/detail",$theData,TRUE);
        $detailInvoiceView = $this->load->view("admin/manual-payment-detail/detail-invoice",$theData,TRUE);
        $historyView = $this->load->view("admin/manual-payment-detail/history",$theData,TRUE);
        $modalReasonFailedView = $this->load->view("admin/manual-payment-detail/modal-reason-failed",$theData,TRUE);

        $this->LTemplate->headerAdmin();

        $this->load->view("admin/manual-payment-detail",[          
            "detail" => $detailView,
            "detailInvoice"  => $detailInvoiceView,
            "history" => $historyView,
            "modalReasonFailed" => $modalReasonFailedView
        ]);
        
        $this->LTemplate->footerAdmin();         
    }

    public function successPayment($id){
        $manualPayment = $this->MManualPayment->first_where([
            "id" => $id,
            "status" => "validasi"
        ]);

        if(!$manualPayment){
            $this->LRedirect->backWith("error",[
                "title" => "Terjadi Kesalahan",
                "text" => "Data pembayaran manual tidak valid"
            ]);
        }

        $this->db->trans_start();

        if($this->MManualPayment->update_where([
            "id" => $id,
            "status" => "validasi"
        ],[
            "status" => "success"
        ])["success"]){            
            $this->MNotif->create([
                "user_id" => $manualPayment['user_id'],
                "title" => "Pembayaran #".$id,
                "sub_title" => "Pembayaran berhasil",
                "description" => "Pembayaran #".$id." telah berhasil divalidasi admin untuk invoice #".$manualPayment['invoice_id']        
            ]);

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "title" => "Berhasil",
                "text" => "Berhasil mengubah status"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "title" => "Terjadi Kesalahan",
            "text" => "Gagal mengubah status"
        ]);
    }

    public function failedPayment($id){
       $manualPayment = $this->MManualPayment->first_where([
            "id" => $id,
            "status" => "validasi"
        ]);

        if(!$manualPayment){
            $this->LRedirect->backWith("error",[
                "title" => "Terjadi Kesalahan",
                "text" => "Data pembayaran manual tidak valid"
            ]);
        }

        $this->db->trans_start();

        if($this->MManualPayment->update_where([
            "id" => $id,
            "status" => "validasi"
        ],[
            "status" => "failed",
            "status_description" => $this->input->post('status_description')
        ])["success"]){            
            $this->MNotif->create([
                "user_id" => $manualPayment['user_id'],
                "title" => "Pembayaran #".$id,
                "sub_title" => "Pembayaran gagal",
                "description" => "Pembayaran #".$id." telah gagal divalidasi oleh admin dengan alasan : ".$this->input->post('status_description')." untuk invoice #".$manualPayment['invoice_id']
             ]);

            $this->db->trans_complete();

            $this->LRedirect->backWith("success",[
                "title" => "Berhasil",
                "text" => "Berhasil mengubah status"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "title" => "Terjadi Kesalahan",
            "text" => "Gagal mengubah status"
        ]);
    }

    public function paid($id){
        $invoice = $this->MInvoice->first_where([
            "id" => $id,
            "status" => "payment",
            "status_payment" => "unpaid"
        ]);

        if(!$invoice){
            $this->LRedirect->backWith("error",[
                "text" => "Data invoice tidak valid",
                "title" => "Terjadi Kesalahan"
            ]);
        }

        $isThreeValidasi = count($this->MManualPayment->get_where([
            "invoice_id" => $id,
            "status" => "validasi"
        ]));

        if(intval($isThreeValidasi) > 0){
            if(!$invoice){
                $this->LRedirect->backWith("error",[
                    "text" => "Data invoice tidak valid",
                    "title" => "Terjadi Kesalahan"
                ]);
            }
        }

        $this->db->trans_start();

        if($this->MInvoice->update_where([
            "id" => $id,
        ],[
            "status" => "prepare",
            "status_payment" => "paid"
        ])){
            $this->MNotif->create([
                "user_id" => $invoice['user_id'],
                "title" => "Invoice #".$invoice['id'],
                "sub_title" => "Status telah berubah",
                "description" => "Pembayaran berhasil untuk invoice #".$invoice['id']." status telah berubah menjadi persiapan"    
            ]);

            $this->db->trans_complete();
            
            $this->LRedirect->backWith("success",[
                "title" => "Berhasil",
                "text" => "Berhasil mengubah status"
            ]);
        }

        $this->LRedirect->backWith("error",[
            "text" => "Gagal Mengubah Status",
            "title" => "Terjadi Kesalahan"
        ]);
    }
}