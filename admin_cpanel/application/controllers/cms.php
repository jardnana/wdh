<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class CMS extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Cms_Model');
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
		$categories['category_list'] 		= $this->Cms_Model->get_home_page_categories();
		$this->load->view('cms/cms_categories_list',$categories);
	}
	
	function add_category(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('category_name','Category Name','required');
			$this->form_validation->set_rules('table_name','Category Related Table Name','required');
			if($this->form_validation->run()==TRUE){
				$this->Cms_Model->add_category_details($_POST);
				redirect('cms','refresh');
			} else {
				$categories 					= $this->General_Model->get_home_page_settings();
				$this->load->view('cms/add_category',$categories);
			}
		}else{
			$categories 					= $this->General_Model->get_home_page_settings();
			$this->load->view('cms/add_category',$categories);
		}
	}
	
	function inactive_category($category_id){
		$this->Cms_Model->inactive_category($category_id);
		redirect('cms','refresh');
	}
	
	function active_category($category_id){
		$this->Cms_Model->active_category($category_id);
		redirect('cms','refresh');
	}
	 
	function edit_category($category_id){
		$categories 					= $this->General_Model->get_home_page_settings();
		$categories['category_list'] 	= $this->Cms_Model->get_home_page_categories($category_id);
		$this->load->view('cms/edit_category',$categories);
	}
	
	function delete_category($category_id){
		$this->Cms_Model->delete_category($category_id);
		redirect('cms','refresh');
	}
	
	function update_category($category_id){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('category_name','Category Name','required');
			if($this->form_validation->run()==TRUE){
				$this->Cms_Model->update_category($_POST,$category_id);
				redirect('cms','refresh');
			} else {
				redirect('cms/edit_category/'.$category_id,'refresh');
			}
		}else if($city_id!=''){
			redirect('cms/edit_category/'.$category_id,'refresh');
		}else{
			redirect('cms','refresh');
		}
	}
} 
?>
