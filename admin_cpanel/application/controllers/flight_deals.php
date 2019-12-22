<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Flight_Deals extends CI_Controller {	
	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Flightdeals_Model');
		$this->load->model('Airline_Model');
		// $this->check_admin_login();		
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
		$categories['deals_list'] 		= $this->Flightdeals_Model->get_deals_list();
		$this->load->view('flight_deals/deal_list',$categories);
	}
	function add_deal(){
		if (count($_POST) > 0) {
				$this->form_validation->set_rules('date_range','Check-in and Check-out Date Range','required');
				$this->form_validation->set_rules('price_offer','Price Offer','required');
				if($this->form_validation->run()==TRUE){
					$deal_image_name = '';
					if (!empty($_FILES['deal_image']['name'])) {
						if (is_uploaded_file($_FILES['deal_image']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$sourcePath = $_FILES['deal_image']['tmp_name'];
							$filename = $_FILES['deal_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['deal_image']['name'];
								$targetPath = "uploads/flight_deals/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$deal_image_name = $img_Name;
								}
							}
						}
					}
					$this->Flightdeals_Model->add_deal($_POST, $deal_image_name);
				} else {
					$deals = $this->General_Model->get_home_page_settings();
					$deals['airline_list'] 	= $this->Airline_Model->get_airline_list();
					$this->load->view('flight_deals/add_deal', $deals);
				}
            redirect('flight_deals/', 'refresh');
        } else {
            $deals = $this->General_Model->get_home_page_settings();
            $deals['airline_list'] 	= $this->Airline_Model->get_airline_list();
            $this->load->view('flight_deals/add_deal', $deals);
        }
	}
	
	function inactive_deal($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightdeals_Model->inactive_deal($id);
		}
		//exit;
		redirect('flight_deals/','refresh');
	}
	function active_deal($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightdeals_Model->active_deal($id);
		}
		redirect('flight_deals/','refresh');
	}
	function edit_deal($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$deal 					= $this->General_Model->get_home_page_settings();
			$deal['deal'] 			= $this->Flightdeals_Model->get_deals_list_from_table($id);
			$deal['airline_list'] 	= $this->Airline_Model->get_airline_list();
			$this->load->view('flight_deals/edit_deal',$deal);
		} else {
			redirect('flight_deals/','refresh');
		}
	}
	function update_deal($id1){
		if (count($_POST) > 0) {
            $id = json_decode(base64_decode($id1));
            if($id != ''){
				$this->form_validation->set_rules('date_range','Check-in and Check-out Date Range','required');
				$this->form_validation->set_rules('price_offer','Price Offer','required');
				if($this->form_validation->run()==TRUE){
					$deal_image_name = $_REQUEST['deal_image_old'];
					if (!empty($_FILES['deal_image']['name'])) {
						if (is_uploaded_file($_FILES['deal_image']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = $deal_image_name;
							unlink($oldImage);
							$sourcePath = $_FILES['deal_image']['tmp_name'];
							$filename = $_FILES['deal_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['deal_image']['name'];
								$targetPath = "uploads/flight_deals/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$deal_image_name = $img_Name;
								}
							}
						}
					}
					//echo"<pre/>";print_r($_POST);exit;
					$this->Flightdeals_Model->update_deal($_POST, $id, $deal_image_name);
				} else {
					redirect('flight_deals/edit_deal/'.$id1, 'refresh');
				}
			}
            redirect('flight_deals/', 'refresh');
        } else if ($id != '') {
            redirect('flight_deals/', 'refresh');
        } else {
            redirect('flight_deals/', 'refresh');
        }
	}
	function delete_deal($id){
		$id = json_decode(base64_decode($id));
		if($id != ''){
			$this->Flightdeals_Model->delete_deal($id);
		}
		redirect('flight_deals/','refresh');
	}
	
	function get_airports(){
		ini_set('memory_limit', '-1');
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		$airports = $this->Flightdeals_Model->get_airport_list($term)->result();
		foreach($airports as $airport){
			$airports['label'] = $airport->airport_city.' - '.$airport->airport_name.', '.$airport->country.', '.$airport->airport_code;
			$airports['value'] = $airport->airport_city.', '.$airport->airport_code;
			$airports['id'] = $airport->airport_id;
			$result[] = $airports; 
		}
		echo json_encode($result);//format the array into json data
	}
	
	function get_airports_code(){
		ini_set('memory_limit', '-1');
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		$airports = $this->Flightdeals_Model->get_airport_list($term)->result();
		foreach($airports as $airport){
			$airports['label'] = $airport->airport_city.' - '.$airport->airport_name.', '.$airport->country.', '.$airport->airport_code;
			$airports['value'] = $airport->airport_code;
			$airports['id'] = $airport->airport_id;
			$result[] = $airports; 
		}
		echo json_encode($result);//format the array into json data
	}
	
} 
?>
