<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(0);
class Social extends CI_Controller {	
	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Social_Model');
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
    
    function social_links(){
		$social 						= $this->General_Model->get_home_page_settings();
		$social['links_list'] 		= $this->Social_Model->get_social_links_list();
		//echo"<pre/>";print_r($social); exit;
		$this->load->view('social_links/social_links_list',$social);
	}
	
	function add_social_link(){
		if(count($_POST) > 0){
			$this->Social_Model->add_social_links($_POST);
			redirect('social/social_links','refresh');
		}else{
			$social_links 					= $this->General_Model->get_home_page_settings();
			$this->load->view('social_links/add_social_link',$social_links);
		}
	}
	
	function inactive_social_link($social_link_id1){
		$social_link_id 	= json_decode(base64_decode($social_link_id1));
		if($social_link_id != ''){
			$this->Social_Model->inactive_social_link($social_link_id);
		}
		redirect('social/social_links','refresh');
	}
	
	function active_social_link($social_link_id1){
		$social_link_id 	= json_decode(base64_decode($social_link_id1));
		if($social_link_id != ''){
			$this->Social_Model->active_social_link($social_link_id);
		}
		redirect('social/social_links','refresh');
	}
	
	function edit_social_link($social_link_id1){
		$social_link_id 	= json_decode(base64_decode($social_link_id1));
		if($social_link_id != ''){
			$social_links 						= $this->General_Model->get_home_page_settings();
			$social_links['links_list'] 		= $this->Social_Model->get_social_links_list($social_link_id);
			$this->load->view('social_links/edit_social_link',$social_links);
		}else{
			redirect('social/social_links','refresh');
		}
	}
	
	function update_social_link($social_link_id1){
		$social_link_id 	= json_decode(base64_decode($social_link_id1));
		if($social_link_id != ''){
			if(count($_POST) > 0){
				$this->Social_Model->update_social_link($_POST,$social_link_id);
				redirect('social/social_links','refresh');
			}else if($social_link_id!=''){
				redirect('social/edit_social_link/'.$social_link_id,'refresh');
			}else{
				redirect('social/social_links','refresh');
			}
		}else{
			redirect('social/social_links','refresh');
		}
	}
	
	function delete_social_link($social_link_id1){
		$social_link_id 	= json_decode(base64_decode($social_link_id1));
		if($social_link_id != ''){
			$this->Social_Model->delete_social_link($social_link_id);
		}
		redirect('social/social_links','refresh');
	}
	
	function newsletters(){
		$newsletters 							= $this->General_Model->get_home_page_settings();
		$newsletters['subscribers_list'] 		= $this->Social_Model->get_newsletter_subscribers_list();
		$this->load->view('newsletter_subscribers/subscribers_list',$newsletters);
	}
	
	function inactive_subscriber($subscriber_id){
		$this->Social_Model->inactive_subscriber($subscriber_id);
		redirect('social/newsletters','refresh');
	}
	
	function active_subscriber($subscriber_id){
		$this->Social_Model->active_subscriber($subscriber_id);
		redirect('social/newsletters','refresh');
	}
	
	function delete_subscriber($subscriber_id){
		$this->Social_Model->delete_subscriber($subscriber_id);
		redirect('social/newsletters','refresh');
	}
	
	function send_mail_to_subscriber($subscriber_id){
		$newsletters 						= $this->General_Model->get_home_page_settings();
		$newsletters['subscribers_list'] 	= $this->Social_Model->get_newsletter_subscribers_list($subscriber_id);
		$this->load->view('newsletter_subscribers/mailto_subscriber',$newsletters);
	}
	
	function subscriber_mailing($subscriber_id){
		if(count($_POST) > 0){
			$this->Social_Model->sendmail_subscriber($_POST,$subscriber_id);
			redirect('social/newsletters','refresh');
		}else if($subscriber_id!=''){
			redirect('social/send_mail_to_subscriber/'.$subscriber_id,'refresh');
		}else{
			redirect('social/newsletters','refresh');
		}
	}
}
