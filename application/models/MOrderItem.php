<?php
class MOrderItem extends CI_Model{
	public $table = "order_items";	

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

	public function get_cart_count($user_id){
		return count($this->MBase->get_parameter([
			"user_id" => $user_id,
			"status" => "cart"
		],$this->table,$this));
	}

	public function get_most_rent(){
		return $this->db->select($this->table.'.product_id,'.$this->table.'.invoice_id,'.$this->MProduct->table.'.*')
	       	->join($this->MInvoice->table,$this->MInvoice->table.".id = ".$this->table.".invoice_id")
       		->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->table.".product_id")
       		->where($this->MInvoice->table.'.status_payment','paid')
       		->where($this->table.".status","invoice")
       		->order_by($this->table.'.id','desc')
       		->get($this->table,15,0)
        	->result_array();    
	}

	public function get_user_cart(){
		return $this->db->select($this->MProduct->table.".*,".$this->table.".id as order_item_id")		
		->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->table.".product_id")
		->where([
			$this->table.".user_id" => $this->LSession->user()['id'],
			$this->table.'.status' => 'cart'
		])
		->get($this->table)
		->result_array();
	}
}