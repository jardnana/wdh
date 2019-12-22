<?php
class Markup_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }   
	
	function get_markup_list($markup_details_id = ''){		 
		$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		// $this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,p.product_name,ut.user_type_name');
		$this->db->from('markup_details m');
		$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		$this->db->join('airline_details ad', 'ad.airline_details_id = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	public function add_markup($input){

		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		for($ut=0;$ut<count($input['user_type']);$ut++){
			//echo"<pre/>"; print_r($input);
			for($d=0;$d<count($input['domain']);$d++){
				for($p=0;$p<count($input['product']);$p++){
					for($a=0;$a<count($input['api']);$a++){
						for($mt=0;$mt<count($input['markup_type']);$mt++){
						//	for($c=0;$c<count($input['country']);$c++){
							//	for($ad=0;$ad<count($input['airline']);$ad++){
											//echo"<pre/>"; print_r($input);exit;
									$insert_markup_data = array(
											'user_type_id' 				=> $input['user_type'][$ut],
											'domain_details_id' 		=> $input['domain'][$d],
											'product_details_id' 		=> $input['product'][$p],					
											'api_details_id' 			=> $input['api'][$a],			
											'markup_type' 				=> $input['markup_type'][$mt],		
											'country_id' 				=> $input['country'],				
											'airline_details_id' 		=> $input['airline'],													
											'journey_type' 				=> $input['journey_type'],													
											'markup_value' 				=> $input['markup_value'],													
											'markup_fixed' 				=> $input['markup_fixed'],													
											'status'			        => "ACTIVE",				
											'added_by'			        => $this->session->userdata('provab_admin_id'),			
											'creation_date'			    => date('Y-m-d H:i:s')				
										);	
									// echo '<pre/>';print_r($input);print_r($insert_markup_data);exit;
									$this->db->insert('markup_details',$insert_markup_data);									
							//	}								
							//}							
						}								
					}								
				}
			}
		}
	}
	
	public function update_markup($input,$markup_id){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$update_data = array(
								'user_type_id' 				=> $input['user_type'],
								'domain_details_id' 		=> $input['domain'],
								'product_details_id' 		=> $input['product'],					
								'api_details_id' 			=> $input['api'],			
								'markup_type' 				=> $input['markup_type'],		
								'country_id' 				=> $input['country'],				
								'airline_details_id' 		=> $input['airline'],		
								'journey_type' 				=> $input['journey_type'],																								
								'markup_value' 				=> $input['markup_value'],													
								'markup_fixed' 				=> $input['markup_fixed'],													
								'status'			        => "ACTIVE",
								'modified_by'			    => $this->session->userdata('provab_admin_id'),			
								'updation_date'			    => date('Y-m-d H:i:s')				
							);	
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('markup_details', $update_data);
	}
	function active_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('markup_details', $data); 
	}
	
	function inactive_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('markup_details', $data); 
	}
	
	function delete_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('markup_details'); 
	}
}
?>
