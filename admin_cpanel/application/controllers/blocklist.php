<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Blocklist extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Blocklist_Model');
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
     
	function block_list(){
		$block_list 					= $this->General_Model->get_home_page_settings();
		$block_list['blocklist'] 		= $this->Blocklist_Model->get_block_list();
		// echo '<pre/>';print_r($block_list);exit;
		$this->load->view('blocklist/blocklist_list',$block_list);
	}
	
	function add_block_list(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('block_list_name', 'Block List Name', 'required');
			if ($this->form_validation->run() == TRUE){
				$this->Blocklist_Model->add_block_list($_POST);
				redirect('blocklist/block_list','refresh');
			} else {
				$block_list = $this->General_Model->get_home_page_settings();
				$this->load->view('blocklist/add_blocklist',$block_list);
			}
		}else{
			$block_list = $this->General_Model->get_home_page_settings();
			$this->load->view('blocklist/add_blocklist',$block_list);
		}
	}
	
	function active_block_list($block_list_id){
		$block_list_id = json_decode(base64_decode($block_list_id));
		if($block_list_id != ''){
			$this->Blocklist_Model->active_block_list($block_list_id);
		}
		redirect('blocklist/block_list','refresh');
	}
	
	function inactive_block_list($block_list_id){
		$block_list_id = json_decode(base64_decode($block_list_id));
		if($block_list_id != ''){
			$this->Blocklist_Model->inactive_block_list($block_list_id);
		}
		redirect('blocklist/block_list','refresh');
	}
	
	function delete_block_list($block_list_id){
		$block_list_id = json_decode(base64_decode($block_list_id));
		if($block_list_id != ''){
			$this->Blocklist_Model->delete_block_list($block_list_id);
		}
		redirect('blocklist/block_list','refresh');
	}
	
	function edit_block_list($block_list_id){
		$block_list_id = json_decode(base64_decode($block_list_id));
		if($block_list_id){
			$block_list = $this->General_Model->get_home_page_settings();
			$block_list['blocklist'] = $this->Blocklist_Model->get_block_list($block_list_id);
			$this->load->view('blocklist/edit_blocklist',$block_list);
		} else {
			redirect('blocklist/block_list','refresh');
		}
	}
	
	function update_block_list($block_list_id){
		if(count($_POST) > 0){
			$block_list_id = json_decode(base64_decode($block_list_id));
			if($block_list_id != ''){
				$this->form_validation->set_rules('block_list_name', 'Block List Name', 'required');
				if ($this->form_validation->run() == TRUE ) {
					$this->Blocklist_Model->update_block_list($_POST,$block_list_id);				
				} else {
					$block_list = $this->General_Model->get_home_page_settings();
					$block_list['blocklist'] = $this->Blocklist_Model->get_block_list($block_list_id);
					$this->load->view('blocklist/edit_blocklist',$block_list);
				}
			}
			redirect('blocklist/block_list','refresh');
		}else if($block_list_id!=''){
			redirect('blocklist/edit_block_list/'.$block_list_id,'refresh');
		}else{
			redirect('blocklist/block_list','refresh');
		}
	}
}
