<?php
class Email_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_max_email_number($email_type)
    {
		$this->db->where('mail_label',$email_type);
		$this->db->from('mail_box_details');
		return $this->db->count_all_results();
	}

	function insert_email_details($insert)
	{
		$this->db->select('message_number');
		$this->db->from('mail_box_details');
		$this->db->where('message_number',$insert['message_number']);
		$this->db->where('mail_label',$insert['mail_label']);
		$query = $this->db->get();
		if($query->num_rows > 0){}else{
			$insert_data = array(
								'message_number' 				=> $insert['message_number'],
								'message_id' 					=> $insert['message_id'],
								'admin_id' 						=> '1',
								'mail_label'					=> $insert['mail_label'],
								'header_info'	 				=> json_encode($insert['headerinfo']),
								'body_info' 					=> json_encode($insert['imap_body']),
								'structure_info' 				=> json_encode($insert['imap_fetchstructure']),
								'mail_box_details_time_stamp' 	=> (date('Y-m-d H:i:s'))			
							);
			$this->db->insert('mail_box_details',$insert_data);
		}
	}
	
	public function get_email_acess($purpose='') {
           $this->db->select('*')
                ->from('email_access');
           if($purpose != ''){
				$this->db->where('purpose', $purpose);		
			} else {
				$this->db->where('purpose', 'REGISTRATION');
			}
            $query = $this->db->get();
            if ( $query->num_rows > 0 ) {
             return $query->row();
            }
            return false;
    }

	function get_email_details($id = '')
	{
		$this->db->select('*');
		$this->db->from('mail_box_details');
		if($id!='')
			$this->db->where('mail_box_details_id',$id);
		$query = $this->db->get();
		if($query->num_rows > 0) 
        {
			return $query->result();
		}
		else
		{
			return '';
		}
	}
	
	public function get_email_template($email_type) {
		$this->db->where('email_type', $email_type);
        return $this->db->get('email_template');
    }
	
	function get_email_template_details($email_template_id = ''){
		$this->db->select('*');
		$this->db->from('email_template');
		if($email_template_id!='')
			$this->db->where('id',$email_template_id);
		$query = $this->db->get();
		if($query->num_rows > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	function active_email_template($email_template_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('id', $email_template_id);
		$this->db->update('email_template', $data); 
		$this->General_Model->insert_log('3','active_email_template',json_encode($data),'updating  Email Template status to active','email_template','email_template_id',$email_template_id);
	}
	
	function inactive_email_template($email_template_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('id', $email_template_id);
		$this->db->update('email_template', $data); 
		$this->General_Model->insert_log('3','inactive_email_template',json_encode($data),'updating  Email Template status to inactive','email_template','email_template_id',$email_template_id);
	}
	
	function delete_email_template($email_template_id){
		$this->db->where('id', $email_template_id);
		$this->db->delete('email_template'); 
		$this->General_Model->insert_log('3','delete_email_template',json_encode(array()),'deleting  Email Template from database','email_template','email_template_id',$email_template_id);
	}
	
	function update_mail_template($update,$email_template_id){
		//if(!isset($update['status']))
		//	$update['status'] = "INACTIVE";
		$update_data = array(
							'email_type' 			=> $update['email_type'],
							'email_from' 			=> $update['email_from'],
							'email_from_name' 		=> $update['email_from_name'],
							'subject' 				=> $update['subject'],
							'message' 				=> $update['message']				
						);
		$this->db->where('id', $email_template_id);
		$this->db->update('email_template', $update_data);
		$this->General_Model->insert_log('3','update_mail_template',json_encode($update_data),'updating  Email template  to database','email_template','email_template_id',$email_template_id);
	}

	 function send_promocode_mail($data){
    	
        $delimiters =$data['emailid']; 
    	$subject = $data['email_template'];
	         $promo = $data['promo_code'][0]->promo_code;
	        $message = 'Your Promo Code is:' .' '. $promo .' '. $data['description'];
	       
			$data['email_access'] = $this->get_email_acess();
		        $config = Array(
		           'protocol' => $data['email_access']->smtp,
		            // 'protocol' => 'mail',
		            'smtp_host' => $data['email_access']->host,
		            'smtp_port' => $data['email_access']->port,
		            'smtp_user' => $data['email_access']->username,
		            'smtp_pass' => $data['email_access']->password,
		            'mailtype' => 'html',
		            'charset' => 'iso-8859-1',
		            'wordwrap' => TRUE
		        );
	       
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->email->from($data['email_access']->username);
	        $this->email->to($delimiters);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();
        //echo $this->email->print_debugger();exit();
   }

   	function send_mail_to_user($data){
	        $mail 		= $data['emailid'];
	        $message 	= $data['description'];
	        $subject 	= $data['subject'];
			$data['email_access'] = $this->Booking_Model->get_email_acess()->row();
			$data['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
			$message1 = $data['email_template']->message;
			$message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
			$message1 = str_replace("{%%MESSAGE%%}", $data['description'], $message1);
			$message1 = str_replace("{%%WEB_URL%%}", base_url(), $message1);
        
			$config = Array(
			   'protocol' => $data['email_access']->smtp,
				// 'protocol' => 'mail',
				'smtp_host' => $data['email_access']->host,
				'smtp_port' => $data['email_access']->port,
				'smtp_user' => $data['email_access']->username,
				'smtp_pass' => $data['email_access']->password,
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
	       // echo '<pre/>sds';print_r($message1);exit;
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->email->from($data['email_access']->username);
	      	$test =  $this->email->to($mail);
	        $this->email->subject($subject);
	        $this->email->message($message1);
	        $this->email->send();
	      
   }
	
	
     function send_promo_to_user($data){
	        $mail = $data['emailid']; 
	        $promo = $data['promo_code'][0]->promo_code; 
	        $message = 'Your Promo Code is:' .' '. $promo;
	        $subject = 'Promo Code';
			$data['email_access'] = $this->Booking_Model->get_email_acess()->row();
		    $data['email_template'] = $this->Email_Model->get_email_template('promo_code')->row();
		    $config = Array(
		           'protocol' => $data['email_access']->smtp,
		            // 'protocol' => 'mail',
		            'smtp_host' => $data['email_access']->host,
		            'smtp_port' => $data['email_access']->port,
		            'smtp_user' => $data['email_access']->username,
		            'smtp_pass' => $data['email_access']->password,
		            'mailtype' => 'html',
		            'charset' => 'iso-8859-1',
		            'wordwrap' => TRUE
		        ); 
	       
	       
	       $promo_code = $data['promo_code'][0];
			$promo_type = $promo_code->promo_type;
			$product=$promo_code->product;
			if($promo_type == "Promo code by %") {
				$price_unit = '%';
			} else if($promo_type == "Promo code by amount") {
				$price_unit = '$';
			} else {
				$price_unit = '';
			}

			$message1 = $data['email_template']->message;
			$message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
			$message1 = str_replace("{%%PROMOCODE%%}", $data['promo_code'][0]->promo_code, $message1);
			$message1 = str_replace("{%%DISCOUNT%%}", $data['promo_code'][0]->discount, $message1);
			$message1 = str_replace("{%%UNIT_TYPE%%}", $price_unit, $message1);
			$message1 = str_replace("{%%PRODUCT%%}", $product, $message1);
			$message1 = str_replace("{%%EXPIRYDATE%%}", date('M j,Y', strtotime($data['promo_code'][0]->exp_date)), $message1);
			$message1 = str_replace("{%%WEB_URL%%}", base_url(), $message1);
	       
	       // echo '<pre/>sds';print_r($message1);exit;
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->email->from($data['email_access']->username);
	        $this->email->to($mail);
	        $this->email->subject($subject);
	        $this->email->message($message1);
	        $this->email->send();
	        // echo $this->email->print_debugger(); exit();
   }

      	function send_newsletter($data){
	        $mail = $data['email_id'];
	        $message = $data['message'];
	        $subject = $data['subject'];
			$data['email_access'] = $this->get_email_acess();
		        $config = Array(
		           'protocol' => $data['email_access']->smtp,
		            // 'protocol' => 'mail',
		            'smtp_host' => $data['email_access']->host,
		            'smtp_port' => $data['email_access']->port,
		            'smtp_user' => $data['email_access']->username,
		            'smtp_pass' => $data['email_access']->password,
		            'mailtype' => 'html',
		            'charset' => 'iso-8859-1',
		            'wordwrap' => TRUE
		        );
	       
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->email->from($data['email_access']->username);
	      	$this->email->to($mail);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();
	      
   }
   
   public function sendmail_redefinedVoucher($data) {
		// error_reporting(E_ALL);
        //$social_url = $data['social_url'];
        $subject = 'Fly2Escape - Your Booking PNR '.$data['pnr_no'].' '.$data['booking_status'];

        $data['email_access'] = $this->get_email_acess('Registration');
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        
		$config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );
       
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['to'], $email_to_1);
        $this->email->subject($subject);
        $this->email->message($data['message']);
        if(!$this->email->send()){
			$error = $this->email->print_debugger();
			return false ;
		} else {
			return true;
		} 
    }

    public function sendmail_voucher($data) {
        $message1 = $data['message'];
        $email = $data['email'];
        $subject = "Your Fly2Escape Voucher";
        $data['email_access'] = $this->get_email_acess('BOOKING');
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_access']->username, "Fly2Escape");
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message1);
        if(!$this->email->send()){
            $error = $this->email->print_debugger();
            //echo "<pre/>Mail Not Sent: "; print_r($error);  exit;
            return false;
        } else {
            return true;
        }
    }
    
    public function sendmail_contact_reply($data){
		$message1 = $data['email_template']->message;
		$message1 = str_replace("{%%FIRSTNAME%%}", $data['user_data'][0]->contact_name, $message1);
		$message1 = str_replace("{%%REPLY_MESSAGE%%}", $data['message'], $message1);
		
		$subject = $data['email_template']->subject;
		
		$data['email_access'] = $this->get_email_acess('Registration');
		$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        // $email_to_2 = $email_to[1];
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data'][0]->contact_email, $email_to_1);
        $this->email->subject($subject);
        $this->email->message($message1);
        if($this->email->send())
			return true;
		else 
			return false;
   }
   
   public function sendmail_newsletter($data){
		$message1 = $data['email_template']->message;
		$message1 = str_replace("{%%FIRSTNAME%%}", $data['user_data'][0]->subscriber_name, $message1);
		$message1 = str_replace("{%%ID%%}", base64_encode(json_encode($data['user_data'][0]->subscriber_details_id)), $message1);
		$subject = $data['email_template']->subject;
		
		$data['email_access'] = $this->get_email_acess('Sharing');
		$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        // $email_to_2 = $email_to[1];
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data'][0]->email_id, $email_to_1);
        $this->email->subject($subject);
        $this->email->message($message1);
        if($this->email->send())
			return true;
		else 
			return false;
   }

 
    
}
?>
