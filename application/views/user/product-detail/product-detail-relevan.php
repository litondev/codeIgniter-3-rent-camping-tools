<div class="row pl-4 pr-4 pt-3 pb-3" 
 id="product-relevan">

<?php if(count($productRelevan)){ ?>
<div class="col-12">
	<h6>Product Terkait</h6>
</div>
<?php } ?>

<?php foreach($productRelevan as $item){ ?>
<div class="mt-3 mb-3  list-product">          
  <div class="box-camp d-flex flex-column justify-content-between border-radius-20" 
    style="height:100%">      
    <div class="card-header no-border bg-none text-center pos-relative" 
      style="height:50%">      
        <img 
            src="<?php echo base_url('assets/images/products/'.get_product_images($item['images'])[0]);?>"
            style="width:80%;height:auto;max-width:80%">
      
        <?php 
          if($this->LSession->user()){
        ?>
        <div style="height:25px;width:25px;border-radius:50%;background:violet;position:absolute;bottom:20px;right:20px;padding-top:0px;" 
          class="box-camp cursor-pointer"
          onclick="this.disabled = true;window.location='<?php echo site_url();?>/action/add-cart/<?php echo $item['id'];?>'">
          <small>
            <i class="fa fa-shopping-basket" 
              style="color:white"></i>
          </small>
        </div>
        <?php }else { ?>
          <div style="height:25px;width:25px;border-radius:50%;background:violet;position:absolute;bottom:20px;right:20px;padding-top:0px;" 
            class="box-campc cursor-pointer"
            onclick="window.location='<?php echo site_url();?>/signin'">
          <small>
            <i class="fa fa-shopping-basket" style="color:white"></i>
          </small>
        </div>
        <?php } ?>
    </div>

    <div class="row p-2">        
      <div class="col-md-6 col-sm-12 col-lg-6 p-3">
        <span class="ft-15">
          <a href="<?php echo site_url();?>/product/<?php echo $item['id'];?>">
            <?php echo $item['name'];?>
          </a>
        </span>

        <br>

        <span class="ft-13 text-success">
          <?php echo money($item['rent_price']);?>
        </span>

        <br>

        <?php if($item['status_rent']){ ?>
          <span class="ft-13 text-danger">
            Tersewa
          </span>
        <?php }else{ ?>
          <span class="ft-13 text-success">
            Tidak Tersewa
          </span>
        <?php } ?>
      </div>

      <div class="col-md-6 col-sm-12 col-lg-6 p-3">
        <small>
          <span id="make-star-product-<?php echo $item['id'];?>"></span>
        </small>

        <script>
          makeStar('<?php echo $item['star'];?>','make-star-product-<?php echo $item['id'];?>')
        </script>
      </div>
    </div>  
  </div>
</div>  
<?php } ?>