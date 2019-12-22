<?php

class Searchmodule_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_search_module_list($id = '') {
        $this->db->select('*');
        $this->db->from('search_module');
        if ($id != '')
            $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function add_module_details($input) {
        if (!isset($input['status']))
            $input['status'] = "INACTIVE";
        $insert_data = array(
            'module_name' => $input['module_name'],
            'module_icon' => $input['module_icon'],
            'module_id' => $input['module_id'],
            'position' => $input['position'],
            'status' => $input['status'],
            'date_created' => (date('Y-m-d H:i:s'))
        );
        $this->db->insert('search_module', $insert_data);
    }

    function active_module($id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('id', $id);
        $this->db->update('search_module', $data);
    }

    function inactive_module($id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('id', $id);
        $this->db->update('search_module', $data);
    }

    function delete_module($id) {
        $this->db->where('id', $id);
        $this->db->delete('search_module');
    }

    function update_module_details($update, $id) {
        if (!isset($update['status']))
            $update['status'] = "INACTIVE";
        $update_data = array(
            'module_name' => $update['module_name'],
            'module_icon' => $update['module_icon'],
            'position' => $update['position'],
            'status' => $update['status']
        );
        $this->db->where('id', $id);
        $this->db->update('search_module', $update_data);
    }
}

?>
