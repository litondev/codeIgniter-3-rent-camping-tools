<div class="modal no-border" 
	id="modal-add-komentar">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
            Balasan Komentar
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
      		<form
      			action="<?php echo site_url();?>/admin/review/replay-add"
      			method="post"
      			id="form-add-komentar"
      			enctype="multipart/form-data">											

      			<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>"
              name="<?php echo $this->security->get_csrf_token_name();?>">

            <input type="hidden" name="id">

      			<div class="form-group row">
      				<div class="col-3">
      					Balasan
      				</div>
      				<div class="col-9">
      					<textarea class="form-control" 
                  name="replay" 
                  data-parsley-required></textarea>
      				</div>
      			</div>

      			<div class="form-group">
      				<button class="btn btn-primary" 
      					type="submit" 
      					id="button-add-komentar">
      					<i class="fa fa-reply"></i> Balasan
      				</button>
      			</div>
      		</form>
        </div>      
      </div>
	</div>
</div>