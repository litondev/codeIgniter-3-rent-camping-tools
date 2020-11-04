<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*

 CARA MENJALANKAN/TESTING =>

 ke terminal/cmd/cli

 menuju project folder 

 ketikan perintah =>

 => php index.php CronjobController testing
    => perintah untuk testing

 => php index.php CronjobController backingStuff
 
 => php index.php CronjobController expiredInvoice

 => php index.php CronjobController expiredPayment

 setelah tidak ada masalah tinggal pasang di cronjob server

*/

class CronjobController extends CI_Controller{

	public function testing(){
		echo "Hello Saya Testing";
	}

	public function backingStuff(){	
		$this->MInvoice->cronjob_backing_stuff();
	}

	public function expiredInvoice(){
		$this->MInvoice->cronjob_expired_invoice();
	}

	public function expiredPayment(){
		$this->MInvoice->cronjob_expired_payment();
	}

	public function index(){
		$this->LTemplate->headerAdmin();

		$this->load->view("admin/cronjob");

		$this->LTemplate->footerAdmin();
	}

	public function actionBackingStuff(){
		$this->MInvoice->cronjob_backing_stuff();

		$this->LRedirect->backWith("success",[
			"text" => "Berhasil menjalankan tugas",
			"title" => "Berhasil"
		]);
	}

	public function actionExpiredInvoice(){
		$this->MInvoice->cronjob_expired_invoice();

		$this->LRedirect->backWith("success",[
			"text" => "Berhasil menjalankan tugas",
			"title" => "Berhasil"
		]);
	}

	public function actionExpiredPayment(){
		$this->MInvoice->cronjob_expired_payment();

		$this->LRedirect->backWith("success",[
			"text" => "Berhasil menjalankan tugas",
			"title" => "Berhasil"
		]);
	}
}