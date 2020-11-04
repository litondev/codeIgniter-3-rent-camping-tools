<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminHomeController extends CI_Controller{
	public function __construct(){
		parent::__construct();

    	if(!$this->LSession->user()){
      		redirect("/");
    	}

    	if($this->LSession->user()['role'] != "admin"){
    		redirect("/");
    	}
	}

	public function index(){
		$now = date("Y-m-d");
    	$label_sales = [];
    	$total_sales = [];
	    $total_value_sales = [];	  	    
	    
	    $gap = $this->input->get('gap') ? $this->input->get('gap') : 7;

	    for($i=0;$i<intval($gap);$i++){    
	       array_push($label_sales,$this->LCarbon->createFromFormat("Y-m-d",$now)
	       	->subDays($i)
	       	->format("d M"));

	       $time_1 = $this->LCarbon->createFromFormat("Y-m-d",$now)
	       ->subDays($i)
	       ->toDateTimeString();
	       $time_1 = explode(" ",$time_1)[0]." 00:00:00";
	    
	       $time_2 = $this->LCarbon->createFromFormat("Y-m-d",$now)
	       ->subDays($i)
	       ->toDateTimeString();
	       $time_2 = explode(" ",$time_2)[0]." 23:59:59"; 

	       $data1 = $this->db->select("count(*) as total,sum(total) as total_val")
	       ->where("created_at >",$time_1)
		   ->where("created_at <",$time_2)
	       ->where("status","completed")
	       ->get($this->MInvoice->table)
	       ->result_array()[0];

	        if(empty($data1["total_val"])){
	          $data1["total_val"] = 0;
	        }
	      	
	       	array_push($total_sales,$data1["total"]);       
	       	array_push($total_value_sales,$data1["total_val"]);
	    }

		$data = [];

		$data["widget"]["total_invoice"] = $this->db->select("count(*) as total")
			->get($this->MInvoice->table)
			->result_array()[0];
		$data["widget"]["total_product"] = $this->db->select("count(*) as total")
			->get($this->MProduct->table)
			->result_array()[0];
		$data["widget"]["total_manual_payment"] = $this->db->select("count(*) as total")
			->get($this->MManualPayment->table)
			->result_array()[0];
		$data["widget"]["total_value_invoice"] = $this->db->select("sum(total) as total")
			->where('status','completed')
			->get($this->MInvoice->table)
			->result_array()[0];

		$data["invoice"] = $this->db->order_by('id','desc')->get($this->MInvoice->table,5,0)->result_array();
		$data["manual_payment"] = $this->db->order_by('id','desc')->get($this->MManualPayment->table,5,0)->result_array();

		$data["user"]["total"] = $this->db->select("count(*) as total")
			->get($this->MUser->table)
			->result_array()[0];
		$data["user"]["blokir"] = $this->db->select("count(*) as total")
			->where('status','blokir')
			->get($this->MUser->table)
			->result_array()[0];
		$data["user"]["aktif"] = $this->db->select("count(*) as total")
			->where('status','aktif')
			->get($this->MUser->table)
			->result_array()[0];
		$data["user"]["new"] = $this->db->select("count(*) as total")
			->where("created_at <",$this->LCarbon->now()->setTime(0,0,0)->toDateTimeString())
			->where("created_at >",$this->LCarbon->now()->setTime(0,0,0)->subDays(7)->toDateTimeString())
			->get($this->MUser->table)
			->result_array()[0];

		$data["label_sales"] = $label_sales;
    	$data["total_sales"] = $total_sales;
    	$data["total_value_sales"] = $total_value_sales;

		$statistikUserView = $this->load->view("admin/home/statistik-user",$data,TRUE);
		$statistikSaleView = $this->load->view("admin/home/statistik-sale",$data,TRUE);
		$statistikPaymentView = $this->load->view("admin/home/statistik-payment",$data,TRUE);
		$statistikInvoiceView = $this->load->view("admin/home/statistik-invoice",$data,TRUE);
		$widgetView = $this->load->view("admin/home/widget",$data,TRUE);

		$this->LTemplate->headerAdmin();

		$this->load->view("admin/home",[
			"statistikUser" => $statistikUserView,
			"statistikSale" => $statistikSaleView,
			"statistikPayment"  => $statistikPaymentView,
			"statistikInvoice" => $statistikInvoiceView,
			"widget" => $widgetView,
		]);
		
		$this->LTemplate->footerAdmin();
	}	
}