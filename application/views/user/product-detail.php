<style>
.list-product-detail > .active{
	background: rgb(217,217,217,0.8);
}

.list-item-product-detail{
	cursor: pointer;
	margin-left: 10px;
	background: rgb(217,217,217,0.3);
	border:1px solid gray;
	color: black;
	padding-top:5px;
	padding-bottom: 5px;
	padding-left: 25px;
	padding-right: 25px;
	border-radius: 20px;	
	font-size: 12px;
}	

.list-item-product-detail:hover{
	background: rgb(217,217,217,0.8);
}

.list-komentar{
	background:rgb(127,127,127,0.1);
	border-radius:0px 20px 20px 20px;
}

#product-detail-description{
	display: block;
}

#product-detail-description > div{
	border-radius: 20px;
}

#product-detail-fine{
	display: none;
}

#product-detail-fine > div{
	border-radius: 20px;
}

#product-detail-komentar{
	display: none;
}

#product-detail-komentar > div{
	border-radius: 20px;
}

#product-detail-question{
	display: none;
}

#product-detail-question > div{
	border-radius: 20px;
}

#product-detail-condition{
	display: none;	
}

#product-detail-condition > div{
	border-radius: 20px;
}
</style>

<div class="container">
	<div class="row pl-4 pr-4 pt-5 pb-3">
		<div class="col-md-6 col-lg-6 col-sm-12">
			<div class="owl-carousel owl-theme" 
				id="product-detail-image">
				
				<?php 
					foreach (get_product_images($product['images']) as $item) {				
				?>
          		<div class="item text-center col-12 p-3" 
          			style="height:20%">
        			<img 
        				style="height:auto;width:60%;min-width:60%;margin:auto"
            			src="<?php echo base_url('assets/images/products/'.$item);?>">
		        </div>	                       
		       	<?php 
		       		}
		       	?>
			</div>
		</div>

		<div class="col-md-6 col-lg-6 col-sm-12">
			<div class="mt-3">
				<h3><?php echo $product['name'];?></h3>
			</div>

			<div class="mt-3">
				<h5 class="text-success"><?php echo money($product['rent_price']);?> / Sekali Sewa</h5>
			</div>

			<div class="mt-3">
				 <?php if($product['status_rent']){ ?>
				 	<h5 class="text-danger">Tersewa</h5>
				 <?php }else{ ?>
					<h5 class="text-success">Belum Tersewa</h5>
				 <?php } ?>
			</div>

			<div class="ft-15 mt-4">
				<span id="make-star-product-<?php echo $product['id'];?>"></span> (Dari <?php echo $count_review;?> review)
				<script>
				  makeStar("<?php echo $product['star'];?>","make-star-product-<?php echo $product['id'];?>")
				</script>
			</div>
		
			<div class="mt-5">
				<?php if($this->LSession->user()){ ?>
					<button class="btn btn-success"
						onclick="this.disabled = true;window.location='<?php echo site_url();?>/action/add-cart/<?php echo $product['id'];?>'">
						<i class="fa fa-shopping-basket"></i> Keranjang
					</button>
					<button class="btn btn-primary"
						onclick="this.disabled = true;window.location='<?php echo site_url();?>/action/add-wishlist/<?php echo $product['id'];?>'">
						<i class="fa fa-heart"></i> Wishlist <?php echo $count_wishlist;?>
					</button>
				<?php }else{ ?>
					<button class="btn btn-success" 
						onclick="window.location='<?php echo site_url();?>/signin'">
						<i class="fa fa-shopping-basket"></i> Keranjang
					</button>
					<button class="btn btn-primary" 
						onclick="window.location='<?php echo site_url();?>/signin'">
						<i class="fa fa-heart"></i> Wishlist
					</button>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- PRODUCT DETAIL INFO -->
		<?php 
			echo $productDetail;
		?>
	<!-- PRODUCT DETAIL INFO -->

	<!-- PRODUCT DETAIL DESCRIPTION -->
		<?php 
			echo $productDetailDescription;
		?>
	<!-- PRODUCT DETAIL DESCRIPTION -->

	<!-- PRODUCT DETAIL DENDA -->
		<?php 
			echo $productDetailFine;
		?>	
	<!-- PRODUCT DETAIL DENDA -->

	<!-- PRODUCT DETAIL PERTANYAAN -->
		<?php 
			echo $productDetailQuestion;
		?>
	<!-- PRODUCT DETAIL PERTANYAAN -->

	<!-- PRODUCT DETAIL SYARAT DAN KETENTUAN -->
		<?php
			echo $productDetailCondition
		?>
	<!-- PRODUCT DETAIL SYARAT DAN KETENTUAN -->

	<!-- PRODUCT DETAIL KOMENTAR -->
		<?php 
			echo $productDetailKomentar;
		?>
	<!-- PRODUCT DETAIL KOMENTAR -->

	<!-- PRODUCT RELEVAN -->
		<?php 
			echo $productDetailRelevan;
		?>	
	<!-- PRODUCT RELEVAN -->
	</div>
</div>


<?php 
if($this->input->get('productDetail')){
	if($this->input->get('productDetail') == "komentar"){
?>
  <script>
  	$(".list-item-product-detail").removeClass("active");
  	$(".product-detail-info").hide();
  	$("#product-detail-komentar").show();

  	document.getElementById("product-detail-komentar").scrollIntoView();
  </script>
<?php 
	}
}
?>
<!-- RESPONSIVE -->
<script>
function phone_res(){
	$(".list-product-detail").removeClass("flex-row overflow-a").addClass("flex-column overflow-h w-100");
	$(".list-item-product-detail").addClass("mt-3");
	$(".list-product").removeClass("col-3").addClass("col-6");
}

function tablet_res(){
	$(".list-product-detail").removeClass("flex-row overflow-a").addClass("flex-column overflow-h w-100");
	$(".list-item-product-detail").addClass("mt-3");
	$(".list-product").removeClass("col-3").addClass("col-6");
}

function destop_res(){
	$(".list-product-detail").removeClass("flex-column overflow-h w-100").addClass("flex-row overflow-a");
	$(".list-item-product-detail").removeClass("mt-3");
	$(".list-product").removeClass("col-6").addClass("col-3");
}
</script>

<script>
function activeProductDetailInfo(id){
	$(".list-item-product-detail").removeClass("active");
	$(".product-detail-info").hide();
	$("#product-detail-"+id).show();

	if(id == "komentar"){
		if(window.location.search == ""){
			window.location.search = "?productDetail=komentar";
		}
	}
	
	// document.getElementById("product-detail-"+id).scrollIntoView();
}

</script>

<!-- PRODUCT DETAIL CAROUSEL -->
<script>
$(document).ready(function() {
 $('#product-detail-image').owlCarousel({
    loop: true,
    nav: true,  
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      960: {
        items: 1
      },
      1200: {
        items: 1
      }
    }
  });    
});
</script>