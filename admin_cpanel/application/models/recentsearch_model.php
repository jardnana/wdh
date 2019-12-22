<?php
class Recentsearch_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function recentsearch_list($id = ''){
		$this->db->select('*');
		$this->db->from('search_parameter_details');
		if($id !='')
			$this->db->where('search_parameter_details_id', $id);
		$this->db->order_by('search_parameter_details_id','DESC');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	

	function active_recentsearch($id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('search_parameter_details_id', $id);
		$this->db->update('search_parameter_details', $data); 
	}
	
	function inactive_recentsearch($id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('search_parameter_details_id', $id);
		$this->db->update('search_parameter_details', $data); 
	}
	
	function delete_recentsearch($id){
		$this->db->where('search_parameter_details_id', $id);
		$this->db->delete('search_parameter_details'); 
	}
	

}
?>
