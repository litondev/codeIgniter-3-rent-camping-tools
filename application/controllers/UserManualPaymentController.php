<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManualPaymentController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	function index(){
		$data = [];

        $data['invoice'] = $this->MInvoice->first_where([
        	'user_id' => $this->LSession->user()['id'],
        	'status' => 'payment',        	
        ]);

        if(!$data['invoice']){
        	$this->LRedirect->backWith("error",[
        		"text" => "Anda tidak mempunyai invoice yang aktif",
        		"title" => "Terjadi Kesalahan"
        	]);
        }

		$data['invoice']['manual_payment'] = $this->MManualPayment->get_active_manual_payment($data['invoice']['id']);

		$this->LTemplate->headerUser([
			"title" => "Pembayaran Manual"
		]);
		
		$this->load->view("user/manual-payment",$data);

		$this->LTemplate->footerUser();		
	}

	function historyManualPayment(){
		$historyManualPayment = $this->MManualPayment->get_user_history_manual_payment();

		$this->LTemplate->headerUser([
			"title" => "Riwayat Pembayaran Manual"
		]);
		
		$this->load->view("user/history-manual-payment",$historyManualPayment);

		$this->LTemplate->footerUser();
	}

	function manualPayment(){
		$this->form_validation->set_rules(
			'description','Deskripsi','required',[
				'required' => '%s harus diisi'
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

		$isValidImage = $this->LValidateImage->isValid($_FILES['proof'],[
			"required" => true,			
		]);

		if($isValidImage){
			$this->LRedirect->backWith("error",$isValidImage);
		}

        $invoice = $this->MInvoice->first_where([
        	'user_id' => $this->LSession->user()['id'],
        	'status' => 'payment',        	
        ]);

        if(!$invoice){
 	     	$this->LRedirect->backWith("error",[
        		"text" => "Data invoice tidak ditemukan",
        		"title" => "Terjadi Kesalahan"
        	]);  
        }

  	   	$nameFile = random_string('alpha',20);
  	   	$extension = substr($_FILES['proof']['name'], -3);
  	   	$theNameFile = $nameFile.".".$extension;

        $this->db->trans_start();

        if($this->MManualPayment->create([
        		"user_id" => $this->LSession->user()['id'],
        		"invoice_id" => $invoice['id'],
        		"proof" => $theNameFile,
        		"description" => $this->input->post('description'),
        		"status" => "validasi",    		
        	])['success']){
        	   	$this->MNotifAdmin->create([
                    "content" => "User ".$this->LSession->user()['first_name']." telah mengirim bukti pembayaran"
        		]);

				move_uploaded_file($_FILES["proof"]["tmp_name"], "./assets/images/proofs/".$theNameFile);

				$this->db->trans_complete();

        		$this->LRedirect->redirectWith("success",[
    				"title" => "Berhasil",
		            "text" => "Berhasil mengirim pembayaran manual,tunggu diproses admin"
		    	],"/history-manual-payment");                 
        }        

        $this->LRedirect->backWith("error",[
        	"text" => "Gagal mengirim pembayaran manual",
        	"title" => "Terjadi Kesalahan"
        ]);      
	}
}