<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
class General extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('General_Model');
    }
    function load_cities() {
        $city = $this->General_Model->load_cities($_REQUEST['country_code'])->result();
        $city_sHtml = "";
        $city_sHtml .= '<option value="">Select City</option>';
        if (!empty($city)) {
            foreach ($city as $key => $value) {
                $city_sHtml .= '<option value="' . $value->cityName . ' |' . $value->cityCode . '">' . $value->cityName . '</option>';
            }
        }
        echo json_encode(array('load_cities' => $city_sHtml));
    }
    function get_hotel_cities() {
        ini_set('memory_limit', '-1');
        $term = $this->input->get('term');
        $term = trim(strip_tags($term));
        $cities = $this->General_Model->get_hotel_cities_list($term)->result();
        foreach ($cities as $city) {
            $apts['label'] = $city->city;
            $apts['value'] = $city->city;
            $apts['id'] = $city->id;
            $result[] = $apts;
        }
        echo json_encode($result);
    }
    
      function get_hotel_cities_polish() {
        ini_set('memory_limit', '-1');
        $term = $this->input->get('term');
        $term = trim(strip_tags($term));
        $cities = $this->General_Model->get_hotel_cities_polish($term)->result();
        foreach ($cities as $city) {
            $apts['label'] = $city->city_polish;
            $apts['value'] = $city->city_polish;
            $apts['id'] = $city->id;
            $result[] = $apts;
        }
        echo json_encode($result);
    }
    
	function get_terminals()
	{
		$city = $this->General_Model->get_city_terminals($_REQUEST['city_code']);
        $city_sHtml = "";
        $city_sHtml .= '<option value="">Select terminal</option>';
        if (!empty($city)) {
            foreach ($city as $key => $value) {
                $city_sHtml .= '<option value="' . $value->name . '|' . $value->code . '">' . $value->name . '</option>';
            }
        }
        echo json_encode(array('load_terminal' => $city_sHtml));
	}
	function get_terminal_hotels()
	{
		$terminal = $this->General_Model->get_terminal_hotels($_REQUEST['terminal_code']);
        $hotels_sHtml = "";
        $hotels_sHtml .= '<option value="">Select hotel</option>';
        if (!empty($terminal)) {
            foreach ($terminal as $key => $value) {
                $hotels_sHtml .= '<option value="' . $value->hotel_code . '">' . $value->hotel_name . '</option>';
            }
        }
        echo json_encode(array('load_hotel_terminal' => $hotels_sHtml));
	}
	
	
}

?>
