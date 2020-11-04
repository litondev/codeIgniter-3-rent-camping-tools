<div class="card shadow mb-4">
	<form
		action="<?php echo site_url();?>/admin/category"
		method="get">
    	<div class="card-body row">
	
    		<div class="col-12">
    			<h6>Search : </h6>
    		</div>	

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
		    	<input type="text" 
		    		class="form-control" 
		    		placeholder="Dari id" 
		    		name="form_id"
		    		onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
		    		value="<?php echo $this->input->get('form_id') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Ke id" 
	    			name="to_id"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
		    		value="<?php echo $this->input->get('to_id') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Nama" 
	    			name="name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('name') ?? '';?>">
	    	</div>

  			<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control" 
	    			name="status"
	    			onchange="this.form.submit()">	    			
	    			<option value="">Pilih</option>
	    			<option value="aktif" <?php echo $this->input->get('status') && $this->input->get('status') == 'aktif' ? 'selected' : '';?>>Aktif</option>
	    			<option value="nonaktif" <?php echo $this->input->get('status') && $this->input->get('status') == 'nonaktif' ? 'selected' : '';?>>Nonaktif</option>	    			
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Search Tgl"
	    			name="search_created_at"
	    			id="search-created-at">
	    	</div>		    	

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<a class="btn btn-info" 
	    			href="<?php echo site_url();?>/admin/category">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>