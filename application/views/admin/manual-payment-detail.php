<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-lg-8 col-sm-12">
			<div class="row">
				<?php 
					echo $detail;
				?>

				<?php 
					echo $history;
				?>
			</div>
		</div>

		<div class="col-md-4 col-lg-4 col-sm-12">
			<?php 
				echo $detailInvoice;
			?>
		</div>
	</div>
</div>

<?php 
	echo $modalReasonFailed;
?>

<script>
$("#form-reason-failed").parsley().on('form:validate',function(){
	if($("#form-reason-failed").parsley().isValid()){
		$("#button-reason-failed").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-reason-failed").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>