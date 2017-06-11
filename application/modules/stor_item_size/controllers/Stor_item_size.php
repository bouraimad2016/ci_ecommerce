<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stor_item_size extends MX_Controller
{

function __construct() {
parent::__construct();
}
function _delete_item($update_id){
	$mysql_query = "DELETE FROM item_size WHERE item_id = $update_id";
    $query = $this->_custom_query($mysql_query); 

}
function delete($update_id){
	//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		//get data from dataase
		$query = $this->get_where($update_id);
		foreach($query->result() as $row){
			$item_id = $row->item_id;
		}
		//delete item 
		$this->_delete($update_id);
		$flash_msg = 'The Item Size Was Successfully Deleted';
		$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
		$this->session->set_flashdata('item', $value);
	    //redirect
	    redirect('stor_item_size/update/'.$item_id);
		// get id
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
	 // submit handler
		$data['headline'] = 'Update Size Item';
    //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'update';
		$this->load->module('templates');
		$this->templates->admin($data);
	}

function submit($update_id){
	//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
    // get id

		
	    $submit = $this->input->post('submit', TRUE);
	    $size = trim($this->input->post('size', TRUE));
	    if($submit=='Finish'){
            redirect('Stor_items/create/'.$update_id);
	    }else if($submit == 'Submit'){
	    	if($size !=''){
              $data['item_id'] = $update_id;
              $data['item_size'] = $size;
              $data = $this->_insert($data);
              //flash data 
              $flash_msg = 'The Item Size Was Successfully added';
		      $value = '<div class="alert alert-success">'.$flash_msg.'</div>';
		      $this->session->set_flashdata('item', $value);
	
	    	}
	    }
        redirect('stor_item_size/update/'.$update_id);
	}

function update($update_id){
	//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		//get data from dataase
		$data['query'] = $this->get_where_custom('item_id', $update_id);
		$data['num_rows'] = $data['query']->num_rows();
    // get id
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
	 // submit handler
		$data['headline'] = 'Update Size Item';
    //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'update';
		$this->load->module('templates');
		$this->templates->admin($data);
	}

function get($order_by) {
$this->load->model('mdl_stor_item_size');
$query = $this->mdl_stor_item_size->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_stor_item_size');
$query = $this->mdl_stor_item_size->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_stor_item_size');
$query = $this->mdl_stor_item_size->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_stor_item_size');
$query = $this->mdl_stor_item_size->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_stor_item_size');
$this->mdl_stor_item_size->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_stor_item_size');
$this->mdl_stor_item_size->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_stor_item_size');
$this->mdl_stor_item_size->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_stor_item_size');
$count = $this->mdl_stor_item_size->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_stor_item_size');
$max_id = $this->mdl_stor_item_size->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_stor_item_size');
$query = $this->mdl_stor_item_size->_custom_query($mysql_query);
return $query;
}

}