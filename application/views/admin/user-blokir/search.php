<div class="card shadow mb-4">
	<form
		action="<?php echo site_url();?>/admin/user-blokir"
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
	    			placeholder="Nama Depan" 
	    			name="first_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('first_name') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Nama Belakang" 
	    			name="last_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('last_name') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Email" 
	    			name="email"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('email') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="No Telp" 
	    			name="phone"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('phone') ?? '';?>">
	    	</div>
			
	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control"
	    			name="gender"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>	    			
	    				<option value="male" <?php echo $this->input->get('gender') && $this->input->get('male') ? 'selected' : '';?>>Laki-Laki</option>
	    				<option value="female" <?php echo $this->input->get('gender') && $this->input->get('female') ? 'selected' : '';?>>Perempuan</option>	    			
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
	    		<select 
	    			class="form-control"
	    			name="per_page"
	    			onchange="this.form.submit()">
	    			<option value="10" <?php echo $this->input->get('per_page') && $this->input->get('per_page') == '10' ? 'selected' : '';?>>10</option>
	    			<option value="20" <?php echo $this->input->get('per_page') && $this->input->get('per_page') == '20' ? 'selected' : '';?>>20</option>
	    			<option value="30" <?php echo $this->input->get('per_page') && $this->input->get('per_page') == '30' ? 'selected' : '';?>>30</option>
	    			<option value="40" <?php echo $this->input->get('per_page') && $this->input->get('per_page') == '40' ? 'selected' : '';?>>40</option>
	    			<option value="50" <?php echo $this->input->get('per_page') && $this->input->get('per_page') == '50' ? 'selected' : '';?>>50</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select 
	    			class="form-control"
	    			name="column"
	    			onchange="this.form.submit()">
	    			<option value="id" <?php echo $this->input->get('column') && $this->input->get('column') == 'id' ? 'selected' : '';?>>Id</option>
	    			<option value="first_name" <?php echo $this->input->get('column') && $this->input->get('column') == 'first_name' ? 'selected' : '';?>>Nama</option>
	    			<option value="last_name" <?php echo $this->input->get('column') && $this->input->get('column') == 'laste_name' ? 'selected' : '';?>>Nama Belakang</option>	    		
	    		</select>
	    	</div>

 			<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select 
	    			class="form-control"
	    			name="order_by"
	    			onchange="this.form.submit()">
	    			<option value="desc" <?php echo $this->input->get('order_by') && $this->input->get('order_by') == 'desc' ? 'selected' : '';?>>Terbesar</option>	    		    		
	    			<option value="asc" <?php echo $this->input->get('order_by') && $this->input->get('order_by') == 'asc' ? 'selected' : '';?>>Terkecil</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<a class="btn btn-info" 
	    			href="<?php echo site_url();?>/admin/user/blokir">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>