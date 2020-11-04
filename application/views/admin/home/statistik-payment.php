<div class="col-md-6 col-lg-6 col-sm-12">
		<div class="card shadow mb-4">      
    	<div class="card-body">
  			<h5>Statistik 5 Pembayaran Terakhir</h5>
  			<hr/>
  			<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">
    				<tr>
    					<td><b>Id</b></td>	        					
    					<td><b>Status</b></td>
    				</tr>	      
    				<?php foreach($manual_payment as $item){ ?>
        				<tr>
        					<td>
                                <?php 
                                    echo $item['id'];
                                ?>        				
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
        				</tr>
    				<?php } ?>

                    <?php if(!count($manual_payment)){ ?>
        				<tr>
        					<td colspan="2" class="text-center">
        						<h5>Tidak ditemukan</h5>
        					</td>
        				</tr>
    				<?php } ?>

    				<?php if(count($manual_payment)){ ?>
    				<tr>
    					<td colspan="2">
    						<div class="float-right">
    							<a href="<?php echo site_url();?>/admin/manual-payment">
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