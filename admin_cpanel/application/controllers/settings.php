<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Settings extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Settings_Model');
		// $this->check_admin_login();		
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
	 
	public function index(){
		$settings 				= $this->General_Model->get_home_page_settings();
		$settings['settings'] 	= $this->Settings_Model->get_settings_list();
		//	 echo '<pre/>';print_r($settings);exit;
		$this->load->view('settings/index',$settings);
	}
	
	function update_settings(){
		$this->Settings_Model->update_settings_details($_POST);
		redirect('settings','refresh');
	}
}
