<?php
class Currency_Model extends CI_Model {
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = 'aeb28412707b836f2fd98e6e7ddb2a6057b4fcd3099811a94d1b88bed742f45b';
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function add_currency_details($input){
		$arrayval = array(
						'currency_code' => $input['currency_code'],
						'country_code'	=> $input['currency_symbol'],
						'currency_name'	=> $input['currency_name'],
						'value'			=> $input['currency_value'],
						'date_time'		=> (date('Y-m-d H:i:s'))	
					); 
		$this->db->insert('currency_converter_usd', $arrayval);
	}
	
	public function update_currency_details($id, $update){
		$this->db->where('cur_id', $id);
		$this->db->update('currency_converter_usd', $update);
	}
	
	public function delete_currency_details($id){
		$this->db->where('cur_id', $id);
		$this->db->delete('currency_converter_usd');
	}
	
	function get_currency_api_details_byname($api_name){
		$this->db->select('*')->from('currency_api_details');
		$this->db->where('api_name', $api_name);
		$this->db->where('api_status', 'ACTIVE');
		$this->db->order_by('position', 'ASC');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
    
}
?>
