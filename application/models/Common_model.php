<?php
	class Common_model extends CI_Model {
		function __construct(){
			parent::__construct();
		}
		
		function header_menu_details_id($admin_id){		
			$this->db->select('admin_details.*,address_details.*,role_details.role_name');
			$this->db->from('admin_details');
			$this->db->join('address_details','address_details.address_details_id = admin_details.address_details_id');
			$this->db->join('role_details','role_details.role_id = admin_details.role_id');
			$this->db->where('admin_id',$admin_id);
			$this->db->where('admin_details.status_id',ACTIVE_VALUE);
			$query = $this->db->get();
			return $this->Database_model->get_mysql_row($query);
		}
		
		function get_header_menu_details(){
			$this->db->select('*');
			$this->db->from('header_menu_details');
			$this->db->where('header_menu_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('header_menu_details.menu_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_language_details(){
			$this->db->select('*');
			$this->db->from('language_details');
			$this->db->where('language_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('language_details.language_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_banner_details(){
			$this->db->select('*');
			$this->db->from('banner_details');
			$this->db->where('banner_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('banner_details.banner_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_footer_menu_details(){
			$this->db->select('*');
			$this->db->from('footer_details');
			$this->db->where('footer_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('footer_details.footer_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_social_link_details(){
			$this->db->select('*');
			$this->db->from('social_link_details');
			$this->db->where('social_link_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('social_link_details.social_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_plans_details(){
			$this->db->select('*');
			$this->db->from('plans');
			$this->db->where('plans.status_id',ACTIVE_VALUE);
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_features_details(){
			$this->db->select('*');
			$this->db->from('features_details');
			$this->db->where('features_details.status_id',ACTIVE_VALUE);
			$this->db->order_by('features_details.feature_position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_testimonial_details(){
			$this->db->select('*');
			$this->db->from('customer_testimonials');
			$this->db->where('customer_testimonials.status_id',ACTIVE_VALUE);
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_faqs_details(){
			$this->db->select('*');
			$this->db->from('faqs');
			$this->db->where('faqs.status_id',ACTIVE_VALUE);
			$this->db->order_by('faqs.position');
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function get_about_us_details(){
			$this->db->select('*');
			$this->db->from('about_us');
			$this->db->where('about_us.status_id',ACTIVE_VALUE);
			$query = $this->db->get();
			return $this->Database_model->get_mysql_results($query);
		}
		
		function add_customer_message($input){
			$insert_array = array(
				'customer_name' 	=> $input['name'],
				'customer_email' 	=> $input['email'],
				'customer_message' 	=> $input['message']
			);
			$query = $this->db->insert('customer_message',$insert_array);
		}
		
		function upload_image_source($path,$file,$name,$old_file=''){
			$date=date('Y-m-d h:i');
		    $random_id=str_replace(array('-',' ',':'),array('','',''),$date);

		   $target_file   = $path.'/'.$random_id.'_'.$file[$name]['name'];
		   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		   $allowedFile   = array('jpg','png','jpeg','gif');
		   if(in_array($imageFileType, $allowedFile)){
			   	if($old_file!=''){ unlink($path.'/'.$old_file); }
			   		move_uploaded_file($file[$name]['tmp_name'], $target_file);
			   		return $file[$name]['name'];
		   }else{
		   	 return "";
		   }
		}
		function upload_multiple_image_source($path,$file,$name,$old_file=''){
		

		$date=date('Y-m-d h:i');
		$random_id=str_replace(array('-',' ',':'),array('','',''),$date);
		 for ($i = 0; $i <count($file[$name]['name']) ; $i++) {	
		   $target_file   = $path.'/'.$random_id.'_'.$file[$name]['name'][$i];
		   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		   $allowedFile   = array('jpg','png','jpeg','gif');
		   if(in_array($imageFileType, $allowedFile)){
			   	if($old_file!=''){ unlink($path.'/'.$old_file); }
			   		move_uploaded_file($file[$name]['tmp_name'][$i], $target_file);
			   		$pic[]=$random_id.'_'.$file[$name]['name'][$i];
		   }else{
		   	 $pic[]='';
		   }
			}
		  return $pic;
		 }
		
		public function get_destination_list($query){ 
		$this->db->like('city', $query);
		$this->db->where('status', '1');
        $this->db->limit(10);
		return $this->db->get('busdestination');
	}		
		
		
	}
?>
