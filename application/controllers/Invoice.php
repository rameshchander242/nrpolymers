<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('invoice_model');
	}
	
	public function index(){
		$this->data['title'] = 'Invoices';
		$this->data['invoices'] = $this->invoice_model->get_all();
		$this->render->view('invoice/index', $this->data);
	}
	
	public function add(){
		$this->data['title'] = 'Add New Invoice';
		$this->load->model('company_model');
		$this->load->model('product_model');
		$this->data['companies'] = $this->company_model->get_all();
		$this->data['products'] = $this->product_model->get_all();
		//$this->session->set_flashdata('success', 'invoice Create Successfully.');
		$this->render->view('invoice/add');
	}
	
	public function create(){
		if(!empty($_POST)){
			$this->form_validation->set_rules('invoice_name', 'Invoice Name', 'trim|required');
			$this->form_validation->set_rules('invoice_price', 'Invoice Price', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$invoice_data = array(
					'invoice_name' => $this->input->post('invoice_name'),
					'invoice_price' => $this->input->post('invoice_price'),
					'invoice_description' => $this->input->post('invoice_description'),
					'created_by' => $this->session->userdata('user_id')
				);
			}
			if ($this->form_validation->run() === TRUE && $this->invoice_model->insert($invoice_data)){
				$this->session->set_flashdata('success', 'Invoice Create Successfully.');
				redirect('invoice', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('invoice/add', 'refresh');
			}
		}else{
			redirect('invoice/add', 'refresh');
		}
	}
	
	public function edit($id){
		$this->data['title'] = 'Edit Invoice';
		$this->data['invoice'] = $this->invoice_model->get(array('id'=>$id));
		$this->render->view('invoice/edit', $this->data);
	}
	
	public function update($id){
		if(!empty($_POST)){
			$invoice = $this->invoice_model->get(array('id'=>$id));
			if(empty($invoice)){
				$this->session->set_flashdata('error', 'Not Found Invoice.');
				redirect('invoice', 'refresh');
			}
			$this->form_validation->set_rules('invoice_name', 'Invoice Name', 'trim|required');
			$this->form_validation->set_rules('invoice_price', 'Invoice price', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$invoice_data = array(
					'invoice_name' => $this->input->post('invoice_name'),
					'invoice_price' => $this->input->post('invoice_price'),
					'invoice_description' => $this->input->post('invoice_description'),
				);
			}
			if( $this->form_validation->run() === TRUE && $this->invoice_model->update($invoice_data, array('id'=>$invoice->id)) ){
				$this->session->set_flashdata('success', 'Invoice Update Successfully.');
				redirect('invoice', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('invoice/edit/'.$invoice->id, 'refresh');
			}
		}else{
			redirect('invoice/edit/'.$id, 'refresh');
		}
	}
	
	public function destroy(){
		
	}
}
