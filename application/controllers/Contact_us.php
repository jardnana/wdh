<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Contact_us extends CI_Controller {
 	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Database_model');
    }

	public function index(){
		$this->load->view('contact_us/index');
	}
	
	function add_message(){
		$_POST 	= $this->security->xss_clean($_POST);
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]|max_length[66]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]|max_length[66]');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ( $this->form_validation->run() !== false ){
			$this->Common_model->add_customer_message($_POST); 	
			$data['status']=true; 	$data['message'] = 'Thanks for your feedback!';	
		}else{
			$data['status']=false; 	$data['message'] = validation_errors();	
		}
		echo json_encode($data); exit;
	}
	
}
