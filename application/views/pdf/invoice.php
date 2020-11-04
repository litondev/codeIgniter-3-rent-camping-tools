<!DOCTYPE HTML>
<html>
	<head>
		<style>
			table {
				padding: 10px !important;
			}

	        .clearfix::after {
	  			content: "";
		  		clear: both;
	  			display: table;
			}

			.list-invoice{
				padding: 10px;
				margin-left: 10px;
			}

			.list-item-invoice{
				padding: 0px;
			}
		</style>
	</head>
<body>
	<div class="clearfix">		
		<div style="float:left">
			<h3>Invoice No #<?php echo $invoice['id'];?></h3>				
		</div>
		<div style="float:right">
			Dibuat Pada 
			<br>
			<b><?php echo $invoice['created_at'];?></b>
		</div>
	</div>

	<div class="clearfix">		
		<div style="float:left">
			<div class="list-invoice">
				<div class="list-item-invoice">Status Sekarang</div>
				<div class="list-item-invoice">
					<?php if($invoice['status'] == "completed"){ ?>
					<b class="badge badge-success">
						Selesai
					</b>
					<?php }elseif(
						$invoice['status'] == "expired payment" || 
						$invoice['status'] == "rejected" || 
						$invoice['status'] == "canceled" || 
						$invoice['status'] == "expired invoice"
					){ ?>
					<b class="badge badge-danger">
						<?php if($invoice['status'] == "expired payment"){ ?>
							Kadaluarasa Pembayaran
						<?php }elseif($invoice['status'] == "expired invoice"){ ?>
							Kadaluarasa Invoice
						<?php }elseif($invoice['status'] == "rejected"){ ?>
							Ditolak
						<?php }elseif($invoice['status'] == "canceled"){ ?>
							Dibatalkan
						<?php } ?>
					</b>
					<?php }elseif($invoice['status'] == "pending"){ ?>
			 		<b class="badge badge-warning text-light">
			 			Pending
			 		</b>
			 		<?php }elseif($invoice['status'] == "payment"){ ?>
			 		<b class="badge badge-primary text-light">
			 			Pembayaran
			 		</b>
			 		<?php }elseif($invoice['status'] == "prepare"){ ?>
			 		<b class="badge badge-primary text-light">
			 			Persiapan
			 		</b>
			 		<?php }elseif($invoice['status'] == "withdrawing stuff"){ ?>
			 		<b class="badge badge-success text-light">
			 			Pengambilan Barang
			 		</b>
			 		<?php }elseif($invoice['status'] == "in rent"){ ?>
			 		<b class="badge badge-success text-light">
			 			Dalam Penyewaan
			 		</b>
			 		<?php }elseif($invoice['status'] == "backing stuff"){ ?>
			 		<b class="badge badge-success text-light">
			 			Pengembalian Barang
			 		</b>
			 		<?php } ?>
				</div>
			</div>		

			<div class="list-invoice">
				<div class="list-item-invoice">Tgl Sewa</div>
				<div class="list-item-invoice">
					<b><?php echo $invoice['start_rent'];?></b>
				</div>
			</div>

			<div class="list-invoice">
				<div class="list-item-invoice">Tgl Sewa Berakhir</div>
				<div class="list-item-invoice">
					<b><?php echo $invoice['end_rent'];?></b>
				</div>
			</div>

			<div  class="list-invoice">
				<div class="list-item-invoice">Jaminan</div>
				<div class="list-item-invoice">
					<b><?php echo $invoice['guaranteing'];?></b>
				</div>
			</div>
		</div>

		<div style="float:right">
			<?php if($invoice['status'] != "pending"){?>
				<div class="list-invoice">
					<div class="list-item-invoice">Status Pembayaran</div>
					<div class="list-item-invoice">
						<?php if($invoice['status_payment'] == "unpaid"){ ?>
							<b>Belum bayar</b>
						<?php }elseif($invoice['status_payment'] == "expired"){?>
							<b>Expired</b>
						<?php }elseif($invoice['status_payment'] == "paid"){ ?>
							<b>Sudah Bayar</b>
						<?php } ?>
					</div>
				</div>

				<div class="list-invoice">
					<div class="list-item-invoice">Expired Pembayaran</div>
					<div class="list-item-invoice">
						<?php echo $invoice['expired_payment'];?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<table>
		<tr>
			<th>Product name</th>
			<th>Harga</td>
		</tr>

		<?php foreach($product as $order_item){ ?>
		<tr>
			<td width="400px">
				<?php echo $order_item['name'];?>
			</td>
			<td width="400px">
				<span style="color:green">
					<b><?php echo money($order_item['rent_price']);?></b>
				</span>
			</td>
		</tr>
		<?php } ?> 
	</table>

	<table>
		<tr>
			<td width="200px">
				<b>Jumlah Biaya Total</b>
			</td>
			<td width="100px">
				<b style="color:green">
					<?php echo money($invoice['total']);?>
				</b>
			</td>
		</tr>	
	</table>
</body>
</html>