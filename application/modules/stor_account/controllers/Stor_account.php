<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stor_account extends MX_Controller
{

function __construct() {
parent::__construct();
}
function update_password(){
		$this->load->library('session');
    // security form
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
    // get id
		$update_id = $this->uri->segment(3);
		$submit = $this->input->post('submit', TRUE);
		if(!is_numeric($update_id)){
			redirect('stor_account/manage');
		}elseif($submit == 'Cancel'){
			redirect('stor_account/create/'.$update_id);
		}
	// insert data in table 
		if($submit == 'Submit'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

			if($this->form_validation->run() == TRUE){
				
					$password = $this->input->post('password', TRUE);
					$this->load->module('site_security');
					$data['password'] = $this->site_security->_hasshin_password($password);
					$this->_update($update_id, $data);
					$flash_msg = 'The Password  Was Successfully Updated';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('stor_account/create/'.$update_id);
				
			}
		}
	
	    $data['headline'] = 'Update  Password';
         // load data to module
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
         //$data['stor_items'] = 'stor_items';
		$data['view_file'] = 'update_password';
		$this->load->module('templates');
		$this->templates->admin($data);
	}
function get_data_from_post(){
		$data['firstname'] = $this->input->post('firstname', TRUE);
		$data['lastname'] = $this->input->post('lastname', TRUE);
		$data['company'] = $this->input->post('company', TRUE);
		$data['adress1'] = $this->input->post('adress1', TRUE);
		$data['adress2'] = $this->input->post('adress2', TRUE);
		$data['town'] = $this->input->post('town', TRUE);
		$data['country'] = $this->input->post('country', TRUE);
		$data['poste_code'] = $this->input->post('poste_code', TRUE);
		$data['telephone'] = $this->input->post('telephone', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		return $data;

}
	
	
function get_data_from_db($update_id){
         //redirect if not allowd
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$query = $this->get_where($update_id);
		foreach($query->result() as $row){
			$data['firstname'] = $row->firstname;
			$data['lastname'] = $row->lastname;
			$data['company'] = $row->company;
			$data['adress1'] = $row->adress1;
			$data['adress2'] = $row->adress2;
			$data['town'] = $row->town;
			$data['country'] = $row->country;
			$data['poste_code'] = $row->poste_code;
			$data['telephone'] = $row->telephone;
			$data['email'] = $row->email;
			$data['password'] = $row->password;
		}
		if(!isset($data)){
			$data = '';
		}
		return $data;
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
			redirect('stor_account/manage');
		}
	// insert data in table 
		if($submit == 'Submit'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('lastname', 'Item Title', 'required');
			

			if($this->form_validation->run() == TRUE){
				$data = $this->get_data_from_post();
			
				if(is_numeric($update_id)){
					$this->_update($update_id, $data);
					$flash_msg = 'The Item Detail Was Successfully Updated';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('stor_account/create/'.$update_id);
				}else{
					$data['date_made'] = time();
					$this->_insert($data);
					$update_id = $this->get_max();
					$flash_msg = 'The Item  Was Successfully Aded';
					$value = '<div class="alert alert-success">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('stor_account/create/'.$update_id);
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
			$data['headline'] = 'Add New Account';
		}else{
			$data['headline'] = 'Update  Account';
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
		$data['query'] = $this->get('lastname');
		$data['flash'] = $this->session->flashdata('item');
   // $data['stor_items'] = 'stor_items';
		$data['view_file'] = 'manage';
		$this->load->module('templates');
		$this->templates->admin($data);
	}

function get($order_by) {
$this->load->model('mdl_stor_account');
$query = $this->mdl_stor_account->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_stor_account');
$query = $this->mdl_stor_account->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_stor_account');
$query = $this->mdl_stor_account->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_stor_account');
$query = $this->mdl_stor_account->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_stor_account');
$this->mdl_stor_account->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_stor_account');
$this->mdl_stor_account->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_stor_account');
$this->mdl_stor_account->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_stor_account');
$count = $this->mdl_stor_account->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_stor_account');
$max_id = $this->mdl_stor_account->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_stor_account');
$query = $this->mdl_stor_account->_custom_query($mysql_query);
return $query;
}
 function imad (){
 	$mysql_query = "SHOW COLUMNs FROM items_acount";
 	$query = $this->_custom_query($mysql_query);
 	foreach($query->result() as $row){
		$filds = $row->Field;
	$var = '<div class="control-group">
 						<label class="control-label">'.ucfirst($filds). ': </label>
 						<div class="controls">
							<input type="text" class="span6" name="'.$filds.'" value="<?php echo $'.$filds.';?>"  />
				</div>
 					</div>';
 					echo htmlentities($var);
 					echo '<br>';
	}
  }
}