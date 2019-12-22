<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(0);
class Promo extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Promo_Model');
		$this->load->model('Email_Model');
		$this->check_admin_login();		
	}

	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == "" && $this->session->userdata('lgm_supplier_admin_logged_in') == ""){
	        redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In" ){
			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
		}else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Lock_Screen") {
		 	redirect('login/lock_screen','refresh');
		}
    }
	 
	function promo_code_list(){
		$promo 						= $this->General_Model->get_home_page_settings();
		$promo['promo_code_list'] 	= $this->Promo_Model->get_promo_code_list("",$promo);
		$this->load->view('promo/promo_list',$promo);
	}
	
	function add_promo_code(){
		//echo "<pre/>";print_r($_POST);exit;
		if(count($_POST) > 0){
			$this->Promo_Model->add_promo_code_details($_POST);
			redirect('promo/promo_code_list','refresh');
		}else{
			$api = $this->General_Model->get_home_page_settings();
			$this->load->view('promo/add_promo',$api);
		}
	}
	
	function active_promo($promo_id1){
		$promo_id 	= json_decode(base64_decode($promo_id1));
		if($promo_id != ''){
			$this->Promo_Model->active_promo($promo_id);
		}
		redirect('promo/promo_code_list','refresh');
	}
	
	function inactive_promo($promo_id1){
		$promo_id 	= json_decode(base64_decode($promo_id1));
		if($promo_id != ''){
			$this->Promo_Model->inactive_promo($promo_id);
		}
		redirect('promo/promo_code_list','refresh');
	}
	
	function delete_promo($promo_id1){
		$promo_id 	= json_decode(base64_decode($promo_id1));
		if($promo_id != ''){
			$this->Promo_Model->delete_promo($promo_id);
		}
		redirect('promo/promo_code_list','refresh');
	}
	
	function edit_promo($promo_id1)
	{
		$promo_id 	= json_decode(base64_decode($promo_id1));
		if($promo_id != ''){
			$promo 		= $this->General_Model->get_home_page_settings();
			$promo['promo'] = $this->Promo_Model->get_promo_code_list($promo_id, $promo);
			$this->load->view('promo/edit_promo',$promo);
		}else{
			redirect('promo/promo_code_list','refresh');
		}
	}

	function update_promo($promo_id1){
		$promo_id 	= json_decode(base64_decode($promo_id1));
		if($promo_id != ''){
			if(count($_POST) > 0){
				$this->Promo_Model->update_promo($_POST,$promo_id);
				redirect('promo/promo_code_list','refresh');
			}else{
				redirect('promo/promo_code_list','refresh');
			}
		}else{
			redirect('promo/promo_code_list','refresh');
		}		
	}

	function send_email($promo_id1)
	{
	 $promo_id 	= json_decode(base64_decode($promo_id1));
	 if($promo_id != ''){
		$user = $this->General_Model->get_home_page_settings();
		$promo['promo'] = $this->Promo_Model->get_promo_code_list($promo_id, "");
		$this->load->view('promo/send_mail',$promo);
		}else{
		redirect('promo/promo_code_list');
		}
		
	}

	function send_mail_user_new($promo_id1)
	{
		 $promo_id 	= json_decode(base64_decode($promo_id1));  //print_r($promo_id); exit();
		 $user = $this->General_Model->get_home_page_settings();
		$email  = '';
		if(isset($_POST['b2c']))	
		{
			$b2c = $this->Promo_Model->get_user_list();
			for($i=0;$i<count($b2c);$i++)
			{
				$ee[] = $b2c[$i]->user_email;
				//$email  .= $b2c[$i]->user_email.', ';
			}
		}
		if(isset($_POST['b2b']))	
		{
			$b2b = $this->Promo_Model->get_agent_list();
			for($i=0;$i<count($b2b);$i++)
			{
				$ee[] = $b2b[$i]->user_email;
			}
		}
		
		
		if(isset($_POST['newsletter'])){
			$subs = $this->Promo_Model->get_all_subscribers();
			foreach($subs as $sb){
				$ee[] = $sb->email_id;
			}
		}
		$email = implode(',', $ee);

			$promo_value = $this->Promo_Model->get_promo_code_list($promo_id1, $user);
			$data['promo_code'] = $promo_value;
	        $exp_date = date('M j,Y', strtotime($promo_value[0]->exp_date));
			$data['emailid'] = $email;
			$data['email_template'] = $_POST['subject']; 
			$data['description'] = $_POST['description']; //print_r($data['description']); exit();
			$this->Email_Model->send_promocode_mail($data);
		redirect('promo/promo_code_list','refresh');
		
	}
}
