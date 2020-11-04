<div class="col-lg-4 col-md-4 col-sm-12 offset-lg-1 offset-md-1 mt-4">
	<div class="p-3 box-camp"
		id="box-checkout">
		<form 
			id="form-checkout-dekstop"
			action="<?php echo site_url();?>/checkout"
			method="post">

			<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
				name="<?php echo $this->security->get_csrf_token_name();?>">

			<div class="mt-1">
				<b>Product : </b>
				<ul class="list-group">
					<?php 
						$total = [];
					?>

					<?php foreach($cart as $item){ ?>						

						<?php 
							array_push($total,$item['rent_price']);
						?>

						<li class="list-group-item no-border ft-13">
							<?php echo $item['name'];?> : <?php echo money($item['rent_price']);?>
						</li>
					<?php } ?>
				</ul>
			</div>

			<div class="mt-3">
				<b>Total : </b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<span class="badge badge-success">
							Rp <?php echo money(array_sum($total));?>
						</span>
					</li>
				</ul>
			</div>				

			<div class="mt-3">
				<b>Tgl Awal Sewa - Tgl Akhir Sewa: </b>
				<ul class="list-group">
					<li class="list-group-item no-border text-success">
						<b class="badge badge-success">
							*Min Sewa : <?php echo $this->config->item('app.min_rent_product');?> Hari
						</b>
					</li>
					<li class="list-group-item no-border text-danger">
						<b class="badge badge-danger">
							*Max Sewa : <?php echo $this->config->item('app.max_rent_product');?> Hari
						</b>
					</li>										
					<li class="list-group-item no-border text-danger ft-13">
						* Tgl sekarang akan ditambah dengan <?php echo $this->config->item('app.expired_invoice');?> hari sebagai jangka waktu untuk pembayaran dan persiapan
					</li>
					<li class="list-group-item no-border">						
						<input type="text" 
							name="date_rent" 
							class="form-control input-camp" 
							id="date-dekstop"
							data-parsley-required/>
					</li>
				</ul>
			</div>

			<div class="mt-3">
				<b>Jaminan : </b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<select class="form-control" name="guaranteing">
							<option value="ktp">Ktp</option>
							<option value="sim">Sim</option>
						</select>
					</li>
				</ul>
			</div>

			<div class="mt-3">
				<button class="btn btn-success btn-block" 
					type="submit" 
					id="button-checkout-dekstop">
					Checkout
				</button>
			</div>
		</form>
	</div>		
</div>