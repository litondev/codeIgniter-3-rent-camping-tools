<div class="container-fluid">
  	<div class="row">
  		<div class="col-md-7 col-lg-7 col-sm-12">
  			<div class="row">		
  				<?php 
  					echo $detail;
  				?>
	    		
	    		<?php
	    			echo $manualPayment;
	    		?>
	    	</div>
    	</div>

    	<div class="col-md-5 col-lg-5 col-sm-12">
    		<?php 
    			echo $product;
    		?>
    	</div>
	</div>
	
	<?php 
		echo $modalAddFine;
	?>

	<?php 
		echo $modalEditFine;
	?>

	<?php 
		echo $modalReasonReject;
	?>
</div>

<!-- MASK -->
<script>
$("input[name=fine_total]").mask("000.000.000",{reverse: true});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-reason-rejected").parsley().on('form:validate',function(){
	if($("#form-reason-rejected").parsley().isValid()){
		$("#button-reason-rejected").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-reason-rejected").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-add-fine").parsley().on('form:validate',function(){
	if($("#form-add-fine").parsley().isValid()){
		$("#button-add-fine").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-fine").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-edit-fine").parsley().on('form:validate',function(){
	if($("#form-edit-fine").parsley().isValid()){
		$("#button-edit-fine").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-fine").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>