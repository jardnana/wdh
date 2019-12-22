<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(0);
class Product extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Product_Model');
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
     
	function product_list(){
		$product 					= $this->General_Model->get_home_page_settings();
		$product['product_list'] 	= $this->Product_Model->get_product_list();
		// echo '<pre/>';print_r($product);exit;
		$this->load->view('product/product_list',$product);
	}
	
	function add_product(){
		if(count($_POST) > 0){
			$this->Product_Model->add_product($_POST);
			redirect('product/product_list','refresh');
		}else{
			$product = $this->General_Model->get_home_page_settings();
			$this->load->view('product/add_product',$product);
		}
	}
	
	function active_product($product_id1){
		$product_id 	= json_decode(base64_decode($product_id1));
		if($product_id != ''){
			$this->Product_Model->active_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function inactive_product($product_id1){
		$product_id 	= json_decode(base64_decode($product_id1));
		if($product_id != ''){
			$this->Product_Model->inactive_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function delete_product($product_id1){
		$product_id 	= json_decode(base64_decode($product_id1));
		if($product_id != ''){
			$this->Product_Model->delete_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function edit_product($product_id1)
	{
		$product_id 	= json_decode(base64_decode($product_id1));
                //echo $product_id;
                //exit(1); 
		if($product_id != ''){
			$product 			= $this->General_Model->get_home_page_settings();
			$product['product'] = $this->Product_Model->get_product_list($product_id);
			$this->load->view('product/edit_product',$product);
		}else{
			redirect('product/product_list','refresh');
		}
	}
	
	function update_product($product_id){   
		$product_id 	= json_decode(base64_decode($product_id1));
		if($product_id != ''){
			if(count($_POST) > 0){
				$this->Product_Model->update_product($_POST,$product_id);
				redirect('product/product_list','refresh');
			}else if($product_id!=''){
				redirect('product/edit_product/'.$product_id,'refresh');
			}else{
				redirect('product/product_list','refresh');
			}
		}else{
			redirect('product/product_list','refresh');
		}
	}
}
