<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Footer extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Footer_Model');
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
	 
	function footer_list(){
		$footer 				= $this->General_Model->get_home_page_settings();
		$footer['footer_list'] 	= $this->Footer_Model->get_footer_list();
		$this->load->view('footer/footer_list',$footer);
	}
	
	function add_footer(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('footer_name','Footer Name','required');
			$this->form_validation->set_rules('position','Position','required');
			if($this->form_validation->run()==TRUE){
				$footer_logo_name = '';
				if(!empty($_FILES['footer_logo']['name'])){	
					if(is_uploaded_file($_FILES['footer_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['footer_logo']['tmp_name'];
						$filename = $_FILES['footer_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['footer_logo']['name'];
							$targetPath = "uploads/footer/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$footer_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Footer_Model->add_footer_details($_POST,$footer_logo_name);
				redirect('footer/footer_list','refresh');
			} else {
				$footer = $this->General_Model->get_home_page_settings();
				$this->load->view('footer/add_footer',$footer);
			}
		}else{
			$footer = $this->General_Model->get_home_page_settings();
			$this->load->view('footer/add_footer',$footer);
		}
	}
	
	function active_footer($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->active_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function inactive_footer($footer_id){
		//echo $footer_id;
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->inactive_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function delete_footer($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->delete_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function edit_footer($footer_id)
	{
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$footer 			   = $this->General_Model->get_home_page_settings();
			$footer['footer_list'] = $this->Footer_Model->get_footer_list($footer_id);
			$this->load->view('footer/edit_footer',$footer);
		} else {
			redirect('footer/footer_list','refresh');
		}
	}

	function update_footer($footer_id1){
		if(count($_POST) > 0){
			$footer_id = json_decode(base64_decode($footer_id1));
			if($footer_id != ''){
				$this->form_validation->set_rules('footer_name','Footer Name','required');
				$this->form_validation->set_rules('position','Position','required');
				if($this->form_validation->run()==TRUE){
					$footer_logo_name  = $_REQUEST['footer_logo_old'];
					if(!empty($_FILES['footer_logo']['name'])){	
						if(is_uploaded_file($_FILES['footer_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/footer/".$footer_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['footer_logo']['tmp_name'];
							$filename = $_FILES['footer_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['footer_logo']['name'];
								$targetPath = "uploads/footer/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$footer_logo_name = $img_Name;
								}
							}
						}				
					}
					$this->Footer_Model->update_footer($_POST,$footer_id, $footer_logo_name);
				} else {
					redirect('footer/edit_footer/'.$footer_id1,'refresh');
				}
			} 
			redirect('footer/footer_list','refresh');
		}else if($footer_id!=''){
			redirect('footer/footer_list','refresh');
		}else{
			redirect('footer/footer_list','refresh');
		}
	}
}
