<style>
.product-favorite-item{
 height:262px;
 position:relative;
}

.product-favorite-inside-item{
 position:absolute;
 top:10%;
 left:20%;
 text-align: center;
}

.kategori-product:hover{
  box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
  border:3px solid rgb(127,127,127,0.2); 
  border-radius: 20px;
}
</style>

<div class="container">
	<div class="row pb-5 pt-5">
    <!-- SLIDER HOME PAGE -->
    <?php 
      echo $slider;
    ?>
    <!-- SLIDER HOME PAGE -->

    <!-- PRODUCT FAVORITE TERBARU -->
    <?php 
      echo $wishlist;
    ?>
    <!-- PRODUCT FAVORITE TERBARU -->
	</div>

  <!-- PRODUCT TERSEWA TERBANYAK -->  
    <?php 
      echo $mostRent;
    ?>
  <!-- PRODUCT TERSEWA TERBANYAK -->

  <!-- PRODUCT -->  
  <?php 
    echo $product;
  ?>
  <!-- PRODUCT -->

  <!-- KATEGORI -->
	<?php 
    echo $category;
  ?>
  <!-- KATEGORI -->
</div>

<!-- RESPONSIVE -->
<script>
function phone_res(){
  $(".list-product,.kategori-product").removeClass("col-3").addClass("col-6");
}

function tablet_res(){
  $(".list-product,.kategori-product").removeClass("col-3").addClass("col-6");
}

function destop_res(){
  $(".list-product,.kategori-product").removeClass("col-6").addClass("col-3");
}
</script>

<!-- OWL CAROUSEL -->
<script>
$("document").ready(function(){    
  $('#slider-home-page').owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
  })

  $('#product-favorite').owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items: 2
        },
        1000: {
          items: 2
        }
      }
  })

  $("#product-most-rent").owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 3
        }
      }
  })
});
</script>