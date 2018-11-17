<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('company_model');
	}
	
	public function index(){
		$this->data['title'] = 'Companies';
		$this->data['companies'] = $this->company_model->get_all();
		$this->render->view('company/index', $this->data);
	}
	
	public function add(){
		$this->data['title'] = 'Add New Company';
		//$this->session->set_flashdata('success', 'Company Create Successfully.');
		$this->render->view('company/add');
	}
	
	public function create(){
		if(!empty($_POST)){
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$more_contacts = array();
				foreach($this->input->post('more_contacts')['name'] as $key=>$val){
					if( !empty($this->input->post('more_contacts')['name'][$key]) || !empty($this->input->post('more_contacts')['number'][$key]) ){
						$more_contacts['name'][] = $this->input->post('more_contacts')['name'][$key];
						$more_contacts['number'][] = $this->input->post('more_contacts')['number'][$key];
					}
				}
				$company_data = array(
					'company_name' => $this->input->post('company_name'),
					'customer_name' => $this->input->post('customer_name'),
					'contact_number' => $this->input->post('contact_number'),
					'more_contacts' => json_encode($more_contacts),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'pincode' => $this->input->post('pincode'),
					'created_by' => $this->session->userdata('user_id')
				);
			}
			if ($this->form_validation->run() === TRUE && $this->company_model->insert($company_data)){
				$this->session->set_flashdata('success', 'Company Create Successfully.');
				redirect('company', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('company/add', 'refresh');
			}
		}else{
			redirect('company/add', 'refresh');
		}
	}
	
	public function edit($id){
		$this->data['title'] = 'Edit Company';
		$this->data['company'] = $this->company_model->get(array('id'=>$id));
		$this->render->view('company/edit', $this->data);
	}
	
	public function update($id){
		if(!empty($_POST)){
			$company = $this->company_model->get(array('id'=>$id));
			if(empty($company)){
				$this->session->set_flashdata('error', 'Not Found Company.');
				redirect('company', 'refresh');
			}
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				$more_contacts = array();
				foreach($this->input->post('more_contacts')['name'] as $key=>$val){
					if( !empty($this->input->post('more_contacts')['name'][$key]) || !empty($this->input->post('more_contacts')['number'][$key]) ){
						$more_contacts['name'][] = $this->input->post('more_contacts')['name'][$key];
						$more_contacts['number'][] = $this->input->post('more_contacts')['number'][$key];
					}
				}
				$company_data = array(
					'company_name' => $this->input->post('company_name'),
					'customer_name' => $this->input->post('customer_name'),
					'contact_number' => $this->input->post('contact_number'),
					'more_contacts' => json_encode($more_contacts),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'pincode' => $this->input->post('pincode'),
					'created_by' => $this->session->userdata('user_id')
				);
			}
			if( $this->form_validation->run() === TRUE && $this->company_model->update($company_data, array('id'=>$company->id)) ){
				$this->session->set_flashdata('success', 'Company Update Successfully.');
				redirect('company', 'refresh');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect('company/edit/'.$company->id, 'refresh');
			}
		}else{
			redirect('company/edit/'.$id, 'refresh');
		}
	}
	
	public function destroy(){
		
	}
}
