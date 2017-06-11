<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends MX_Controller
{

function __construct() {
parent::__construct();
}
function _draw_item_to_cart($item_id){
     //post coulour 
     $submited_colour = $this->input->post('submited_colour', TRUE);
     if($submited_colour == ''){
     	$colour_options[''] = 'Select ...';
     }
     $this->load->module('stor_item_colour');
     $query = $this->stor_item_colour->get_where_custom('item_id', $item_id);
     //get cout rows 
     $data['colour_count'] = $query->num_rows();
     foreach($query->result() as $row){
     	$colour_options[$row->id] = $row->item_colour; 
     }
     $data['submited_colour'] = $submited_colour;
     $data['colour_options'] = $colour_options;

      //post size 
     $submited_size = $this->input->post('submited_size', TRUE);
     if($submited_size == ''){
     	$size_options[''] = 'Select ...';
     }
     $this->load->module('stor_item_size');
     $query = $this->stor_item_size->get_where_custom('item_id', $item_id);
     //get cout rows 
     $data['size_count'] = $query->num_rows();
     foreach($query->result() as $row){
     	$size_options[$row->id] = $row->item_size; 
     }
     $data['submited_size'] = $submited_size;
     $data['size_options'] = $size_options;
     $data['item_id'] = $item_id;
     $this->load->view('add_to_cart', $data);
    
}


}