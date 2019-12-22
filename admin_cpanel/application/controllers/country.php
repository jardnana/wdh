<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Country extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Country_Model');
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
		$country 					= $this->General_Model->get_home_page_settings();
		$country['country_list'] 	= $this->Country_Model->get_country_list();
		$this->load->view('country/country_list',$country);
	}
	
	function add_country(){
		if(count($_POST) > 0){
			$country_logo_name = '';
			$this->form_validation->set_rules('country_name','Country Name','required');
			$this->form_validation->set_rules('iso_code','Country ISO 2 Digit Code','required');
			$this->form_validation->set_rules('iso3_code','Country ISO 3 Digit Code','required');
			$this->form_validation->set_rules('iso_numeric','Country ISO Numeric Code','required');
			$this->form_validation->set_rules('phone_code','Country Phone Number Code','required');
			$this->form_validation->set_rules('currency_name','Currency Name','required');
			$this->form_validation->set_rules('currency_code','Currency Code','required');
			$this->form_validation->set_rules('currency_symbol','Currency Symbol','required');
			if($this->form_validation->run()==TRUE){
				if(!empty($_FILES['country_logo']['name'])){	
					if(is_uploaded_file($_FILES['country_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['country_logo']['tmp_name'];
						$filename = $_FILES['hotel_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['country_logo']['name'];
							$targetPath = "uploads/country/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$country_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Country_Model->add_country_details($_POST,$country_logo_name);
				redirect('country','refresh');
			} else {
			
			}
		}else{
			$country = $this->General_Model->get_home_page_settings();
			$this->load->view('country/add_country',$country);
		}
	}
	
	function active_country($country_id){
		$country_id = json_decode(base64_decode($country_id));
		if($country_id != ''){
			$this->Country_Model->active_country($country_id);
		}
		redirect('country','refresh');
	}
	
	function inactive_country($country_id){
		$country_id = json_decode(base64_decode($country_id));
		if($country_id != ''){
			$this->Country_Model->inactive_country($country_id);
		}
		redirect('country','refresh');
	}
	
	function delete_country($country_id){
		$country_id = json_decode(base64_decode($country_id));
		if($country_id != ''){
			$this->Country_Model->delete_country($country_id);
		}
		redirect('country','refresh');
	}
	
	function edit_country($country_id){
		$country_id = json_decode(base64_decode($country_id));
		if($country_id != ''){
			$country 					= $this->General_Model->get_home_page_settings();
			$country['country_list'] 	= $this->Country_Model->get_country_list($country_id);
			$this->load->view('country/edit_country',$country);
		} else {
			redirect('country','refresh');
		}
	}

	function update_country($country_id){
		if(count($_POST) > 0){
			$country_id = json_decode(base64_decode($country_id));
			if($country_id != ''){
				$this->form_validation->set_rules('country_name','Country Name','required');
				$this->form_validation->set_rules('iso_code','Country ISO 2 Digit Code','required');
				$this->form_validation->set_rules('iso3_code','Country ISO 3 Digit Code','required');
				$this->form_validation->set_rules('iso_numeric','Country ISO Numeric Code','required');
				$this->form_validation->set_rules('phone_code','Country Phone Number Code','required');
				$this->form_validation->set_rules('currency_name','Currency Name','required');
				$this->form_validation->set_rules('currency_code','Currency Code','required');
				$this->form_validation->set_rules('currency_symbol','Currency Symbol','required');
				if($this->form_validation->run()==TRUE){
					$country_logo_name  = $_REQUEST['country_logo_old'];
					if(!empty($_FILES['country_logo']['name'])){	
						if(is_uploaded_file($_FILES['country_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/country/".$country_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['country_logo']['tmp_name'];
							$filename = $_FILES['hotel_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['country_logo']['name'];
								$targetPath = "uploads/country/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$country_logo_name = $img_Name;
								}
							}
						}				
					}
					$this->Country_Model->update_country($_POST,$country_id, $country_logo_name);
				} else {
					
				}
			}
			redirect('country','refresh');
		}else if($country_id!=''){
			redirect('country/edit_country/'.$country_id,'refresh');
		}else{
			redirect('country','refresh');
		}
	}
}
