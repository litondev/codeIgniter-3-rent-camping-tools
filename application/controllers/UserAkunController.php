<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAkunController extends CI_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->LSession->user()){
			redirect("/signin");
		}
	}

	public function index(){
		$akun = [
			[
				"title" => "Profil",
				"img" => "profil.png",
				"link" => "profil"
			],
			[
				"title" => "Keinginan",
				"img" => "wishlist.png",
				"link" => "wishlist"
			],
			[
				"title" => "Invoice",
				"img" => "invoice.png",
				"link" => "invoice"
			],
			[
				"title" => "Riwayat Invoice",
				"img" => "invoice-history.png",
				"link" => "history-invoice"
			],
			[
				"title" => "Riwayat Pembayaran Manual",
				"img" => "manual-payment.png",
				"link" => "history-manual-payment"
			]
		];

		$this->LTemplate->headerUser([
			"title" => "Akun"
		]);

		$this->load->view("user/akun",["akun" => $akun]);

		$this->LTemplate->footerUser();	
	}
}