<style>
#box-checkout{
	border: 0px solid rgb(127,127,127,0.3);
	border-radius: 10px;
}

#box-checkout-mobile{
	z-index:1035;
	top:0px;
	bottom:0px;
	position:fixed;
	display:none;
	overflow: auto;
}

#box-checkout-mobile > div{
    height: 100%; 
}

@media(max-width: 567px) {
  .daterangepicker{
    top:0px !important;
    left:10% !important;
  }
}
</style>

<script> 
	var cart = [];
</script>

<?php if(count($cart)){ ?>
 <div class="container p-5">
	<div class="row">
		<div id="box-product">
			<div class="row">
				<div class="col-12">
					<h4>Keranjang Belanja</h4>
				</div>

				<div class="col-12 mb-3 mt-3">
					<div class="clearfix">
						<div class="float-left">
							<input type="checkbox" 
								onclick="clickAllCheckout(event)">
						</div>
						<div class="float-right">				
							<span class="text-dark cursor-pointer" 
								onclick="sendFormSubsCart(this)">
								<i class="fa fa-trash"></i>
							</span>
							<span class="text-dark ml-2" 
								id="icon-checkout-mobile" 
								onclick="onOpenBoxCheckoutMobile('show')">
								<i class="fa fa-stream"></i>
							</span>
						</div>
					</div>
				</div>

				<?php echo $product;?>
			</div>
		</div>

		<?php echo $sidebarDekstop;?>
	</div>
 </div>
 <?php echo $sidebarMobile;?>
<?php }else{ ?>
<div class="container p-4">
	<div class="row">
		<div class="col-12 text-center">
			<h4>Keranjang Belanja</h4>
		</div>

		<div class="col-12 text-center p-3">
			<img src="<?php echo base_url('assets/images/not-found.png');?>" width="40%"class="img-fluid">
				<br>
			<span class="ft-20"><b>Data Tidak Ditemukan</b></span>
				<br>
			<span class="ft-13">Keranjang Belanja Tidak Ditemukan</span>
		</div>		
	</div>	
</div>  
<?php } ?>

<!-- RESPONSIVE -->
<script>                         
function phone_res(){
	$("#box-checkout").hide();
	$("#icon-checkout-mobile").show();
	$("#box-product").removeClass("col-md-7 col-lg-7 col-sm-12").addClass("col-12");

	$(".list-product-image").removeClass("col-3").addClass("col-8 text-center");
	$(".list-product-checkbox").removeClass("col-1").addClass("col-2");
}

function tablet_res(){
	$("#box-checkout").hide();
	$("#icon-checkout-mobile").show();
	$("#box-product").removeClass("col-md-7 col-lg-7 col-sm-12").addClass("col-12");

	$(".list-product-image").removeClass("col-3").addClass("col-8 text-center");
	$(".list-product-checkbox").removeClass("col-1").addClass("col-2");
}

function destop_res(){
	$("#box-checkout").show();
	$("#icon-checkout-mobile").hide();
	$("#box-product").removeClass("col-12").addClass("col-md-7 col-lg-7 col-sm-12");

	$(".list-product-image").removeClass("col-8 text-center").addClass("col-3");
	$(".list-product-checkbox").removeClass("col-2").addClass("col-1");
}
</script>

<script>
function onOpenBoxCheckoutMobile(way){
	if(way == 'show'){
		$("#box-checkout-mobile").show();
		$("body").css({"overflow" : "hidden"});
	}else{
		$("#box-checkout-mobile").hide();
		$("body").css({"overflow" : "auto"});
	}
}
</script>

<script>
function deleteData(id){
	swal.fire({
		title: 'Apakah Anda Yakin?',
		icon: 'warning',
		confirmButtonColor: '#fe7c96',
		showCancelButton: true,
		confirmButtonText: 'Oke',
		showLoaderOnConfirm: true,
		cancelButtonText: 'Batal',      
	})
	.then(result => {		
		if(result.value){
	 		$("#loading-modal").show();
	 		$("#loading-modal > div").show();

			window.location = "<?php echo site_url();?>/action/sub-cart/"+id;
		}  	
  	})		
}
</script>

<?php if(count($cart)){ ?>
	<?php echo $jsDateRangeDekstop;?>
	<?php echo $jsDateRangeMobile;?>
	<?php echo $jsCheckout;?>
	<?php echo $jsFormCheckout;?>
	<?php echo $jsFormSubsCart;?>
<?php } ?>