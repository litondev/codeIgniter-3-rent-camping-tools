<div class="col-md-6 col-lg-6 col-sm-12">
	<h6>Slider Home Page</h6>   
  <br>
	<div class="owl-carousel owl-theme" 
    id="slider-home-page">
    <?php foreach ($slider as $item) { ?>    
      <div class="item cursor-pointer" 
        onclick="window.open('<?php echo $item['link'];?>')">
        <img 
          src="<?php echo base_url('assets/images/sliders/'.$item['image']);?>" 
          class="img-fluid">
      </div>	                       
    <?php } ?>
    </div>
</div>