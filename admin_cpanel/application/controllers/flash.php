<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Flash extends CI_Controller {	
	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Flash_Model');
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
	 
	function flash_list(){
		$flash 				= $this->General_Model->get_home_page_settings();
		$flash['flash_list'] 	= $this->Flash_Model->get_flash_list();
		$this->load->view('flash/flash_list',$flash);
	}
	
	function add_flash(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('flash_title','Flash Title','required');
			$this->form_validation->set_rules('description','Description','required');
			$this->form_validation->set_rules('duration','Duration','required');
			if($this->form_validation->run()==TRUE){
				$this->Flash_Model->add_flash_details($_POST);
				redirect('flash/flash_list','refresh');
			} else {
				$flash = $this->General_Model->get_home_page_settings();
				$this->load->view('flash/add_flash',$flash);
			}
		}else{
			$flash = $this->General_Model->get_home_page_settings();
			$this->load->view('flash/add_flash',$flash);
		}
	}
	
	function active_flash($flash_id){
		$flash_id = json_decode(base64_decode($flash_id));
		if($flash_id != ''){
			$this->Flash_Model->active_flash($flash_id);
		}
		redirect('flash/flash_list','refresh');
	}
	
	function inactive_flash($flash_id){
		//echo $flash_id;
		$flash_id = json_decode(base64_decode($flash_id));
		if($flash_id != ''){
			$this->Flash_Model->inactive_flash($flash_id);
		}
		redirect('flash/flash_list','refresh');
	}
	
	function delete_flash($flash_id){
		$flash_id = json_decode(base64_decode($flash_id));
		if($flash_id != ''){
			$this->Flash_Model->delete_flash($flash_id);
		}
		redirect('flash/flash_list','refresh');
	}
	
	function edit_flash($flash_id)
	{
		$flash_id = json_decode(base64_decode($flash_id));
		if($flash_id != ''){
			$flash 			   = $this->General_Model->get_home_page_settings();
			$flash['flash_list'] = $this->Flash_Model->get_flash_list($flash_id);
			$this->load->view('flash/edit_flash',$flash);
		} else {
			redirect('flash/flash_list','refresh');
		}
	}

	function update_flash($flash_id1){
		if(count($_POST) > 0){
			$flash_id = json_decode(base64_decode($flash_id1));
			if($flash_id != ''){
				$this->form_validation->set_rules('flash_title','Flash Title','required');
				$this->form_validation->set_rules('description','Description','required');
				$this->form_validation->set_rules('duration','Duration','required');
				if($this->form_validation->run()==TRUE){
					$this->Flash_Model->update_flash($_POST,$flash_id);
				} else {
					redirect('flash/edit_flash/'.$flash_id1,'refresh');
				}
			} 
			redirect('flash/flash_list','refresh');
		}else if($flash_id!=''){
			redirect('flash/flash_list','refresh');
		}else{
			redirect('flash/flash_list','refresh');
		}
	}
}
