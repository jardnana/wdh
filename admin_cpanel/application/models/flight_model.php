<?php
class Flight_Model extends CI_Model {
	function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->library('xml_to_array');
    }
    
    
    function view_all_flights(){       
        $this->db->select('*');
        $this->db->from('flight_crs');
        if ($this->session->userdata('lgm_supplier_admin_logged_in') == 'Logged_In'){
            $this->db->where('added_by',$this->session->userdata('lgm_supplier_admin_id'));
            $this->db->where('added_by_type','Supplier');
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;   
        }  
    }

    function view_all_flights_supplier($supplier_id){
        $this->db->select('*');
        $this->db->from('flight_crs');
        $this->db->where('added_by',$supplier_id);
        $this->db->where('added_by_type','Supplier');

        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;   
        }  
    }

    function delete_flight($flight_id){
        $this->db->where('flight_id', $flight_id);
        $this->db->delete('flight_crs'); 
        $this->db->where('flight_id', $flight_id);
        $this->db->delete('flight_segments'); 
        $this->db->where('flight_id', $flight_id);
        $this->db->delete('flight_price_details'); 
      
    }

    function update_flight_status($flight_id,$status){
        if($status == 0) {
            $update_data = array(
                'status' => 'INACTIVE'
            );
            $this->db->where('flight_id', $flight_id);
            $this->db->update('flight_crs', $update_data);
        } else {
            $update_data = array(
                'status' => 'ACTIVE'
            );
            $this->db->where('flight_id', $flight_id);
            $this->db->update('flight_crs', $update_data);
        }
       
    }

    function get_flight_list($flight_id = ''){
        $this->db->select('*');
        $this->db->from('flight_crs');
        if($flight_id !='')
            $this->db->where('flight_id', $flight_id);
            $query=$this->db->get();
        if($query->num_rows() =='') {
            return '';
        } else {
            return $query->result();
        }
    }

    function update_flight_info($data,$flight_id){
        $this->db->where('flight_id', $flight_id);
        $query = $this->db->update('flight_crs',$data,$where);
        if($query) {
            $flg=true;
        } else {
            $flg=false;
        }
        return $flg;
    }

    public function get_airport_list_old($query){
		$this->db->like('airport_city', $query); 
		$this->db->or_like('airport_name', $query);
		$this->db->or_like('airport_code', $query); 
		$this->db->or_like('country', $query);
		$this->db->where('city_status', 'ACTIVE');
        $this->db->limit(10);
		return $this->db->get('flight_airport_list');
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

    function add_flight_info($flight_data){
        if ($this->session->userdata('lgm_supplier_admin_logged_in') == 'Logged_In') {
            $flight_data['added_by'] = $this->session->userdata('lgm_supplier_admin_id');
            $flight_data['added_by_type'] = "Supplier";
        } else {
            $flight_data['added_by'] = $this->session->userdata('provab_admin_id');
            $flight_data['added_by_type'] = "Admin";
        }
            $this->db->insert('flight_crs',$flight_data);
        }

    function get_flight_segments($flight_id,$trip_type){
          // print_r($flight_id);
          // print_r($trip_type);exit();
        $this->db->select('*');
        $this->db->from('flight_segments');
        $this->db->where('flight_id',$flight_id);
        $this->db->where('journey_type',$trip_type);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;   
        }
    }

    function add_flight_segment_info($flight_data,$flight_segment_data,$flight_id){
        $result = $this->db->insert('flight_segments',$flight_segment_data);
        $this->db->where('flight_id', $flight_id);
        $query = $this->db->update('flight_crs',$flight_data,$where);
    }

    function update_flight_segment_status($flight_segments_id,$status){
        if($status == 0){
            $update_data = array(
                'status' => 'INACTIVE'
            );
            $this->db->where('flight_segments_id', $flight_segments_id);
            $this->db->update('flight_segments', $update_data);
        } else {
            $update_data = array(
                'status' => 'ACTIVE'
            );
            $this->db->where('flight_segments_id', $flight_segments_id);
            $this->db->update('flight_segments', $update_data);
        }
       
    }

    function delete_flight_segment($flight_segments_id){
        $this->db->where('flight_segments_id', $flight_segments_id);
        $this->db->delete('flight_segments'); 
      
    }
    
    function delete_flight_segments($flight_id,$trip_type){
        $this->db->where('flight_id',$flight_id);
        $this->db->where('journey_type',$trip_type);
        $this->db->delete('flight_segments'); 
    }

    function get_flight_segments_by_id($flight_segments_id){          
        $this->db->select('fs.*,f.o_departure_time,f.o_arrival_time,f.r_departure_time,f.r_arrival_time,f.max_stop,f.connection_location');
        $this->db->from('flight_segments fs');
        $this->db->join('flight_crs f', 'f.flight_crs_id = fs.flight_crs_id');
        $this->db->where('fs.flight_segments_id',$flight_segments_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;   
        }
    }

    function update_flight_segment_info($flight_segment_data,$flight_data,$flight_segments_id,$flight_crs_id){
        $this->db->where('flight_segments_id', $flight_segments_id);
        $query1 = $this->db->update('flight_segments',$flight_segment_data);
        $this->db->where('flight_crs_id', $flight_crs_id);
        $query = $this->db->update('flight_crs',$flight_data);
        if($query && $query1){
            $flg=true;
        } else {
            $flg=false;
        }
        return $flg;
        
    }

    function add_flight_pricing_data($flight_pricing){
            $this->db->insert('flight_price_details',$flight_pricing);
    }

    function get_flight_pricing($flight_id,$flight_crs_id){       
        $this->db->select('*');
        $this->db->from('flight_price_details f');
        $this->db->where('flight_id',$flight_id);
        $this->db->where('flight_crs_id',$flight_crs_id);
        $this->db->join('seasons_details s', 's.seasons_details_id = f.seasons_details_id','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;   
        }
    }

    function update_flight_price_status($flight_price_details_id,$status){
      //  print_r($flight_price_details_id);exit();
        if($status == 0){
            $update_data = array(
                'status' => 'INACTIVE'
            );
            $this->db->where('flight_price_details_id', $flight_price_details_id);
            $this->db->update('flight_price_details', $update_data);
        } else {
            $update_data = array(
                'status' => 'ACTIVE'
            );
            $this->db->where('flight_price_details_id', $flight_price_details_id);
            $this->db->update('flight_price_details', $update_data);
        }
       
    }

    function delete_flight_pricing_details($flight_id,$flight_crs_id){
        $this->db->where('flight_id',$flight_id);
        $this->db->where('flight_crs_id',$flight_crs_id);
        $this->db->delete('flight_price_details'); 
    }

    function delete_flight_price($flight_price_details_id){
        $this->db->where('flight_price_details_id', $flight_price_details_id);
        $this->db->delete('flight_price_details'); 
    }

    function get_flight_price_id($flight_price_details_id) {
        $this->db->select('*');
        $this->db->from('flight_price_details');
        $this->db->where('flight_price_details_id',$flight_price_details_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;   
        }
    }

    function update_flight_pricing_data($flight_price_details_id,$flight_pricing) {
        $this->db->where('flight_price_details_id',$flight_price_details_id);
        $query = $this->db->update('flight_price_details',$flight_pricing,$where);
        if($query) {
            $flg=true;
        } else {
            $flg=false;
        }
        return $flg;
    }
	
	function get_api_credentials(){
		$this->db->where('api_name', 'Sabre');
		$this->db->where('api_status', 'ACTIVE');
		$query = $this->db->get('api_details');
		if($query->num_rows() != 0 ){
			return $query->row();
		}else{
			return '';
		}
	}
    
}
?>
