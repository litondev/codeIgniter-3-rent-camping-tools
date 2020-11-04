<?php

class MNotif extends CI_Model{
	public $table = "notifs";		

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
	
	public function get_user_notif(){
		$notif = [];
		
		$notif["notif_link"] = Null;

		$page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
			? ((intval($this->input->get('page'))*10)-10) 
			: 0;

		$notif["notif"] = $this->db->where("user_id",$this->LSession->user()['id'])
			->order_by('id','desc')
			->get($this->table,10,$page)
			->result_array();

		$pagiQueryCount = $this->db->where('user_id',$this->LSession->user()['id'])
			->order_by('id','desc')
			->count_all_results($this->table);		
		
		if($pagiQueryCount > 10){
			$this->pagination->initialize([
				"total_rows" => $pagiQueryCount,
				"per_page" => 10,	
			]);				

			$notif['notif_link'] = $this->pagination->create_links();		
		}

		return $notif;
	}
}