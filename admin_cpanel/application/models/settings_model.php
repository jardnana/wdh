<?php
class Settings_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_settings_list($settings_id = ''){
		$this->db->select('*');
		$this->db->from('general_settings');
		if($settings_id !='')
			$this->db->where('general_settings_id', $settings_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function update_settings_details($input){		
		$this->db->truncate('general_settings'); 
		$insert_data = array(
							'site_title' 					=> $input['site_title'],
							'tag_line' 						=> $input['tag_line'],
							'site_url' 						=> $input['site_url'],
							'email_address' 				=> $input['email_address'],
							'contact_number' 				=> $input['contact_number'],
							'contact_address' 				=> $input['contact_address'],
						);			
		$this->db->insert('general_settings',$insert_data);
	}
}
?>
