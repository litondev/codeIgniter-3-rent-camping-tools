<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProductController extends CI_Controller{
	/* PRODUCT */
	public function product(){	
		$pagi_data = $this->getPagiDataProduct();
		
		$pagi_link = $this->getPagiLinkProduct();
				
		$price = $this->load->view("user/product/price",[],TRUE);

		$category = $this->load->view("user/product/category",[
			"category" => $this->MCategory->get_where([
				"status" => "aktif"
			])
		],TRUE);

		$product = $this->load->view("user/product/product",[
			"pagi_data" => $pagi_data,
			"pagi_link" => $pagi_link
		],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Product"
		]);

		$this->load->view("user/product",[
			"price" => $price,
			"category" => $category,
			"product" => $product
		]);

		$this->LTemplate->footerUser();	
	}

	public function getPagiDataProduct(){		
		$page = !empty($this->input->get('page')) && $this->input->get('page') != '0' 
			? ((intval($this->input->get('page'))*9)-9) 
			: 0;

		$pageQuery = $this->db->select($this->MProduct->table.".*,".$this->MCategory->table.".id as id_category,".$this->MCategory->table.".name as name_category");
		$pageQuery = $pageQuery->join($this->MCategory->table,$this->MCategory->table.".id = ".$this->MProduct->table.".category_id");
		$pageQuery = $this->searchPagiProduct($pageQuery);
		$pageQuery = $pageQuery->get($this->MProduct->table,9,$page)->result_array();					

		return $pageQuery;
	}

	public function getPagiLinkProduct(){
		$pagiQueryCount = $this->db->select($this->MProduct->table.".*,".$this->MCategory->table.".id as id_category,".$this->MCategory->table.".name as name_category");
		$pagiQueryCount = $pagiQueryCount->join($this->MCategory->table,$this->MCategory->table.".id = ".$this->MProduct->table.".category_id");		
		$pagiQueryCount = $this->searchPagiProduct($pagiQueryCount);	
		$pagiQueryCount = $pagiQueryCount->count_all_results($this->MProduct->table);		

		if($pagiQueryCount > 9){
			$this->pagination->initialize([
				"total_rows" => $pagiQueryCount,
				"per_page" => 9,				
			]);				

			return $this->pagination->create_links();		
		}else{
			return "";
		}
	}

	public function searchPagiProduct($pageQuery){	
		if(!empty($this->input->get('search'))){
			$pageQuery = $pageQuery->like($this->MProduct->table.'.name',$this->input->get('search'));
		}
		
		if(!empty($this->input->get('category'))){
			$pageQuery = $pageQuery->like($this->MCategory->table.'.name',$this->input->get('category'));
		}

		if(!empty($this->input->get('price'))){
         	if($this->input->get('price') == "termahal"){
	         	$pageQuery = $pageQuery->order_by($this->MProduct->table.'.rent_price','desc');
         	}else{
	         	$pageQuery = $pageQuery->order_by($this->MProduct->table.'.rent_price','asc');
         	}
      	}else{
      		$pageQuery = $pageQuery->order_by($this->MProduct->table.'.id','desc');
      	}

		$pageQuery = $pageQuery->where($this->MProduct->table.'.status','aktif');

		return $pageQuery;
	}
	/* PRODUCT */
}