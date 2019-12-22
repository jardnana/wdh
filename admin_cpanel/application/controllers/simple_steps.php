<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Simple_Steps extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Simplesteps_Model');
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
		$categories					= $this->General_Model->get_home_page_settings();
		$categories['steps'] 		= $this->Simplesteps_Model->get_steps();
	
		$this->load->view('simple_steps/steps_list',$categories);
	}
	
	function add_step(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('step_title','Title','required');
			$this->form_validation->set_rules('full_desc','Full Description','required');
			if($this->form_validation->run()==TRUE){
			
				if (!empty($_FILES['step_logo']['name'])) {
					if (is_uploaded_file($_FILES['step_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['step_logo']['tmp_name'];
						$filename = $_FILES['step_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name = time() . $_FILES['step_logo']['name'];
							$targetPath = "uploads/banner/" . $img_Name;
							if (move_uploaded_file($sourcePath, $targetPath)) {
								$banner_logo_name = $img_Name;
							}
						}
					}
				}
				$this->Simplesteps_Model->add_step_details($_POST, $banner_logo_name);
				redirect('simple_steps','refresh');
			} else {
				$categories 					= $this->General_Model->get_home_page_settings();
				$this->load->view('simple_steps/add_step',$categories);
			}
		}else{
			$categories 					= $this->General_Model->get_home_page_settings();
			$this->load->view('simple_steps/add_step',$categories);
		}
	}
	
	function inactive_step($step_id){
		$step_id = json_decode(base64_decode($step_id));
		if($step_id != ''){
			$this->Simplesteps_Model->inactive_step($step_id);
		}
		redirect('simple_steps','refresh');
	}
	
	function active_step($step_id){
		$step_id = json_decode(base64_decode($step_id));
		if($step_id != ''){
			$this->Simplesteps_Model->active_step($step_id);
		}
		redirect('simple_steps','refresh');
	}
	 
	function edit_step($step_id){
		$step_id = json_decode(base64_decode($step_id));
		if($step_id != ''){
			$categories 					= $this->General_Model->get_home_page_settings();
			$categories['steps'] 			= $this->Simplesteps_Model->get_steps($step_id);
			//echo"<pre/>";print_r($categories); exit;
			$this->load->view('simple_steps/edit_step',$categories);
		} else {
			redirect('simple_steps','refresh');
		}
	}
	
	function delete_step($step_id){
		$step_id = json_decode(base64_decode($step_id));
		if($step_id != ''){
			$this->Simplesteps_Model->delete_step($step_id);
		}
		redirect('simple_steps','refresh');
	}
	
	function update_step($step_id){
		if(count($_POST) > 0){
			$banner_logo_name = $_REQUEST['step_logo_old'];
			$this->form_validation->set_rules('step_title','Title','required');
			$this->form_validation->set_rules('full_desc','Full Description','required');
			if($this->form_validation->run()==TRUE){
				if (!empty($_FILES['step_logo']['name'])) {
					//echo"anand"; exit;
						if (is_uploaded_file($_FILES['step_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/banner/" . $banner_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['step_logo']['tmp_name'];
							$filename = $_FILES['step_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['step_logo']['name'];
								$targetPath = "uploads/banner/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$banner_logo_name = $img_Name;
								}
							}
						}
					}
				$step_id = json_decode(base64_decode($step_id));
				if($step_id != ''){
					$this->Simplesteps_Model->update_step($_POST,$step_id, $banner_logo_name);
				}
				redirect('simple_steps','refresh');
			} else {
				redirect('simple_steps/edit_step/'.$step_id,'refresh');
			}
		}else if($city_id!=''){
			redirect('simple_steps/edit_step/'.$step_id,'refresh');
		}else{
			redirect('simple_steps','refresh');
		}
	}

	

} 
?>
