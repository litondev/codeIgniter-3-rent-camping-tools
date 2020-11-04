<style>
.box-daftar{
	margin: auto;
	border: 0px solid rgb(127,127,127,0.3) !important;
	border-radius: 10px;
}
</style>

<div class="container">
	<div class="row pt-5 pb-5">
		<div class="col-md-10 col-lg-10 col-sm-12 box-camp box-daftar">
			<div class="row">
				<div class="col-12">
					<div class="text-center text-camp-violet">
						<h2>Daftar</h2>
					</div>		

					<div class="text-center">
						<img class="img-fluid"
							src="<?php echo base_url('assets/images/welcome.png');?>">
					</div>
				</div>

				<div class="col-12">				
				 <form 
				 	id="form-daftar"
				 	action="<?php echo site_url();?>/action-signup" 
				 	method="post">

				 	<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
				 		name="<?php echo $this->security->get_csrf_token_name();?>">

					 <div class="row p-4">
					 	<div class="col-md-6 col-lg-6 col-sm-12">
						 	<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			Nama Depan
						 		</div>
						 		<div class="col-12">
						 			<input class="form-control input-camp-violet"
						 				type="text" 
						 				name="first_name"
						 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['first_name'] : '';?>"
						 				data-parsley-required>
						 		</div>
						 	</div>

						 	<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			Nama Belakang
						 		</div>
						 		<div class="col-12">
						 			<input class="form-control input-camp-violet"
						 				type="text" 
						 				name="last_name"
						 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['last_name'] : '';?>"
						 				data-parsley-required>
						 		</div>
						 	</div>

		 					<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			No Telp
						 		</div>
						 		<div class="col-12">
						 			<input class="form-control input-camp-violet"
						 				type="number"
						 				name="phone"
						 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['phone'] : '';?>"
						 				data-parsley-required
						 				data-parsley-type="number">
						 			<div class="small text-info ml-2">*Harus memakai 08</div>
						 		</div>
						 	</div>

						 	<div class="row">					 		
						 		<div class="form-group pl-5">					 			
						 			<label class="text-camp-violet"
						 				for="jenis_kelamin_laki_laki">
						 				Laki-Laki
						 			</label>
						 			<input 
						 				type="radio" 
						 				id="jenis_kelamin_laki_laki" 
						 				checked="true" 
						 				name="gender" 
						 				value="male">
						 		</div>

						 		<div class="form-group pl-5">					 			
						 			<label class="text-camp-violet"
						 				for="jenis_kelamin_wanita">
						 				Perempuan
						 			</label>
						 			<input 
						 				type="radio" 
						 				id="jenis_kelamin_wanita" 
						 				name="gender" 
						 				value="female">
						 		</div>
						 	</div>
					 	</div>

					 	<div class="col-md-6 col-lg-6 col-sm-12">
						 	<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			Email
						 		</div>
						 		<div class="col-12">
						 			<input class="form-control input-camp-violet"
						 				type="text" 
						 				name="email"
						 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['email'] : '';?>"
						 				data-parsley-required
						 				data-parsley-type="email">
						 		</div>
						 	</div>

						 	<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			Password
						 		</div>
						 		<div class="col-12">
						 			<input class="form-control input-camp-violet" 
						 				type="password"
						 				name="password"
						 				value="<?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['password'] : '';?>"
						 				data-parsley-required
						 				data-parsley-minlength="8">						 				
						 		</div>
						 	</div>

		 					<div class="form-group row">
						 		<div class="col-12 text-camp-violet">
						 			Alamat
						 		</div>
						 		<div class="col-12">
						 			<textarea class="form-control textarea-camp-violet"
						 				name="address"						 				
						 				data-parsley-required><?php echo $this->session->flashdata('old_post') ? $this->session->flashdata('old_post')['address'] : '';?></textarea>
						 		</div>
						 	</div>
					 	</div>

					 	<div class="col-12">
						 	<div class="float-right">
					 			<button class="btn btn-violet text-center text-light box-button-camp no-border border-radius-10"
					 				id="button-daftar">
					 				<i class="fab fa-telegram-plane"></i>
					 				Kirim
					 			</button>
						 	</div>
					 	</div>
					 </div>
				 </form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function phone_res(){
	$(".box-daftar").css({"border" : "0px solid white"});
	$(".box-daftar").removeClass("box-camp");
}

function tablet_res(){
	$(".box-daftar").css({"border" : "0px solid white"});
	$(".box-daftar").removeClass("box-camp");
}

function destop_res(){	
	$(".box-daftar").css({"border" : "2px solid rgb(127,127,127,0.3)"});
	$(".box-daftar").removeClass("box-camp").addClass("box-camp");
}
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-daftar").parsley().on('form:validate',function(){
	if($("#form-daftar").parsley().isValid()){
		$("#button-daftar").html("<i class='fa fa-spinner fa-spin'></i>");
		$("#button-daftar").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>