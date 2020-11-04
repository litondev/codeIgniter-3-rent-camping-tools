<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Komentar</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama User</th>
	              <th>Nama Product</th>
	              <th>Komentar</th>
	              <th>Bintang</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($review as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['first_name'];?></td>
	          		<td><?php echo $item['name'];?></td>
	          		<td><?php echo $item['komentar'];?></td>
	          		<td>
	          			<?php if($item['star'] == 1){ ?>
	          				<b class="text-danger">
	          					1 
	          				</b>
	          			<?php }elseif($item['star'] == 2){ ?>
	          				<b class="text-danger">
	          					2
	          				</b>
	          			<?php }elseif($item['star'] == 3){ ?>
							<b class="text-warning">          			
								3 
							</b>
	          			<?php }elseif($item['star'] == 4){ ?>
	          				<b class="text-info">
	          					4 
	          				</b>
	          			<?php }elseif($item['star'] == 5){ ?>
							<b class="text-success">
								5 
							</b>
	          			<?php }elseif($item['star'] == 0){ ?>
	          				<b class="text-dark">
	          					Blm Ada
	          				</b>
	          			<?php } ?>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>	      
	          		 	<?php if(empty($item['replay'])){ ?>   			          
	          				<button class="btn btn-primary mt-2"
	          					data-toggle="modal"
	          					data-target="#modal-add-komentar"
	          					onclick="onAddData('<?php echo $item['id'];?>')">
		          				<i class="fa fa-reply"></i>
	          					Berikan Balasan
	          				</button>
	          			<?php } else { ?>
	          				<button class="btn btn-primary mt-2"
	          					data-toggle="modal"
	          					data-target="#modal-edit-komentar"
	          					onclick="onEditData('<?php echo $item['id'];?>','<?php echo $item['replay'];?>')">
		          				<i class="fa fa-reply"></i>
		          				Edit Balasan
	          				</button>
	          			<?php } ?>

	          			<button class="btn btn-danger mt-2"
	          			 	onclick="deleteData('<?php echo site_url();?>/admin/review/<?php echo $item['id'];?>')">
	          				<i class="fa fa-trash"></i>
	          				Hapus
	          			</button>
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($review)){ ?>
	          	<tr>
	          		<td colspan="100" class="text-center">
	          			<h5>Data tidak ditemukan</h5>
	          		</td>
	          	</tr>
	          	<?php } ?>
	          </tbody>	         
	        </table>

	        <div class="p-3">
				<nav class="float-right paginate-overflow pagination">						
					<?php 
						echo $review_link;
					?>
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
</div>

<?php 
	echo $modalAdd;
?>

<?php 
	echo $modalEdit;
?>

<!-- SEARCH WITH DATERANGE PICKER -->
<script>
$('#search-created-at').daterangepicker({
	timePicker: true,	
}).on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:00'));  		      
	$(this)[0].form.submit();
}).on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
}).on("outsideClick.daterangepicker",function(ev,picker){
  $(this).val('');
});

$("#search-created-at").val("<?php echo $this->input->get('search_created_at') ?? '';?>");
</script>

<!-- ON EDIT DAN ADD -->
<script>
function onAddData(id){
	$("#form-add-komentar").find("input[name=id]").val(id);
}

function onEditData(id,replay){
	$("#form-edit-komentar").find("input[name=id]").val(id);
	$("#form-edit-komentar").find("textarea[name=replay]").val(replay);
}
</script>

<!-- DELETE DATA -->
<script>
function deleteData(action){
  swal.fire({
    title: 'Apakah Anda Yakin?',
    text: 'Menghapus data ini',
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
  	 window.location = action;
  	}
  })
}
</script>

<!-- VALIDATION -->
<script>
$("#form-edit-komentar").parsley().on('form:validate',function(){
	if($("#form-edit-komentar").parsley().isValid()){
		$("#button-edit-komentar").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-komentar").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-add-komentar").parsley().on('form:validate',function(){
	if($("#form-add-komentar").parsley().isValid()){
		$("#button-add-komentar").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-komentar").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>