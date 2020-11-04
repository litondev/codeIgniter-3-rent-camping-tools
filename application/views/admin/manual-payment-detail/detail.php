<div class="col-12">
		<div class="card shadow mb-4">      
    	<div class="card-body">
    		<h5>Detil Pembayaran Manual #<?php echo $manualPayment['id'];?></h5>

    		<hr/>

    		<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">		    			
    				<tr>
    					<td>Bukti</td>
    					<td>Deskripsi</td>
    					<?php if($manualPayment['status_description']){ ?>
    						<td>Status Deskripsi</td>
    					<?php } ?>
    					<td>Status</td>
    					<td>Dikirim</td>
    				</tr>
    				<tr>
    					<td>
    						<a href="<?php echo base_url('assets/images/proofs/'.$manualPayment['proof']);?>" target="_blank">
								<img src="<?php echo base_url('assets/images/proofs/'.$manualPayment['proof']);?>" height="50px">	          	
							</a>
    					</td>
    					<td><?php echo $manualPayment['description'];?></td>
    					<?php if($manualPayment['status_description']){ ?>			        				
    						<td><?php echo $manualPayment['status_description'];?></td>
    					<?php } ?>
    					<td>
    						<?php if($manualPayment['status'] == 'validasi'){ ?>
								<span class="badge badge-primary">
									Validasi
								</span>
		          			<?php }elseif($manualPayment['status'] == 'failed'){ ?>
		          				<span class="badge badge-danger">
		          					Gagal
		          				</span>
		          			<?php }elseif($manualPayment['status'] == 'success'){ ?>
		          				<span class="badge badge-success">
		          					Berhasil
		          				</span>
		          			<?php } ?>	    
    					</td>
    					<td><?php echo $manualPayment['get_human_created_at'];?></td>
    				</tr>
    				<tr>
    					<td colspan="10" class="text-center">
    						<?php if($invoice['status_payment'] == 'unpaid' && $invoice['status'] == 'payment' && $manualPayment['status'] == "validasi"){ ?>
    							<hr/>
    							<button class="btn btn-primary"
    								onclick="window.location='<?php echo site_url();?>/admin/manual-payment/success/<?php echo $manualPayment['id'];?>';this.disabled = true">
    								<i class="fa fa-check"></i> 
    								Tandai Berhasil
    							</button>
    							<button class="btn btn-danger"
    								data-toggle="modal"
    								data-target="#modal-reason-failed">
    								<i class="fa fa-times"></i> 
    								Tandai Gagal
    							</button>
    						<?php } ?>
    					</td>
    				</tr>
    			</table>
    		</div>	        		
    	</div>
    </div>
</div>