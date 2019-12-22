<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(0);
class Privilege extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Roles_Model');
		$this->load->model('Privilege_Model');
		$this->check_admin_login();
		//$this->check_privilege();
	}
	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}
    }
	function privilege_list(){
		$privilege 						= $this->General_Model->get_home_page_settings();
		$privilege['privilege_list'] 	= $this->Privilege_Model->get_privilege_list();
		$this->load->view('privilege/privilege_list',$privilege);
	}
	
	function add_privilege(){
		if(count($_POST) > 0){
			$this->Privilege_Model->add_privilege_details($_POST);
			redirect('privilege/privilege_list','refresh');
		}else{
			$privilege							= $this->General_Model->get_home_page_settings();
			$privilege['roles_list'] 			= $this->Roles_Model->get_roles_list();
			$privilege['module_list'] 			= $this->Privilege_Model->get_module_list();
			$privilege['module_details_list'] 	= $this->Privilege_Model->get_module_details_list();
			$this->load->view('privilege/add_privilege',$privilege);
		}
	}
	
	function active_privilege($privilege_id){
		$this->Privilege_Model->active_privilege($privilege_id);
		redirect('privilege/privilege_list','refresh');
	}
	
	function inactive_privilege($privilege_id){
		$this->Privilege_Model->inactive_privilege($privilege_id);
		redirect('privilege/privilege_list','refresh');
	}
	
	function delete_privilege($privilege_id){
		$this->Privilege_Model->delete_privilege($privilege_id);
		redirect('privilege/privilege_list','refresh');
	}
	
	function edit_privilege($privilege_id)
	{
		$privilege 		= $this->General_Model->get_home_page_settings();
		$privilege['privilege'] = $this->Privilege_Model->get_privilege_list($privilege_id);
		$this->load->view('privilege/edit_privilege',$privilege);
	}

	function update_privilege($privilege_id)
	{
		if(count($_POST) > 0){
			$this->Privilege_Model->update_privilege($_POST,$privilege_id);
			redirect('privilege/privilege_list','refresh');
		}else if($privilege_id!=''){
			redirect('privilege/privilege_list','refresh');
		}else{
			redirect('privilege/privilege_list','refresh');
		}
	}
	
	function privilegeInfo($role_id1=''){
		$role_id 			= json_decode(base64_decode($role_id1));
		$data 				= $this->General_Model->get_home_page_settings();
		$data['role_id']	= $role_id;
		$data['info']		= $this->General_Model->get_left_menu_details();
		$data['default']	= $this->General_Model->get_default_module();
		$this->load->view('privilege/privilege_info',$data);
	}
}
