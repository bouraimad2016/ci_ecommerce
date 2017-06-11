<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stor_items extends MX_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}
	function view($update_id){
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$data = $this->get_data_from_db($update_id);
          //$data['stor_items'] = 'stor_items';
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
		$data['view_file'] = 'view';
		$this->load->module('templates');
		$this->templates->template_boostrap($data);
	}
	function _stor_delete_item($update_id){
			//delete coulor item
        $this->load->module('stor_item_colour');
        $this->stor_item_colour->_delete_item($update_id);
			//delete size item
        $this->load->module('stor_item_size');
        $this->stor_item_size->_delete_item($update_id);
			//delete pic item
        $data = $this->get_data_from_db($update_id);
		$big_pic = $data['big_pic']; 
		$small_pic = $data['small_pic']; 
        //get path
        $big_pic_path = './adminfiles/img/gallery/'.$big_pic;
        $small_pic_path = './adminfiles/img/small_pic/'.$small_pic;

        //unlik imag from 

         if(file_exists($big_pic_path)){
        	unlink($big_pic_path);
        }
         if(file_exists($small_pic_path)){
        	unlink($small_pic_path);
        }
			//delete  item
        $this->_delete($update_id);

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
		//$this->load->view('upload_form', $error)
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
		$submit = $this->input->post('submit', TRUE);
		if($submit=='Cancel'){
			redirect('stor_items/create/'.$update_id);
		}elseif($submit=='Yes - delete'){
           $this->_stor_delete_item($update_id);
           //flash data 
           $flash_msg = 'The Item  Was Successfully Deleted';
		   $value = '<div class="alert alert-success">'.$flash_msg.'</div>';
		   $this->session->set_flashdata('item', $value);
				
	    redirect('stor_items/manage/');
	
		}
	}
	function deleteconf($update_id){
         //redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
         // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		//$this->load->view('upload_form', $error)
			$data['update_id'] = $update_id;
		    $data['flash'] = $this->session->flashdata('item');


		$data['headline'] = 'Delete Items';
          //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'deleteconf';
		$this->load->module('templates');
		$this->templates->admin($data);
	}
	function delete_image($update_id){
	//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
    // get id

		$data = $this->get_data_from_db($update_id);
		$big_pic = $data['big_pic']; 
		$small_pic = $data['small_pic']; 
        //get path
        $big_pic_path = './adminfiles/img/gallery/'.$big_pic;
        $small_pic_path = './adminfiles/img/small_pic/'.$small_pic;

        //unlik imag from 

         if(file_exists($big_pic_path)){
        	unlink($big_pic_path);
        }
         if(file_exists($small_pic_path)){
        	unlink($small_pic_path);
        }
        unset($data);
	    $data['big_pic'] = "";
	    $data['small_pic'] = "";
	    $this->_update($update_id, $data);
        //flash data
        $flash_msg = 'The Item Image Was Successfully Deleted';
		$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
		$this->session->set_flashdata('item', $value);
				
	    redirect('stor_items/create/'.$update_id);
	}
	function _manage_thumbnail($file_name){
       $config['image_library'] = 'gd2';
		$config['source_image'] = './adminfiles/img/gallery/'.$file_name;
		$config['new_image'] = './adminfiles/img/small_pic/'.$file_name;

		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 200;
		$config['height']       = 200;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
	}
   function do_upload($update_id)	{
		//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		//submit value
		$submit = $this->input->post('submit', TRUE);
    //cansel button
		if($submit == 'Cancel'){
			redirect('stor_items/create/'.$update_id);
		}
		//upload
		$config['upload_path']          = './adminfiles/img/gallery/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 3000;
		$config['max_width']            = 2024;
		$config['max_height']           = 968;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile'))
		{
			$data['error'] = array('error' => $this->upload->display_errors());
       
			//$this->load->view('upload_form', $error)
			$data['update_id'] = $update_id;
		    $data['flash'] = $this->session->flashdata('item');

			$data['headline'] = 'upload image';
          //$data['stor_items'] = 'stor_items';
		    $data['view_file'] = 'upload_image';
			$this->load->module('templates');
			$this->templates->admin($data);
	   }
		else
		{   
			$data = array('upload_data' => $this->upload->data());
			//get finename 
			$upload_data = $data['upload_data'];
			$file_name = $upload_data['file_name'];
			$this->_manage_thumbnail($file_name);
             // insert image into database
			$upddate_data['big_pic'] = $file_name;
			$upddate_data['small_pic'] = $file_name;
            $this->_update($update_id, $upddate_data);
			//get id 
			$data['update_id'] = $update_id;
		    $data['flash'] = $this->session->flashdata('item');

			$data['headline'] = 'upload Success';
          //$data['stor_items'] = 'stor_items';
		    $data['view_file'] = 'upload_success';
			$this->load->module('templates');
			$this->templates->admin($data);

			$this->load->view('upload_success', $data);
		}
	}
	function upload_image($update_id){
	//redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
    // get id

		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');

	 // submit handler

		$data['headline'] = 'upload image';
    //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'upload_image';
		$this->load->module('templates');
		$this->templates->admin($data);
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
			redirect('stor_items/manage');
		}
	// insert data in table 
		if($submit == 'Submit'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[50]|callback_item_check');
			$this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
			$this->form_validation->set_rules('was_price', 'Was Price', 'numeric');
			$this->form_validation->set_rules('status', 'Status', 'required|numeric');
			$this->form_validation->set_rules('item_description', 'Item Description', 'required');



			if($this->form_validation->run() == TRUE){
				$data = $this->get_data_from_post();
				$data['items_url'] = url_title($data['items_title']); 
				if(is_numeric($update_id)){
					$this->_update($update_id, $data);
					$flash_msg = 'The Item Detail Was Successfully Updated';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('stor_items/create/'.$update_id);
				}else{
					$this->_insert($data);
					$update_id = $this->get_max();
					$flash_msg = 'The Item  Was Successfully Aded';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('stor_items/create/'.$update_id);
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
			$data['headline'] = 'Add New Item';
		}else{
			$data['headline'] = 'Update  Item';
		}
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
		$data['query'] = $this->get('items_title');
		$data['flash'] = $this->session->flashdata('item');
   // $data['stor_items'] = 'stor_items';
		$data['view_file'] = 'manage';
		$this->load->module('templates');
		$this->templates->admin($data);
	}
	function get_data_from_post(){
		$data['items_title'] = $this->input->post('item_title', TRUE);
		$data['items_price'] = $this->input->post('item_price', TRUE);
		$data['waz_price'] = $this->input->post('was_price', TRUE);
		$data['items_descr'] = $this->input->post('item_description', TRUE);
		$data['status'] = $this->input->post('status', TRUE);
		return $data;
	}
	function get_data_from_db($update_id){
         //redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$query = $this->get_where($update_id);
		foreach($query->result() as $row){
			$data['items_title'] = $row->items_title;
			$data['items_descr'] = $row->items_descr;
			$data['items_price'] = $row->items_price;

			$data['item_url'] = $row->items_url;
			$data['big_pic'] = $row->big_pic;
			$data['small_pic'] = $row->small_pic;
			$data['waz_price'] = $row->waz_price;
			$data['status'] = $row->status;


		}
		if(!isset($data)){
			$data = '';
		}
		return $data;
	}
	function get($order_by) {
		$this->load->model('mdl_stor_items');
		$query = $this->mdl_stor_items->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by) {
		$this->load->model('mdl_stor_items');
		$query = $this->mdl_stor_items->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id) {
		$this->load->model('mdl_stor_items');
		$query = $this->mdl_stor_items->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value) {
		$this->load->model('mdl_stor_items');
		$query = $this->mdl_stor_items->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data) {
		$this->load->model('mdl_stor_items');
		$this->mdl_stor_items->_insert($data);
	}

	function _update($id, $data) {
		$this->load->model('mdl_stor_items');
		$this->mdl_stor_items->_update($id, $data);
	}

	function _delete($id) {
		$this->load->model('mdl_stor_items');
		$this->mdl_stor_items->_delete($id);
	}

	function count_where($column, $value) {
		$this->load->model('mdl_stor_items');
		$count = $this->mdl_stor_items->count_where($column, $value);
		return $count;
	}

	function get_max() {
		$this->load->model('mdl_stor_items');
		$max_id = $this->mdl_stor_items->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query) {
		$this->load->model('mdl_stor_items');
		$query = $this->mdl_stor_items->_custom_query($mysql_query);
		return $query;
	}

	function item_check($str) {
		$items_url = url_title($str);
		$mysqli_query = "SELECT * FROM items_shop WHERE items_title = '$str' AND items_url = '$items_url'";
		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)){
			$mysqli_query .= "AND id != '$update_id'";
		}
		$query = $this->_custom_query($mysqli_query);
		$num_rows = $query->num_rows();
		if ($num_rows>0){
			$this->form_validation->set_message('item_check', 'The Item Already Exist');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}