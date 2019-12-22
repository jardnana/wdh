<?php
class Management_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_api_management_list($domain_product_api_id = ''){		 
		$this->db->select('dpa.*, d.domain_name,a.api_name,a.api_alternative_name,p.product_name');
		$this->db->from('domain_product_api dpa');
		$this->db->join('domain_details d', 'd.domain_details_id = dpa.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = dpa.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = dpa.product_details_id');
		if($domain_product_api_id !='')
			$this->db->where('domain_product_api_id', $domain_product_api_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    public function manage_api($input){
		$this->db->truncate('domain_product_api'); 
		for($d=0;$d<count($input['doamin']);$d++){
			for($p=0;$p<count($input['product']);$p++){
				$insert_api_manage_data = array(
											'domain_details_id' 		=> $input['doamin'][$d],
											'product_details_id' 		=> $input['product'][$p],					
											'api_details_id' 			=> $input['api'],				
											'domain_product_api_status' => "ACTIVE"				
										);			
				$this->db->insert('domain_product_api',$insert_api_manage_data);					
			}
		}
	}
    
	function active_api_management($domain_product_api_id){
		$data = array( 'domain_product_api_status' => 'ACTIVE' );
		$this->db->where('domain_product_api_id', $domain_product_api_id);
		$this->db->update('domain_product_api', $data); 
	}
	
	function inactive_api_management($domain_product_api_id){
		$data = array('domain_product_api_status' => 'INACTIVE');
		$this->db->where('domain_product_api_id', $domain_product_api_id);
		$this->db->update('domain_product_api', $data); 
	}
	
	function delete_api_management($domain_product_api_id){
		$this->db->where('domain_product_api_id', $domain_product_api_id);
		$this->db->delete('domain_product_api'); 
	}


	function get_product_management_list($domain_product_api_id = ''){		 
		$this->db->select('dp.*, d.domain_name,p.product_name');
		$this->db->from('domain_product dp');
		$this->db->join('domain_details d', 'd.domain_details_id = dp.domain_details_id');
		$this->db->join('product_details p', 'p.product_details_id = dp.product_details_id');
		if($domain_product_api_id !='')
			$this->db->where('domain_product_api_id', $domain_product_api_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	public function manage_product($input){
		$this->db->truncate('domain_product'); 
		for($d=0;$d<count($input['doamin']);$d++){
			$insert_product_manage_data = array(
										'domain_details_id' 		=> $input['doamin'][$d],
										'product_details_id' 		=> $input['product'],					
										'domain_product_status' => "ACTIVE"				
									);			
			$this->db->insert('domain_product',$insert_product_manage_data);					
		}
	}

	function active_product_management($domain_product_id){
		$data = array( 'domain_product_status' => 'ACTIVE' );
		$this->db->where('domain_product_id', $domain_product_id);
		$this->db->update('domain_product', $data); 
	}
	
	function inactive_product_management($domain_product_id){
		$data = array('domain_product_status' => 'INACTIVE');
		$this->db->where('domain_product_id', $domain_product_id);
		$this->db->update('domain_product', $data); 
	}
	
	function delete_product_management($domain_product_id){
		$this->db->where('domain_product_id', $domain_product_id);
		$this->db->delete('domain_product'); 
	}

	function get_payment_api_management_list($domain_product_api_id = ''){		 
		$this->db->select('dpa.*, d.domain_name,a.api_name,a.api_alternative_name,p.product_name');
		$this->db->from('domain_product_payment_api dpa');
		$this->db->join('domain_details d', 'd.domain_details_id = dpa.domain_details_id');
		$this->db->join('payment_api_details a', 'a.payment_api_details_id = dpa.payment_api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = dpa.product_details_id');
		if($domain_product_api_id !='')
			$this->db->where('domain_product_api_id', $domain_product_api_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	public function manage_payment_api($input){
		$this->db->truncate('domain_product_payment_api'); 
		for($d=0;$d<count($input['doamin']);$d++){
			for($p=0;$p<count($input['product']);$p++){
				$insert_payment_api_manage_data = array(
											'domain_details_id' 		=> $input['doamin'][$d],
											'product_details_id' 		=> $input['product'][$p],					
											'payment_api_details_id' 	=> $input['payment_api'],				
											'domain_product_api_status' => "ACTIVE"				
										);			
				$this->db->insert('domain_product_payment_api',$insert_payment_api_manage_data);					
			}
		}
	}

	function active_payment_api_management($domain_product_payment_api_id){
		$data = array( 'domain_product_api_status' => 'ACTIVE' );
		$this->db->where('domain_product_payment_api_id', $domain_product_payment_api_id);
		$this->db->update('domain_product_payment_api', $data); 
	}
	
	function inactive_payment_api_management($domain_product_payment_api_id){
		$data = array('domain_product_api_status' => 'INACTIVE');
		$this->db->where('domain_product_payment_api_id', $domain_product_payment_api_id);
		$this->db->update('domain_product_payment_api', $data); 
	}
	
	function delete_payment_api_management($domain_product_payment_api_id){
		$this->db->where('domain_product_payment_api_id', $domain_product_payment_api_id);
		$this->db->delete('domain_product_payment_api'); 
	}

	function get_site_management_list($domain_product_api_id = ''){		 
		// $this->db->select('btd.*, b.block_list_name, d.domain_name,a.api_name,a.api_alternative_name,p.product_name','pa.api_name as payment_api_name,pa.api_alternative_name as payment_api_alternative_name,ut.user_type_name,u.user_name,c.country_name,c.iso3_code');
		$this->db->select('*');
		$this->db->from('block_type_details btd');
		$this->db->join('block_list b', 'b.block_list_id = btd.block_list_id');
		$this->db->join('domain_details d', 'd.domain_details_id = btd.domain_details_id');
		$this->db->join('product_details p', 'p.product_details_id = btd.product_details_id');
		$this->db->join('api_details a', 'a.api_details_id = btd.api_details_id');
		$this->db->join('user_type ut', 'ut.user_type_id = btd.user_type_id');
		$this->db->join('user_details u', 'u.user_details_id = btd.user_details_id');
		$this->db->join('payment_api_details pa', 'pa.payment_api_details_id = btd.payment_api_details_id');
		$this->db->join('country_details c', 'c.country_id = btd.country_id');
		if($domain_product_api_id !='')
			$this->db->where('block_type_details_id', $domain_product_api_id);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    public function site_management($input){
		$this->db->truncate('block_type_details'); 
		for($d=0;$d<count($input['doamin']);$d++){
			for($p=0;$p<count($input['product']);$p++){
				for($a=0;$a<count($input['api']);$a++){
					for($ut=0;$ut<count($input['user_type']);$ut++){
						for($u=0;$u<count($input['users']);$u++){
							for($pa=0;$pa<count($input['paymnet']);$pa++){
								for($c=0;$c<count($input['country']);$c++){
									$insert_api_manage_data = array(
											'block_list_id' 			=> $input['block_list'],
											'domain_details_id' 		=> $input['doamin'][$d],
											'product_details_id' 		=> $input['product'][$p],					
											'api_details_id' 			=> $input['api'][$a],				
											'user_type_id' 				=> $input['user_type'][$a],				
											'user_details_id' 			=> $input['users'][$a],				
											'payment_api_details_id' 	=> $input['paymnet'][$a],				
											'country_id' 				=> $input['country'][$a],				
											'block_type_status'			=> "ACTIVE"				
										);			
									$this->db->insert('block_type_details',$insert_api_manage_data);									
								}								
							}								
						}								
					}								
				}
			}
		}
	}

	function active_site_management($block_type_details_id){
		$data = array( 'block_type_status' => 'ACTIVE' );
		$this->db->where('block_type_details_id', $block_type_details_id);
		$this->db->update('block_type_details', $data); 
	}
	
	function inactive_site_management($block_type_details_id){
		$data = array('block_type_status' => 'INACTIVE');
		$this->db->where('block_type_details_id', $block_type_details_id);
		$this->db->update('block_type_details', $data); 
	}
	
	function delete_site_management($block_type_details_id){
		$this->db->where('block_type_details_id', $block_type_details_id);
		$this->db->delete('block_type_details'); 
	}
	
	function get_social_links_list($linkid=''){
		$this->db->select('*');
		$this->db->from('social_links');
		if($linkid !=''){
			$this->db->where('social_links_id', $linkid);
		}
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function update_social_link($update,$linkid){
		$update_data = array(
							'link_in_english' 		=> $update['link_english'],
							'link_in_polish' 		=> $update['link_polish']			
						);			
		$this->db->where('social_links_id', $linkid);
		$this->db->update('social_links', $update_data);
	}
	
	function active_social_link($linkid){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('social_links_id', $linkid);
		$this->db->update('social_links', $data); 
	}
	
	function inactive_social_link($linkid){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('social_links_id', $linkid);
		$this->db->update('social_links', $data); 
	}
	
}
?>
