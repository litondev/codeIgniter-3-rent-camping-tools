<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Slider</h5> 

	      <button class="btn btn-primary"
	      	data-toggle="modal"
	      	data-target="#modal-add-slider">
	      	<i class="fa fa-plus"></i> Tambah
	      </button>
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Link</th>
	              <th>Aktif</th>
	              <th>Gambar</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($slider as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td>
	          			<a href="<?php echo $item['link'];?>" target="_blank">
	          				<?php echo $item['link'];?>
	          			</a>
	          		</td>
	          		<td>
	          			<input type="checkbox" data-plugin="switchery" 
	          			onchange="onChangeStatus(event)"
	          			<?php echo $item['status'] == 'aktif' ? 'checked' : '';?>
	          			value="<?php echo $item['id'];?>">
	          		</td>
	          		<td>
	          			<a href="<?php echo base_url('assets/images/sliders/'.$item['image']);?>" target="_blank">
	          				<img src="<?php echo base_url('assets/images/sliders/'.$item['image']);?>" height="50px">	          	
	          			</a>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>	          			
	          			<button class="btn btn-danger mt-1"
	          				onclick="deleteData('<?php echo site_url();?>/admin/slider/<?php echo $item['id'];?>')">
	          				<i class="fa fa-trash"></i> Hapus
	          			</button>
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($slider)){ ?>
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
						echo $slider_link;
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

<!-- DELETE ALERT -->
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
$("#form-add-slider").parsley().on('form:validate',function(){
	if($("#form-add-slider").parsley().isValid()){
		$("#button-add-slider").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-slider").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<script>
function onChoseImage(event){
	var files = event.target.files;

	if (files && files[0]) {		
		if(!['image/png','image/jpg','image/jpeg'].includes(files[0].type)){
			document.getElementById("form-add-slider").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-add-slider").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>

<script>
function onChangeStatus(event){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();

	if(event.target.checked){
 		window.location = "<?php echo site_url();?>/admin/slider/"+event.target.value+"/aktif";
	}else{
		window.location = "<?php echo site_url();?>/admin/slider/"+event.target.value+"/nonaktif";
	}
}
</script>