<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class 	Templates extends MX_Controller {

	public function imad (){
		$data = "";
		$this->template_boostrap($data); 
	}
	public function template_boostrap($data){
		if(!isset($data['stor_items'])){
			$data['stor_items'] = $this->uri->segment(1);
		}
	  $this->load->view('template_boostrap',$data);
	}
	public function public_jqm($data){
		if(!isset($data['stor_items'])){
			$data['stor_items'] = $this->uri->segment(1);
		}
	  $this->load->view('public_jqm', $data);
	}
	public function admin($data){
		if(!isset($data['stor_items'])){
			$data['stor_items'] = $this->uri->segment(1);
		}
	  $this->load->view('admin', $data);
	}
}