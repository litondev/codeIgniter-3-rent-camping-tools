<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserHomeController extends CI_Controller{
	public function index(){
		// SLIDER YANG AKTIF
  		$slider = $this
  			->MSlider
  			->get_where(["status" => "aktif"]);
		$sliderView = $this->load->view("user/home/slider",["slider" => $slider],TRUE);

  	    // KATEGORI YANG AKTIF
  		$category = $this
  			->MCategory
  			->get_where(["status" => "aktif"]);
		$categoryView = $this->load->view("user/home/category",["category" => $category],TRUE);

  	   	// PRODUCT YANG AKTIF   
  		$product = $this
  			->MProduct
  			->get_new_product();
  		$productView = $this->load->view("user/home/product",["product" => $product],TRUE);

  		// DAFTAR KEINGINAN TERBARU      	
  		$wishlist = $this
  			->MWishlist
  			->get_new_wishlist();
  		$wishlistView = $this->load->view("user/home/product-favorite",["wishlist" => $wishlist],TRUE);

  	    // PRODUCT TERSEWA TERBANYAK
       	$mostRent = $this->MOrderItem->get_most_rent();
  		$mostRentView = $this->load->view("user/home/product-most-rent",["mostRent" => $mostRent],TRUE);

		$this->LTemplate->headerUser([
			"title" => "Home"
		]);

		$this->load->view("user/home",[
			"slider" => $sliderView,
			"category" => $categoryView,
			"product" => $productView,
			"mostRent" => $mostRentView,
			"wishlist" => $wishlistView
		]);

		$this->LTemplate->footerUser();
	}
}