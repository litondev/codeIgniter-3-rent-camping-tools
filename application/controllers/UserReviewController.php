<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserReviewController extends CI_Controller{
	public function reviewProduct(){
    $this->form_validation->set_rules(
      'star','Bintang','required|integer',[
        'required' => '%s harus diisi',
        'integer' => '%s tidak valid'
      ]
    );

    $this->form_validation->set_rules(
      'komentar','Komentar','required',[
        'required' => '%s harus diisi'
      ]
    );

    $this->form_validation->set_rules(
      'product_id','Product Id','required|integer',[
        'required' => '%s harus diisi',
        'integer' => '%s tidak valid'
      ]
    );

    $this->form_validation->set_rules(
      'invoice_id','Invoice Id','required|integer',[
        'required' => '%s harus diisi',
        'integer' => '%s tidak valid'
      ]
    );

    if ($this->form_validation->run() == FALSE){
      $theError = $this->form_validation->error_array();
      $keyArray = array_keys($theError);
      $this->LRedirect->backWith("error",[
        "text" => $theError[$keyArray[0]],
        "title" => "Terjadi Kesalahan"
      ]);
    }

    //   CEK ORDER ITEM
    if(!$this->MOrderItem->first_where([
      'user_id' => $this->LSession->user()['id'],
      'product_id' => $this->input->post('product_id'),
      'invoice_id' => $this->input->post('invoice_id'),
      'status' => 'invoice'
    ])){
      $this->LRedirect->backWith("error",[
        "text" => "Maaf spertinya data ada yang tidak valid",
        "title" => "Terjadi Kesalahan"
      ]); 
    }

    // CEK DI INVOICE 
    if(!$this->MInvoice->first_where([
        'user_id' => $this->LSession->user()['id'],
        'id' => $this->input->post('invoice_id'),                
    ])){
      $this->LRedirect->backWith("error",[
        "text" => "Maaf sepertinya data invoice sudah tidak valid",
        "title" => "Terjadi Kesalahan"
      ]); 
    }

    $this->db->trans_start();

    if($this->MReview->create([
      'user_id' => $this->LSession->user()['id'],
      'product_id' => $this->input->post('product_id'),
      'star' => $this->input->post('star'),
      'komentar' => $this->input->post('komentar')
    ])['success']){
        $ratings = $this->MReview->get_value_total_review($this->input->post('product_id'));

        if(!empty($ratings)){
          $value = intval($ratings['value']);
          $rating = 0;

          $rcount = intval($ratings['total']);

          if($rcount > 0){
            $rating = round(($value/$rcount)); 
          }

          $this->MProduct->update_id($this->input->post('product_id'),[
            "star" => $rating
          ]);
        }

        $this->MNotifAdmin->create([
          "content" => "User ".$this->LSession->user()['first_name']." telah mereview product #".$this->input->post('product_id')
        ]);    

        $this->db->trans_complete();

        $this->LRedirect->redirectWith("success",[
          "title" => "Berhasil",
          "text" => "Berhasil memberi review"
        ],"/product/".$this->input->post('product_id')."?productDetail=komentar");               
    }

    $this->LRedirect->backWith("error",[
      "title" => "Terjadi Kesalahan",
      "text" => "Gagal memberi review"
    ]);    
	}
}