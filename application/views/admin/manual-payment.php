<div class="container-fluid">	
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Manual Payment</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>User Nama</th>
	              <th>Invoice Id</th>
	              <th>Bukti</th>
	              <th>Status</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($manualPayment as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['first_name'];?></td>
	          		<td><?php echo $item['invoice_id'];?></td>
	          		<td>
	          			<a href="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" target="_blank">
	          				<img src="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" height="50px">	          	
	          			</a>
	          		</td>
	          		<td>
	          			<?php if($item['status'] == 'validasi'){ ?>
							<span class="badge badge-primary">
								Validasi
							</span>
	          			<?php }elseif($item['status'] == 'failed'){ ?>
	          				<span class="badge badge-danger">
	          					Gagal
	          				</span>
	          			<?php }elseif($item['status'] == 'success'){ ?>
	          				<span class="badge badge-success">
	          					Berhasil
	          				</span>
	          			<?php } ?>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>
	          			<button class="btn btn-primary"
	          				onclick="window.location='<?php echo site_url();?>/admin/manual-payment/detail/<?php echo $item['id'];?>'">
	          				<i class="fa fa-info-circle"></i> Detail
	          			</button>
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($manualPayment)){ ?>
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
						echo $manualPayment_link;
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