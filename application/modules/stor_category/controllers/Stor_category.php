<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stor_category extends MX_Controller
{

function __construct() {
parent::__construct();
}
function _get_cat_parent($update_id){
	$data = $this->get_data_from_db($update_id);
	$cat_title = $data['cat_title'];
	return $cat_title;
}
function get_data_from_post(){
		$data['cat_title'] = $this->input->post('cat_title', TRUE);
		$data['cat_parent'] = $this->input->post('cat_parent', TRUE);
		return $data;
	}
	function get_data_from_db($update_id){
         //redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$query = $this->get_where($update_id);
		foreach($query->result() as $row){
			$data['cat_title'] = $row->cat_title;
			$data['cat_parent'] = $row->cat_parent;
		}
		if(!isset($data)){
			$data = '';
		}
		return $data;
	}
function _get_category_parent($update_id){
	if(!is_numeric($update_id)){
		$update_id = 0;
	}
	$options[''] = 'Please Select ...';
    $mysql_query = "SELECT * from items_category where cat_parent = 0 AND id != $update_id";
    $query = $this->_custom_query($mysql_query);
    foreach($query->result() as $row){
    	$options[$row->id] = $row->cat_title;
    }
    return $options;
}
function create(){
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
    // get id
		$update_id = $this->uri->segment(3);
		$submit = $this->input->post('submit', TRUE);
    //cansel button
		if($submit == 'Cancel'){
			redirect('Stor_category/manage');
		}
	// insert data in table 
		if($submit == 'Submit'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('cat_title', 'category name', 'required|max_length[50]');
			


			if($this->form_validation->run() == TRUE){
				$data = $this->get_data_from_post();
				 
				if(is_numeric($update_id)){
					$this->_update($update_id, $data);
					$flash_msg = 'The Category Detail Was Successfully Updated';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('Stor_category/create/'.$update_id);
				}else{
					$this->_insert($data);
					$update_id = $this->get_max();
					$flash_msg = 'The Category  Was Successfully Aded';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('Stor_category/create/'.$update_id);
				}
			}
		}
	 // submit handler
		if((is_numeric($update_id))&&($submit!='Submit')){
			$data = $this->get_data_from_db($update_id);
		}else{
			$data = $this->get_data_from_post();
		}
     // create headline 
		if(!is_numeric($update_id)){
			$data['headline'] = 'Add New Category';
		}else{
			$data['headline'] = 'Update  Category';
		}
		$data['options'] = $this->_get_category_parent($update_id);
		$data['count_parent_cat'] = count($data['options']);
   // load data to module
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
    //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'create';
		$this->load->module('templates');
		$this->templates->admin($data);
	}
function manage(){

		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
	// get data from database
		$data['query'] = $this->get('cat_title');
		$data['flash'] = $this->session->flashdata('item');
   // $data['stor_items'] = 'stor_items';
		$data['view_file'] = 'manage';
		$this->load->module('templates');
		$this->templates->admin($data);
	}
function get($order_by) {
$this->load->model('mdl_stor_category');
$query = $this->mdl_stor_category->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_stor_category');
$query = $this->mdl_stor_category->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_stor_category');
$query = $this->mdl_stor_category->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_stor_category');
$query = $this->mdl_stor_category->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_stor_category');
$this->mdl_stor_category->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_stor_category');
$this->mdl_stor_category->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_stor_category');
$this->mdl_stor_category->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_stor_category');
$count = $this->mdl_stor_category->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_stor_category');
$max_id = $this->mdl_stor_category->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_stor_category');
$query = $this->mdl_stor_category->_custom_query($mysql_query);
return $query;
}

}