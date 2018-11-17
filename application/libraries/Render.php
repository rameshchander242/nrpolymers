<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Render{
    public $viewFolder = null;
    public $layoutsFodler = 'layouts';
    public $layout = 'default';
	public $header_content = '';
	public $footer_content = '';
    var $obj;

    function __construct(){
        $this->obj =& get_instance();
    }

    function view($view, $data=NULL, $returnhtml=FALSE){
        $view = $view;
		$loadedData = empty($data) ? $this->obj->data : $data;
        $loadedData['view_content'] = ($this->viewFolder)?$this->viewFolder.'/'.$view:$view;

        $layoutPath = '/'.$this->layoutsFodler.'/'.$this->layout;
        $this->obj->load->view($layoutPath, $loadedData);
    }
	
	function setHeader($content){
		$this->header_content .= $content;
	}
	function setFooter($content){
		$this->footer_content .= $content;
	}
	function getHeader(){
		return $this->header_content;
	}
	function getFooter(){
		return $this->footer_content;
	}
}