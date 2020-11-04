<?php

class MWishlist extends CI_Model{
	public $table = "wishlists";		

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

	public function get_new_wishlist(){
		  return $this->db->select($this->table.'.product_id,'.$this->MProduct->table.'.*')
  			->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->table.".product_id")
  			->group_by($this->table.'.product_id')
  			->order_by($this->MProduct->table.'.id','desc')
  			->get($this->table,5,0)
  			->result_array();
  }

  public function get_user_wishlist(){
    $wishlist = [];
    
    $wishlist["wishlist_link"] = Null;

    $page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
      ? ((intval($this->input->get('page'))*9)-9) 
      : 0;

    $wishlist["wishlist"] = $this->db
      ->select($this->table.".product_id,".$this->table.".user_id,".$this->table.".id as wishlist_id,".$this->MProduct->table.".*")
      ->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->table.".product_id")
      ->where($this->table.".user_id",$this->LSession->user()['id'])
      ->order_by($this->table.'.id','desc')
      ->get($this->table,9,$page)
      ->result_array();

    $pagiQueryCount = $this->db->select($this->table.".product_id,".$this->table.".user_id,".$this->MProduct->table.".*")
      ->join($this->MProduct->table,$this->MProduct->table.".id = ".$this->table.".product_id")      
      ->where($this->table.'.user_id',$this->LSession->user()['id'])
      ->order_by($this->table.'.id','desc')
      ->count_all_results($this->table);    
    
    if($pagiQueryCount > 9){
      $this->pagination->initialize([
        "total_rows" => $pagiQueryCount,
        "per_page" => 9, 
      ]);       

      $wishlist['wishlist_link'] = $this->pagination->create_links();   
    }

    return $wishlist;
  }
}