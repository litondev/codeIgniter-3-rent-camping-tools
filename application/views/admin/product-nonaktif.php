<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Product</h5> 	
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama</th>
	              <th>Gambar</th>
	              <th>Harga</th>
	              <th>Status</th>
	              <th>Status Sewa</th>
	              <th>Bintang</th>
	              <th>Dibuat</th>	             
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($product as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['name'];?></td>
	          		<td class="text-center">
	          			<a href="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>" target="_blank">
	          				<img src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>" height="50px">	          	
	          			</a>
	          		</td>

	          		<td>
	          			<b class="text-success">
	          				<?php echo money($item['rent_price']);?>
	          			</b>
	          		</td>

	          		<td>
	          			<input type="checkbox" data-plugin="switchery" 
	          				onchange="onChangeStatus(event)"
	          				<?php echo $item['status'] == 'aktif' ? 'checked' : '';?>
	          				value="<?php echo $item['id'];?>">
	          		</td>

	          		<td>
	          			<?php if($item['status_rent']){ ?>
	          				<b class="text-danger">
	          					Tersewa
	          				</b>
	          			<?php } else { ?>
	          				<b class="text-success">
	          					Blm Tersewa
	          				</b>
	          			<?php } ?>
	          		</td>	 
	          		         	
	          		<td>
	          			<?php if($item['star'] == 1){ ?>
	          				<b class="text-danger">
	          					1 
	          				</b>
	          			<?php }elseif($item['star'] == 2){ ?>
	          				<b class="text-danger">
	          					2
	          				</b>
	          			<?php }elseif($item['star'] == 3){ ?>
							<b class="text-warning">          			
								3 
							</b>
	          			<?php }elseif($item['star'] == 4){ ?>
	          				<b class="text-info">
	          					4
	          				</b>
	          			<?php }elseif($item['star'] == 5){ ?>
							<b class="text-success">
								5 
							</b>
	          			<?php }elseif($item['star'] == 0){ ?>
	          				<b class="text-dark">
	          					Blm Ada
	          				</b>
	          			<?php } ?>
	          		</td>

	          		<td>
	          			<?php echo $item["created_at"];?>
	          		</td>

	          		<td>
	          			<button class="btn btn-success mt-1"
	          				onclick="window.location='<?php echo site_url();?>/admin/product/<?php echo $item['id'];?>'">	          				
	          				<i class="fa fa-edit"></i> Edit
	          			</button>	           		
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($product)){ ?>
	          	<tr>
	          		<td colspan="100" class="text-center">
	          			<h5>Data tidak ditemukan</h5>
	          		</td>
	          	</tr>
	          	<?php } ?>
	          </tbody>	         
	        </table>

	        <div class="p-3">
				<nav class="float-right paginate-overflow pagination">						
					<?php 
						echo $product_link;
					?>
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
</div>

<!-- SEARCH WITH DATERANGE PICKER -->
<script>
$('#search-created-at').daterangepicker({
	timePicker: true,	
}).on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:00'));  		      
	$(this)[0].form.submit();
}).on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
}).on("outsideClick.daterangepicker",function(ev,picker){
  $(this).val('');
});

$("#search-created-at").val("<?php echo $this->input->get('search_created_at') ?? '';?>");
</script>

<script>
function onChangeStatus(event){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();

	if(event.target.checked){
 		window.location = "<?php echo site_url();?>/admin/product/"+event.target.value+"/aktif";
	}else{
		window.location = "<?php echo site_url();?>/admin/product/"+event.target.value+"/nonaktif";
	}
}
</script>