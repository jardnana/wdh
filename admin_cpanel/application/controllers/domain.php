<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Domain extends CI_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->model('General_Model');		
		$this->load->model('Domain_Model');
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
	 	
	function domain_list(){
		$domain = $this->General_Model->get_home_page_settings();
		$domain['domain_list'] = $this->Domain_Model->get_domain_list();
		//echo "<pre/>";print_r($domain);exit;
		$this->load->view('domain/domain_list',$domain);
	}
	
	function add_domain(){
		if(count($_POST) > 0){
			$domain_logo_name = '';
			$this->form_validation->set_rules('domain_name','Domain Name','required');
			$this->form_validation->set_rules('domain_url','Domain URL','required');
			if($this->form_validation->run()==TRUE){
				if(!empty($_FILES['domain_logo']['name'])){	
					if(is_uploaded_file($_FILES['domain_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['domain_logo']['tmp_name'];
						$filename = $_FILES['domain_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['domain_logo']['name'];
							$targetPath = "uploads/domain/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$domain_logo_name = $img_Name;
							}
						} 
					}				
				}
				$this->Domain_Model->add_domain($_POST,$domain_logo_name);
				redirect('domain/domain_list','refresh');
			} else {
				$domain = $this->General_Model->get_home_page_settings();
				$this->load->view('domain/add_domain',$domain);		
			}
		}else{
			$domain = $this->General_Model->get_home_page_settings();
			$this->load->view('domain/add_domain',$domain);
		}
	}
	
	function active_domain($domain_id){
		$domain_id = json_decode(base64_decode($domain_id));
		if($domain_id!=''){
			$this->Domain_Model->active_domain($domain_id);
		}
		redirect('domain/domain_list','refresh');
	}
	
	function inactive_domain($domain_id){
		$domain_id = json_decode(base64_decode($domain_id));
		if($domain_id!=''){
			$this->Domain_Model->inactive_domain($domain_id);
		}
		redirect('domain/domain_list','refresh');
	}
	
	function delete_domain($domain_id){
		$domain_id = json_decode(base64_decode($domain_id));
		if($domain_id != ''){
			$this->Domain_Model->delete_domain($domain_id);
		}
		redirect('domain/domain_list','refresh');
	}
	
	function edit_domain($domain_id){
		$domain_id = json_decode(base64_decode($domain_id));
		if($domain_id != ''){
			$domain 			= $this->General_Model->get_home_page_settings();
			$domain['domain'] 	= $this->Domain_Model->get_domain_list($domain_id);
			$this->load->view('domain/edit_domain',$domain);
		} else {
			redirect('domain/domain_list','refresh');
		}
	}
	
	function update_domain($domain_id){
		if(count($_POST) > 0){
			$domain_id = json_decode(base64_decode($domain_id));
			if($domain_id != ''){
				$this->form_validation->set_rules('domain_name','Domain Name','required');
				$this->form_validation->set_rules('domain_url','Domain URL','required');
				if($this->form_validation->run()==TRUE){
					$domain_logo_name  = $_REQUEST['domain_logo_old'];
					if(!empty($_FILES['domain_logo']['name'])){	
						if(is_uploaded_file($_FILES['domain_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/domain/".$domain_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['domain_logo']['tmp_name'];
							$filename = $_FILES['domain_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['domain_logo']['name'];
								$targetPath = "uploads/domain/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$domain_logo_name = $img_Name;
								}
							}
						}				
					}
					$this->Domain_Model->update_domain($_POST,$domain_id, $domain_logo_name);
					redirect('domain/domain_list','refresh');
				} else {
					redirect('domain/edit_domain/'.$domain_id,'refresh');
				}
			} else {
				redirect('domain/domain_list','refresh');
			}
		} else if($domain_id!='') {
			redirect('domain/edit_domain/'.$domain_id,'refresh');
		}else{
			redirect('domain/domain_list','refresh');
		}
	}
}
