<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Api extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Api_Model');
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
	 
	function api_list(){
		$api 				= $this->General_Model->get_home_page_settings();
		$api['api_list'] 	= $this->Api_Model->get_api_list();
		$this->load->view('api/api_list',$api);
	}
	
	function add_api(){
		if(count($_POST) > 0){
			$api_logo_name = '';
			$this->form_validation->set_rules('api_name', 'API Name', 'required');
			$this->form_validation->set_rules('api_name_alternative', 'API Alternative Name', 'required');
			$this->form_validation->set_rules('api_user_name', 'API User Name', 'required');
			$this->form_validation->set_rules('api_url', 'API URL', 'required');
			$this->form_validation->set_rules('api_password', 'API Password', 'required');
			if ($this->form_validation->run() == TRUE){
				if(!empty($_FILES['api_logo']['name'])){	
					if(is_uploaded_file($_FILES['api_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['api_logo']['tmp_name'];
						$filename = $_FILES['api_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['api_logo']['name'];
							$targetPath = "uploads/api/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$api_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Api_Model->add_api_details($_POST,$api_logo_name);
				redirect('api/api_list','refresh');
			} else {
				$api = $this->General_Model->get_home_page_settings();
				$this->load->view('api/add_api',$api);
			}
		}else{
			$api = $this->General_Model->get_home_page_settings();
			$this->load->view('api/add_api',$api);
		}
	}
	
	function active_api($api_id){
		$api_id = json_decode(base64_decode($api_id));
		if($api_id != ''){
			$this->Api_Model->active_api($api_id);
		}
		redirect('api/api_list','refresh');
	}
	
	function inactive_api($api_id){
		$api_id = json_decode(base64_decode($api_id));
		if($api_id != ''){
			$this->Api_Model->inactive_api($api_id);
		}
		redirect('api/api_list','refresh');
	}
	
	function delete_api($api_id){
		$api_id = json_decode(base64_decode($api_id));
		if($api_id != ''){
			$this->Api_Model->delete_api($api_id);
		}
		redirect('api/api_list','refresh');
	}
	
	function edit_api($api_id){
		$api_id = json_decode(base64_decode($api_id));
		if($api_id){
			$api 		= $this->General_Model->get_home_page_settings();
			$api['api'] = $this->Api_Model->get_api_list($api_id);
			$this->load->view('api/edit_api',$api);
		} else {
			redirect('api/api_list','refresh');
		}
	}

	function update_api($api_id){
		if(count($_POST) > 0){
			$api_id = json_decode(base64_decode($api_id));
			if($api_id != ''){
				$api_logo_name  = $_REQUEST['api_logo_old'];
				$this->form_validation->set_rules('api_name', 'API Name', 'required');
				$this->form_validation->set_rules('api_name_alternative', 'API Alternative Name', 'required');
				$this->form_validation->set_rules('api_user_name', 'API User Name', 'required');
				$this->form_validation->set_rules('api_url', 'API URL', 'required');
				$this->form_validation->set_rules('api_password', 'API Password', 'required');
				if ($this->form_validation->run() == TRUE){
					if(!empty($_FILES['api_logo']['name'])){	
						if(is_uploaded_file($_FILES['api_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/api/".$api_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['api_logo']['tmp_name'];
							$filename = $_FILES['api_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['api_logo']['name'];
								$targetPath = "uploads/api/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$api_logo_name = $img_Name;
								}
							}
						}				
					}
					$this->Api_Model->update_api($_POST,$api_id, $api_logo_name);
					redirect('api/api_list','refresh');
				} else {
					$api 		= $this->General_Model->get_home_page_settings();
					$api['api'] = $this->Api_Model->get_api_list($api_id);
					$this->load->view('api/edit_api',$api);
				}
			}			
			redirect('api/api_list','refresh');
		} else if($api_id!='') {
			redirect('api/api_list','refresh');
		} else {
			redirect('api/api_list','refresh');
		}
	}
}
