<?php

class advertisement_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_advertisement_list($advertisement_id = '') {
        $this->db->select('*');
        $this->db->from('advertisement_details');
        if ($advertisement_id != '')
            $this->db->where('advertisement_details_id', $advertisement_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function add_advertisement_details($input, $advertisement_left_image_name,$advertisement_right_image_name) {
        if (!isset($input['status']))
            $input['status'] = "INACTIVE";
        $insert_data = array(
            'title' => $input['title'],
            'advertisement_type' => $input['advertisement_type'],
            'advertisement_left_image_name' => $advertisement_left_image_name,
            'advertisement_right_image_name' => $advertisement_right_image_name,
            'adv_details' => $input['description1'],
            'img_alt_text' => $input['img_alt_text'],
            'link' => $input['link'],
            'position' => $input['position'],
           // 'advertisement_caption' => $input['slogan_english'],
          //  'caption_description' => $input['slogandesc_english'],
            'status' => $input['status'],
            'creation_date' => (date('Y-m-d H:i:s'))
        );
    //    print_r($insert_data);ecxit();
        $this->db->insert('advertisement_details', $insert_data);
    }

    function active_advertisement($advertisement_id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('advertisement_details_id', $advertisement_id);
        $this->db->update('advertisement_details', $data);
    }

    function inactive_advertisement($advertisement_id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('advertisement_details_id', $advertisement_id);
        $this->db->update('advertisement_details', $data);
    }

    function delete_advertisement($advertisement_id) {
        $this->db->where('advertisement_details_id', $advertisement_id);
        $this->db->delete('advertisement_details');
    }

    function update_advertisement($update, $advertisement_id, $advertisement_left_image_name,$advertisement_right_image_name) {
        if (!isset($update['status']))
            $update['status'] = "INACTIVE";
        $update_data = array(
            'title' => $update['title'],
            'advertisement_type' => $update['advertisement_type'],
            'advertisement_left_image_name' => $advertisement_left_image_name,
            'advertisement_right_image_name' => $advertisement_right_image_name,
            'adv_details' => $update['description1'],
            'img_alt_text' => $update['img_alt_text'],
            'link' => $update['link'],
           'position' => $update['position'],
          //  'advertisement_caption' => $update['slogan_english'],
          //  'caption_description' => $update['slogandesc_english'],
            'status' => $update['status']
        );
        $this->db->where('advertisement_details_id', $advertisement_id);
        $this->db->update('advertisement_details', $update_data);
        
    }

}

?>
