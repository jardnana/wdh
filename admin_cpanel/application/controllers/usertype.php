<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Usertype extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Usertype_Model');
		$this->check_admin_login();
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

    function index(){
		$user_type 					= $this->General_Model->get_home_page_settings();
		$user_type['user_type'] 	= $this->Usertype_Model->get_user_type_list();
		$this->load->view('user_type/user_type_list',$user_type);
	}

	function add_user_type(){
		if(count($_POST) > 0){
			$this->Usertype_Model->add_user_type_details($_POST);
			redirect('usertype','refresh');
		}else{
			$user_type = $this->General_Model->get_home_page_settings();
			$this->load->view('user_type/add_user_type',$user_type);
		}
	}
	
	function active_user_type($user_type_id){
		$this->Usertype_Model->active_user_type($user_type_id);
		redirect('usertype','refresh');
	}
	
	function inactive_user_type($user_type_id){
		$this->Usertype_Model->inactive_user_type($user_type_id);
		redirect('usertype','refresh');
	}
	
	function delete_user_type($user_type_id){
		$this->Usertype_Model->delete_user_type($user_type_id);
		redirect('usertype','refresh');
	}
	
	function edit_user_type($user_type_id){
		$user_type 					= $this->General_Model->get_home_page_settings();
		$user_type['user_type'] 	= $this->Usertype_Model->get_user_type_list($user_type_id);
		$this->load->view('user_type/edit_user_type',$user_type);
	}

	function update_user_type($user_type_id){
		if(count($_POST) > 0){
			$this->Usertype_Model->update_user_type($_POST,$user_type_id);
			redirect('usertype','refresh');
		}else if($user_type_id!=''){
			redirect('usertype/edit_user_type/'.$user_type_id,'refresh');
		}else{
			redirect('usertype','refresh');
		}
	}
}
