<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Controller extends CI_Controller {
	public $data = array();
	public function __construct(){
		parent::__construct();
		$this->data['error'] = array();
		$this->data['site_name'] = config_item('site_name');
	}
}

class Admin_Controller extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = '&copy; CRM';
		$this->load->helper(array('form', 'language'));
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->lang->load('auth');
		$this->load->model('Ion_auth_model', 'auth');
		$exception_urls = array('login', 'logout');
		if(in_array(uri_string(), $exception_urls) == FALSE){
			if($this->ion_auth->logged_in() === FALSE){
				redirect('login');
			}
		}
	}
}