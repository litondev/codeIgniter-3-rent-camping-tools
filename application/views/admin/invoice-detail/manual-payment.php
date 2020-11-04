<div class="col-12">
	<div class="card shadow mb-4">      					
		<div class="card-body">
			<h5>Pembayaran Manual</h5>

			<hr/>

			<table class="table table-borderless table-hover">
				<tr>
					<td>Id</td>
					<td>Status</td>
					<td>Deskripsi</td>
					<td>Bukti</td>
					<td>Dikirim</td>
				</tr>
				<?php foreach($manualPayment as $item){ ?>
				<tr>
					<td>
						<a href="<?php echo site_url();?>/admin/manual-payment/detail/<?php echo $item['id'];?>">
							<?php echo $item['id'];?>
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
					<td><?php echo $item['description'];?></td>
					<td>
						<a href="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" target="_blank">
							<img src="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" width="50px">
						</a>
					</td>
					<td>
						<?php echo $item['created_at'];?>
					</td>
				</tr>
				<?php } ?>

				<?php if(!count($manualPayment)){ ?>
				<tr>
					<td colspan="100" class="text-center">
						Data tidak ditemukan
					</td>
				</tr>
				<?php } ?>							
			</table>
		</div>
	</div>
</div>