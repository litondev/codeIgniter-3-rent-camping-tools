<!DOCTYPE HTML>
<html>
	<head>
	 <!-- META CHARSET -->
	 <meta charset="UTF-8">

	 <!-- TITLE PAGE -->
	 <title>
	 	<?php 
	 		echo $title;
	 	?>
	 	|

	 	<?php 
	 		echo $this->config->item("app.site_name");
	 	?>
	 </title>


	 <!-- META VIEW PORT -->
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">

	 <!-- META VIEW PORT -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- META DESCRIPTION -->
     <meta name="description" content="<?php echo $this->config->item('app.meta_description'); ?>">

     <!-- LOGO -->
     <link rel="icon" href="<?php echo base_url('assets/images/logo-header.png');?>" type="image/png">

     <!-- BOOTSTRAP CSS -->    
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/user/assets/css/bootstrap.min.css');?>">

	 <!-- TOAST CSS -->
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/user/assets/css/toastr.min.css');?>">

	 <!-- OWL CAROUSEL CSS -->
     <link rel="stylesheet" href="<?php echo base_url('assets/user/assets/css/owl/owl.carousel.min.css');?>">
     <link rel="stylesheet" href="<?php echo base_url('assets/user/assets/css/owl/owl.theme.default.min.css');?>">

     <!-- DATERANGE PICKER CSS -->
     <link rel="stylesheet" href="<?php echo base_url('assets/user/assets/css/daterangepicker.css');?>">

     <!-- SEMUA CSS BUATAN SENDIRI -->
     <link rel="stylesheet" href="<?php echo base_url('assets/all.css');?>">

     <!-- SCRIPT JAVSCRIPT UNTUK MEMBUAT FONT BINTANG -->
	 <script>
		function makeStar(count,id){
			var html = "";

			if(parseInt(count) == 0){
				for(var i=0;i<5;i++){
					html += `<i class="fa fa-star text-camp"></i>`
				}
			}else{
				for(var i=0;i<parseInt(count);i++){
					html += `<i class="fa fa-star text-camp" style="color:yellow"></i>`
				}

				var remain = 5-parseInt(count);

				for(var i=0;i<parseInt(remain);i++){
					html += `<i class="fa fa-star text-camp"></i>`;
				}
			}

			document.getElementById(id).innerHTML = html;
		}
	 </script>

	 <!-- CSS STYLE UNTUK LOADING PAGE DAN LOADING MODAL -->
	 <style>
	 	 #loader-page{
	       position:fixed;
	       z-index:99999;
	       top:0;
	       left:0;
	       bottom:0;
	       right:0;
	       background: white;
	       transition: 1s 0.4s;
	     }

	     #loader-page-indikator{
	        top:20%;
	        left:50%;
	        position:absolute;
	     }   

	 	 #loading-modal{
	 	   display: none;
   		   position:fixed;
	       z-index:999990;
	       top:0;
	       left:0;
	       bottom:0;
	       right:0;
	       background: rgb(127,127,127,0.5);
	 	 }

	 	 #loading-modal > div{
	 	 	position: fixed;
	 	 	left:40%;
	 	 	top:30%;
	 	 	width:300px;	 	 	
	 	 	z-index: 999999 !important;  
	 	 }	

	     @media only screen and (max-width: 698px){
	     	#loader-page-indikator{
	     		left:40%;
	     	}

	     	#loading-modal > div{
	     		left:10%;	 	 
	     	}
	     }
	 </style> 

	 <!-- CSS STYLE UNTUK PARSLEY ERRORS -->
	 <style>
		 .parsley-errors-list{
			color:red;
			list-style:none;
			padding:8px;
			opacity: 0.8;
		 }
	 </style>

	<!-- JQUERY -->
	<script src="<?php echo base_url('assets/user/assets/js/jquery.min.js');?>"></script>	
	<!-- POPPER -->
	<script src="<?php echo base_url('assets/user/assets/js/popper.min.js');?>"></script>
	<!-- BOOTSTRAP -->
	<script src="<?php echo base_url('assets/user/assets/js/bootstrap.min.js');?>"></script>
	<!-- TOASTR -->
	<script src="<?php echo base_url('assets/user/assets/js/toastr.min.js');?>"></script>
	<!-- SWETALERT -->
	<script src="<?php echo base_url('assets/user/assets/js/sweetalert2.js');?>"></script>
	<!-- MOMENT -->
	<script src="<?php echo base_url('assets/user/assets/js/moment.js');?>"></script>	
	<!-- MOMENT LOCALE -->
	<script src="<?php echo base_url('assets/user/assets/js/moment-with-locales.js');?>"></script>
	<!-- PARSLEY -->
	<script src="<?php echo base_url('assets/user/assets/js/parsley.min.js');?>"></script>
	<!-- PARSLEY I18N -->
	<script src="<?php echo base_url('assets/user/assets/js/i18n/id.js');?>"></script>
	<!-- FONTAWESOME -->
	<script src="<?php echo base_url('assets/user/assets/js/fontawesome.min.js');?>"></script>
	<!-- OWL CAROUSEL -->
	<script src="<?php echo base_url('assets/user/assets/js/owl.carousel.min.js');?>"></script>
	<!-- DATERANGE PICKER -->
	<script src="<?php echo base_url('assets/user/assets/js/daterangepicker.js');?>"></script>
   
	</head>
