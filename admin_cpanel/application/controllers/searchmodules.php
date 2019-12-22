<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

// error_reporting(0)
class Searchmodules extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('General_Model');
        $this->load->model('Searchmodule_Model');
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

    function index() {
        $header = $this->General_Model->get_home_page_settings();
        $module_lists['module_list'] = $this->Searchmodule_Model->get_search_module_list();
        $this->load->view('search_modules/module_list', $module_lists);
    }

    function module_list() {
        $header = $this->General_Model->get_home_page_settings();
        $module_lists['module_list'] = $this->Searchmodule_Model->get_search_module_list();
        $this->load->view('search_modules/module_list', $module_lists);
    }

    function add_module() {
        if (count($_POST) > 0) {
            $this->Searchmodule_Model->add_module_details($_POST);
            redirect('searchmodules/module_list', 'refresh');
        } else {
            $module = $this->General_Model->get_home_page_settings();
            $this->load->view('search_modules/add_module', $module);
        }
    }

    function active_module($id) {
        $this->Searchmodule_Model->active_module($id);
        redirect('searchmodules/module_list', 'refresh');
    }

    function inactive_module($id) {
        $this->Searchmodule_Model->inactive_module($id);
        redirect('searchmodules/module_list', 'refresh');
    }

    function delete_module($id) {
        $this->Searchmodule_Model->delete_module($id);
        redirect('searchmodules/module_list', 'refresh');
    }

    function edit_module($id) {
        $module = $this->General_Model->get_home_page_settings();
        $module['module_list'] = $this->Searchmodule_Model->get_search_module_list($id);
        $this->load->view('search_modules/edit_module', $module);
    }

    function update_module($id) {
        if (count($_POST) > 0) {
            $this->Searchmodule_Model->update_module_details($_POST, $id);
            redirect('searchmodules/module_list', 'refresh');
        } else if ($id != '') {
            redirect('searchmodules/edit_module/' . $id, 'refresh');
        } else {
            redirect('searchmodules/module_list', 'refresh');
        }
    }
}
