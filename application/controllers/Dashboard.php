<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->data['title'] = 'Dashboard';
		$this->render->view('dashboard', $this->data);
	}
	
	public function login(){
		$this->data['title'] = 'Login';
		$this->render->layout = 'fullPage';
		$this->render->view('login', $this->data);
	}
	
	public function logout(){
		
	}
}
