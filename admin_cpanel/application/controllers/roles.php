<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Roles extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Roles_Model');
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
	function managePrivilege($roles_id1)
	{
		//echo "<pre/>";print_r($_POST['privilege_ids']);exit;
		$this->db->select('role_details_id'); 
		$this->db->where('role_details_id',$_POST['role_id']);
		$query=$this->db->get('privilege_details');

		$user_id 	= json_decode(base64_decode($user_id1));
		$id = $_POST['role_id'];
		
		if($query->num_rows()>0){
			$this->db->where('role_details_id',$_POST['role_id']);
			$this->db->delete('privilege_details');
			$action_key = "modified_by";
			$action_date_key = "modification_date";
	    }
		else{ $action_key = "created_by"; $action_date_key = "creation_date";}
		//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		for($c=0;$c<count($_POST['privilege_ids']);$c++){
         $insert_privilege_data = array(
            "role_details_id"=>$id,
			//"dashboard_module_id"=>$_POST['dashboard_module_id'],
			"dashboard_module_details_id"=>$_POST['privilege_ids'][$c],
			"status"=> 'ACTIVE',
			$action_key => $this->session->userdata('provab_admin_id'),
			$action_date_key => date('Y-m-d H:i:s'),
          );
          //echo "<pre>"; print_r($insert_privilege_data); echo "</pre>"; exit;
         $this->db->insert('privilege_details',$insert_privilege_data);
        }
		redirect('roles/roles_list','refresh');
	}
	function roles_list(){
		$roles 					= $this->General_Model->get_home_page_settings();
		$roles['roles_list'] 	= $this->Roles_Model->get_roles_list();
		$this->load->view('roles/roles_list',$roles);
	}
	
	function add_roles(){
		if(count($_POST) > 0){
			$roles_logo_name = '';
			if(!empty($_FILES['role_logo']['name'])){	
				if(is_uploaded_file($_FILES['role_logo']['tmp_name'])) {
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['role_logo']['tmp_name'];
					$filename = $_FILES['role_logo']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['role_logo']['name'];
						$targetPath = "uploads/roles/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$roles_logo_name = $img_Name;
						}
					}
				}				
			}
			$this->Roles_Model->add_roles_details($_POST,$roles_logo_name);
			redirect('roles/roles_list','refresh');
		}else{
			$roles = $this->General_Model->get_home_page_settings();
			$this->load->view('roles/add_roles',$roles);
		}
	}
	
	function active_roles($roles_id){
		$roles_id = json_decode(base64_decode($roles_id));
		if($roles_id != ''){
			$this->Roles_Model->active_roles($roles_id);
		}
		redirect('roles/roles_list','refresh');
	}
	
	function inactive_roles($roles_id){
		$roles_id = json_decode(base64_decode($roles_id));
		if($roles_id != ''){
			$this->Roles_Model->inactive_roles($roles_id);
		}
		redirect('roles/roles_list','refresh');
	}
	
	function delete_roles($roles_id){
		$roles_id = json_decode(base64_decode($roles_id));
		if($roles_id != ''){
			$this->Roles_Model->delete_roles($roles_id);
		}
		redirect('roles/roles_list','refresh');
	}
	
	function edit_roles($roles_id){
		$roles_id = json_decode(base64_decode($roles_id));
		if($roles_id != ''){
			$roles 					= $this->General_Model->get_home_page_settings();
			$roles['roles_list'] 	= $this->Roles_Model->get_roles_list($roles_id);
			$this->load->view('roles/edit_roles',$roles);
		} else {
			redirect('roles/roles_list','refresh');
		}
	}

	function update_roles($roles_id){
		if(count($_POST) > 0){
			$roles_id = json_decode(base64_decode($roles_id));
			if($roles_id != ''){
				$roles_logo_name  = $_REQUEST['role_logo_old'];
				if(!empty($_FILES['role_logo']['name'])){	
					if(is_uploaded_file($_FILES['role_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$oldImage = "uploads/roles/".$roles_logo_name;
						unlink($oldImage);
						$sourcePath = $_FILES['role_logo']['tmp_name'];
						$filename = $_FILES['site_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['role_logo']['name'];
							$targetPath = "uploads/roles/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$roles_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Roles_Model->update_roles($_POST,$roles_id, $roles_logo_name);
			}
			redirect('roles/roles_list','refresh');
		}else if($roles_id!=''){
			redirect('roles/edit_roles/'.$roles_id,'refresh');
		}else{
			redirect('roles/roles_list','refresh');
		}
	}
}
