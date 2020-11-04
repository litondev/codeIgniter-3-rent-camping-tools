<div class="row p-2">
	<div class="col-12">
		<h6>Kategori Product </h6>
	</div>			

	<?php foreach ($category as $item) { ?>			
	<div class="mt-3 mb-3 pt-3 pb-3 kategori-product cursor-pointer text-dark"
		id="kategori-<?php echo $item['id'];?>"
	    onclick="window.location='<?php echo site_url();?>/product?category=<?php echo $item['name'];?>'">
    	<div class="text-center">
    		<img src="<?php echo base_url('assets/images/categories/'.$item['image']);?>" class="img-fluid">
    	</div>
		<div class="text-center">
			<b><?php echo $item['name'];?></b>
		</div> 	
	</div>	
	<?php } ?>
</div>