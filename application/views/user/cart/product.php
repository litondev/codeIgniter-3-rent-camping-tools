<?php foreach($cart as $item){ ?>
<div class="col-12 p-3 box-camp mt-4">					
	<div class="row p-2">				
		<div class="list-product-checkbox">
			<input 
				type="checkbox" 
				onclick="clickCheckout(event,'<?php echo $item['order_item_id'];?>')"
				value="<?php echo $item['order_item_id'];?>"
				class="list-cart-checkbox">
		</div>

		<div class="list-product-image">							
			<img 
	            src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>"
				class="img-fluid">
		</div>

		<div class="col-md-8 col-lg-8 col-sm-12">
			<div class="ft-13 mt-2">
				<a href="<?php echo site_url();?>/product/<?php echo $item['id'];?>" class="text-dark">
					<b><?php echo $item['name'];?></b>
				</a>
			</div>

			<div class="ft-12 mt-2">
				<?php if($item['status_rent']){ ?>
					<span class="badge badge-danger">Tersewa</span>	
				<?php }else { ?>
					<span class="badge badge-success">Belum Tersewa</span>	
				<?php } ?>
			</div>

			<div class="ft-13 mt-2">
				<b style="color:green">
					<?php echo money($item['rent_price']);?>
				</b>
			</div>
			<div class="mt-3">
				<button class="btn btn-danger mt-2" 
					onclick="deleteData('<?php echo $item['order_item_id'];?>')">
					<i class="fa fa-trash"></i> Hapus
				</button>			
			</div>
		</div>
	</div>
</div>
<?php } ?>