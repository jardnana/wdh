<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Content extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Content_Model');
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
	 
	function content_list(){
		$content 					= $this->General_Model->get_home_page_settings();
		$content['content_list'] 	= $this->Content_Model->get_content_list();
		$this->load->view('content/content_list',$content);
	}
	
	function add_content(){
		if(count($_POST) > 0){
			$this->Content_Model->add_content_details($_POST);
			redirect('content/content_list','refresh');
		}else{
			$api = $this->General_Model->get_home_page_settings();
			$this->load->view('content/add_content',$api);
		}
	}
	
	function active_content($content_id){
		$content_id = json_decode(base64_decode($content_id));
		if($content_id != ''){
			$this->Content_Model->active_content($content_id);
		}
		redirect('content/content_list','refresh');
	}
	
	function inactive_content($content_id){
		$content_id = json_decode(base64_decode($content_id));
		if($content_id != ''){
			$this->Content_Model->inactive_content($content_id);
		}
		redirect('content/content_list','refresh');
	}
	
	function delete_content($content_id){
		$content_id = json_decode(base64_decode($content_id));
		if($content_id != ''){
			$this->Content_Model->delete_content($content_id);
		}
		redirect('content/content_list','refresh');
	}
	
	function edit_content($content_id){
		$content_id = json_decode(base64_decode($content_id));
		if($content_id != ''){
			$content 					= $this->General_Model->get_home_page_settings();
			$content['content_list'] 	= $this->Content_Model->get_content_list($content_id);
			$this->load->view('content/edit_content',$content);
		} else {
			redirect('content/content_list','refresh');
		}
	}

	function update_content($content_id){
		if(count($_POST) > 0){
			$content_id = json_decode(base64_decode($content_id));
			if($content_id != ''){
				$this->Content_Model->update_content($_POST,$content_id);
			}
			redirect('content/content_list','refresh');
		}else if($content_id!=''){
			redirect('content/edit_content/'.$content_id,'refresh');
		}else{
			redirect('content/content_list','refresh');
		}
	}
}
