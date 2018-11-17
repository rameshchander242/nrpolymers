<?php
function btn_edit($url){
	return anchor($url, '<span class="fa fa-edit"></span>');
}
function btn_schedule($url){
	return anchor($url, '<span class="fa fa-calendar"></span>');
}

function btn_delete($url){
	return anchor($url, '<i class="fa fa-times text-danger"></i> ', array('onclick'=>"return confirm('You are about delete a record. This cannot be undone. Are You Sure?')"));
}

function btn_status($url='', $status=0){
	$class= ($status==0)?'fa-times-circle text-danger':'fa-check-circle text-success';
	if(empty($url) || $url=='#'){
		return '<span class="fa '.$class.'"></span>';
	}
	return anchor($url, '<span class="fa '.$class.'"></span>');
}

if(!function_exists('printx')){
	function printx($var){
		echo "<pre>"; print_r($var); echo "</pre>";
	}
}

function datex($d='', $f=''){
	$d = !empty($d)?$d:date('Y-m-d H:i:s');
	$f = !empty($f)?$f:'Y-m-d H:i:s';
	return date($f, strtotime($d));
}

function pagination($url, $total, $segment=3, $limit=10, $num_links=6){
	$ci =& get_instance();
	$ci->load->library('pagination');
	$config['base_url'] = $url;
	$config['per_page'] = $limit;
	$config['total_rows'] = $total;
	$config['uri_segment'] = $segment;
    $config["num_links"] = $num_links;
	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['prev_link'] = '&laquo';
	$config['prev_tag_open'] = '<li class="prev">';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = '&raquo';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';	
	$ci->pagination->initialize($config);
	return $ci->pagination->create_links();
}

function title($str){
	return ucwords(str_replace('_', ' ', $str));
}

function clear_website($url){
	return trim(str_replace(array('http://','https://','www.'),'',$url));
}

function error_message($ci){
	if($ci->session->flashdata('error')){
		echo '<div class="alert alert-danger">'.title($ci->session->flashdata('error')).'</div>';
	}elseif($ci->session->flashdata('success')){
		echo '<div class="alert alert-success">'.title($ci->session->flashdata('success')).'</div>';
	}elseif($ci->session->flashdata('message')){
		echo '<div class="alert alert-warning">'.title($ci->session->flashdata('message')).'</div>';
	}
}

function user_restrict($ci){
	if($ci->session->userdata('user_role')!='admin'){
		$ci->template->view('crm/user_restrict', $ci->data); 
		return true;
	}
}
function is_allowed($ci){
	if($ci->session->userdata('user_role')!='admin'){
		return false;
	}
	return true;
}

function currency_format($price, $sign=false){
	return ($sign==true?CURRENCY_SIGN:currency_sign()).$price;
}

function currency_sign(){
	return '<i class="fa fa-'.CURRENCY_ICON.'"></i>';
}