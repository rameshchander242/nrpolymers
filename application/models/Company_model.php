<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->table='companies';
	}
}
