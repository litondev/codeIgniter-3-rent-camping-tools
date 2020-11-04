<style>
.list-info-invoice{
 border-radius:10px;
}
</style>

<div class="container">
	<div class="row p-2">
		<div class="col-12 text-center p-3">
			<h4>Detail Invoice #<?php echo $invoice['id'];?></h4>
		</div>

		<div class="col-12">
			<div class="row p-3">
				<!-- DETAIL -->
				<?php echo $detail;?>

				<!-- SIDEBAR -->
				<?php echo $infoSidebar;?>
			</div>
		</div>
	</div>
</div>

<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>

<!-- INFO -->
<?php echo $jsInfo;?>

<!-- CANCEL ORDER -->
<?php echo $jsCancelOrder;?>

<!-- ON CHOSE IMAGE -->
<?php echo $jsInChoseImage;?>

<!-- FORM VALIDATION REVIEW -->
<?php if(
	$invoice['status'] == "in rent" || 
	$invoice['status'] == "backing stuff"
){ ?>
	<?php foreach($invoice['product'] as $item){ ?>
	<script>
		$("#form-review-<?php echo $item['id'];?>").parsley().on('form:validate',function(){
			if($("#form-review-<?php echo $item['id'];?>").parsley().isValid()){
				$("#button-submit-form-review-<?php echo $item['id'];?>").html("<i class='fa fa-spinner fa-spin'></i>")
				$("#button-submit-form-review-<?php echo $item['id'];?>").attr("disabled",true);
				$("#button-cancel-form-review-<?pjp echo $item['id'];?>").attr("disabled",true);
			}else{
				toastr.warning("Sepertinya ada data yang belum valid","");
			}
		});
	</script>
	<?php } ?>

	<script>
		function showFormReviewProduct(id){	
			$(".form-review-product").hide();
			$("#form-review-product-"+id).show();
		}

		function hideFormReviewProduct(){
			$(".form-review-product").hide();
		}
	</script>
<?php } ?>