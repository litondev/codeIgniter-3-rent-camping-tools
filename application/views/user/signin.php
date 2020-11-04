<style>
.box-masuk{
	margin: auto;
	border: 0px solid rgb(127,127,127,0.3) !important;
	border-radius: 10px;
}
</style>

<div class="container">
	<div class="row pt-5 pb-5">
		<div class="col-md-4 col-lg-4 col-sm-12 box-camp box-masuk">
			<div class="row">
				<div class="col-12">
					<div class="text-center text-camp-violet">
						<h2>Masuk</h2>
					</div>				
					<div class="text-center">
						<img class="img-fluid"
							src="<?php echo base_url('assets/images/welcome.png');?>">
					</div>
				</div>

				<div class="col-12">				
				 <form 
				 	id="form-masuk" 
				 	action="<?php echo site_url();?>/action-signin" 
				 	method="post">

				 	<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
				 		name="<?php echo $this->security->get_csrf_token_name();?>">

				 	<div class="form-group row">
				 		<div class="col-12 text-camp-violet">
				 			Email
				 		</div>

				 		<div class="col-12">
				 			<input class="form-control input-camp-violet"  
				 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['email'] : '';?>"
				 				data-parsley-required
				 				data-parsley-type="email"
				 				name="email"
				 				type="text">
				 		</div>
				 	</div>

				 	<div class="form-group row">
				 		<div class="col-12 text-camp-violet">
				 			Password
				 		</div>
				 		<div class="col-12">
				 			<input class="form-control input-camp-violet"
					 			type="password"
				 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['password'] : '';?>"				 						
				 				name="password"
				 				data-parsley-minlength="8"
				 				data-parsley-required>
				 		</div>
				 	</div>

				 	<div class="form-group row">
				 		<div class="col-12">
				 			<a href="<?php echo site_url();?>/forget-password">
				 				Lupa Password 
				 			</a>
				 		</div>
				 	</div>

				 	<div class="form-group row">
				 		<div class="col-12">
				 			<button class="btn btn-violet btn-block text-center text-light border-radius-10 box-button-camp no-border" 
				 				id="button-masuk">
				 				<i class="fa fa-sign-in-alt"></i>
				 				Masuk
				 			</button>
				 		</div>
				 	</div>				 
				 </form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- RESPONSIVE -->
<script>
function phone_res(){
	$(".box-masuk").css({"border" : "0px solid white"});
	$(".box-masuk").removeClass("box-camp");
}

function tablet_res(){
	$(".box-masuk").css({"border" : "0px solid white"});
	$(".box-masuk").removeClass("box-camp");
}

function destop_res(){	
	$(".box-masuk").css({"border" : "2px solid rgb(127,127,127,0.3)"});
	$(".box-masuk").removeClass("box-camp").addClass("box-camp");
}
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-masuk").parsley().on('form:validate',function(){
	if($("#form-masuk").parsley().isValid()){
		$("#button-masuk").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-masuk").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>