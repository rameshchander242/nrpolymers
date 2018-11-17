<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Admin_Controller {
	public function index(){
		$this->render->view('dashboard');
	}
	
	public function add(){
		$this->render->view('invoice/add');
	}
	
	public function create(){
		
	}
	
	public function edit(){
		$this->render->view('invoice/edit');
	}
	
	public function update(){
		
	}
	
	public function destroy(){
		
	}
}
