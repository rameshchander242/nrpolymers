<?php
class MY_Model extends CI_Model{
  protected $_table_prefix = 'crm_';
  protected $table;
  public $where_arr = NULL;

  function __construct(){
    parent::__construct();
	$this->table = $this->_table_prefix.$this->table;
  }
  public function get_all($where_arr = NULL, $order_by_var_arr = NULL, $select = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
    }
    if(isset($order_by_var_arr)){
      if(!is_array($order_by_var_arr)){
        $order_by[0] = $order_by_var_arr;
        $order_by[1] = 'asc';
      }else{
        $order_by[0] = $order_by_var_arr[0];
        $order_by[1] = $order_by_var_arr[1];
      }
      $this->db->order_by($order_by[0],$order_by[1]);
    }
    if(isset($select)){
      $this->db->select($select);
    }
    $query = $this->db->get($this->table);
    //echo $this->db->last_query();
    if($query->num_rows()>0){
      foreach($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }else{
      return FALSE;
    }
  }
  public function get($where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->limit(1);
      $query = $this->db->get($this->table);
      if($query->num_rows()>0){
        return $query->row();
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }
  public function insert($columns_arr){
    if(is_array($columns_arr)){
      if($this->db->insert($this->table,$columns_arr)){
        return $this->db->insert_id();
      }else{
        return FALSE;
      }
    }
  }
  public function update($columns_arr, $where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->update($this->table,$columns_arr);
      if($this->db->affected_rows()>0){
        return $this->db->affected_rows();
      }
    }else{
      return FALSE;
    }
  }
  public function delete($where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->delete($this->table);
      return $this->db->affected_rows();
    }else{
      return FALSE;
    }
  }
	
	function get_unique_slug($string, $table, $field='slug', $key=NULL, $value=NULL, $rslug=true){
		$slug = strtolower(url_title($string));
		$i = 0; $params = array();
		$params[$field] = $slug;
		if($key)$params["$key !="] = $value;
		while ($this->db->where($params)->get($table)->num_rows()){  
			if($rslug==false) return false;
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) $slug .= '-' . ++$i;
			else $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}  
		return $slug;  
	}
}