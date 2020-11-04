<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola User</h5> 	

	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama depan</th>
	              <th>Email</th>
	              <th>Status</th>
	              <th>Role</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php foreach($user as $item){ ?>
	          	<tr>
	          		<td><?php echo $item['id'];?></td>
	          		<td><?php echo $item['first_name'];?></td>
	          		<td><?php echo $item['email'];?></td>
	          		<td>
	          			<?php if($item['status'] == "aktif"){ ?>
	          				<span class="badge badge-success">
	          					Aktif
	          				</span>
	          			<?php } else { ?>
	          				<span class="badge badge-danger">
	          					Blokir
	          				</span>
	          			<?php } ?>
	          		</td>
	          		<td>
	          			<?php if($item['role'] == 'admin'){ ?>
	          				<span class="badge badge-danger">
	          					Admin
	          				</span>
	          			<?php } else { ?>
	          				<span class="badge badge-success">
	          					User
	          				</span>
	          			<?php } ?>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>	     
	          			<?php if($item['role'] != 'admin'){ ?>
		          			<button class="btn btn-success mt-1"
								onclick="window.location='<?php echo site_url();?>/admin/user/<?php echo $item['id'];?>'">		          		
		          				<i class="fa fa-edit"></i> Edit
		          			</button>	    

		          			<?php if($item['status'] == 'aktif'){ ?>
		          				<button class="btn btn-danger mt-1"
		          					data-toggle="modal"
		      						data-target="#modal-blokir-user"
		          					onclick="blokirUser('<?php echo $item['id'];?>')">
		          					<i class="fa fa-times"></i> Blokir
		          				</button>
		          			<?php } else { ?>
		          				<button class="btn btn-info mt-1"
		          					onclick="unBlokirUser('<?php echo site_url();?>/admin/user/action-unblokir/<?php echo $item['id'];?>')">
		          					<i class="fa fa-check"></i> Unblokir
		          				</button>
		          			<?php } ?>
	          			<?php } ?>		
	          		</td>
	          	</tr>
	          	<?php } ?>

	          	<?php if(!count($user)){ ?>	          
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
						echo $user_link;
					?>
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
</div>

<?php 
	echo $modalBlokirUser;
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

<script>
// BLOKIR USER
function blokirUser(id){
	$("#form-blokir-user").find("input[name=id]").val(id);
}

// UNBLOKIR USER
function unBlokirUser(action){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();
  	window.location = action;
}
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-blokir-user").parsley().on('form:validate',function(){
	if($("#form-blokir-user").parsley().isValid()){
		$("#button-blokir-user").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-blokir-user").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>