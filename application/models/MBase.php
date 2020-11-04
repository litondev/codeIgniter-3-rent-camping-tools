<?php

/* 
	MBase digunakan sebagai model yang menampung query yang sering digunakan
*/
	
class MBase{
	// MENGAMBIL SEMUA DATA
	public function all($table,$self){
		return $self->db->get($table)->result_array();
	}

	// MENGAMBIL DENGAN PARAMETER
	public function get_parameter($parameter,$table,$self){
		return $self->db->get_where($table,$parameter)
		->result_array();
	}

	// MEMBUAT DATA
	public function create($data,$table,$self){
		$data["created_at"] = $self->LCarbon->now()->toDateTimeString();
		$data["updated_at"] = $self->LCarbon->now()->toDateTimeString();

		if(intval($self->db->insert($table,$data))){	
			return [
				"success" => true,
				"data" => $this->first($self->db->insert_id(),$table,$self)
			];
		}else{
			return [
				"success" => false
			];
		}
	}

	// UPDATE DENGAN ID
	public function update($id,$data,$table,$self){		
		$data["updated_at"] = $self->LCarbon->now()->toDateTimeString();

		if(intval($self->db->update($table,$data,[
			"id" => $id
		]))){
			return [
				"success" => true,
				"data" => $this->first($id,$table,$self)
			];
		}else{
			return [
				"success" => false
			];
		}
	}

	// DELETE DENGAN ID
	public function delete($id,$table,$self){
		$first = $this->first($id,$table,$self);

		if(intval($self->db->delete($table,[
			"id" => $id
		]))){
			return [
				"success" => true,
				"data" => $first
			];
		}else{
			return [
				"success" => false
			];
		}
	}

	// FIRST DENGAN ID
	public function first($id,$table,$self){
		$theData = $self->db->where("id",$id)
			->get($table)
			->result_array();

		if(count($theData) == 1){
			$theData[0]['get_human_updated_at'] = $self->LCarbon->parse($theData[0]['updated_at'])->diffForHumans();   
			$theData[0]["get_human_created_at"] = $self->LCarbon->parse($theData[0]['created_at'])->diffForHumans();   

			return $theData[0];
		}else{
			return Null;
		}
	}

	// FIRST DENGAN PARAMETER
	public function firstParameter($parameter,$table,$self){
		$theData = $self->db->get_where($table,$parameter)		
			->result_array();

		if(count($theData) == 1){
			$theData[0]['get_human_updated_at'] = $self->LCarbon->parse($theData[0]['updated_at'])->diffForHumans();    
			$theData[0]["get_human_created_at"] = $self->LCarbon->parse($theData[0]['created_at'])->diffForHumans();   

			return $theData[0];
		}else{
			return Null;
		}
	}

	// UPDATE DENGAN PARAMETER
	public function updateParameter($parameter,$data,$table,$self){
		$data["updated_at"] = $self->LCarbon->now()->toDateTimeString();
		
		if(intval($self->db->update($table,$data,$parameter))){
			return [
				"success" => true,
				"data" => $this->firstParameter($parameter,$table,$self)
			];
		}else{
			return [
				"success" => false
			];
		}
	}

	// DELETE DENGAN PARAMETER 
	public function deleteParameter($parameter,$table,$self){
		$first = $this->firstParameter($parameter,$table,$self);

		if(intval($self->db->delete($table,$parameter))){
			return [
				"success" => true,
				"data" => $first
			];
		}else{
			return [
				"success" => false
			];
		}
	}
}