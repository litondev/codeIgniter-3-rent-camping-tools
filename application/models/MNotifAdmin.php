<?php

class MNotifAdmin extends CI_Model{
	public $table = "notif_admins";	

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

	public function get_last_notif($id){
		return $this->db->order_by('id','desc')->get($this->table,3,0)->result_array();
	}
}