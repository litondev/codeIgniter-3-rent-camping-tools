<div class="col-md-8 col-lg-8 col-sm-12 p-3 mb-4 box-camp border-radius-10">
	<div class="clearfix">
		<div class="float-left">
			<div>
				<b class="ft-12">Status Sekarang : </b>

				<ul class="list-group">
					<li class="list-group-item no-border">
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
				 		<?php } ?>
					</li>
				</ul>
			</div>		

			<div>
				<b class="ft-12">Tgl Sewa :</b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<b class="text-success ft-13"><?php echo $invoice['start_rent'];?></b>
					</li>
				</ul>												
			</div>

			<div>
				<b class="ft-12">Tgl Sewa Berakhir :</b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<b class="text-danger ft-13"><?php echo $invoice['end_rent'];?></b>
					</li>
				</ul>												
			</div>	

			<div>
				<b class="ft-12">Jaminan :</b>
				<ul class="list-group">
					<li class="list-group-item no-border ft-13">
						<b><?php echo $invoice['guaranteing'];?></b>
					</li>
				</ul>
			</div>
		</div>

		<div class="float-right">					
			<?php if($invoice['status'] != "pending"){ ?>
				<div>
					<b class="ft-12">Status Pembayaran :</b>
					<ul class="list-group">
						<li class="list-group-item no-border"> 
							<?php if($invoice['status_payment'] == "unpaid"){ ?>
								<b class="badge badge-danger">Belum Bayar</b>
							<?php }elseif($invoice['status_payment'] == "expired"){ ?>
								<b class="badge badge-danger text-light">Kadaluarsa</b>
							<?php }elseif($invoice['status_payment'] == "paid"){ ?>
								<b class="badge badge-success text-light">Sudah Bayar</b>
							<?php } ?>
						</li>
					</ul>
				</div>			

				<div>
					<b class="ft-12">Expired Pembayaran Pada :</b>
					<ul class="list-group">
						<li class="list-group-item no-border"> 
							<b class="text-danger ft-13">
								Mohon Bayar Sebelum : <?php echo $invoice['expired_payment'];?>
							</b>
						</li>
					</ul>
				</div>	
			<?php } ?>
		</div>
	</div>

	<div class="mb-3">
		<b class="ft-12"> Product : </b>
		<table class="table table-hover mt-3">
			<?php foreach($invoice['product'] as $item){ ?>
			<tr>
				<td width="120px">
					<img 
	                	src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>"
						class="img-fluid"/>
				</td>		
				<td>
					<div class="clearfix">
						<div class="float-left">
							<div class="d-flex flex-column">
								<span>
									<a href="<?php echo site_url();?>/product/<?php echo $item['id'];?>" class="text-dark">
										<?php echo $item['name'];?>
									</a>
								</span>
								<span class="text-success">						
									<?php echo money($item['rent_price']);?>							
								</span>
							</div>
						</div>					
						
						<?php if(
							$invoice['status'] == "in rent" ||
							$invoice['status'] == "backing stuff"
						){ ?>
						<div class="float-right">
							<span class="cursor-pointer"
								onclick="showFormReviewProduct('<?php echo $item['id'];?>')">
								<i class="fa fa-comment"></i>
								Review
							</span>
						</div>
						<?php } ?>
					</div>

					<div class="mt-4 form-review-product"
						id="form-review-product-<?php echo $item['id'];?>"
						style="display:none">

						<form
							id="form-review-<?php echo $item['id'];?>"
							method="post"
							action="<?php echo site_url();?>/action/review-product">

 							<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
				 			name="<?php echo $this->security->get_csrf_token_name();?>">

							<input type="hidden" 
								name="invoice_id" 
								value="<?php echo $invoice['id'];?>">

							<input type="hidden" 
								name="product_id" 
								value="<?php echo $item['id'];?>">

							<div class="form-group">								
								<select name="star" class="form-control">
									<option value="1">Bintang 1</option>
									<option value="2">Bintang 2</option>
									<option value="3">Bintang 3</option>
									<option value="4">Bintang 4</option>
									<option value="5">Bintang 5</option>
								</select>
							</div>

							<div class="form-group">
								<textarea class="form-control textarea-camp-violet" 
									name="komentar" 
									placeholder="Komentar"
									data-parsley-required></textarea>
							</div>

							<div class="form-group">
								<button class="btn btn-violet text-light no-border box-button-camp mb-2"
									id="button-submit-form-review-<?php echo $item['id'];?>">
									<i class="fab fa-telegram-plane"></i> 
									Kirim
								</button>

								<button class="btn btn-violet text-light no-border box-button-camp mb-2"
									type="reset"
									onclick="hideFormReviewProduct()"
									id="button-cancel-form-review-<?php echo $item['id'];?>">
									<i class="fa fa-times"></i>
									Batal
								</button>
							</div>
						</form>
					</div>
				</td>				
			</tr>
			<?php } ?>
			<tr>
				<td colspan="2" class="text-right no-border">
					Total Pembayaran  :
					<b class="text-success"> <?php echo money($invoice['total']);?></b>
				</td>
			</tr>
		</table>
	</div>
</div>