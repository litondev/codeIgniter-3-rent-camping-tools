<?php

class MReview extends CI_Model{
	public $table = "reviews";	

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

  	public function get_value_total_review($id){
  		return $this->db->select("sum(star) as value,count(*) as total")
          ->where('product_id',$id)
          ->get($this->table)
          ->result_array()[0];
  	}

	public function get_product_review($id_product){
		$komentar = [];		

		$komentar["page"] =  !empty($this->input->get('page')) && $this->input->get('page') != '0' 
			? ((intval($this->input->get('page'))*10)-10) 
			: 0;	

		$komentar['data'] = $this->db
			->select($this->table.".*,".$this->MUser->table.".first_name")
			->join($this->MUser->table,$this->MUser->table.".id = ".$this->table.".user_id")
			->where("product_id",$id_product)
			->get($this->table,10,$komentar['page'])
			->result_array();	

		$komentar['pagiQueryCount'] = $this->db->where("product_id",$id_product)
			->count_all_results($this->table);		
			
		$komentar['link'] = Null;		

		if($komentar['pagiQueryCount'] > 10){
			$this->pagination->initialize([
				"total_rows" => $komentar['pagiQueryCount'],
		 		"per_page" => 10,	
			]);

			$komentar['link'] = $this->pagination->create_links();		
		}

		return $komentar;
	}
}