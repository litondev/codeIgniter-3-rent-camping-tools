<style>
.akun-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}
</style>

<div class="container">
	<div class="row p-5">
		<div class="col-12 text-center mb-4 text-camp-violet">
			<h4>Akun</h4>
		</div>

		<?php foreach ($akun as $item){ ?>					
		<div class="col-md-4 col-lg-4 col-sm-12 cursor-pointer text-center mt-5 mb-5 akun-card p-2"
		 	onclick="window.location='<?php echo site_url();?>/<?php echo $item['link'];?>'">
			<img class="img-fluid" 
				src="<?php echo base_url('assets/images/akuns/'.$item['img']);?>">
				<br>
				<br>
			<span class="ft-13 text-camp-violet">
				<b><?php echo $item['title'];?></b>
			</span>
		</div>
		<?php } ?>
	</div>
</div>

<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>