<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Pages extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Pages_Model');
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
	 
	function pages_list(){
		$pages 					= $this->General_Model->get_home_page_settings();
		$pages['pages_list'] 	= $this->Pages_Model->get_pages_list();
		$this->load->view('pages/pages_list',$pages);
	}
	
	function add_pages(){
		if(count($_POST) > 0){
			$this->Pages_Model->add_pages_details($_POST);
			redirect('pages/pages_list','refresh');
		}else{
			$api = $this->General_Model->get_home_page_settings();
			$this->load->view('pages/add_pages',$api);
		}
	}
	
	function active_pages($pages_id){
		$pages_id = json_decode(base64_decode($pages_id));
		if($pages_id != ''){
			$this->Pages_Model->active_pages($pages_id);
		}
		redirect('pages/pages_list','refresh');
	}
	
	function inactive_pages($pages_id){
		$pages_id = json_decode(base64_decode($pages_id));
		if($pages_id != ''){
			$this->Pages_Model->inactive_pages($pages_id);
		}
		redirect('pages/pages_list','refresh');
	}
	
	function delete_pages($pages_id){
		$pages_id = json_decode(base64_decode($pages_id));
		if($pages_id != ''){
			$this->Pages_Model->delete_pages($pages_id);
		}
		redirect('pages/pages_list','refresh');
	}
	
	function edit_pages($pages_id){
		$pages_id = json_decode(base64_decode($pages_id));
		if($pages_id != ''){
			$pages 					= $this->General_Model->get_home_page_settings();
			$pages['pages_list'] 	= $this->Pages_Model->get_pages_list($pages_id);
			$this->load->view('pages/edit_pages',$pages);
		} else {
			redirect('pages/pages_list','refresh');
		}
	}

	function update_pages($pages_id){
		if(count($_POST) > 0){
			$pages_id = json_decode(base64_decode($pages_id));
			if($pages_id != ''){
				$this->Pages_Model->update_pages($_POST,$pages_id);
			}
			redirect('pages/pages_list','refresh');
		}else if($pages_id!=''){
			redirect('pages/edit_pages/'.$pages_id,'refresh');
		}else{
			redirect('pages/pages_list','refresh');
		}
	}
}
