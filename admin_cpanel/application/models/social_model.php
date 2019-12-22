<?php
class Social_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
     function get_social_links_list($social_link_id = ''){
		$this->db->select('*');
		$this->db->from('social_link_details');
		if($social_link_id !='')
			$this->db->where('social_link_details_id', $social_link_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function add_social_links($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'social_link_name' 	=> $input['social_link_title'],
							'link' 				=> $input['social_link'],
							'position' 			=> $input['position'],
							'icon' 				=> $input['social_link_icon'],
							'status' 			=> $input['status']					
						);			
		$this->db->insert('social_link_details',$insert_data);
		$social_link_id = $this->db->insert_id();
		//$this->General_Model->insert_log('9','add_social_links',json_encode($insert_data),'Adding  Social Link Details to database','social_link_details_id','social_link_details_id',$social_link_id);
	}
	
	function inactive_social_link($social_link_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('social_link_details_id', $social_link_id);
		$this->db->update('social_link_details', $data);
		//$this->General_Model->insert_log('9','inactive_social_link',json_encode($data),'updating Social Link Details status to inactive','social_link_details_id','social_link_details_id',$social_link_id);  
	}
	
	function active_social_link($social_link_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('social_link_details_id', $social_link_id);
		$this->db->update('social_link_details', $data);
		//$this->General_Model->insert_log('9','active_social_link',json_encode($data),'updating Social Link Details status to active','social_link_details_id','social_link_details_id',$social_link_id);
	}
	
	function update_social_link($input, $social_link_id){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$update_data = array(
							'social_link_name' 	=> $input['social_link_title'],
							'link' 				=> $input['social_link'],
							'position' 			=> $input['position'],
							'icon' 				=> $input['social_link_icon'],
							'status' 			=> $input['status']					
						);	
		$this->db->where('social_link_details_id', $social_link_id);
		$this->db->update('social_link_details', $update_data);
		//$this->General_Model->insert_log('9','update_social_link',json_encode($update_data),'updating Social Link Details to database','social_link_details_id','social_link_details_id',$social_link_id);
	}
	
	function delete_social_link($social_link_id){
		$this->db->where('social_link_details_id', $social_link_id);
		$this->db->delete('social_link_details'); 
		//$this->General_Model->insert_log('9','delete_social_link',json_encode(array()),'deleting  Social Link Details from database','social_link_details_id','social_link_details_id',$social_link_id);
	}
	
	function get_newsletter_subscribers_list($subscriber_id=''){
		$this->db->select('*');
		$this->db->from('newsletter_subscriptions');
		if($subscriber_id !='')
			$this->db->where('newsletter_subscription_id', $subscriber_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function inactive_subscriber($subscriber_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('newsletter_subscription_id', $subscriber_id);
		$this->db->update('newsletter_subscriptions', $data);	
		//$this->General_Model->insert_log('9','inactive_subscriber',json_encode($data),'updating Newsletter Subscription Details status to inactive','newsletter_subscription','newsletter_subscription_id',$subscriber_id);  
	}
	
	function active_subscriber($subscriber_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('newsletter_subscription_id', $subscriber_id);
		$this->db->update('newsletter_subscriptions', $data);	
		//$this->General_Model->insert_log('9','active_subscriber',json_encode($data),'updating Newsletter Subscription Details status to active','newsletter_subscription','newsletter_subscription_id',$subscriber_id);
	}
	
	function delete_subscriber($subscriber_id){
		$this->db->where('newsletter_subscription_id', $subscriber_id);
		$this->db->delete('newsletter_subscriptions'); 
		//$this->General_Model->insert_log('9','delete_subscriber',json_encode(array()),'deleting  Newsletter Subscription Details from database','newsletter_subscription','newsletter_subscription_id',$subscriber_id);
	}
	
	function sendmail_subscriber($input, $subscriber_id){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$update_data = array(
							'email_id' 				=> $input['subscriber_mail_id'],
							'mail_content' 			=> $input['mail_content'],
							'status' 				=> $input['status']					
						);	
		$this->db->where('newsletter_subscription_id', $subscriber_id);
		$this->db->update('newsletter_subscriptions', $update_data);
		//$this->General_Model->insert_log('9','sendmail_subscriber',json_encode($update_data),'updating  Newsletter sendmail subscriber from database','newsletter_subscription','newsletter_subscription_id',$subscriber_id);
	}
}
?>
