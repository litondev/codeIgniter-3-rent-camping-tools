<div class="col-md-6 col-lg-6 col-sm-12">
	<h6>Product Favorite Terbaru </h6> 

  <br>
  
	<div class="owl-carousel owl-theme" 
  id="product-favorite">
    <?php foreach ($wishlist as $item) { ?>    
    <div class="item cursor-pointer product-favorite-item"
      onclick="window.location='<?php echo site_url();?>/product/<?php echo $item['id'];?>'">	            	
    	<div class="product-favorite-inside-item" style="height:110px">
        <img style="height:60%;width:auto;min-width:60%;margin:auto"
          src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>">      

    		<span><?php echo $item['name'];?></span> 

        <br><br>

        <?php if($item['status_rent']){ ;?>
          <span class="text-danger">Tersewa</span>             
        <?php }else{ ?>
          <span class="text-success">Belum Tersewa</span>             
        <?php } ?>
    	</div>
    </div>	                 
    <?php } ?>
	</div>
</div>