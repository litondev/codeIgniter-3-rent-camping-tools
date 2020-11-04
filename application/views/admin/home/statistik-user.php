<div class="col-md-4 col-lg-4 col-sm-12">
	<div class="card shadow mb-4">      
	<div class="card-body">
			<h5>Statistik User</h5>
			<hr/>
			<div class="table-responsive mt-2">  						
			<table class="table table-borderless table-hover">
				<tr>
					<td><b>Jumlah</b></td>	        					
					<td>
						<?php 
							echo $user["total"]["total"];
						?>
					</td>
				</tr>	        				
				<tr>
					<td><b>Blokir</b></td>	        					
					<td>
						<?php 
							echo $user["blokir"]["total"];
						?>
					</td>
				</tr>	       
				<tr>
					<td><b>Aktif</b></td>
					<td>
						<?php 
							echo $user["aktif"]["total"];
						?>
					</td>
				</tr>
				<tr>
					<td><b>Baru</b></td>
					<td>
						<?php 
							echo $user["new"]["total"];
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="float-right">
							<a href="<?php echo site_url();?>/admin/user">
								Lihat Semuanya
							</a>
						</div>
					</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>