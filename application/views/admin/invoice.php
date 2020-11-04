<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Invoice</h5> 
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>User Nama</th>
	              <th>Status</th>
	              <th>Status Pembayaran</th>
	              <th>Total</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($invoice as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['first_name'];?></td>
	          		<td>
	          			<?php if($item['status'] == "pending"){ ?>
				 		<b class="badge badge-warning text-light">
				 			Pending
				 		</b>
				 		<?php }elseif($item['status'] == "payment"){ ?>
				 		<b class="badge badge-primary text-light">
				 			Pembayaran
				 		</b>
				 		<?php }elseif($item['status'] == "prepare"){ ?>
				 		<b class="badge badge-primary text-light">
				 			Persiapan
				 		</b>
				 		<?php }elseif($item['status'] == "withdrawing stuff"){ ?>
				 		<b class="badge badge-success text-light">
				 			Pengambilan Barang
				 		</b>
				 		<?php }elseif($item['status'] == "in rent"){ ?>
				 		<b class="badge badge-success text-light">
				 			Dalam Penyewaan
				 		</b>
				 		<?php }elseif($item['status'] == "backing stuff"){ ?>
				 		<b class="badge badge-success text-light">
				 			Pengembalian Barang
				 		</b>
				 		<?php }elseif($item['status'] == "completed"){ ?>
				 		<b class="badge badge-success text-light">
				 			Selesai
				 		</b>
				 		<?php }elseif($item['status'] == "rejected"){ ?>
				 		<b class="badge badge-danger text-light">
				 			Ditolak
				 		</b>
				 		<?php }elseif($item['status'] == 'canceled'){ ?>
				 		<b class="badge badge-danger text-light">
				 			Dibatalkan
				 		</b>
				 		<?php }elseif($item['status'] == 'expired payment'){ ?>
				 		<b class="badge badge-danger text-light">
				 			Kadaluarsa Pembayaran
				 		</b>
				 		<?php }elseif($item['status'] == 'expired invoice'){ ?>
				 		<b class="badge badge-danger text-light">
				 			Kadaluarsa Invoice
				 		</b>
				 		<?php } ?>
	          		</td>
	          		<td>
	          			<?php if($item['status_payment'] == 'unpaid'){ ?>
	          				<span class="badge badge-danger">
	          					Belum Dibayar
	          				</span>
	          			<?php }elseif($item['status_payment'] == 'expired'){ ?>
	          				<span class="badge badge-danger">
	          					Kadaluarsa Pembayaran
	          				</span>
	          			<?php } else { ?>
	          				<span class="badge badge-success">
	          					Dibayar
	          				</span>
	          			<?php } ?>
	          		</td>
	          		<td>
	          			<b>
	          				<?php echo money($item['total']);?>
	          			</b>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>
	          			<button class="btn btn-primary"
	          				onclick="window.location='<?php echo site_url();?>/admin/invoice/detail/<?php echo $item['id'];?>'">
	          				<i class="fa fa-info-circle"></i>
	          				Detail
	          			</button>
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($invoice)){ ?>	          	
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
						echo $invoice_link;
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