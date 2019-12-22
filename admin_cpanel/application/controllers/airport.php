<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Airport extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Airport_Model');
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
	 
	function index($country = "India"){
		ini_set('memory_limit','-1');
		$airport 					= $this->General_Model->get_home_page_settings();
		$airport['airport_list'] 	= $this->Airport_Model->get_airport_list($country);
		$airport['countyr_list'] 	= $this->Airport_Model->get_country_list($country);
		$airport['country'] 		= $country;
		$this->load->view('airport/airport_list',$airport);
	}
	
	function add_airport(){
		if(count($_POST) > 0){
			$airport_logo_name = '';
			$this->form_validation->set_rules('airport_name', 'airport Name', 'required');
			$this->form_validation->set_rules('airport_code', 'airport Code', 'required');
			if ($this->form_validation->run() == TRUE){
				$this->Airport_Model->add_airport_details($_POST);
				redirect('airport','refresh');
			} else {
				$airport = $this->General_Model->get_home_page_settings();
				$this->load->view('airport/add_airport',$airport);
			}
		}else{
			$airport = $this->General_Model->get_home_page_settings();
			$this->load->view('airport/add_airport',$airport);
		}
	}
	
	function active_airport($airport_id){
		$airport_id = json_decode(base64_decode($airport_id));
		if($airport_id != ''){
			$this->Airport_Model->active_airport($airport_id);
		}
		redirect('airport','refresh');
	}
	
	function inactive_airport($airport_id){
		$airport_id = json_decode(base64_decode($airport_id));
		if($airport_id != ''){
			$this->Airport_Model->inactive_airport($airport_id);
		}
		redirect('airport','refresh');
	}
	
	function delete_airport($airport_id){
		$airport_id = json_decode(base64_decode($airport_id));
		if($airport_id != ''){
			$this->Airport_Model->delete_airport($airport_id);
		}
		redirect('airport','refresh');
	}
	
	function edit_airport($airport_id){
		$airport_id = json_decode(base64_decode($airport_id));
		if($airport_id != ''){
			$airport 					= $this->General_Model->get_home_page_settings();
			$airport['airport_list'] 	= $this->Airport_Model->get_airport_list($airport_id);
			$this->load->view('airport/edit_airport',$airport);
		} else {
			redirect('airport','refresh');
		}
	}

	function update_airport($airport_id){
		if(count($_POST) > 0){
			$airport_id = json_decode(base64_decode($airport_id));
			if($airport_id != ''){
				$airport_logo_name  = $_REQUEST['airport_logo_old'];
				$this->form_validation->set_rules('airport_name', 'airport Name', 'required');
				$this->form_validation->set_rules('airport_code', 'airport Code', 'required');
				if ($this->form_validation->run() == TRUE){
					$this->Airport_Model->update_airport($_POST,$airport_id);
					redirect('airport','refresh');
				} else {
					$airport = $this->General_Model->get_home_page_settings();
					$this->load->view('airport/add_airport',$airport);
				}
			}
			redirect('airport','refresh');
		}else if($airport_id!=''){
			redirect('airport/edit_airport/'.$airport_id,'refresh');
		}else{
			redirect('airport','refresh');
		}
	}

	function airport_details_insert(){
		$airport_list 	= $this->Airport_Model->get_airport_list();
		for($i=0;$i<count($airport_list);$i++){
			$image = FCPATH."assets/airport_logo/".$airport_list[$i]->airportName.".jpg";
			if(file_exists($image)) {
				echo "The file $image exists";
			} else {
				echo "The file $image does not exist";
			}
			echo "<br/>";
			$insert_data = array(
							'airport_name' 			=> $airport_list[$i]->airportName,
							'airport_code' 			=> $airport_list[$i]->airportCode,
							'airport_logo' 			=> '',
							'provider_type' 		=> $airport_list[$i]->ProviderType,
							'status' 				=> 'ACTIVE',
							'airport_creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
			// $this->db->insert('airport_details',$insert_data);
		}
		
	}
}
