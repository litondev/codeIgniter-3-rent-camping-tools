<?php

function money($money){
	return "Rp ".number_format(intval($money),"2");
}

function get_product_images($images){
	return json_decode($images);
}