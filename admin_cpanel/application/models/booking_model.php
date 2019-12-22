<?php
class Booking_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_booking_list($booking = ''){
		$this->db->select('*');
		$this->db->from('booking_global g');
		$this->db->join('booking_flight f','f.parent_pnr = g.parent_pnr','left');
		// $this->db->join('insurance_details1','insurance_details1.parent_pnr = g.parent_pnr', 'left');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function get_booking_list_by_user($user_details_id = ''){
		$this->db->select('*');
		$this->db->from('booking_global g');
		$this->db->join('booking_flight f','f.parent_pnr = g.parent_pnr','left');
		if($user_details_id !='')
			$this->db->where('g.user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	 function get_booking_list_for_ticketing(){
		$this->db->select('*');
		$this->db->from('booking_global g');
		$this->db->join('booking_flight f','f.parent_pnr = g.parent_pnr','left');
		$this->db->where('g.pnr_no !=', '');
		$this->db->where('g.eticket_number', NULL);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
    function get_booking_flight_data($parent_pnr){
        $this->db->where('parent_pnr',$parent_pnr);
		return $this->db->get('booking_flight')->result();
    }
    
    function get_booking_global_data($parent_pnr){
        $this->db->where('parent_pnr',$parent_pnr);
		return $this->db->get('booking_global')->result();
    }
    
    function get_booking_payment_data($parent_pnr){
        $this->db->where('parent_pnr',$parent_pnr);
		return $this->db->get('booking_payment_details')->result();
    }
    
    function get_email_acess() {
		$this->db->where('mail_id','3');
       return $this->db->get('email_access');
    }
    
    function send_voucher($data) {
		$data['email_access'] = $this->Booking_Model->get_email_acess()->row();
		// echo '<pre/>';print_r($data['email_access']);exit;
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
        $this->email->from($data['email_access']->username, 'UTRAVEL');
        $this->email->to($data['to']);
        // $bcc_list = array('sunilgr.provab@gmail.com','utravel@aol.com',$data['email_access']->username);
        //~ $bcc_list = array('sunilgr.provab@gmail.com',$data['email_access']->username);
        $bcc_list = array('sunilgr.provab@gmail.com');
        $this->email->bcc($bcc_list);
        $this->email->subject('Utravel  - Flight Voucher :  '.$data['booking_number']);
        $this->email->message($data['email_voucher']);
        if ($this->email->send()) {
			// echo $this->email->print_debugger();exit;
            return 1;
        }else{
			// echo $this->email->print_debugger();exit;
            return 0;
        }
    }
    
     public function update_booking_global($booking_no, $update_booking){
        $this->db->where('pnr_no',$booking_no);
        $this->db->update('booking_global', $update_booking);
    }
    
    public function get_email_template($email_type) {
        $this->db->where('email_type', $email_type);
        return $this->db->get('email_template');
    }
    
    function get_insurancedata_data($parent_pnr){
        $this->db->where('parent_pnr',$parent_pnr);
		return $this->db->get('insurance_details1')->result();
    }
    
    public function update_ticket_info($pnr_no, $update_booking){
        $this->db->where('pnr_no',$pnr_no);
        $this->db->update('booking_global', $update_booking);
    }
}
?>
