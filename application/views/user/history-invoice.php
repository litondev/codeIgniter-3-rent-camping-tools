<style>
.history-invoice-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}

.history-invoice-card:nth-child(even){
	background: rgb(139,21,158,0.1);
	border-radius: 20px;
}
</style>
<?php if(count($invoice) > 0){ ?>
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center mb-4">
				<h4>Riwayat Invoice</h4>
			</div>

			<?php foreach($invoice as $item){ ?>
				<div class="col-12 cursor-pointer mt-3 mb-5 history-invoice-card p-2">
					<div class="row p-3">	
						<div class="col-md-2 col-lg-2 col-sm-12">					
							<img 
								src="<?php echo base_url('assets/images/invoice.png');?>" 
								class="img-fluid">
						</div>

						<div class="col-md-10 col-lg-10 col-sm-12 mt-2">
							<div class="row p-2">
								<div class="col-12">								
									<span class="badge badge-info">
										<b>No Invoice : </b>  #<?php echo $item['id'];?>
									</span>
								</div>

								<div class="col-12 mt-2 ft-12">
									<b>Tgl Order : </b> <?php echo $item['created_at'];?>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 mt-2 ft-12 text-success">
									<b>Tgl Sewa : </b> <?php echo $item['start_rent'];?>
								</div> 

								<div class="col-lg-6 col-md-6 col-sm-6 mt-2 ft-12 text-danger">
									<b>Tgl Sewa Berakhir : </b> <?php echo $item['end_rent'];?>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
									<?php if($item['status'] == "completed"){ ?>
									<b class="badge badge-success">
										Status : Selesai
									</b>
									<?php }elseif( 
										$item['status'] == "expired payment" ||
										$item['status'] == "rejected" || 
										$item['status'] == "canceled" || 
										$item['status'] == "expired invoice"
									){ ?>
									<b class="badge badge-danger">
										Status : 
										<?php if($item['status'] == "expired payment"){ ?>
											Kadaluarasa Pembayaran
										<?php }elseif($item['status'] == "expired invoice"){ ?>
											Kadaluarasa Invoice
										<?php }elseif($item['status'] == "rejected"){ ?>
											Ditolak
										<?php }elseif($item['status'] == "canceled"){ ?>
											Dibatalkan
										<?php } ?>
									</b>
									<?php } elseif($item['status'] == "pending"){ ?>
							 		<b class="badge badge-warning text-light">
							 			Status : Pending
							 		</b>
							 		<?php } elseif($item['status'] == "payment"){ ?>
							 		<b class="badge badge-primary text-light">
							 			Status : Pembayaran
							 		</b>
							 		<?php } elseif($item['status'] == "prepare"){ ?>
							 		<b class="badge badge-primary text-light">
							 			Status : Persiapan
							 		</b>
							 		<?php } elseif($item['status'] == "withdrawing stuff"){ ?>
							 		<b class="badge badge-success text-light">
							 			Status : Pengambilan Barang
							 		</b>
							 		<?php } elseif($item['status'] == "in rent") { ?>
							 		<b class="badge badge-success text-light">
							 			Status : Dalam Penyewaan
							 		</b>
							 		<?php } elseif($item['status'] == "backing stuff"){ ?>
							 		<b class="badge badge-success text-light">
							 			Status : Pengembalian Barang
							 		</b>
							 		<?php } ?>
								</div>	

								<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
									<b class="badge badge-success">
										Total : <?php echo money($item['total']);?>
									</b>
								</div>	

								<div class="col-12 pt-2 mt-2">
									<button class="btn btn-violet text-light mt-2" 
										data-toggle="modal" 
										data-target="#modal-detail-invoice-<?php echo $item['id'];?>">
										Detail Invoice
									</button>

									<button class="btn btn-primary text-light mt-2" 
										data-toggle="modal" 
										data-target="#modal-detail-product-invoice-<?php echo $item['id'];?>">
										Detail Product
									</button>

									<?php if($item['is_fine']){ ?>
									 <button class="btn btn-danger text-light mt-2" 
									 	data-toggle="modal" 
									 	data-target="#modal-detail-fine-invoice-<?php echo $item['id'];?>">
									 	Detail Denda
									 </button>
									<?php } ?>

									<?php if(count($item['manual_payment']) > 0){ ?>
									 <button class="btn btn-success text-light mt-2"
									  data-toggle="modal" 
									  data-target="#modal-detail-manual-payment-<?php echo $item['id'];?>">
									 	Detail Pembayaran
									 </button>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
		
				<div class="modal no-border" 
					id="modal-detail-product-invoice-<?php echo $item['id'];?>">
					<div class="modal-dialog modal-lg no-border">
				      <div class="modal-content no-border">        
				      	<div class="modal-header">
				        	<h5 class="modal-title">
				        		Detail Product Invoice #<?php echo $item['id'];?>
				        	</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				        <div class="modal-body no-border">
				        	<table class="table table-hover">				        		        					        	
				        		<?php foreach($item['product'] as $item_order){ ?>
				        		<tr>
					        		<td class="no-border">
					        			<?php echo $item_order['name'];?>
					        		</td>
					        		<td class="no-border">
					        			<b class="badge badge-success">
					        				<?php echo money($item_order['rent_price']);?>
					        			</b>
					        		</td>
					        		<td class="no-border">
					        			<button class="btn btn-primary" 
					        				onclick="window.location='<?php echo site_url();?>/product/<?php echo $item_order['id'];?>'">
					        				Detail
					        			</button>
					        		</td>
					        	</tr>
					     		<?php } ?>
					        </table>
				        </div>      
				      </div>
					</div>
				</div>

				<div class="modal no-border" 
					id="modal-detail-invoice-<?php echo $item['id'];?>">
					<div class="modal-dialog no-border">
					  <div class="modal-content no-border">        
					  	<div class="modal-header">
					    	<h5 class="modal-title">
					    		Detail Invoice #<?php echo $item['id'];?>
					    	</h5>
					    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					      		<span aria-hidden="true">&times;</span>
					    	</button>
					  	</div>

					    <div class="modal-body no-border">
					    	<table class="table table-hover">				        		        	
					    		<tr>
					    			<td class="no-border">Status</td>

					    			<td class="no-border">
					    				<?php if($item['status'] == "completed"){?>
										<b class="badge badge-success">
											Status : Selesai
										</b>
										<?php }elseif(
					                        $item['status'] == "expired payment" || 
					                        $item['status'] == "rejected" || 
					                        $item['status'] == "canceled" || 
					                        $item['status'] == "expired invoice"
					                    ){ ?>
										<b class="badge badge-danger">
											Status : 
											<?php if($item['status'] == "expired payment"){ ?>
												Kadaluarasa Pembayaran
											<?php }elseif($item['status'] == "expired invoice"){ ?>
												Kadaluarasa Invoice
											<?php }elseif($item['status'] == "rejected"){ ?>
												Ditolak
											<?php }elseif($item['status'] == "canceled"){ ?>
												Dibatalkan
											<?php } ?>
										</b>
										<?php }elseif($item['status'] == "pending"){ ?>
								 		<b class="badge badge-warning text-light">
								 			Status : Pending
								 		</b>
								 		<?php }elseif($item['status'] == "payment"){ ?>
								 		<b class="badge badge-primary text-light">
								 			Status : Pembayaran
								 		</b>
								 		<?php }elseif($item['status'] == "prepare"){ ?>
								 		<b class="badge badge-primary text-light">
								 			Status : Persiapan
								 		</b>
								 		<?php }elseif($item['status'] == "withdrawing stuff"){ ?>
								 		<b class="badge badge-success text-light">
								 			Status : Pengambilan Barang
								 		</b>
								 		<?php }elseif($item['status'] == "in rent"){ ?>
								 		<b class="badge badge-success text-light">
								 			Status : Dalam Penyewaan
								 		</b>
								 		<?php }elseif($item['status'] == "backing stuff"){ ?>
								 		<b class="badge badge-success text-light">
								 			Status : Pengembalian Barang
								 		</b>
								 		<?php } ?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Tgl Order</td>
					    			<td class="no-border">
					    				<?php echo $item['created_at'];?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Total Biaya</td>
					    			<td class="no-border">
										<b class="badge badge-success">
											Total Biaya : <?php echo money($item['total']);?>
										</b>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Tgl Sewa</td>
					    			<td class="no-border text-success">
					    				<?php echo $item['start_rent'];?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Tgl Sewa Berakhir</td>
					    			<td class="no-border text-danger">
					    				<?php echo $item['end_rent'];?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Tgl Expired Pembayaran</td>
					    			<td class="no-border">
					    				<?php echo $item['expired_payment'];?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Pembayaran</td>
					    			<td class="no-border">
					    				<?php if($item['status_payment'] == "unpaid"){ ?>
											<b class="badge badge-danger">Belum Bayar</b>
										<?php }elseif($item['status_payment'] ==  "expired"){ ?>
											<b class="badge badge-danger text-light">Kadaluarsa Pembayaran</b>
										<?php }elseif($item['status_payment'] == "paid"){ ?>
											<b class="badge badge-success text-light">Sudah Bayar</b>
										<?php } ?>
					    			</td>
					    		</tr>

					    		<tr>
					    			<td class="no-border">Jaminan</td>
					    			<td class="no-border">
					    				<b><?php echo $item['guaranteing'];?></b>
					    			</td>
					    		</tr>
					    	</table>
					    </div>      
					  </div>
					</div>
				</div> 

				<div class="modal no-border" 
					id="modal-detail-fine-invoice-<?php echo $item['id'];?>">
					<div class="modal-dialog no-border">
				      <div class="modal-content no-border">        
				      	<div class="modal-header">
				        	<h5 class="modal-title">
				        		Detail Denda Invoice #<?php echo $item['id'];?>
				        	</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				        <div class="modal-body no-border">
				        	<table class="table table-hover">				        		        					        	
				        		<tr>
				        			<td>Denda Description</td>
				        			<td><?php echo $item['fine_description'];?></td>
				        		</tr>
				        		<tr>
				        			<td>Denda Total</td>
				        			<td>
				        				<b class="badge badge-success">
				                  			<?php echo money($item['fine_total']);?>
				                		</b>
				        			</td>
				        		</tr>
					        </table>
				        </div>      
				      </div>
					</div>
				</div>

				<div class="modal no-border" 
					id="modal-detail-manual-payment-<?php echo $item['id'];?>">
					<div class="modal-dialog no-border">
				      <div class="modal-content no-border">        
				      	<div class="modal-header">
				        	<h5 class="modal-title">
				        		Detail Pembayaran Manual Invoice #<?php echo $item['id'];?>
				        	</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				        <div class="modal-body no-border table-responsive">
				        	<table class="table table-hover">				        		        					        	
				        		<?php foreach($item['manual_payment'] as $item_payment){ ?>
				        		<tr>
				        			<td class="no-border">
					        			<?php if($item_payment['status'] == "validasi"){ ?>
										<span class="badge badge-primary">Validasi</span>
										<?php }elseif($item_payment['status'] == "success"){ ?>
										<span class="badge badge-success">Success</span>
										<?php }elseif($item_payment['status'] == "failed"){ ?>
										<span class="badge badge-danger">Gagal</span>
										<?php } ?>
					        		</td>
					        		<td class="no-border">
					        			<?php echo $item_payment['description'];?>
					        		</td>
					        		<td class="no-border">
					        			<?php echo $item_payment['created_at'];?>
					        		</td>
					        		<td class="no-border">
					        			<img src="<?php echo base_url('assets/images/proofs/'.$item_payment['proof']);?>" 
					        				class="border-radius-10 cursor-pointer" 
					        				height="10%"							        												
											onclick="window.open('<?php echo base_url('assets/images/proofs/'.$item_payment['proof']);?>')"/>		      
					        		</td>			
					        	</tr>
					     		<?php } ?>
					        </table>
				        </div>      
				      </div>
					</div>
				</div>

			<?php } ?>

			<div class="col-12 p-3">
				<nav class="float-right paginate-overflow pagination">						
					<?php echo $invoice_link;?>
				</nav>					
			</div>
		</div>
	</div>	
<?php } else { ?> 
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center">
				<h4>Riwayat Invoice</h4>
			</div>

			<div class="col-12 text-center">
				<img src="<?php echo base_url('assets/images/not-found.png');?>" 
					width="40%"
					class="img-fluid">
				<br>
				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>
				<br>
				<span class="ft-13">
					Riwayat Invoice Tidak Ditemukan
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