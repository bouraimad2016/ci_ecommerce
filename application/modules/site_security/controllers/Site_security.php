<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_security extends MX_Controller
{

function __construct() {
parent::__construct();
}
function _hasshin_password($str){
	$hash = password_hash($str, PASSWORD_BCRYPT, array('cost' => 11));
	return $hash;
}
function _confirm_password($confirm_password, $hash){
    $password_confirm = password_verify($confirm_password, $hash);
    return $password_confirm;
}

function _make_sure_is_admin(){
	$is_admin = TRUE;
	if($is_admin != TRUE){
		redirect('Site_security/not_allowed');
	}
}
function not_allowed(){
	echo 'You Cant Be Here';
}


}