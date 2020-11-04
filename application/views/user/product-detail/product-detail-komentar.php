<div class="pl-4 pr-4 pt-3 pb-3 product-detail-info" 
	id="product-detail-komentar">
	<div class="row box-camp p-2">
		<div class="col-12">
			<h6>Komentar</h6>	
		</div>	

		<div class="col-12 ft-14">	
			<?php foreach($data as $item){ ?>
			<div class="row mt-4 p-2">				
				<div class="col-12">
					<div class="clearfix">
						<div class="float-left">
							<span class="badge badge-primary">
								<?php echo $item['first_name'];?>
							</span>
							<br>
							<span id="make-star-review-<?php echo $item['id'];?>"></span>
							<script>
							  makeStar('<?php echo $item['star'];?>','make-star-review-<?php echo $item['id'];?>')
							</script>
							<br>
						</div>

						<div class="float-right">
							<span class="badge badge-info">
								<?php echo $item['created_at'];?>
							</span>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2 pl-4 pt-2 pb-2 list-komentar">
					<?php 
						echo $item['komentar'];
					?>
				</div>

				<?php if($item['replay']){ ?>
				<div class="col-11 mt-2 pl-4 pt-2 pb-2 offset-1 list-komentar">
					<?php 
						echo $item['replay'];
					?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(!count($data)){ ?>
			<div class="text-center p-3">
				<img 
					src="<?php echo base_url('assets/images/not-found.png');?>" 
					width="40%"
					class="img-fluid">
					<br>
				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>
					<br>
				<span class="ft-13">
					Komentar Tidak Ditemukan
				</span>
			</div>
			<?php } ?>
		</div>

		<?php if($link){ ?>
		<div class="col-12 p-3">
			<nav class="float-right paginate-overflow pagination">
				<?php 
					echo $link;
				?>
			</nav>
		</div>
		<?php } ?>
	</div>	
</div>