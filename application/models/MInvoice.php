<?php

class MInvoice extends CI_Model{
	public $table = "invoices";

	/* MBASE QUERY */
		public function all(){
			return $this->MBase->all($this->table,$this);
		}

		public function get_where($parameter){
			return $this->MBase->get_parameter($parameter,$this->table,$this);
		}

		public function create($data){
			return $this->MBase->create($data,$this->table,$this);
		}

		public function update_id($id,$data){
			return $this->MBase->update($id,$data,$this->table,$this);
		}

		public function delete_id($id){
			return $this->MBase->delete($id,$this->table,$this);
		}	

		public function first_id($id){
			return $this->MBase->first($id,$this->table,$this);
		}

		public function first_where($parameter){
			return $this->MBase->firstParameter($parameter,$this->table,$this);
		}	

		public function update_where($parameter,$data){
			return $this->MBase->updateParameter($parameter,$data,$this->table,$this);
		}

		public function delete_where($parameter){
			return $this->MBase->deleteParameter($parameter,$this->table,$this);
		}	
	/* MBASE QUERY */

	public function get_is_invoice_active(){
		return count($this->db->where("user_id",$this->LSession->user()['id'])
			->where_in('status',["pending","payment","prepare","withdrawing stuff","in rent","backing stuff"])
			->get($this->table)
			->result_array());
	}

	public function get_is_invoice_cancelable($id){
		return count($this->db->where("user_id",$this->LSession->user()['id'])
			->where("id",$id)
			->where_in('status',["pending","payment","prepare"])
			->get($this->table)
			->result_array());
	}

	public function get_invoice_active(){		
		$invoice = $this->db->where("user_id",$this->LSession->user()['id'])
			->where_in('status',["pending","payment","prepare","withdrawing stuff","in rent","backing stuff"])
			->get($this->table)
			->result_array()[0];

		$invoice['product'] = $this->db->select($this->MProduct->table.".*")
			->join($this->MOrderItem->table,$this->MOrderItem->table.".product_id = ".$this->MProduct->table.".id")
			->join($this->table,$this->table.".id = ".$this->MOrderItem->table.".invoice_id")
			->where($this->MProduct->table.".status_rent",true)
			->where($this->MOrderItem->table.'.status','invoice')
			->where_in($this->table.'.status',["pending","payment","prepare","withdrawing stuff","in rent","backing stuff"])
			->where($this->table.'.user_id',$this->LSession->user()['id'])
			->get($this->MProduct->table)
			->result_array();

		return $invoice;
	}

	public function get_product_invoice($id){
		return $this->db->select($this->MProduct->table.".*")
				->join($this->MOrderItem->table,$this->MOrderItem->table.".product_id = ".$this->MProduct->table.".id")
				->join($this->table,$this->table.".id = ".$this->MOrderItem->table.".invoice_id")
				->where($this->MOrderItem->table.'.status','invoice')
				->where($this->table.'.id',$id)
				->get($this->MProduct->table)
				->result_array();
	}

	public function get_history_invoice(){
		$invoice = [];
    
	    $invoice["invoice_link"] = Null;

    	$page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
      		? ((intval($this->input->get('page'))*10)-10) 
      		: 0;

      	$invoice["invoice"] = $this->db
     			->where("user_id",$this->LSession->user()['id'])
     			->order_by('id','desc')
     			->get($this->table,10,$page)
     			->result_array();
   
    	$pagiQueryCount = $this->db
    			->where("user_id",$this->LSession->user()['id'])
     			->order_by('id','desc')
      			->count_all_results($this->table);    
    
    	if($pagiQueryCount > 10){
      		$this->pagination->initialize([
        		"total_rows" => $pagiQueryCount,
        		"per_page" => 10, 
      		]);       

      		$invoice['invoice_link'] = $this->pagination->create_links();   
    	}

    	foreach ($invoice['invoice'] as $key => $item) {
    		$invoice['invoice'][$key]['product'] = $this->db->select($this->MProduct->table.".*")
				->join($this->MOrderItem->table,$this->MOrderItem->table.".product_id = ".$this->MProduct->table.".id")
				->join($this->table,$this->table.".id = ".$this->MOrderItem->table.".invoice_id")
				->where($this->MOrderItem->table.'.status','invoice')
				->where($this->table.'.user_id',$this->LSession->user()['id'])
				->where($this->table.'.id',$item['id'])
				->get($this->MProduct->table)
				->result_array();

    		$invoice['invoice'][$key]['manual_payment'] = $this->db
    			->where('invoice_id',$item['id'])
    			->where('user_id',$this->LSession->user()['id'])
    			->get($this->MManualPayment->table)
    			->result_array();
    	}

    	return $invoice;
	}

	/* CRONJOB MODEL */
	public function cronjob_backing_stuff(){		
        $this->db->update($this->table,[
        	"status" => "backing stuff"
        ],[
        	"status" => "in rent",
        	"status_payment" => "paid",
        	"end_rent <" => $this->LCarbon->now()->toDateTimeString()
        ]);
	}

	public function cronjob_expired_invoice(){		
        $this->db->update($this->table,[
        	"status" => "expired invoice"
        ],[
        	"end_rent <" => $this->LCarbon->now()->addDays(-1)->toDateTimeString(),
        	"status_payment" => "paid",
        	"status" => "backing stuff"
        ]);
	}

	public function cronjob_expired_payment(){	       
        $invoice = $this->db->where("status","payment")
        	->where("status_payment","unpaid")
        	->where("expired_payment <",$this->LCarbon->now()->toDateTimeString())
        	->get($this->table,300,0)
        	->result_array();

        foreach ($invoice as $itemInvoice) {
        	$this->db->trans_start();

	        	$this->db->update($this->table,[
	        		"status" => "expired payment",
	        		"status_payment" => "expired"
	        	],[
	        		"id" => $itemInvoice['id']
	        	]);

				$orderItem = $this->db->select($this->MProduct->table.".*")
				->join($this->MOrderItem->table,$this->MOrderItem->table.".product_id = ".$this->MProduct->table.".id")
				->join($this->table,$this->table.".id = ".$this->MOrderItem->table.".invoice_id")
				->where($this->MProduct->table.".status_rent",true)
				->where($this->MOrderItem->table.'.status','invoice')
				->where($this->table.'.id',$itemInvoice['id'])
				->get($this->MProduct->table)
				->result_array();

                foreach ($orderItem as $itemOrderItem) {
                	$this->db->update($this->MProduct->table,[
                		"status_rent" => 0
                	],[
                		"id" => $itemOrderItem['id']
                	]);                
                }

                $this->db->update($this->MManualPayment->table,[
                	"status" => "failed",
                	"status_description" => "Kadaluarsa Pembayaran"
                ],[
                	"status" => "validasi",
                	"invoice_id" => $itemInvoice['id']
                ]);

           $this->db->trans_complete();
        }
	}
	/* CRONJOB MODEL */
}