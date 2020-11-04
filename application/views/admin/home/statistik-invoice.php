<div class="col-md-6 col-lg-6 col-sm-12">
	<div class="card shadow mb-4">      
	<div class="card-body">
			<h5>Statistik 5 Invoice Terakhir</h5>
			<hr/>
			<div class="table-responsive mt-2">
			<table class="table table-borderless table-hover">
				<tr>
					<td><b>Id</b></td>	        					
					<td><b>Status</b></td>
				</tr>	

				<?php foreach($invoice as $item){ ?>
    				<tr>
    					<td>
    						<?php 
                                echo $item['id'];
                            ?>
    					</td>
    					<td>
    						<?php if($item['status'] == 'pending'){ ?>
    						<span class="badge badge-warning">
    							Pending
    						</span>
    						<?php }elseif($item['status'] == 'payment'){ ?>
    						<span class="badge badge-primary">
    							Pembayaran
    						</span>
    						<?php }elseif($item['status'] == "canceled"){ ?>
    						<span class="badge badge-danger">
    							Batal
    						</span>
    						<?php }elseif($item['status'] == "completed"){ ?>
    						<span class="badge badge-success">
    							Selesai
    						</span>
    						<?php }elseif($item['status'] == "prepare"){ ?>
    						<span class="badge badge-primary">
    							Persiapan
    						</span>
    						<?php }elseif($item['status'] == "rejected"){ ?>
    						<span class="badge badge-danger">
    							Ditolak
    						</span>
    						<?php }elseif($item['status'] == "expired invoice"){ ?>
    						<span class="badge badge-danger">
    							Kadaluarsa Invoice
    						</span>
    						<?php }elseif($item['status'] == "expired payment"){ ?>
    						<span class="badge badge-danger">
    							Kadaluarsa Pembayaran
    						</span>
    						<?php }elseif($item['status'] == "in rent"){ ?>
    						<span class="badge badge-success">
    							Dalam Penyewaan
    						</span>
    						<?php }elseif($item['status'] == "withdrawing stuff"){ ?>
    						<span class="badge badge-success">
    							Pengambilan Barang
    						</span>
    						<?php }elseif($item['status'] == "backing stuff"){ ?>
    						<span class="badge badge-success">
    							Pengembalian Barang
    						</span>
    						<?php } ?>
    					</td>
    				</tr>
				<?php } ?>

                <?php if(!count($invoice)){ ?>
    				<tr>
    					<td colspan="2" class="text-center">
    						<h5>Tidak ditemukan</h5>
    					</td>
    				</tr>
				<?php } ?>

				<?php if(count($invoice)){ ?>
				<tr>
					<td colspan="2">
						<div class="float-right">
							<a href="<?php echo site_url();?>/admin/invoice">
								Lihat Semuanya
							</a>
						</div>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		</div>
	</div>
</div>