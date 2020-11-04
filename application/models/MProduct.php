<?php

class MProduct extends CI_Model{
	public $table = "products";	
	
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

	public function count_wishlist($id){
		return $this->db->where(["product_id" => $id])->count_all_results($this->MWishlist->table);
	}

	public function count_review($id){
		return $this->db->where(["product_id" => $id])->count_all_results($this->MReview->table);
	}

	public function get_new_product(){
		return $this->db->where('status','aktif')
  			->order_by('id','desc')  	
  			->get($this->table,16,0)
  			->result_array();
	}

	public function get_product_relevan($category_id,$product_id){
		return $this->db->where("category_id",$category_id)
			->order_by('id','desc')
			->where_not_in('id',[$product_id])
			->get($this->table,4,0)
			->result_array();
	}
}