<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

// error_reporting(0)
class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('General_Model');
        $this->load->model('Banner_Model');
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

    function banner_list() {
        $banner = $this->General_Model->get_home_page_settings();
        $banner['banner_list'] = $this->Banner_Model->get_banner_list();
        $this->load->view('banner/banner_list', $banner);
    }

    function add_banner() {
        if (count($_POST) > 0) {
            $banner_logo_name = '';
            $this->form_validation->set_rules('title', 'Banner Name', 'required');
			$this->form_validation->set_rules('img_alt_text', 'Banner Image Alternate Text', 'required');
		//	$this->form_validation->set_rules('link', 'Banner URL', 'required');
			$this->form_validation->set_rules('position', 'Banner Position', 'required');
		//	$this->form_validation->set_rules('slogan_english', 'Banner Slogan English', 'required');
		//	$this->form_validation->set_rules('slogandesc_english', 'Banner Slogan Description English', 'required');
			if ($this->form_validation->run() == TRUE){
				if (!empty($_FILES['banner_logo']['name'])) {
					if (is_uploaded_file($_FILES['banner_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['banner_logo']['tmp_name'];
						$filename = $_FILES['banner_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name = time() . $_FILES['banner_logo']['name'];
							$targetPath = "uploads/banner/" . $img_Name;
							if (move_uploaded_file($sourcePath, $targetPath)) {
								$banner_logo_name = $img_Name;
							}
						}
					}
				}
				$this->Banner_Model->add_banner_details($_POST, $banner_logo_name);
				redirect('banner/banner_list', 'refresh');
			} else {
				$banner = $this->General_Model->get_home_page_settings();
				$this->load->view('banner/add_banner', $banner);
			}
        } else {
            $banner = $this->General_Model->get_home_page_settings();
            $this->load->view('banner/add_banner', $banner);
        }
    }

    function active_banner($banner_id) {
		$banner_id = json_decode(base64_decode($banner_id));
		if($banner_id != ''){
			$this->Banner_Model->active_banner($banner_id);
		}
        redirect('banner/banner_list', 'refresh');
    }

    function inactive_banner($banner_id) {
		$banner_id = json_decode(base64_decode($banner_id));
		if($banner_id != ''){
			$this->Banner_Model->inactive_banner($banner_id);
		}
        redirect('banner/banner_list', 'refresh');
    }

    function delete_banner($banner_id) {
		$banner_id = json_decode(base64_decode($banner_id));
		if($banner_id != ''){
			$this->Banner_Model->delete_banner($banner_id);
		}
        redirect('banner/banner_list', 'refresh');
    }

    function edit_banner($banner_id) {
		$banner_id = json_decode(base64_decode($banner_id));
		if($banner_id != ''){
			$banner = $this->General_Model->get_home_page_settings();
			$banner['banner_list'] = $this->Banner_Model->get_banner_list($banner_id);
			$this->load->view('banner/edit_banner', $banner);
		} else {
			redirect('banner/banner_list', 'refresh');
		}
    }

    function update_banner($banner_id) {
		//echo"<pre/>";print_r($_POST); exit;
        if (count($_POST) > 0) {
			$banner_id = json_decode(base64_decode($banner_id));
			if($banner_id != ''){
				$banner_logo_name = $_REQUEST['banner_logo_old'];
				$this->form_validation->set_rules('title', 'Banner Name', 'required');
				$this->form_validation->set_rules('img_alt_text', 'Banner Image Alternate Text', 'required');
				//$this->form_validation->set_rules('link', 'Banner URL', 'required');
				$this->form_validation->set_rules('position', 'Banner Position', 'required');
			//	$this->form_validation->set_rules('slogan_english', 'Banner Slogan English', 'required');
			//	$this->form_validation->set_rules('slogandesc_english', 'Banner Slogan Description English', 'required');
				if ($this->form_validation->run() == TRUE){
					if (!empty($_FILES['banner_logo']['name'])) {
						if (is_uploaded_file($_FILES['banner_logo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/banner/" . $banner_logo_name;
							unlink($oldImage);
							$sourcePath = $_FILES['banner_logo']['tmp_name'];
							$filename = $_FILES['banner_logo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name = time() . $_FILES['banner_logo']['name'];
								$targetPath = "uploads/banner/" . $img_Name;
								if (move_uploaded_file($sourcePath, $targetPath)) {
									$banner_logo_name = $img_Name;
								}
							}
						}
					}
					$this->Banner_Model->update_banner($_POST, $banner_id, $banner_logo_name);
				} else {
					$banner = $this->General_Model->get_home_page_settings();
					$banner['banner_list'] = $this->Banner_Model->get_banner_list($banner_id);
					$this->load->view('banner/edit_banner', $banner);
				}
			}
            redirect('banner/banner_list', 'refresh');
        } else if ($banner_id != '') {
            redirect('banner/banner_list', 'refresh');
        } else {
            redirect('banner/banner_list', 'refresh');
        }
    }

}
