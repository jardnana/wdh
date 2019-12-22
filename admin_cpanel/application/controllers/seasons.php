<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Seasons extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Seasons_Model');
		$this->check_admin_login();		
	}

	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
            redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
      			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
            redirect('login/lock_screen','refresh');
        }else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Logged_In"){
      			// redirect('dashboard','refresh');
        }else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Lock_Screen") {
            redirect('login/lock_screen','refresh');
        }
    }
  
	public function index(){
		$flight 						= $this->General_Model->get_home_page_settings();
		$flight['seasons_list'] 	   	= $this->Seasons_Model->get_seasons_list();
		$this->load->view('seasons/seasons_list',$flight);
	}
	
	public function seasons_list(){
		$flight 						= $this->General_Model->get_home_page_settings();
		$flight['seasons_list'] 	   	= $this->Seasons_Model->get_seasons_list();
		$this->load->view('seasons/seasons_list',$flight);
	}
	
	function add_seasons(){
		if(count($_POST) > 0){
			try{
				$this->General_Model->begin_transaction();
				$this->Seasons_Model->add_seasons($_POST);
				$this->General_Model->commit_transaction();
				redirect('seasons/seasons_list','refresh');
			} catch(Exception $e) {
				$this->General_Model->rollback_transaction();
				return $e;
			}
		}else{
			$flight 						= $this->General_Model->get_home_page_settings();
			$this->load->view('seasons/add_seasons',$flight);
		}
	} 
	
	function delete_seasons($seasons_details_id1){
		$seasons_details_id 	= json_decode(base64_decode($seasons_details_id1));
		if($seasons_details_id != ''){
			$this->Seasons_Model->delete_seasons($seasons_details_id);
		}
		redirect('seasons/seasons_list','refresh');
	}

	function inactive_seasons($seasons_details_id1){
		$seasons_details_id 	= json_decode(base64_decode($seasons_details_id1));
		if($seasons_details_id != ''){
			$this->Seasons_Model->inactive_seasons($seasons_details_id);
		}
		redirect('seasons/seasons_list','refresh');
	}
	
	function active_seasons($seasons_details_id1){
		$seasons_details_id 	= json_decode(base64_decode($seasons_details_id1));
		if($seasons_details_id != ''){
			$this->Seasons_Model->active_seasons($seasons_details_id);
		}
		redirect('seasons/seasons_list','refresh');
	}
	
	function edit_seasons($seasons_details_id1){		 
		$seasons_details_id 	= json_decode(base64_decode($seasons_details_id1));
		if($seasons_details_id != ''){
			$flight 						= $this->General_Model->get_home_page_settings();
			$flight['seasons_list'] 	   	= $this->Seasons_Model->get_seasons_list($seasons_details_id);
			$this->load->view('seasons/edit_seasons',$flight);
		}else{
			redirect('seasons/seasons_list','refresh');
		}
	}
	
	function update_seasons($seasons_details_id1){
		$seasons_details_id 	= json_decode(base64_decode($seasons_details_id1));
		if($seasons_details_id != ''){
			if(count($_POST) > 0){
				try{
					$this->General_Model->begin_transaction();
					$this->Seasons_Model->update_seasons($_POST,$seasons_details_id);
					$this->General_Model->commit_transaction();
					redirect('seasons/seasons_list','refresh');
				} catch(Exception $e) {
				  $this->General_Model->rollback_transaction();
				  return $e;
				}
			}else{
				redirect('seasons/edit_seasons/'.$seasons_details_id1,'refresh');
			}
		}else{
			redirect('seasons/seasons_list/','refresh');
		}
	} 	
}
