<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Email extends CI_Controller {
 
	// imap server connection
	public $conn;
 
	// inbox storage and inbox message count
	private $inbox;
	private $msg_cnt;
 
	// email login credentials
	// private $server = '{imap.gmail.com:993/imap/ssl/novalidate-cert}';
	private $server = '{mail.gettop3quotes.com:993/imap/ssl/novalidate-cert}';
	private $user   = 'developers@gettop3quotes.com';
	private $pass   = 'Dev@@2015';

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Email_Model');
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
	// close the server connection
	function close() {
		$this->inbox = array();
		$this->msg_cnt = 0;
		imap_close($this->conn);
	}
 
	// open the server connection
	// the imap_open function parameters will need to be changed for the particular server
	// these are laid out to connect to a Dreamhost IMAP server
	function connect($email_type = ''){
		$this->conn = imap_open($this->server.$email_type, $this->user, $this->pass);
	}
 
	// move the message to a new folder
	function move($msg_index, $folder='INBOX.Processed') {
		// move on server
		imap_mail_move($this->conn, $msg_index, $folder);
		imap_expunge($this->conn);
 
		// re-read the inbox
		$this->inbox();
	}
 
	// get a specific message (1 = first email, 2 = second email, etc.)
	function get($msg_index=NULL) {
		if (count($this->inbox) <= 0) {
			return array();
		}
		elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
			return $this->inbox[$msg_index];
		}
 
		return $this->inbox[0];
	}
 

	function email_configure($email_type = 'INBOX') {
		$this->connect($email_type);
		// $type_lists = imap_list($this->conn, $this->server.$email_type, "*");
		// foreach($type_lists as $type_list) {
			// $type_list_short[] = str_replace($this->server, '', $type_list);
		// }
		$type_list_short[] = 'INBOX';
		if($type_list_short!=''){
			for($t=0;$t<count($type_list_short);$t++){
				if($email_type != ''){
					$this->msg_cnt = 0; imap_close($this->conn);
					$this->conn = imap_open($this->server.$type_list_short[$t], $this->user, $this->pass);
				}
				$this->msg_cnt = imap_num_msg($this->conn);
				$mail_count = $this->Email_Model->get_max_email_number($type_list_short[$t]);
				if($this->msg_cnt != $mail_count){
					$result = array();
					if($mail_count == '')
						$result = imap_search($this->conn,'');
					else
						$result = imap_search($this->conn,'UNSEEN');

					if(isset($result[0])){
						if(count($result) + $mail_count == $this->msg_cnt){}else{
							$result = imap_search($this->conn,'');
						}
					}else{
						$result = imap_search($this->conn,'');
					}
					if($result!=''){
						for($new = 0;$new < count($result);$new++){
							if(isset($result[$new]) && $result[$new]!=''){
								$insert['headerinfo'] 			= imap_headerinfo($this->conn, $result[$new]);
								// echo '<pre/>';print_r($insert['headerinfo']);exit;
								$insert['message_id'] 			= '';// $insert['headerinfo']->message_id;
								$insert['message_number']		= $insert['headerinfo']->Msgno;
								$insert['mail_label']			= $type_list_short[$t];
								$insert['imap_body'] 			= imap_body($this->conn, $result[$new]);
								$insert['imap_fetchstructure'] 	= imap_fetchstructure($this->conn, $result[$new]);
								$this->Email_Model->insert_email_details($insert);
							}
						}
					}
				}
			}
			echo "All the Emails are configured Successfully";
		}else{
			echo "Email in not configured Successfully";
		}
	}
	
	function email_details() {
		$data 					= $this->General_Model->get_home_page_settings();
		$data['mail_details'] 	= $this->Email_Model->get_email_details();
		$this->load->view('mailbox/mail_details',$data);
	}
	
	function email_content($id) {
		$data 					= $this->General_Model->get_home_page_settings();
		$data['mail_details'] 	= $this->Email_Model->get_email_details($id);
		// echo '<pre/>';print_r($data['mail_details']);exit;
		$this->load->view('mailbox/mail_content',$data);
	}
	
	function email_template_list() {
		$data 						= $this->General_Model->get_home_page_settings();
		$data['email_template'] 	= $this->Email_Model->get_email_template_details();
		$this->load->view('email/email_template_list',$data);
	}
	
	function active_email_template($template_id1){
		$template_id 	= json_decode(base64_decode($template_id1));
		if($template_id != ''){
			$this->Email_Model->active_email_template($template_id);
		}
		redirect('email/email_template_list','refresh');
	}
	
	function inactive_email_template($template_id1){
		$template_id 	= json_decode(base64_decode($template_id1));
		if($template_id != ''){
			$this->Email_Model->inactive_email_template($template_id);
		}
		redirect('email/email_template_list','refresh');
	}
	
	function delete_email_template($template_id1){
		$template_id 	= json_decode(base64_decode($template_id1));
		if($template_id != ''){
			$this->Email_Model->delete_email_template($template_id);
		}
		redirect('email/email_template_list','refresh');
	}
	
	function edit_mail_template($template_id1)
	{
		$template_id 	= json_decode(base64_decode($template_id1));
		if($template_id != ''){
			$email 						= $this->General_Model->get_home_page_settings();
			$email['email_template'] 	= $this->Email_Model->get_email_template_details($template_id);
			$this->load->view('email/edit_email_template',$email);
		}else{
			redirect('email/email_template_list','refresh');
		}
	}

	function update_mail_template($template_id1){
		$template_id 	= json_decode(base64_decode($template_id1));
		if($template_id != ''){
			if(count($_POST) > 0){
				$this->form_validation->set_rules('email_type','Email Type','required');
				$this->form_validation->set_rules('email_from','Email From','required');
				$this->form_validation->set_rules('email_from_name','Email From Name','required');
				if($this->form_validation->run()==TRUE){
					$this->Email_Model->update_mail_template($_POST,$template_id);
					redirect('email/email_template_list','refresh');
				} else {
					redirect('email/edit_mail_template/'.$template_id1,'refresh');
				}
			}else{
				redirect('email/email_template_list','refresh');
			}
		}else{
			redirect('email/email_template_list','refresh');
		}		
	}
 
}
 
?>
