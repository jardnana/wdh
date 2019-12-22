<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE){ session_start(); }
error_reporting(0);
class Home extends CI_Controller {
 	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Database_model');
    }

	public function index(){
		$this->load->view('home/index');
	}
	
	public function about_us(){
		$this->load->view('home/about_us');
	}
	
	public function faqs(){
		$this->load->view('faqs/index');
	}
	
	public function not_found(){
		$data['page'] = 'not_found';
		$this->load->view('errors/404',$data);
	}

	function get_busDestinations(){
		ini_set('memory_limit', '-1');
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		$destinations = $this->Common_model->get_destination_list($term)->result();
		
		foreach($destinations as $destination){
			$destinations['label'] = $destination->city;
			$destinations['value'] = $destination->city;
			$destinations['id'] = $destination->destid;
			$result[] = $destinations; 
		}
		// echo '<pre>da'; print_r($result); exit();
		echo json_encode($result);//format the array into json data
	}

	

}
