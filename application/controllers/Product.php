<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('product_model');
	}
	
	public function index(){
		$this->data['title'] = 'Products';
		$this->data['products'] = $this->product_model->get_all();
		$this->render->view('product/index', $this->data);
	}
	
	public function add(){
		$this->data['title'] = 'Add New product';
		//$this->session->set_flashdata('success', 'product Create Successfully.');
		$this->render->view('product/add');
	}
	
	public function create(){
		if(!empty($_POST)){
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$product_data = array(
					'product_name' => $this->input->post('product_name'),
					'product_price' => $this->input->post('product_price'),
					'product_description' => $this->input->post('product_description'),
					'created_by' => $this->session->userdata('user_id')
				);
			}
			if ($this->form_validation->run() === TRUE && $this->product_model->insert($product_data)){
				$this->session->set_flashdata('success', 'Product Create Successfully.');
				redirect('product', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('product/add', 'refresh');
			}
		}else{
			redirect('product/add', 'refresh');
		}
	}
	
	public function edit($id){
		$this->data['title'] = 'Edit Product';
		$this->data['product'] = $this->product_model->get(array('id'=>$id));
		$this->render->view('product/edit', $this->data);
	}
	
	public function update($id){
		if(!empty($_POST)){
			$product = $this->product_model->get(array('id'=>$id));
			if(empty($product)){
				$this->session->set_flashdata('error', 'Not Found Product.');
				redirect('product', 'refresh');
			}
			$this->form_validation->set_rules('product_name', 'product Name', 'trim|required');
			$this->form_validation->set_rules('product_price', 'Product price', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$product_data = array(
					'product_name' => $this->input->post('product_name'),
					'product_price' => $this->input->post('product_price'),
					'product_description' => $this->input->post('product_description'),
				);
			}
			if( $this->form_validation->run() === TRUE && $this->product_model->update($product_data, array('id'=>$product->id)) ){
				$this->session->set_flashdata('success', 'Product Update Successfully.');
				redirect('product', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('product/edit/'.$product->id, 'refresh');
			}
		}else{
			redirect('product/edit/'.$id, 'refresh');
		}
	}
	
	public function destroy(){
		
	}
}
