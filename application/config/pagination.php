<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config["base_url"] = current_url();
$config["per_page"] = 10;
$config["page_query_string"] = TRUE;
$config["enable_query_string"] = TRUE;
$config["use_page_numbers"] = TRUE;
$config["reuse_query_string"] = TRUE;
$config["query_string_segment"] = "page";
$config['attributes'] = array('class' => 'page-link');
$config['last_link'] = ">>";
$config['first_link'] = "<<";
$config['cur_tag_open'] = "<strong class='page-link'>";
$config['cur_tag_close'] = "</strong>";