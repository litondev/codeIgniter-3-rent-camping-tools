<div class="mt-3">
	<b>Kategori :</b>
	<ul class="list-group">
		<?php 
			foreach($category as $item){
		?>
		<li class="list-group-item no-border">
			<a href="<?php echo site_url();?>/product?category=<?php echo $item['name'];?>">
				<?php echo $item['name'];?>
			</a>
		</li>
		<?php 
			}
		?>
	</ul>
</div>