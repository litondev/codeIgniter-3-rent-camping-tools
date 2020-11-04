<!-- SUMMER NOTE -->	
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/sumernote/summernote-bs4.min.css');?>">

<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Info</h5> 

	      <button class="btn btn-primary"
	      	data-toggle="modal"
	      	data-target="#modal-add-info">
	      	<i class="fa fa-plus"></i> Tambah
	      </button>
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Judul</th>
	              <th>Gambar</th>
	              <th>Sub title</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($info as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['title'];?></td>
	          		<td>
	          			<a href="<?php echo base_url('assets/images/infos/'.$item['image']);?>" target="_blank">
	          				<img src="<?php echo base_url('assets/images/infos/'.$item['image']);?>" height="50px">	          	
	          			</a>
	          		</td>
	          		<td><?php echo $item['sub_title'];?></td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>
	          			<button class="btn btn-success mt-1"
	          				onclick="editData('<?php echo $item['title'];?>','<?php echo $item['sub_title'];?>',`<?php echo $item['content'];?>`,'<?php echo site_url();?>/admin/info/action-edit/<?php echo $item['id'];?>')"
	          				data-toggle="modal"
	      					data-target="#modal-edit-info">
	          				<i class="fa fa-edit"></i> Edit
	          			</button>
	          			<button class="btn btn-danger mt-1"
	          				onclick="deleteData('<?php echo site_url();?>/admin/info/<?php echo $item['id'];?>')">
	          				<i class="fa fa-trash"></i> Hapus
	          			</button>
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($info)){ ?>
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
						echo $info_link;
					?>
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
</div>


<?php 
	echo $modalAdd;
	echo $modalEdit;
?>

<!-- SUMMER NOTE -->
<script src="<?php echo base_url('assets/admin/sumernote/summernote-bs4.min.js');?>"></script>

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

<!-- SUMERNOTE INSTALL -->
<script>
$('#sumernote-add').summernote({
	placeholder : "Kontent"
});	

$('#sumernote-edit').summernote({
	placeholder : "Kontent",
	height: 400
});
</script>

<!-- EDIT DATA -->
<script>
function editData(title,sub_title,content,action){	
	$("#form-edit-info").attr({"action" : action});
	$("#modal-edit-info").find("input[name=title]").val(title);
	$("#modal-edit-info").find("input[name=sub_title]").val(sub_title);
	$("#sumernote-edit").summernote("code",content);
}
</script>

<!-- VALIDATION -->
<script>
$("#form-add-info").parsley().on('form:validate',function(){
	if($("#form-add-info").parsley().isValid()){
		$("#button-add-info").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-info").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-edit-info").parsley().on('form:validate',function(){
	if($("#form-edit-info").parsley().isValid()){
		$("#button-edit-info").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-info").attr("disabled",true);
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
			document.getElementById("form-add-info").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-add-info").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>