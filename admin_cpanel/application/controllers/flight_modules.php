<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(E_ALL);
class Flight_Modules extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Flightmodules_Model');
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
		$categories							= $this->General_Model->get_home_page_settings();
		$categories['category_list'] 		= $this->Flightmodules_Model->flightmodules_list();

		$this->load->view('flight_modules/flightmodules_list',$categories);
	}
	function inactive_flightmodules($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightmodules_Model->inactive_flightmodules($id);
		}
		redirect('flight_modules/','refresh');
	}
	function active_flightmodules($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightmodules_Model->active_flightmodules($id);
		}
		redirect('flight_modules/','refresh');
	}
	function edit_flightmodules($category_id){
		$category_id = json_decode(base64_decode($category_id));
		if($category_id != ''){
			$categories 					= $this->General_Model->get_home_page_settings();
			$categories['category_list'] 	= $this->Flightmodules_Model->get_flightmodulues_details($category_id);
			$this->load->view('flight_modules/edit_flightmodule',$categories);
		} else {
			redirect('flight_modules','refresh');
		}
	}
		
	function update_flightmodules($category_id){

		if(count($_POST) > 0){
			$this->form_validation->set_rules('flight_module_name','flight_module_name','required');
			$this->form_validation->set_rules('position','Position','required');
			if($this->form_validation->run()==TRUE){
		        $category_id = json_decode(base64_decode($category_id));
				if($category_id != ''){
					$this->Flightmodules_Model->update_flightmodulues_details($_POST,$category_id);
				}
				redirect('flight_modules','refresh');
			} else {
				redirect('flight_modules/edit_flightmodules/'.$category_id,'refresh');
			}
		}else if($city_id!=''){
			redirect('flight_modules/edit_flightmodules/'.$category_id,'refresh');
		}else{
			redirect('flight_modules','refresh');
		}
	}

	function delete_flightmodules($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightmodules_Model->delete_flightmodules($id);
		}
		redirect('flight_modules/','refresh');
	}
} 
?>
