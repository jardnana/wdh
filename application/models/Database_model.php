<?php
	class Database_model extends CI_Model {
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		function get_mysql_results($results){
			if($results->num_rows() ==''){
				return '';
			}else{
				return $results->result();
			}
		}
		
		function get_mysql_results_array($results){
			if($results->num_rows() ==''){
				return '';
			}else{
				return $results->result_array();
			}
		}
		
		function get_mysql_results_with_status($results){
			if($results->num_rows() ==''){
				$data['status']	=	BOOLEAN_FALSE;
				$data['result']	=	'Empty data';
				return $data;
			}else{
				$data['status']	=	BOOLEAN_TRUE;
				$data['result']	=	$results->result();
				return $data;		
			}
		}
		
		function get_mysql_row($results){
			if($results->num_rows() ==''){
				return '';
			}else{
				return $results->row();
			}
		}
		
		function insert_batch($table,$insert_data){
			$query = $this->db->insert_batch($table,$insert_data);
			// $this->Database_model->check_sql_error($query);		
		}
		
		function get_mysql_row_with_status($results){
			if($results->num_rows() ==''){
				$data['status']	=	BOOLEAN_FALSE;
				$data['result']	=	'Empty data';
				return $data;
			}else{
				$data['status']	=	BOOLEAN_TRUE;
				$data['result']	=	$results->row();
				return $data;		
			}
		}
		
		function get_mysql_filed($results,$field_name){
			if($results->num_rows() ==''){
				return '';
			}else{
				$row 	= $results->row();
				return $row->$field_name;
			}
		}
		
		function special_char_escape($value){
			// return ($value);
			return $value;
		}
		
		function escape_string($value){
			// return mysql_real_escape_string($value);
			return ($value);
		}
		
		function check_unique_credit_card($table,$card_number,$where_condition = ''){
			$check_card = "SELECT * FROM $table WHERE card_number  = AES_ENCRYPT('$card_number','".SECURITY_KEY."')".$where_condition;
			$query = $this->db->query($check_card);		
			if($query->num_rows() ==''){
				return true;
			}else{
				return false;
			}
		}
		
		function check_unique_credit_card_details($table,$card_number,$where_condition = ''){
			$check_card = "SELECT * FROM $table WHERE card_number  = AES_ENCRYPT('$card_number','".SECURITY_KEY."')".$where_condition;
			$query = $this->db->query($check_card);		
			if($query->num_rows() ==''){
				$data['row'] 	= $query->row(); 
				$data['status'] = true;
				return $data;
			}else{
				$data['row'] 	= '' ;
				$data['status'] = false;
				return $data;
			}
		}
		
		function execute_procedure_query($procedure_name){
			$results = $this->db->query("CALL ".$procedure_name);
			if($results->num_rows == ''){
				return '';
			}else{
				return $results->result();
			}
		}
		
		function check_sql_error($results){
			// $_error_number  = $this->db->_error_number();
			// $_error_message = $this->db->_error_message();
			// if($_error_number > 0 ){
				// $this->Database_model->insert_sql_error_log($_error_number,$_error_message,'ADMIN');
				// redirect('error/sql_error/'.base64_encode(json_encode($_error_number)),'refresh');
			// }else{
				// return true;
			// }
			return true;
		}
		
		function insert_sql_error_log($error_number,$error_message, $user_type){
			$log_data['sql_error_code'] 		= $error_number;
			$log_data['sql_error_message'] 		= $error_message;
			$log_data['ip_address'] 			= $_SERVER['REMOTE_ADDR'];
			$log_data['system_browser_info'] 	= $_SERVER['HTTP_USER_AGENT'];
			$log_data['system_info'] 			= $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT'];
			// $log_data['created_date'] 			= date('Y-m-d H:i:s');
			$log_data['user_type'] 				= 'ADMIN';
			$log_data['user_id'] 				= $this->session->userdata('sa_id');;
			$this->db->insert('sql_error_logs',$log_data);
		}
		
		function begin_transaction(){
			$this->db->trans_begin();
		}
		
		function commit_transaction(){
			$this->db->trans_commit();
		}
		
		function rollback_transaction(){
			$this->db->trans_rollback();
		}
	}
?>
