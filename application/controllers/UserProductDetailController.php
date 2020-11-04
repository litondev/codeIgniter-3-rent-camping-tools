<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProductDetailController extends CI_Controller{
	public function productDetail($id){
		$product = $this->MProduct->first_id($id);

		if(!$product){
			$this->LRedirect->back();
		}

		// PRODUCT DETAIL 
		$productDetailView = $this->load->view("user/product-detail/product-detail",[],TRUE);

		// PROUDCT DETAIL CONDITION
		$productDetailConditionView = $this->load->view("user/product-detail/product-detail-condition",["product" => $product],TRUE);

		// PRODUCT DETAIL DESCRIPTION
		$productDetailDescriptionView = $this->load->view("user/product-detail/product-detail-description",["product" => $product],TRUE);

		// PRODUCT DETAIL FINE
		$productDetailFineView = $this->load->view("user/product-detail/product-detail-fine",["product" => $product],TRUE);

		// PRODUCT DETAIL QUESTION
		$productDetailQuestionView = $this->load->view("user/product-detail/product-detail-question",["product" => $product],TRUE);
	
		// PRODUCT DETAIL KOMENTAR
		$komentar = $this->MReview->get_product_review($product['id']);
		
		$productDetailKomentarView = $this->load->view("user/product-detail/product-detail-komentar",$komentar,TRUE);

		// PRODUCT RELEVAN
		$productRelevan = $this->MProduct->get_product_relevan($product['category_id'],$product['id']);		
		$productDetailRelevanView = $this->load->view("user/product-detail/product-detail-relevan",["productRelevan" => $productRelevan],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Product Detail"
		]);
	
		$this->load->view("user/product-detail",[
			"productDetail" => $productDetailView,
			"productDetailCondition" => $productDetailConditionView,
			"productDetailDescription" => $productDetailDescriptionView,
			"productDetailFine" => $productDetailFineView,
			"productDetailQuestion" => $productDetailQuestionView,
			"productDetailKomentar" => $productDetailKomentarView,
			"productDetailRelevan" => $productDetailRelevanView,
			"count_wishlist" => $this->MProduct->count_wishlist($id),
			"count_review" => $this->MProduct->count_review($id),
		]);

		$this->LTemplate->footerUser();	
	}
}