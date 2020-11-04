<div class="card shadow mb-4">      	
<div class="card-body">	
	<h5>Detail Barang Orderan</h5>

	<hr/>

	<div class="table-responsive">
		<table class="table table-borderless table-hover">
			<tr>
				<td><b>Nama</b></td>
				<td><b>Gambar</b></td>
				<td><b>Harga</b></td>
			</tr>
			<?php foreach($product as $item){ ?>
			<tr>
				<td>
					<a href="<?php echo site_url();?>/admin/product/<?php echo $item['id'];?>"
						target="_blank">
						<?php echo $item['name'];?>
					</a>
				</td>
				<td>
					<a href="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>" target="_blank">
	          			<img src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>" height="50px">	          	
	          		</a>
				</td>
				<td><b class='text-success'>
					<?php 
						echo money($item['rent_price']);
					?>
				</b></td>									
			</tr>
			<?php } ?>
		</table>
	</div>						
</div>
</div>