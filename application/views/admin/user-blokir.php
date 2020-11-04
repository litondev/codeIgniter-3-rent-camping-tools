<div class="container-fluid">
	<?php 
		echo $search;
	?>

	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola User Blokir</h5> 	
	      <hr/>
	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama depan</th>
	              <th>Email</th>
	              <th>Deskripsi Blokir</th>
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
	          			<b><?php echo $item['description_blokir'];?></b>
	          		</td>
	          		<td><?php echo $item['created_at'];?></td>
	          		<td><?php echo $item['updated_at'];?></td>
	          		<td>	     	          				   		          
	      				<button class="btn btn-info mt-1"
	      					onclick="unBlokirUser('<?php echo site_url();?>/admin/user/unblokir/<?php echo $item['id'];?>')">
	      					<i class="fa fa-check"></i> Unblokir
	      				</button>
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
// UNBLOKIR USER
function unBlokirUser(action){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();
  	window.location = action;
}
</script>