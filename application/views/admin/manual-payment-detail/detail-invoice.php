<div class="card shadow mb-4">      
<div class="card-body">
 <h5>Detail Invoice #<?php echo $manualPayment['invoice_id'];?></h5>

 <hr/>

 <div class="table-responsive mt-2">
  <table class="table table-borderless table-hover">		    						        				
	<tr>
	 <td>Invoice</td>
	 <td>
	  <a href="<?php echo site_url();?>/admin/invoice/detail/<?php echo $manualPayment['invoice_id'];?>">
		<?php echo $manualPayment['invoice_id'];?>
	  </a>
	 </td>
	</tr>
	<tr>
	 <td>Total Bayar</td>
	 <td>
	       <b class="text-success">
	       		<?php echo money($invoice['total']);?>
	       </b>
	 </td>
	</tr>
	<tr>
	 <td>Awal Rental</td>
	 <td>
	       <b>
	       	<?php 
	       		echo $invoice['start_rent'];
	       	?>	   
	       </b>
	 </td>
	</tr>
	<tr>
	 <td>Akhir Rental</td>
	 <td>
		<b>
			<?php 
	       		echo $invoice['end_rent'];
	       	?>
		</b>
	 </td>
	</tr>
	<tr>
	 <td>Kadaluarsa Pembayaran</td>
	 <td>
		<b>
			<?php 
	       		echo $invoice['expired_payment'];
	       	?>
		</b>
	 </td>
	</tr>
	<tr>
	 <td>Status</td>
	 <td>
	    <?php if($invoice['status'] == "pending"){ ?>
 		<b class="badge badge-warning text-light">
 			Pending
 		</b>
 		<?php }elseif($invoice['status'] == "payment"){ ?>
 		<b class="badge badge-primary text-light">
 			Pembayaran
 		</b>
 		<?php }elseif($invoice['status'] == "prepare"){ ?>
 		<b class="badge badge-primary text-light">
 			Persiapan
 		</b>
 		<?php }elseif($invoice['status'] == "withdrawing stuff"){ ?>
 		<b class="badge badge-success text-light">
 			Pengambilan Barang
 		</b>
 		<?php }elseif($invoice['status'] == "in rent"){ ?>
 		<b class="badge badge-success text-light">
 			Dalam Penyewaan
 		</b>
 		<?php }elseif($invoice['status'] == "backing stuff"){ ?>
 		<b class="badge badge-success text-light">
 			Pengembalian Barang
 		</b>
 		<?php }elseif($invoice['status'] == "completed"){ ?>
 		<b class="badge badge-success text-light">
 			Selesai
 		</b>
 		<?php }elseif($invoice['status'] == "rejected"){ ?>
 		<b class="badge badge-danger text-light">
 			Ditolak
 		</b>
 		<?php }elseif($invoice['status'] == 'canceled'){ ?>
 		<b class="badge badge-danger text-light">
 			Dibatalkan
 		</b>
 		<?php }elseif($invoice['status'] == 'expired payment'){ ?>
 		<b class="badge badge-danger text-light">
 			Kadaluarsa Pembayaran
 		</b>
 		<?php }elseif($invoice['status'] == 'expired invoice'){ ?>
 		<b class="badge badge-danger text-light">
 			Kadaluarsa Invoice
 		</b>
 		<?php } ?>
	 </td>
	</tr>

	<tr>
	 <td>Status Pembayaran</td>
	 <td>
		<?php if($invoice['status_payment'] == 'unpaid'){ ?>
		 <b class="badge badge-danger">Belum Bayar</b>
		<?php }elseif($invoice['status_payment'] == 'paid'){ ?>
		 <b class="badge badge-success">Dibayar</b>
		<?php }else{ ?>
		 <b class="badge badge-danger">Kadaluarsa Pembayaran</b>
		<?php } ?>
	 </td>
	</tr>

	<tr>
	 <td colspan="2" class="text-center">
		<?php if($invoice['status_payment'] == 'unpaid' && $invoice['status'] == 'payment' && $isThreeValidasi == 0){ ?>
			<button class="btn btn-success mt-3" 			        								
				onclick="window.location='<?php echo site_url();?>/admin/manual-payment/paid/<?php echo $manualPayment['invoice_id'];?>';this.disabled = true">
				<i class="fa fa-check"></i> 
				Tandai Sudah Bayar
			</button>
			<br>
			<small class="text-primary">
				* Tandai Sudah Bayar Akan Mengubah Status Invoice Menjadi Persiapan
			</small>
		<?php }else{ ?>
			<?php if($invoice['status'] == 'payment'){ ?>
				<small class="text-primary">
					* Button tandai sudah bayar akan muncul ketika tidak ada status validasi pada pembayaran manual
				</small>
			<?php } ?>
		<?php } ?>
	 </td>
	</tr>
  </table>
 </div>		    			
</div>
</div>