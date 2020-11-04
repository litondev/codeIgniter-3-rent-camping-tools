	<div class="container-fluid">		
		<div class="row p-4" 
			id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-12">
						<div class="row text-center">
							<div class="col-12">
								Kontak Kami
								<br>
								<?php echo $this->config->item('app.footer_contact_us');?>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 col-sm-12">
						<div class="row text-center">
							<div class="col-12">
								Dengan campRental mempermudah cara berkemah anda.
							</div>

							<div class="col-12 mt-5">
								Siap selalu melayani anda
							</div>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 col-sm-12">
						<div class="row text-center">
							<div class="col-12">
								<a 
								 href="<?php echo site_url();?>">
									 <img 
										src="<?php echo base_url('assets/images/logo.png');?>" 
										height="45px"/> 
								</a>
							</div>
							<div class="col-12">
								Hanya di kota 
								<?php echo $this->config->item('app.city');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row p-3" 
			id="copyright">
			<div class="col-12 text-center">
				Copyright@super
			</div>
		</div>
	</div>

	<!-- CSS FOOTER -->
	<style>
		#footer{
			box-shadow: 10px 10px 20px 10px rgb(127,127,127,0.2);
			background:rgb(16,37,63);
			color:white;
			font-size: 15px;
		}

		#footer > div > div > div{
			padding: 20px;
		}

		#footer > div > div > div > div{
			padding-top:10px;
			border-radius: 10px;
			border-top:5px solid white;		
		}

		#copyright{
			font-size: 15px;
			color:white;
			background:rgb(30,28,17);
		}
	</style>

	<!-- LOADING FADEOUT -->
    <script>
	    $("document").ready(function(){
	        $("#loader-page").fadeOut(2000);
	    });
	</script>

	<!-- MOMENT SET LOCALE -->
	<script>
		moment.locale('id');
	</script>

	<!-- JIKA ADA SESSION SUCCESS DARI SERVER -->
	<?php 
		if(!empty($this->session->flashdata("success"))){
			?>
			<script>
			toastr.success(
				"<?php echo $this->session->flashdata('success')['text'];?>",
				"<?php echo $this->session->flashdata('success')['title'];?>",
			);
			</script>
			<?php
		}
	?>


    <!-- JIKA ADA SESSION ERROR DARI SERVER -->   
	<?php 
		if(!empty($this->session->flashdata("error"))){
			?>
			<script>
			toastr.error(
				"<?php echo $this->session->flashdata('error')['text'];?>",
				"<?php echo $this->session->flashdata('error')['title'];?>",
			);
			</script>
			<?php
		}
	?>     

	<script>    
    // function reponsive akan dipanggil setiap halaman diload atau diresize
    function responsive(){
    	var win = $(this);

		if (win.width() < 599) {   
			try{
		 		phone_res();
		 	}catch(e){

		 	}

	 		phone_res_navbar()	 		
		}else if(win.width() > 600 && win.width() < 968){
			try{
		 		tablet_res();
		 	}catch(e){

		 	}

	 		tablet_res_navbar();
		}else{	
			try{
				destop_res();	 	
			}catch(e){

			}

	 		destop_res_navbar()	 		
		}
    }

    // MEMANGIL FUNCTION RESPONSIVE KETIKA DILOAD
    $(window).on("load",function(){
    	responsive();
    });

    // MEMANGIL FUNCTION RESPONSIVE KETIKA RESIZE
    $(window).on('resize', function() {
		responsive();
	});
    </script>
</body>
</html>