<div class="col-12">
	<div class="card shadow mb-4">      
    	<div class="card-body">
    		<h5>Riwayat Pembayaran Manual Invoice</h5>

    		<hr/>

    		<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">		    			
    				<tr>
    					<td>Id</td>
    					<td>Bukti</td>
    					<td>Deskripsi</td>
    					<td>Status</td>
    					<td>Dikirim</td>
    				</tr>
    				<?php foreach($historyManualPayment as $item){ ?>
    				<tr>
    					<td>
    						<a href="<?php echo site_url();?>/admin/manual-payment/detail/<?php echo $item['id'];?>">
                                <?php echo $item['id'];?>
                            </a>
    					</td>
    					<td>
    						<a href="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" target="_blank">
									<img src="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" height="50px">	          	
								</a>
    					</td>
    					<td><?php echo $item['description'];?></td>
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
    				</tr>
                    <?php } ?>
    			</table>
    		</div>	        		
    	</div>
    </div>
</div>