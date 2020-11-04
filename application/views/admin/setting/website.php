<div class="container-fluid">
	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola setting website</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	      	<form 
	      		action="<?php echo site_url();?>/admin/setting/website/action-edit"
	      		method="post"
	      		id="form-setting-website">

	      		<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
				 	name="<?php echo $this->security->get_csrf_token_name();?>">

		        <table class="table table-borderless table-hover">	         
		        	<thead>
		       	  		<tr>
			       	  		<th width="200px">Nama</th>
			       	  		<th>Nilai</th>
		       	  		</tr>
		       		</thead>
		       		<tbody>
		       			<tr>
		       				<td>Nama website</td>
		       				<td>
		       					<input type="text" 
		       						name="site_name"
		       						class="form-control"
		       						data-parsley-required
		       						value="<?php echo $this->config->item('app.site_name');?>"/>	       					
		       					<small>
		       						* nama website		       					
		       					</small>
		       				</td>
		       			</tr>
		       			
		       			<tr>
		       				<td>Meta deskripsi</td>
		       				<td>
		       					<input type="text" 
		       						name="meta_description"
		       						class="form-control"
		       						data-parsley-required
		       						value="<?php echo $this->config->item('app.meta_description');?>"/>	       					
		       					<small>
		       						* meta deskripsi		       					
		       					</small>
		       				</td>
		       			</tr>

		       			<tr>
		       				<td>Footer kontak kami</td>
		       				<td>
		       					<input type="text" 
		       						name="footer_contact_us"
		       						class="form-control"
		       						data-parsley-required
		       						value="<?php echo $this->config->item('app.footer_contact_us');?>"/>	       					
		       					<small>
		       						* Footer Kontak Kami	       					
		       					</small>
		       				</td>
		       			</tr>

		       			<tr>
		       				<td>Kota</td>
		       				<td>
		       					<input type="text" 
		       						name="city"
		       						class="form-control"
		       						data-parsley-required
		       						value="<?php echo $this->config->item('app.city');?>"/>	       					
		       					<small>
		       						* Kota       					
		       					</small>
		       				</td>
		       			</tr>

		       			<tr>
		       				<td colspan="2">
		       					<button class="btn btn-info"
		       						id="button-setting-website"><i class="fa fa-edit"></i> Edit</button>
		       				</td>
		       			</tr>
		       		</tbody>
		        </table>
	    	</form>
	      </div>
	    </div>
	</div>
</div>

<script>
$("#form-setting-website").parsley().on('form:validate',function(){
	if($("#form-setting-website").parsley().isValid()){
		$("#button-setting-website").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-setting-website").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>