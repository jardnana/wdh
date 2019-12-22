<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start();
// error_reporting(E_ALL);
class Bestprice_Deals extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Bestpricedeal_Model');
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
		$categories['category_list'] 		= $this->Bestpricedeal_Model->get_flightdeals_categories();
		$this->load->view('bestprice_deals/flightdeals_categories_list',$categories);
	}
	
	
	function add_category(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('category_name','Category Name','required');
			$this->form_validation->set_rules('table_name','Related Table Name','required');
			if($this->form_validation->run()==TRUE){
				$this->Bestpricedeal_Model->add_category_details($_POST);
				redirect('bestprice_deals','refresh');
			} else {
				$categories 					= $this->General_Model->get_home_page_settings();
				$this->load->view('bestprice_deals/add_category',$categories);
			}
		}else{
			$categories 					= $this->General_Model->get_home_page_settings();
			$this->load->view('bestprice_deals/add_category',$categories);
		}
	}
	
	function inactive_category($category_id){
		$category_id = json_decode(base64_decode($category_id));
		if($category_id != ''){
			$this->Bestpricedeal_Model->inactive_category($category_id);
		}
		redirect('bestprice_deals','refresh');
	}
	
	function active_category($category_id){
		$category_id = json_decode(base64_decode($category_id));
		if($category_id != ''){
			$this->Bestpricedeal_Model->active_category($category_id);
		}
		redirect('bestprice_deals','refresh');
	}
	 
	function edit_category($category_id){
		$category_id = json_decode(base64_decode($category_id));

		if($category_id != ''){
			$categories 					= $this->General_Model->get_home_page_settings();
			$categories['category_list'] 	= $this->Bestpricedeal_Model->get_flightdeals_categories($category_id);
			$this->load->view('bestprice_deals/edit_category',$categories);
		} else {
			redirect('bestprice_deals','refresh');
		}
	}
	
	function delete_category($category_id){
		$category_id = json_decode(base64_decode($category_id));
		if($category_id != ''){
			$this->Bestpricedeal_Model->delete_category($category_id);
		}
		redirect('bestprice_deals','refresh');
	}
	
	function update_category($category_id){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('category_name','Category Name','required');
			if($this->form_validation->run()==TRUE){
				$category_id = json_decode(base64_decode($category_id));
				if($category_id != ''){
					$this->Bestpricedeal_Model->update_category($_POST,$category_id);
				}
				redirect('bestprice_deals','refresh');
			} else {
				redirect('bestprice_deals/edit_category/'.$category_id,'refresh');
			}
		}else if($city_id!=''){
			redirect('bestprice_deals/edit_category/'.$category_id,'refresh');
		}else{
			redirect('bestprice_deals','refresh');
		}
	}
	function deals_list($category_id){		
		$category_id = json_decode(base64_decode($category_id));
		if($category_id != ''){
			$categories 				= $this->General_Model->get_home_page_settings();
			$categories['category_id']	= $category_id;
			$categories['deals_list'] 	= $this->Bestpricedeal_Model->get_deals_list($category_id);
			
			$this->load->view('bestprice_deals/deal_list', $categories);
		} else {
			redirect('bestprice_deals','refresh');
		}
	}
	
	function add_deal($category_id){
		if (count($_POST) > 0) {
			$category_id = json_decode(base64_decode($category_id));
			if($category_id != ''){
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
					$tablename =$category_id;
					$this->Bestpricedeal_Model->add_deal($_POST, $tablename, $deal_image_name);
				} else {
					$deals = $this->General_Model->get_home_page_settings();
					$deals['category_id']	= $category_id;
					$this->load->view('bestprice_deals/add_deal', $deals);
				}
			}
            redirect('bestprice_deals/deals_list/'.$category_id, 'refresh');
        } else {
            $deals = $this->General_Model->get_home_page_settings();
           	$deals['category_id']	= json_decode(base64_decode($category_id));
            $this->load->view('bestprice_deals/add_deal', $deals);
        }
	}
	
	function inactive_deal($id, $category_id){
		$id = json_decode(base64_decode($id));
		$table_name = json_decode(base64_decode($category_id));
		if($id != ''){
			$this->Bestpricedeal_Model->inactive_deal($id, $table_name);
		}
		redirect('bestprice_deals/deals_list/'.$category_id,'refresh');
	}
	function active_deal($id, $category_id){
		$id = json_decode(base64_decode($id));
		$table_name = json_decode(base64_decode($category_id));
		if($id != ''){
			$this->Bestpricedeal_Model->active_deal($id, $table_name);
		}
		redirect('bestprice_deals/deals_list/'.$category_id,'refresh');
	}
	function edit_deal($id, $category_id){
		$id = json_decode(base64_decode($id));
		$table_name = json_decode(base64_decode($category_id));
		if($id != '' && $table_name != ''){
			$deal 					= $this->General_Model->get_home_page_settings();
			$deal['deal'] 			= $this->Bestpricedeal_Model->get_deals_list_from_table($id, $table_name);
			$deal['category_id'] 	= $table_name;
			
			$this->load->view('bestprice_deals/edit_deal',$deal);
		} else {
			redirect('bestprice_deals/deals_list/'.$category_id,'refresh');
		}
	}
	function update_deal($id1, $category_id){
		// echo '<pre/>';print_r($_POST);exit;
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
							$oldImage = "uploads/flight_deals/" . $deal_image_name;
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
					$table_name = json_decode(base64_decode($category_id));
					$this->Bestpricedeal_Model->update_deal($_POST, $id, $table_name, $deal_image_name);
				} else {
					redirect('bestprice_deals/edit_deal/'.$id1.'/'.$category_id, 'refresh');
				}
			}
            redirect('bestprice_deals/deals_list/'.$category_id, 'refresh');
        } else if ($id != '') {
            redirect('bestprice_deals/deals_list/'.$category_id, 'refresh');
        } else {
            redirect('bestprice_deals/deals_list/'.$category_id, 'refresh');
        }
	}
	function delete_deal($id, $category_id){
		$id = json_decode(base64_decode($id));
		$table_name = json_decode(base64_decode($category_id));
		if($id != ''){
			$this->Bestpricedeal_Model->delete_deal($id,$table_name);
		}
		redirect('bestprice_deals/deals_list/'.$category_id,'refresh');
	}
} 
?>
