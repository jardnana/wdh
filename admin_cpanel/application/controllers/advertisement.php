<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

// error_reporting(0)
class Advertisement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('General_Model');
        $this->load->model('Advertisement_Model');
        $this->check_admin_login();
    }

    private function check_admin_login() {
        if ($this->session->userdata('provab_admin_logged_in') == "") {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('provab_admin_logged_in') == "Logged_In") {
            // redirect('dashboard','refresh');
        } else if ($this->session->userdata('provab_admin_logged_in') == "Lock_Screen") {
            redirect('login/lock_screen', 'refresh');
        }
    }

    function advertisement_list() {
        $advertisement = $this->General_Model->get_home_page_settings();
        $advertisement['advertisement_list'] = $this->Advertisement_Model->get_advertisement_list();
      //  print_r($advertisement);exit();
        $this->load->view('advertisement/advertisement_list', $advertisement);
    }

    function add_advertisement() {
        if (count($_POST) > 0) {
            $advertisement_left_image = '';
            $advertisement_right_image = '';
            $this->form_validation->set_rules('title', 'advertisement Name', 'required');
			$this->form_validation->set_rules('img_alt_text', 'advertisement Image Alternate Text', 'required');
		//	$this->form_validation->set_rules('link', 'advertisement URL', 'required');
			$this->form_validation->set_rules('position', 'advertisement Position', 'required');
		//	$this->form_validation->set_rules('slogan_english', 'advertisement Slogan English', 'required');
		//	$this->form_validation->set_rules('slogandesc_english', 'advertisement Slogan Description English', 'required');
			if ($this->form_validation->run() == TRUE){
				if (!empty($_FILES['advertisement_left_image']['name'])) {
					if (is_uploaded_file($_FILES['advertisement_left_image']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['advertisement_left_image']['tmp_name'];
						$filename = $_FILES['advertisement_left_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name = time() . $_FILES['advertisement_left_image']['name'];
							$targetPath = "uploads/advertisement/" . $img_Name;
							if (move_uploaded_file($sourcePath, $targetPath)) {
								$advertisement_left_image_name = $img_Name;
							}
						}
					}
				}
				if (!empty($_FILES['advertisement_right_image']['name'])) {
					if (is_uploaded_file($_FILES['advertisement_right_image']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['advertisement_right_image']['tmp_name'];
						$filename = $_FILES['advertisement_right_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name = time() . $_FILES['advertisement_right_image']['name'];
							$targetPath = "uploads/advertisement/" . $img_Name;
							if (move_uploaded_file($sourcePath, $targetPath)) {
								$advertisement_right_image_name = $img_Name;
							}
						}
					}
				}
				$this->Advertisement_Model->add_advertisement_details($_POST, $advertisement_left_image_name,$advertisement_right_image_name);
				redirect('advertisement/advertisement_list', 'refresh');
			} else {
				$advertisement = $this->General_Model->get_home_page_settings();
				$this->load->view('advertisement/add_advertisement', $advertisement);
			}
        } else {
            $advertisement = $this->General_Model->get_home_page_settings();
            $this->load->view('advertisement/add_advertisement', $advertisement);
        }
    }

    function active_advertisement($advertisement_id) {
		$advertisement_id = json_decode(base64_decode($advertisement_id));
		if($advertisement_id != ''){
			$this->Advertisement_Model->active_advertisement($advertisement_id);
		}
        redirect('advertisement/advertisement_list', 'refresh');
    }

    function inactive_advertisement($advertisement_id) {
		$advertisement_id = json_decode(base64_decode($advertisement_id));
		if($advertisement_id != ''){
			$this->Advertisement_Model->inactive_advertisement($advertisement_id);
		}
        redirect('advertisement/advertisement_list', 'refresh');
    }

    function delete_advertisement($advertisement_id) {
		$advertisement_id = json_decode(base64_decode($advertisement_id));
		if($advertisement_id != ''){
			$this->Advertisement_Model->delete_advertisement($advertisement_id);
		}
        redirect('advertisement/advertisement_list', 'refresh');
    }

    function edit_advertisement($advertisement_id) {
		$advertisement_id = json_decode(base64_decode($advertisement_id));
		if($advertisement_id != ''){
			$advertisement = $this->General_Model->get_home_page_settings();
			$advertisement['advertisement_list'] = $this->Advertisement_Model->get_advertisement_list($advertisement_id);
			$this->load->view('advertisement/edit_advertisement', $advertisement);
		} else {
			redirect('advertisement/advertisement_list', 'refresh');
		}
    }

    function update_advertisement($advertisement_id) {
		//echo"<pre/>";print_r($_POST); exit;
        if (count($_POST) > 0) {
			$advertisement_id = json_decode(base64_decode($advertisement_id));
			if($advertisement_id != ''){
				$advertisement_left_image_name = $_REQUEST['advertisement_left_image_old'];
				$advertisement_right_image_name = $_REQUEST['advertisement_right_image_old'];
				$this->form_validation->set_rules('title', 'advertisement Name', 'required');
				$this->form_validation->set_rules('img_alt_text', 'advertisement Image Alternate Text', 'required');
				//$this->form_validation->set_rules('link', 'advertisement URL', 'required');
				$this->form_validation->set_rules('position', 'advertisement Position', 'required');
			//	$this->form_validation->set_rules('slogan_english', 'advertisement Slogan English', 'required');
			//	$this->form_validation->set_rules('slogandesc_english', 'advertisement Slogan Description English', 'required');
				if ($this->form_validation->run() == TRUE){
					if (!empty($_FILES['advertisement_left_image']['name'])) {
						if (is_uploaded_file($_FILES['advertisement_left_image']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/advertisement/" . $advertisement_left_image;
							unlink($oldImage);
							$sourcePath = $_FILES['advertisement_left_image']['tmp_name'];
							$filename = $_FILES['advertisement_left_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['advertisement_left_image']['name'];
								$targetPath = "uploads/advertisement/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$advertisement_left_image_name = $img_Name;
								}
							}
						}
					}
					if (!empty($_FILES['advertisement_right_image']['name'])) {
						if (is_uploaded_file($_FILES['advertisement_right_image']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/advertisement/" . $advertisement_right_image;
							unlink($oldImage);
							$sourcePath = $_FILES['advertisement_right_image']['tmp_name'];
							$filename = $_FILES['advertisement_right_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['advertisement_right_image']['name'];
								$targetPath = "uploads/advertisement/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$advertisement_right_image_name = $img_Name;
								}
							}
						}
					}
					$this->Advertisement_Model->update_advertisement($_POST, $advertisement_id, $advertisement_left_image_name,$advertisement_right_image_name);
				} else {
					$advertisement = $this->General_Model->get_home_page_settings();
					$advertisement['advertisement_list'] = $this->Advertisement_Model->get_advertisement_list($advertisement_id);
					$this->load->view('advertisement/edit_advertisement', $advertisement);
				}
			}
            redirect('advertisement/advertisement_list', 'refresh');
        } else if ($advertisement_id != '') {
            redirect('advertisement/advertisement_list', 'refresh');
        } else {
            redirect('advertisement/advertisement_list', 'refresh');
        }
    }

}
