<?php
class Cms_Model extends CI_Model {
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = 'aeb28412707b836f2fd98e6e7ddb2a6057b4fcd3099811a94d1b88bed742f45b';
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_home_page_categories(){
		$this->db->select('*');
        $this->db->from('home_page_categories');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
	
	function add_category_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'category_name' 		=> $input['category_name'],
							'related_table_name' 	=> $input['table_name'],
							'category_status' 		=> $input['status'],
							'category_created_on'	=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('home_page_categories',$insert_data);
	}
	
	function active_category($category_id){
		$data = array(
					'category_status' => 'ACTIVE'
					);
		$this->db->where('home_page_category_id', $category_id);
		$this->db->update('home_page_categories', $data); 
	}
	function inactive_category($category_id){
		$data = array(
					'category_status' => 'INACTIVE'
					);
		$this->db->where('home_page_category_id', $category_id);
		$this->db->update('home_page_categories', $data); 
	}
	function delete_category($category_id){
		$this->db->where('home_page_category_id', $category_id);
		$this->db->delete('home_page_categories'); 
	}
    function update_category($update,$category_id){
		$update_data = array(
							'category_name' 	=> $update['category_name'],
							'category_status' 	=> $update['status']					
						);				
		$this->db->where('home_page_category_id', $category_id);
		$this->db->update('home_page_categories', $update_data);
	}
}
?>
