<div class="mt-3">
	<form 
		action="<?php echo site_url();?>/product"
  		method="get">

  		<input type="hidden" 
  				name="search" 
				value="<?php echo $this->input->get('search');?>">

  		<input type="hidden" 
  				name="category" 
				value="<?php echo $this->input->get('category');?>">

		<ul class="list-group mt-2">
			<li class="list-group-item no-border">					
	  			<input type="radio" 
	  			 name="price"
				 value="termahal"
				 onclick="this.form.submit()"> Paling Mahal
			</li>
			<li class="list-group-item no-border">
				<input type="radio" 
				 name="price"
				 value="termurah"
				 onclick="this.form.submit()"> Paling Murah
			</li>
		</ul>
	</form>
</div>