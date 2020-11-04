<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Barryvdh\DomPDF\Facade as PDF;

class UserInvoiceController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	public function index(){
		if(!$this->MInvoice->get_is_invoice_active()){
			$this->LRedirect->redirectWith("error",[
	    		"title" => "Terjadi Kesalahan",
	            "text" => "Sepertinya tidak ada invoice yang aktif"
	    	],"/akun");  
		}

		$invoice = $this->MInvoice->get_invoice_active();

		$jsCancelOrderView = $this->load->view("user/invoice/js-cancel-order",[],TRUE);

		$jsInChoseImageView = $this->load->view("user/invoice/js-in-chose-image",[],TRUE);

		$jsInfoView = $this->load->view('user/invoice/js-info',[
			"invoice" => $invoice
		],TRUE);

		$detailView = $this->load->view("user/invoice/detail",[
			"invoice" => $invoice
		],TRUE);

		$infoSidebarView = $this->load->view("user/invoice/info-sidebar",[
			"invoice" => $invoice
		],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Invoice"
		]);
		
		$this->load->view("user/invoice",[
			"jsCancelOrder" => $jsCancelOrderView,
			"jsInChoseImage" => $jsInChoseImageView,
			"jsInfo" => $jsInfoView,
			"detail" => $detailView,
			"infoSidebar" => $infoSidebarView,			
		]);

		$this->LTemplate->footerUser();
	}

	public function historyInvoice(){
		$invoice = $this->MInvoice->get_history_invoice();

		$this->LTemplate->headerUser([
			"title" => "Riwayat Invoice"
		]);
		
		$this->load->view("user/history-invoice",$invoice);

		$this->LTemplate->footerUser();
	}

	public function cancelOrder($id){
		$this->db->trans_start();
	
		if(!$this->MInvoice->get_is_invoice_cancelable($id)){
			$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	            "text" => "Invoice tidak valid"
	    	]);   
		}

		if($this->MInvoice->update_where([
			"id" => $id,
			"user_id" => $this->LSession->user()['id'],
		],[
			"status" => "canceled"
		])){	
			$this->MManualPayment->update_where([
				"status" => "validasi",
				"invoice_id" => $id,
				"user_id" => $this->LSession->user()['id']
			],[
				"status" => "failed",
				"status_description" => "Pembatalan Order"
			]);          

			$order_item = $this->MInvoice->get_product_invoice($id);

 			foreach ($order_item as $item) {
            	$this->MProduct->update_id($item['id'],[
            		'status_rent' => 0
            	]);             
        	}

        	$this->MNotifAdmin->create([
                "content" => "User ".$this->LSession->user()['first_name']." telah mencancel orderan invoice id #".$id
            ]);       

			$this->db->trans_complete();

        	$this->LRedirect->redirectWith("success",[
	    		"title" => "Berhasil",
	            "text" => "Berhasil Membatalkan Pesanan"
	    	],"/history-invoice");  
		}  

		$this->LRedirect->backWith("error",[
	    	"title" => "Terjadi Kesalahan",
	       	"text" => "Tidak dapat membatalkan pesanan"
	    ]);   
	}

	function downloadPdfInvoice($id){
		$invoice = $this->MInvoice->first_where([
			"id" => $id,
			"user_id" => $this->LSession->user()['id'],			
		]);

        if(!$invoice){
           	$this->LRedirect->backWith("error",[
	    		"title" => "Terjadi Kesalahan",
	    		"text" => "Data invoice tidak valid"
	    	]);   
        }

		$product = $this->MInvoice->get_product_invoice($id);
			
		$html = $this->load->view("pdf/invoice", [
			"invoice" => $invoice,
			"product" => $product
		], TRUE);

        $this->LDomPdf->load_html($html);
  		$this->LDomPdf->render();
  		$this->LDomPdf->stream("invoice.pdf", array("Attachment" => true));     
    }
}