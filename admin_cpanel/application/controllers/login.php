<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Login extends CI_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->model('General_Model');		
		$this->load->model('Security_Model');
	}
	public function index(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        $this->load->view('login/login');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}else{			
			$this->load->view('login/login');
		}
	}
		
	public function login_check(){		
		if($this->session->userdata('provab_admin_logged_in')){
			redirect('dashboard','refresh');
		} 			
		$type 					 =	"URL";
		$ip_white_list_status 	 = $this->Security_Model->admin_ip_check();
		// if($ip_white_list_status == "ACTIVE"){
		if(true){			
			// if($ip_track['row_count'] < 5){
			if(true){
				if(count($_POST) > 0){	
					$this->form_validation->set_rules('username', 'Email-Id', 'trim|required|xss_clean|min_length[3]|max_length[25]');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[3]|max_length[25]');
					if ( $this->form_validation->run() !== false ) {
						$resp = array();	$username = $_POST["username"]; 	$password = $_POST["password"];
						$resp['submitted_data'] = base64_encode(serialize($_POST)); 	$resp['login_status'] =  $login_status = 'invalid';
						$result = $this->Security_Model->check_login_status($username,$password);
						if($result['status']	==	1){
							$resp['login_status'] 	=  $login_status 		= 'success';
							$sessionUserInfo 		= array( 
															'provab_admin_id' 			=> $result['result']->admin_id,
															'provab_admin_name'	 		=> $result['result']->admin_name,
															'provab_admin_logged_in' 	=> "Logged_In"
														);
							$this->session->set_userdata($sessionUserInfo);
							$recent_tracking_id 	 = $this->Security_Model->admin_ip_track($type);
							$ip_track 			 = $this->Security_Model->admin_ip_attempt($recent_tracking_id);
							$resp['redirect_url'] = site_url().'dashboard';
						}else{
							$type 					 = "FAIL"; $recent_tracking_id = '';
							$recent_tracking_id 	 = $this->Security_Model->admin_ip_track($type);
							$ip_track 				 = $this->Security_Model->admin_ip_attempt($recent_tracking_id);
							if($ip_track['row_count'] < 5){
								$resp['login_status'] =  $login_status = 'invalid';
							}else{
								$resp['login_status'] 	=  $login_status 		= 'success';
								$resp['redirect_url']	= site_url('login/blocked');
							}
						}					
					}else{
						redirect('login','refresh');
					}
				}else{
					redirect('login','refresh');
				}
			}else{
				$resp['login_status'] 	=  $login_status 		= 'success';
				$resp['redirect_url']	= site_url('login/blocked');
			}
		}else if($ip_white_list_status == "BLOCK"){
			$resp['login_status'] 	=  $login_status 		= 'success';
			$resp['redirect_url']	= site_url('login/blocked');
		}else{
			$resp['login_status'] 	=  $login_status 		= 'success';
			$resp['redirect_url']	= site_url('login/denied');
		}
		echo json_encode($resp);	
	}
	
	public function blocked(){
		$this->load->view('error/blocked');
	}
	
	public function denied(){
		$this->load->view('error/denied');
	}
	
	public function notfound(){
		$this->load->view('error/not_found');
	}
	
	public function forgot_password(){
		$this->load->view('login/forgot_password');
	}
	
	public function logout(){
		$this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	
	public function lock_screen(){
		if(count($_POST) > 0){
			$resp = array(); 	$provab_admin_id = $this->session->userdata('provab_admin_id'); $password = $_POST["password"];
			$resp['submitted_data'] = $_POST; 	$resp['login_status'] =  $login_status = 'invalid';
			$result = $this->Security_Model->check_login_status_by_Id($provab_admin_id,$password);
			if($result['status']	==	1){
				$resp['login_status'] 	=  $login_status 		= 'success';
				$sessionUserInfo 		= array( 
												'provab_admin_id' 			=> $result['result']->admin_id,
												'provab_admin_name'	 		=> $result['result']->admin_name,
												'provab_admin_logged_in' 	=> "Logged_In"
											);
				$this->session->set_userdata($sessionUserInfo);
				$url_details = $this->Security_Model->get_previous_url();
				if($url_details->url =='')
					$resp['redirect_url'] = site_url().'dashboard';
				else
					$resp['redirect_url'] = $url_details->url;
			}else{
				$resp['login_status'] =  $login_status = 'invalid';
				$resp['redirect_url']	= site_url('login/lock_screen');
			}
			echo json_encode($resp);	
		}else{
			if($this->session->userdata('provab_admin_logged_in') == ""){
				$this->load->view('login/login');
			}else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
				redirect('dashboard','refresh');
			}else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
				$this->load->view('login/logoff');
			}else{			
				$this->load->view('login/login');
			}
		}
	}
	public function logoff(){
		$resp['login_status'] 	=  $login_status 		= 'success';
		$this->session->set_userdata('provab_admin_logged_in','Lock_Screen') ;
		if($this->session->userdata('provab_admin_session_id') == ""){
			$this->session->set_userdata('provab_admin_session_id',session_id()) ;
		}
		$this->Security_Model->insert_lock_screen_details($_POST);
		$resp['redirect_url']	= site_url('login/lock_screen');
		echo json_encode($resp);
	}
	
}
?>
