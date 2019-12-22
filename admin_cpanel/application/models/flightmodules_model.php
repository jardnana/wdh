<?php
class Flightmodules_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function flightmodules_list($id = ''){
		$this->db->select('*');
		$this->db->from('flight_module_details');
		if($id !='')
			$this->db->where('flight_module_details_id', $id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	

	function active_flightmodules($id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('flight_module_details_id', $id);
		$this->db->update('flight_module_details', $data); 
	}
	
	function inactive_flightmodules($id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('flight_module_details_id', $id);
		$this->db->update('flight_module_details', $data); 
	}
	
	 function get_flightmodulues_details($id = ''){
		$this->db->select('*');
        $this->db->from('flight_module_details');
        if($id!=''){
			$this->db->where('flight_module_details_id',$id);
		}
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
	function update_flightmodulues_details($update,$id){
		if(isset($update['status'])){
			$update['status'] ='ACTIVE';
		}else{
			$update['status'] ='INACTIVE';
		}
		$update_data = array(
							'flight_module_name' 	=> $update['flight_module_name'],
							'position' 	=> $update['position'],
							'status' 	=> $update['status']					
						);				
					//echo"<pre/>";print_r($update_data); exit;
		$this->db->where('flight_module_details_id', $id);
		$this->db->update('flight_module_details', $update_data);
	}
	
	function delete_flightmodules($id){
		$this->db->where('flight_module_details_id', $id);
		$this->db->delete('flight_module_details'); 
	}
	

}
?>
