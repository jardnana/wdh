<?php

class Banner_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_banner_list($banner_id = '') {
        $this->db->select('*');
        $this->db->from('banner_details');
        if ($banner_id != '')
            $this->db->where('banner_details_id', $banner_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function add_banner_details($input, $banner_logo_name) {
        if (!isset($input['status']))
            $input['status'] = "INACTIVE";
        $insert_data = array(
            'title' => $input['title'],
            'banner_type' => $input['banner_type'],
            'banner_image' => $banner_logo_name,
            'img_alt_text' => $input['img_alt_text'],
            'link' => $input['link'],
            'position' => $input['position'],
           // 'banner_caption' => $input['slogan_english'],
          //  'caption_description' => $input['slogandesc_english'],
            'status' => $input['status'],
            'creation_date' => (date('Y-m-d H:i:s'))
        );
        $this->db->insert('banner_details', $insert_data);
    }

    function active_banner($banner_id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('banner_details_id', $banner_id);
        $this->db->update('banner_details', $data);
    }

    function inactive_banner($banner_id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('banner_details_id', $banner_id);
        $this->db->update('banner_details', $data);
    }

    function delete_banner($banner_id) {
        $this->db->where('banner_details_id', $banner_id);
        $this->db->delete('banner_details');
    }

    function update_banner($update, $banner_id, $banner_logo_name) {
        if (!isset($update['status']))
            $update['status'] = "INACTIVE";
        $update_data = array(
            'title' => $update['title'],
            'banner_type' => $update['banner_type'],
            'banner_image' => $banner_logo_name,
            'img_alt_text' => $update['img_alt_text'],
            'link' => $update['link'],
           'position' => $update['position'],
          //  'banner_caption' => $update['slogan_english'],
          //  'caption_description' => $update['slogandesc_english'],
            'status' => $update['status']
        );
        $this->db->where('banner_details_id', $banner_id);
        $this->db->update('banner_details', $update_data);
        
    }

}

?>
