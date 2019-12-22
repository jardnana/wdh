<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
//error_reporting(E_ALL);
class Recent_Search extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Recentsearch_Model');
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
		$categories['category_list'] 		= $this->Recentsearch_Model->recentsearch_list();
		//echo"<pre/>";print_r($categories);exit;
		$this->load->view('recent_search/recentsearch_list',$categories);
	}
	function inactive_recent_search($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Recentsearch_Model->inactive_recentsearch($id);
		}
		redirect('recent_search/','refresh');
	}
	function active_recent_search($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Recentsearch_Model->active_recentsearch($id);
		}
		redirect('recent_search/','refresh');
	}

	function delete_recent_search($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Recentsearch_Model->delete_recentsearch($id);
		}
		redirect('recent_search/','refresh');
	}
	
	function view_request($id){
		header('Content-type: text/xml');
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$recentsearch_list = $this->Recentsearch_Model->recentsearch_list($id);
			if($recentsearch_list !=''){
				$file = file_get_contents("../search_logs/".$recentsearch_list[0]->xml_request);
				echo $file;		
			}else{
				echo "No Files Found. Please search for other combinations";
			}
		}else{
			redirect('recent_search/','refresh');
		}
	}
	
	function view_response($id){
		header('Content-type: text/xml');
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$recentsearch_list = $this->Recentsearch_Model->recentsearch_list($id);
			if($recentsearch_list !=''){
				$file = file_get_contents("../search_logs/".$recentsearch_list[0]->xml_response);
				echo $file;
			}else{
				echo "No Files Found. Please search for other combinations";
			}		
		}else{
			redirect('recent_search/','refresh');
		}
	}
	
	function view_flexible_request($id){
		header('Content-type: text/xml');
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$recentsearch_list = $this->Recentsearch_Model->recentsearch_list($id);
			if($recentsearch_list !=''){
				$file = file_get_contents("../search_logs/".$recentsearch_list[0]->xml_request_flexible);
				echo $file;	
			}else{
				echo "No Files Found. Please search for other combinations";
			}	
		}else{
			redirect('recent_search/','refresh');
		}
	}
	
	function view_flexible_response($id){
		header('Content-type: text/xml');
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$recentsearch_list = $this->Recentsearch_Model->recentsearch_list($id);
			if($recentsearch_list !=''){
				$file = file_get_contents("../search_logs/".$recentsearch_list[0]->xml_response_flexible);
				echo $file;		
			}else{
				echo "No Files Found. Please search for other combinations";
			}
		}else{
			redirect('recent_search/','refresh');
		}
	}
} 
?>
