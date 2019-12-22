<?php
class Flightdeals_Model extends CI_Model {
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = 'aeb28412707b836f2fd98e6e7ddb2a6057b4fcd3099811a94d1b88bed742f45b';
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_flightdeals_categories($category_id = ''){
		$this->db->select('*');
        $this->db->from('flight_deals_category');
        if($category_id!=''){
			$this->db->where('flight_deals_category_id',$category_id);
		}
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
							'relation_name' 	=> $input['table_name'],
							'category_status' 		=> $input['status'],
							'creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('flight_deals_category',$insert_data);
	}
	
	function active_category($category_id){
		$data = array(
					'category_status' => 'ACTIVE'
					);
		$this->db->where('flight_deals_category_id', $category_id);
		$this->db->update('flight_deals_category', $data); 
	}
	function inactive_category($category_id){
		$data = array(
					'category_status' => 'INACTIVE'
					);
		$this->db->where('flight_deals_category_id', $category_id);
		$this->db->update('flight_deals_category', $data); 
	}
	function delete_category($category_id){
		$this->db->where('flight_deals_category_id', $category_id);
		$this->db->delete('flight_deals_category'); 
	}
    function update_category($update,$category_id){
		if(!isset($update['status'])){
			$update['status'] ='INACTIVE';
		}
		$update_data = array(
							'category_name' 	=> $update['category_name'],
							'category_status' 	=> $update['status']					
						);				
					//echo"<pre/>";print_r($update_data); exit;
		$this->db->where('flight_deals_category_id', $category_id);
		$this->db->update('flight_deals_category', $update_data);
	}
	
	function get_deals_list($id=''){
		$this->db->select('*');
        $this->db->from('flight_deals');
        if($id!='')
        $this->db->where('flight_deals_id',$id);
        
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
		function get_deals_list_from_table($id){
		$this->db->select('*');
        $this->db->from('flight_deals');
        $this->db->where('flight_deals_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
	
	function get_cities(){
		$this->db->select('*');
        $this->db->from('flight_airport_list');
        $this->db->order_by('airport_city','asc');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
	
	function add_deal($input, $image_name){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$date_range[0] = $date_range[1] = '';
		if(isset($input['date_range']) && $input['date_range']!='')
			$date_range = explode("-",$input['date_range']);
		$insert_data = array(
							'link' 				=> $image_name,
							'price' 			=> $input['price_offer'],
							'departure_date' 	=> $date_range[0],
							'return_date'		=> $date_range[1],					
							'from_city'			=> $input['from_city'],					
							'to_city'			=> $input['to_city'],					
							'adult'				=> $input['adult'],					
							'child'				=> $input['child'],					
							'infant'			=> $input['infant'],					
							'airline'			=> $input['airline'],					
							//'deal_category'			=> $category_id,					
							'status'			=> $input['status'],					
							//'deal_created_on'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('flight_deals',$insert_data);
	}
	
	function inactive_deal($id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('flight_deals_id', $id);
		$this->db->update('flight_deals', $data); 
	}
	function active_deal($id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('flight_deals_id', $id);
		$this->db->update('flight_deals', $data); 
	}
	function update_deal($update, $id, $image_name){
		if(!isset($update['deal_status']))
			$update['deal_status'] = "INACTIVE";
		$date_range[0] = $date_range[1] = '';
		if(isset($update['date_range']) && $update['date_range']!='')
			$date_range = explode("-",$update['date_range']);
		$update_data = array(
							'link' 			=> $image_name,
							'price' 		=> $update['price_offer'],
							'departure_date'=> $date_range[0],
							'return_date'	=> $date_range[1],					
							'from_city'		=> $update['from_city'],					
							'to_city'		=> $update['to_city'],		
							'adult'			=> $update['adult'],					
							'child'			=> $update['child'],					
							'infant'		=> $update['infant'],
							'airline'		=> $update['airline'],				
							'status'		=> $update['deal_status'],					
						);			
		$this->db->where('flight_deals_id', $id);
		$this->db->update('flight_deals', $update_data);
	}
	
	function delete_deal($id){
		$this->db->where('flight_deals_id', $id);
		$this->db->delete('flight_deals'); 
	}
	
	public function get_airport_list($query){
		$raw_search_chars = '"'.$query.'"';
		$sql = 'select * from flight_airport_list where airport_code != "" 
				and airport_name != "" and airport_code like "%'.$query.'%" OR  airport_name like "%'.$query.'%" OR  country like "%'.$query.'%" OR  airport_city like "%'.$query.'%" ORDER BY 
				CASE 
					WHEN	airport_name	LIKE	'.$raw_search_chars.'	THEN 1
					WHEN	airport_code	LIKE	'.$raw_search_chars.'	THEN 2
					WHEN	country			LIKE	'.$raw_search_chars.'	THEN 3
					
					WHEN	country			LIKE	'.$raw_search_chars.'	THEN 4
					WHEN	airport_code	LIKE	'.$raw_search_chars.'	THEN 5
					WHEN	airport_name	LIKE	'.$raw_search_chars.'	THEN 6
					
					WHEN	country			LIKE	'.$raw_search_chars.'	THEN 7
					WHEN	airport_code	LIKE	'.$raw_search_chars.'	THEN 8
					WHEN	airport_city	LIKE	'.$raw_search_chars.'	THEN 9
				ELSE 10 END
				LIMIT 0, 10';		
		return $result_flights = $this->db->query($sql);
	}
}
?>
