<div class="card shadow mb-4">
	<form
		action="<?php echo site_url();?>/admin/invoice"
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
	    			placeholder="User Nama" 
	    			name="first_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('first_name') ?? '';?>">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control"
	    			name="status"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="pending" <?php echo $this->input->get('status') && $this->input->get('status') == 'pending' ? 'selected' : '';?>>Pending</option>
	    			<option value="payment" <?php echo $this->input->get('status') && $this->input->get('status') == 'payment' ? 'selected' : '';?>>Pembayaran</option>
	    			<option value="prepare" <?php echo $this->input->get('status') && $this->input->get('status') == 'prepare' ? 'selected' : '';?>>Persiapan</option>
	    			<option value="in rent" <?php echo $this->input->get('status') && $this->input->get('status') == 'in rent' ? 'selected' : '';?>>Dalam Penyewaan</option>
	    			<option value="completed" <?php echo $this->input->get('status') && $this->input->get('status') == 'completed' ? 'selected' : '';?>>Selesai</option>
	    			<option value="canceled" <?php echo $this->input->get('status') && $this->input->get('status') == 'canceled' ? 'selected' : '';?>>Batal</option>
	    			<option value="rejected" <?php echo $this->input->get('status') && $this->input->get('status') == 'rejected' ? 'selected' : '';?>>Ditolak</option>
	    			<option value="expired payment" <?php echo $this->input->get('status') && $this->input->get('status') == 'expired payment' ? 'selected' : '';?>>Kadaluarsa Pembayaran</option>
	    			<option value="expired invoice" <?php echo $this->input->get('status') && $this->input->get('status') == 'expired invoice' ? 'selected' : '';?>>Kadaluarsa Invoice</option>
	    			<option value="backing stuff" <?php echo $this->input->get('status') && $this->input->get('status') == 'backing stuff' ? 'selected' : '';?>>Pengembalian Barang</option>
	    			<option value="withdrawing stuff" <?php echo $this->input->get('status') && $this->input->get('status') == 'withdrawing stuff' ? 'selected' : '';?>>Pengambilan Barang</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">	
	    		<select class="form-control"    			
	    			name="status_payment"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="unpaid" <?php echo $this->input->get('status_payment') && $this->input->get('status_payment') == 'unpaid' ? 'selected' : '';?>>Belum Bayar</option>
	    			<option value="paid" <?php echo $this->input->get('status_payment') && $this->input->get('status_payment') == 'paid' ? 'selected' : '';?>>Sudah Bayar</option>
	    			<option value="expired" <?php echo $this->input->get('status_payment') && $this->input->get('status_payment') == 'expired' ? 'selected' : '';?>>Kadaluarsa</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text"
	    			class="form-control"
	    			placeholder="Total"
	    			name="total"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="<?php echo $this->input->get('total') ?? '';?>">
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
	    			href="<?php echo site_url();?>/admin/invoice">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>