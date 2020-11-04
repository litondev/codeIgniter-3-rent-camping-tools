<div class="row">
  <div class="col-12">
    <?php if(count($mostRent)){  ?>
	  <h6>Product Tersewa Terbanyak </h6>   
    <br>
    <?php } ?>
    
	  <div class="owl-carousel owl-theme mx-auto p-4" 
     id="product-most-rent">
     <?php foreach($mostRent as $item){ ?>
      <div class="item cursor-pointer" 
        onclick="window.location='<?php echo site_url();?>/product/<?php echo $item['id'];?>'">
          <div class="text-center">
            <img class="img-fluid"
              src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>"
              style="height:170px;width:185px;margin:auto">
          </div>

      	 <div class="text-center mt-2">
      	 	<b><?php echo $item['name'];?></b>
      	 </div>
      </div>                   
      <?php } ?>
    </div>
  </div>
</div>