<body>	
	<!-- LOADING MODAL -->
	<div 
		id="loading-modal">
	  	<div class="modal no-border">
	    	<div class="modal-dialog no-border">
		      <div class="modal-content no-border">        
		        <div class="modal-body no-border pt-5 pb-5">
		        	<div class="text-center no-border">
		        		<i class="fa fa-spinner fa-spin fa-5x"></i> 
		        	</div>		        		     
		        </div>      
		      </div>
	    	</div>
	  	</div>
	 </div>
  	<!-- LOADING MODAL -->

  	<!-- LOADING PAGE -->
    <div 
    	id="loader-page">                        
        <div 
        	id="loader-page-indikator">
        	<div class="text-center">
        		<i class="fa fa-spinner fa-spin fa-5x"></i> 
        	</div>

        	<!-- 
	        	<div class="mt-2 text-center">
	        		<span style="font-size:20px;color:rgb(139,21,158,189)">Loading</span>
	        	</div> 
        	-->
        </div>
    </div>	
    <!-- LOADING PAGE -->

	<!-- BANTALAN UNTUK FIXED TOP NAVBAR -->
	<div style="height:70px"></div>

	<!-- NAVBAR DEKSTOP -->
	<nav class="navbar navbar-expand-lg bg-dark navbar-default fixed-top">
		<div class="container">
		  <span class="navbar-brand">

		  	<a href="<?php echo site_url();?>">
		  		<img 
			  		src="<?php echo base_url('assets/images/logo.png');?>" 
		  			height="45px"/>
		  	</a>

			<form
			  action="<?php echo site_url();?>/product"
	    	  method="get">
				<input class="form-control input-camp-navbar-mobile"
					type="text" 
					name="search"						
					placeholder='&#128269; Search'
					onkeypress="event.key == 'enter' ? this.form.submit() : ''">
			</form>
		  </span>

	 	  <button class="navbar-toggler text-white">
		  	<a class="pos-relative text-light" 
	        	href="<?php echo site_url();?>/cart">
	        	<?php 
	        		if($this->LSession->user()){
	        	?>        	
	        		<?php 
	        			if(intval($this->config->item("app.user_cart"))){
					?>
	        		<span class="point-red-mobile">
		        		<i class="fa fa-circle text-danger"></i>
	        		</span>
	        		<?php 
	        			}
	        		?>
	        	<?php 
	        		}
	        	?>
	        	<i class="fa fa-shopping-basket fa-1x"></i>	        
		    </a>
		  </button>

		  <button class="navbar-toggler text-white" 
		  	onclick="onOpenNavbarMobile('show')">	  	 
			<i class="fa fa-stream fa-1x"></i>
		  </button>

		  <div class="collapse navbar-collapse">
		    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
		      <li class="nav-item">
		        <form class="form-inline mt-1"
		        	action="<?php echo site_url();?>/product"
		        	method="get">
		      		<div class="input-group">
		        		<div class="input-group-prepend">
		          			<span class="input-group-text">
				          		<i class="fa fa-search"></i>
		          			</span>
		        		</div>
		        		<input class="form-control"
		        			type="text" 
		        			name="search"	        			
		        			placeholder="Search . . . "
		        			onkeypress="event.key == 'enter' ? this.submit() : ''">       
		      		</div>
		    	</form>
		      </li> 

	 		  <li class="nav-item">
	      		<a class="nav-link mt-1" 
	      			href="<?php echo site_url();?>/info">	      			
	      			Info
	      		</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link pos-relative" 
		        	href="<?php echo site_url();?>/cart">
		        	<?php 
		        		if($this->LSession->user()){
		        	?>
		        		<?php 
		        			if(intval($this->config->item("app.user_cart"))){
						?>
		        		<span class="point-red">
			        		<i class="fa fa-circle text-danger"></i>
		        		</span>
		        		<?php 
		        			}
		        		?>
		        	<?php 
		        		}
		        	?>
		        	<i class="fa fa-shopping-basket fa-2x"></i>	        
		        </a>
		      </li>      	    

		      <?php 
		      	if($this->LSession->user()){
		      ?>
		      <li class="nav-item">
		      		<a class="nav-link pos-relative" 
		      			href="<?php echo site_url();?>/akun">
		      			<i class="fa fa-user fa-2x"></i>
		      		</a>
		      </li>
		      <?php 
		      	}
		      ?>

		      <?php 
		      	if($this->LSession->user()){
		      ?>
		        <li class="nav-item">
		      		<a class="nav-link pos-relative" 
		      			href="<?php echo site_url();?>/notif">	        
		      			<i class="fa fa-bell fa-2x"></i>
		      		</a>
		      	</li>
		      <?php 
		  		}
		  	  ?>

		      
		      <?php 
		      	if($this->LSession->user()){
		      ?>
		      <li class="nav-item">
		      	<a class="nav-link mt-1" 
		      		href="<?php echo site_url();?>/logout">
		      		Keluar
		      	</a>
		      </li>
		      <?php 
		      	}
		      ?>
		      
	   		  <?php 
		      	if(!$this->LSession->user()){
		      ?>
		      <li class="nav-item">
		        <a class="nav-link mt-1" 
		        	href="<?php echo site_url();?>/signup">
		        	Daftar
		        </a>
		      </li>
		      <?php 
		      	}
		      ?>


	  		  <?php 
		      	if(!$this->LSession->user()){
		      ?>	      
		      <li class="nav-item">
		        <a class="nav-link mt-1" 
		        	href="<?php echo site_url();?>/signin">
		        	Masuk
		       	</a>
		      </li>
		      <?php 
		  		}
		  	  ?>
		  		
		    </ul>
		  </div>
		</div>
	</nav>
	<!-- NAVBAR DEKSTOP -->


	<!-- NAVBAR MOBILE -->
	<nav class="bg-dark fixed-bottom" 
		id="navbar-bottom-mobile"
		style="opacity:0.9">

		<div class="container">
			<div class="row p-2">
				<div class="col-4 text-center">
					<a href="<?php echo site_url();?>">
						<div style="padding:10px;color:white">
							<i class="fa fa-home ft-20"></i>
						</div>
					</a>
				</div>

				<div class="col-4 text-center">
					<a href="<?php echo site_url();?>/akun">
						<div>
							<span style="border-radius:50%;color:white;border:1px solid white;padding-top:21px;padding-bottom:21px;padding-left:25px;padding-right:25px"
								class="bg-dark box-camp">
								<i class="fa fa-user ft-20"></i>
							</span>
						</div>
					</a>
				</div>

				<div class="col-4 text-center">
					<a href="<?php echo site_url();?>/notif">
						<div style="padding:10px;color:white">
							<i class="fa fa-bell ft-20"></i>
						</div>
					</a>
				</div>
			</div>	
		</div>
	</nav>

	<div class="container-fluid" 
		id="box-navbar-mobile">
		<div class="row">
			<div class="col-2 p-3 bg-dark">
				<i class="fa fa-times text-white fa-2x cursor-pointer" 
					onclick="onOpenNavbarMobile('hide')"></i>
			</div>
			<div class="col-10 pt-2 pb-2 bg-light navbar-mobile">
				<ul class="list-group p-2">
					<li class="list-group-item ft-15">
						<b>Navbar : </b>
					</li>

					<li class="list-group-item">
						<a href="<?php echo site_url();?>">Home</a>
					</li>

					<li class="list-group-item">
						<a href="<?php echo site_url();?>/info">Info</a>
					</li>

					<?php 
						if(!$this->LSession->user()){
					?>
					<li class="list-group-item">
						<a href="<?php echo site_url();?>/signin">Masuk</a>
					</li>
					<?php 
						}
					?>


					<?php 
						if(!$this->LSession->user()){
					?>
					<li class="list-group-item">
						<a href="<?php echo site_url();?>/signup">Daftar</a>
					</li>
					<?php 
						}
					?>

					<?php 
						if($this->LSession->user()){
					?>					
					<li class="list-group-item">
						<a href="<?php echo site_url();?>/akun">Akun</a>
					</li>
					<?php 
						}
					?>

					<?php 
						if($this->LSession->user()){
					?>
			        <li class="list-group-item">
			      		<a href="<?php echo site_url();?>/notif">Notif</a>
			      	</li>
				    <?php 
				    	}
				    ?>

					<?php 
						if($this->LSession->user()){
					?>
						<li class="list-group-item">
							<a href="<?php echo site_url();?>/logout">Keluar</a>
						</li>
					<?php 
						}
					?>
				</ul>	
			</div>
		</div>
	</div>
	<!-- NAVBAR MOBILE -->

	<!-- SCRIPT RESPONSIVE NAVBAR -->
	<script>
	function phone_res_navbar(){
	  $(".navbar-brand > a").removeClass("d-block").addClass("d-none");
	  $(".navbar-brand > form").removeClass("d-none").addClass("d-block");
	  $("#navbar-bottom-mobile").show();
	}

	function tablet_res_navbar(){
	  $(".navbar-brand > a").removeClass("d-block").addClass("d-none");
	  $(".navbar-brand > form").removeClass("d-none").addClass("d-block");
	  $("#navbar-bottom-mobile").show();
	}

	function destop_res_navbar(){
	  $(".navbar-brand > a").removeClass("d-none").addClass("d-block");
	  $(".navbar-brand > form").removeClass("d-block").addClass("d-none");
	  $("#navbar-bottom-mobile").hide();
	}
	</script>

	<script>
	function onOpenNavbarMobile(way){
		if(way == 'show'){
			$("#box-navbar-mobile").show();
			$("body").css({"overflow" : "hidden"});		
		}else{
			$("#box-navbar-mobile").hide();
			$("body").css({"overflow" : "auto"});
		}
	}
	</script>

	<!-- CSS NAVBAR -->
	<style>
	.navbar-default{
		color:white;
		font-size: 15px;
		box-shadow: 5px 5px 20px 0px rgb(127,127,127,0.2);
		border-bottom: 1px solid #dddddd;
	}

	.navbar-default >  div > a{
		color: white !important;
	}

	.navbar-default > div > div > ul > li {
		padding-right: 10px;
		padding-left: 10px;
	}

	.navbar-default > div > div > ul > li > a{
		color: white !important;
	}

	.point-red{
		position:absolute;
		top:-5px;
		right:0px;
	}

	.point-red-mobile{
		position:absolute;
		top:-3px;
		right:0px;
		font-size: 10px;
	}

	#box-navbar-mobile{
		z-index:1035;
		top:0px;
		bottom:0px;
		position:fixed;
		display:none;
		overflow: auto;
	}

	#box-navbar-mobile > div{
	    height: 100%; 
	}

	.navbar-mobile{
		background:rgb(242,242,242);
	}

	.navbar-mobile > ul > li{
		background: none;
		border:0px;
		border-radius: 0px !important;
		border-bottom: 1px solid rgb(217,217,217);
	}

	.navbar-mobile > ul > li > a{
		color:rgb(127,127,127,0.5);
	}
	</style>