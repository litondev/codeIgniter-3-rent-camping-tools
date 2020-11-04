<style>
.history-manual-payment-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}
</style>

<?php if(count($historyManualPayment) > 0){ ?>
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center mb-4">
				<h4>Riwayat Pembayaran Manual</h4>
			</div>

			<?php foreach($historyManualPayment as $item){ ?>
				<div class="col-md-4 col-lg-4 col-sm-12 cursor-pointer text-center mt-3 mb-3 history-manual-payment-card p-2">
					<div class="row p-3">
						<div class="col-12">
							<img src="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" class="border-radius-10" 
								width="70px"
								height="70px"
								onclick="window.open('<?php echo base_url('assets/images/proofs/'.$item['proof']);?>')">
							<br>
							<span class="small ft-10">
								*Klik gambar
							</span>
						</div>

						<div class="col-12 mt-2 clearfix">
							<div class="float-left">
								<b class="badge badge-dark">
									Tgl Kirim : <?php echo $item['created_at'];?>
								</b>
							</div>
							<div class="float-right">
								<?php if($item['status'] == "validasi"){ ?>
								<span class="badge badge-primary">Validasi</span>
								<?php }elseif($item['status'] == "success"){ ?>
								<span class="badge badge-success">Success</span>
								<?php }elseif($item['status'] == "failed"){ ?>
								<span class="badge badge-danger">Gagal</span>
								<?php } ?>
							</div>
						</div>

						<div class="col-12 mt-2">
							<button class="btn btn-violet btn-block text-light"
								data-toggle="modal" 
								data-target="#modal-detail-manual-payment-<?php echo $item['id'];?>">
								Detail
							</button>
						</div>
					</div>
				</div>

				<div class="modal no-border" 
					id="modal-detail-manual-payment-<?php echo $item['id'];?>">
					<div class="modal-dialog no-border">
				      <div class="modal-content no-border">        
				      	<div class="modal-header">
				        	<h5 class="modal-title">
				        		Detail Riwayat Pembayaran Invoice #<?php echo $item['invoice_id'];?>
				        	</h5>

				        	<button class="close"
				        		type="button" 					        		
				        		data-dismiss="modal" 
				        		aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				        <div class="modal-body no-border">
				        	<table class="table table-hover">				        		        	
				        		<tr>
				        			<td class="no-border">
				        				Bukti
				        			</td>
				        			<td class="no-border">
				        				<img src="<?php echo base_url('assets/images/proofs/'.$item['proof']);?>" class="border-radius-10 cursor-pointer img-fluid" 										
											onclick="window.open('<?php echo base_url('assets/images/proofs/'.$item['proof']);?>')">
				        			</td>
				        		</tr>
				        		<tr>
				        			<td class="no-border">
				        				Status
				        			</td>
				        			<td class="no-border">			        			
				        				<?php if($item['status'] == "validasi"){?>
										<span class="badge badge-primary">Validasi</span>
										<?php }elseif($item['status'] == "success"){?>
										<span class="badge badge-success">Success</span>
										<?php }elseif($item['status'] == "failed"){?>
										<span class="badge badge-danger">Gagal</span>
										<?php } ?>
				        			</td>
				        		</tr>
				        		<tr>
				        			<td class="no-border">
				        				Keterangan
				        			</td>
				        			<td class="no-border">
				        				<?php echo $item['description'];?>
				        			</td>
				        		</tr>
				        		<?php if($item['status_description']){ ?>
				        		<tr>
				        			<td class="no-border">
				        				Keterangan Balasan
				        			</td>
				        			<td class="no-border">
				        				<?php echo $item['status_description'];?>
				        			</td>
				        		</tr>
				        		<?php } ?>
				        		<tr>
				        			<td class="no-border">
				        				Tgl Kirim
				        			</td>
				        			<td class="no-border">
				        				<?php echo $item['created_at'];?>
				        			</td>
				        		</tr>			       
				        	</table>
				        </div>      
				      </div>
					</div>
				</div>  
			<?php } ?>

			<div class="col-12 p-3">
				<nav class="float-right paginate-overflow pagination">						
					<?php echo $historyManualPayment_link;?>
				</nav>					
			</div>
		</div>
	</div>
<?php }else{ ?>
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center">
				<h4>Riwayat Pembayaran Manual</h4>
			</div>

			<div class="col-12 text-center">
				<img class="img-fluid"
					src="<?php echo base_url('assets/images/not-found.png');?>" 
					width="40%">
					<br>
				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>
					<br>
				<span class="ft-13">
					Riwayat Pembayaran Manual Tidak Ditemukan
				</span>
			</div>
		</div>
	</div> 
<?php } ?>


<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>