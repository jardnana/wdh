<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Airline extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Airline_Model');
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
		$airline 					= $this->General_Model->get_home_page_settings();
		$airline['airline_list'] 	= $this->Airline_Model->get_airline_list();
		$this->load->view('airline/airline_list',$airline);
	}
	
	function add_airline(){
		if(count($_POST) > 0){
			$airline_logo_name = '';
			$this->form_validation->set_rules('airline_name', 'Airline Name', 'required');
			$this->form_validation->set_rules('airline_code', 'Airline Code', 'required');
			// $this->form_validation->set_rules('provider_type', 'Provider Type', 'required');
			if ($this->form_validation->run() == TRUE){
				if(!empty($_FILES['airline_logo']['name'])){	
					if(is_uploaded_file($_FILES['airline_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['airline_logo']['tmp_name'];
						$filename = $_FILES['airline_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['airline_logo']['name'];
							$targetPath = "uploads/airline/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$airline_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Airline_Model->add_airline_details($_POST,$airline_logo_name);
				redirect('airline','refresh');
			} else {
				$airline = $this->General_Model->get_home_page_settings();
				$this->load->view('airline/add_airline',$airline);
			}
		}else{
			$airline = $this->General_Model->get_home_page_settings();
			$this->load->view('airline/add_airline',$airline);
		}
	}
	
	function active_airline($airline_id){
		$airline_id = json_decode(base64_decode($airline_id));
		if($airline_id != ''){
			$this->Airline_Model->active_airline($airline_id);
		}
		redirect('airline','refresh');
	}
	
	function inactive_airline($airline_id){
		$airline_id = json_decode(base64_decode($airline_id));
		if($airline_id != ''){
			$this->Airline_Model->inactive_airline($airline_id);
		}
		redirect('airline','refresh');
	}
	
	function delete_airline($airline_id){
		$airline_id = json_decode(base64_decode($airline_id));
		if($airline_id != ''){
			$this->Airline_Model->delete_airline($airline_id);
		}
		redirect('airline','refresh');
	}
	
	function edit_airline($airline_id){
		$airline_id = json_decode(base64_decode($airline_id));
		if($airline_id != ''){
			$airline 					= $this->General_Model->get_home_page_settings();
			$airline['airline_list'] 	= $this->Airline_Model->get_airline_list($airline_id);
			$this->load->view('airline/edit_airline',$airline);
		} else {
			redirect('airline','refresh');
		}
	}

	function update_airline($airline_id){
		if(count($_POST) > 0){
			$airline_id = json_decode(base64_decode($airline_id));
			if($airline_id != ''){
				$airline_logo_name  = $_REQUEST['airline_logo_old'];
				$this->form_validation->set_rules('airline_name', 'Airline Name', 'required');
				$this->form_validation->set_rules('airline_code', 'Airline Code', 'required');
				// $this->form_validation->set_rules('provider_type', 'Provider Type', 'required');
				if ($this->form_validation->run() == TRUE){
					if(!empty($_FILES['airline_logo']['name'])){	
						if(is_uploaded_file($_FILES['airline_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/airline/".$airline_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['airline_logo']['tmp_name'];
							$filename = $_FILES['airline_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['airline_logo']['name'];
								$targetPath = "uploads/airline/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$airline_logo_name = $img_Name;
								}
							}
						}				
					}
					$this->Airline_Model->update_airline($_POST,$airline_id, $airline_logo_name);
					redirect('airline','refresh');
				} else {
					$airline = $this->General_Model->get_home_page_settings();
					$this->load->view('airline/add_airline',$airline);
				}
			}
			redirect('airline','refresh');
		}else if($airline_id!=''){
			redirect('airline/edit_airline/'.$airline_id,'refresh');
		}else{
			redirect('airline','refresh');
		}
	}

	function airline_details_insert(){
		$airline_list 	= $this->Airline_Model->get_airline_list();
		for($i=0;$i<count($airline_list);$i++){
			$image = FCPATH."assets/airline_logo/".$airline_list[$i]->AirLineName.".jpg";
			if(file_exists($image)) {
				echo "The file $image exists";
			} else {
				echo "The file $image does not exist";
			}
			echo "<br/>";
			$insert_data = array(
							'airline_name' 			=> $airline_list[$i]->AirLineName,
							'airline_code' 			=> $airline_list[$i]->AirLineCode,
							'airline_logo' 			=> '',
							'provider_type' 		=> $airline_list[$i]->ProviderType,
							'status' 				=> 'ACTIVE',
							'airline_creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
			// $this->db->insert('airline_details',$insert_data);
		}
		
	}
}
