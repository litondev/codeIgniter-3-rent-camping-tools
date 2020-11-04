<div class="container-fluid">
	<div class="row">
		<?php 
			echo $widget;
		?>

    	<!-- STATISTIK PENJUALAN -->
    	<?php 
    		echo $statistikSale;
    	?>

		<!-- STATISTIK USER -->
		<?php 
			echo $statistikUser;
		?>

		<!-- STATISTIK 5 INVOICE TERAKHIR -->
		<?php 
			echo $statistikInvoice;
		?>

		<!-- STATISTIK 5 PEMBAYRAN MANUAL TERAKHIR -->
		<?php 
			echo $statistikPayment;
		?>
	</div>
</div>

<script src="<?php echo base_url('assets/user/assets/js/canvasjs.min.js');?>"></script>

<script>
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",	
	data: [{        
		type: "column",  
		dataPoints: [      
			<?php for($i=0;$i<($this->input->get('gap') ? intval($this->input->get('gap')) : 7);$i++){ ?>
				{
				 y: <?php echo intval($total_value_sales[$i]);?>, 
				 label: "<?php echo $label_sales[$i];?> (<?php echo $total_sales[$i];?>)"
				},			
			<?php } ?>
		]
	}]
});

chart.render();
</script>